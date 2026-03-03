<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tool;
use App\Models\loan;
use App\Models\User;
use \App\Models\ActivityLog;
//use App\Models\Borrower;
use App\Http\Controllers\Controller;
//use ilum.supp.fas.db n auth
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//use carb/carb
use Carbon\Carbon;

class LoanController extends Controller
{
    //
    public function adminIndex()
    {
        //   data by class bor, tool, lat get
        $loans = loan::with(['borrower', 'tool', 'approver'])->latest()->paginate(5);
        return view('admin.loans.index', compact('loans'));
    }

    public function petugasIndex()
    {
        //    $ tools = tool:wher(stok,>,0)>get()
        //get req item
        $tools = tool::where('stock', '>', 0)->get();
        //    $ loan  = loan:wher(us_id, auth::id())>with('tool')>last()>get()
        //   data by class bor, tool, lat get
        $loans = loan::with(['borrower', 'tool'])->latest()->get();
        // ret view (pem.ind, comp var)
        return view('petugas.index', compact('tools', 'loans'));
    }

   public function peminjamIndex() {
    $borrowerId = Auth::id();
    // Ambil yang statusnya 'pending' atau 'borrow'
    $myloan = loan::where('borrower_id', $borrowerId)
                ->whereIn('status', ['pending', 'borrow', 'return'])
                ->with('tool')
                ->latest()
                ->get();
    return view('peminjam.index', compact('myloan'));
}

public function peminjamHistory() {
    $borrowerId = Auth::id();
    $history = loan::where('borrower_id', $borrowerId)
                ->where('status', 'return')
                ->with('tool')
                ->latest()
                ->get();
    return view('peminjam.return', compact('history'));
}
public function peminjamCreate() {
    $user = Auth::user();
    
    // Cek kolom nama/kelas di tabel borrowers sudah terisi
    if (!$user->borrower || empty($user->borrower->name) || empty($user->borrower->no_hp)) {
        return redirect()->route('profile.show', $user->id)
            ->with('info', 'please complete your detail acccount.');
    }

    $tools = tool::where('stock', '>', 0)->get();
    return view('peminjam.loan', compact('tools'));
}
    public function create()
    {
        // cek role whres user
        // conf
        $users = User::where('role', '=', 'borrower')->get();
        // get tool whers stock
        $tools = tool::where('stock', '>', 0)->get();

        return view('admin.loans.create', compact('users', 'tools'));
    }


    public function store(Request $request)
    {
        // valid tool id need
        $request->validate([
'tool_id' => 'required',
'qty' => 'required|integer|min:1'
]);

        // start store
        DB::beginTransaction();
        // try the case
        try {
            $tool = tool::findOrFail($request->tool_id);
            $qtyInput = $request->qty ?? 1;
            if ($tool->stock < $qtyInput) {
            return back()->with('error', 'Stok tidak mencukupi! Sisa stok: ' . $tool->stock);
        }
            // get tool id

            // ret
            if ($tool->stock <= 0) return back()->with('error', 'Stok habis!');

            // logic get ID n usn
            $borrowerId = $request->has('user_id') ? $request->user_id : Auth::id();

            // tool->decr(stock )
            //$tool->decrement('stock');
            $dueDate = Carbon::now()->addDays(1);
            //create loan([loan row])
            // $loan = 
            loan::create([
                //if thres no usr_id, get aut id
                'borrower_id' => $borrowerId,
                'tool_id' => $tool->id,
                'due_date'    => $dueDate, // SOLUSI ERROR TADI
                'qty'         => $qtyInput, // Menangani multistock
                'status'      => 'pending',
                'loan_date' => Carbon::now()
            ]);

            // LOGGING
            /* Catatan: Stok JANGAN dikurangi di sini (store),
        ActivityLog::create([
            'data' => "[PINJAM] $borrowerName meminjam alat: $tool->name_tools (ID Pinjam: $loan->id)"
        ]);
*/
            //com all data
            DB::commit();
            return back()->with('success', 'Berhasil meminjam!');
        } catch (\Exception $e) {
            //db rb
            DB::rollback();
            //dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function approve($id)
    {
        // $user = Auth::user();
        //    loan = loan:finfil(id)
        // conf
        $loan = loan::with('borrower', 'tool')->findOrFail($id);
        //loan > upd =([ status boro, admin id =>  id()])
            $tool = tool::findOrFail($loan->tool_id);
        // login, Cek guard
        $approver = Auth::user();

//cond
        if ($tool->stock < $loan->qty) {
        return back()->with('error', 'Stok sudah tidak mencukupi untuk disetujui.');
    }
        // res
        $loan->update([
            'status' => 'borrow',
            'approved_by' => $approver->id,
        ]);

        // LOGGING
        // ActivityLog::create([
        //     'data' => "[APPROVE] 
        // Alat $loan->tool->name_tools 
        // (Data Pinjam ID: $id) 
        // di-acc $approver->username 
        // untuk $loan->borrower->username"
        // ]);

        return back()->with('success', ' telah diserahkan ke peminjam.');
    }

    public function returnTool($id)
    {
        // start func
        DB::beginTransaction();
        try {
            // conf
            $loan = loan::findOrFail($id);
            $user = Auth::user();
            $tool = tool::findOrFail($loan->tool_id);

            // car loan obj - loandate
            $loandate = Carbon::parse($loan->loan_date);
            // car now
            $returndate = Carbon::now();
            // $selisih = $loandate->diffInDays($returndate);

            // $denda = 0;

            // // cond
            // if($selisih > 3) {
            //     $denda = ($selisih - 3) *  1000;
            // }
            $result = DB::select("SELECT hitung_denda(?, ?, ? , ?) as total_denda", [
                $loan->tool_id,
                $loan->qty,
                $loan->due_date,
                $returndate
            ]);
            $denda = $result[0]->total_denda;
            // res
            $loan->update([
                'return_date' => $returndate,
                'status' => 'return',
                'penalty' => $denda,
                'approved_by' => $user->id,
            ]);

            // res 1
            //$tool->increment('stock');

            // comm
            DB::statement("CALL sp_log_activity(?)", [
                "Alat ID {$tool->id} dikembalikan oleh Peminjam ID {$loan->borrower_id}. Denda: Rp {$denda}"
            ]);
            DB::commit();
            return back()->with('success', 'Berhasil return!');
        } catch (\Exception $e) {
            // rb m ge tmsg
            DB::rollback();
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function report(Request $request)
    {
        // cont get data
        $query = loan::with(['borrower', 'tool']);

        //  simple filter  if there a req
        // 
         if ($request->status) {
             $query->where('status', $request->status);
         }

       $query->when($request->username, function ($q) use ($request) {
        return $q->whereHas('borrower', function ($userQuery) use ($request) {
            $userQuery->where('username', 'like', '%' . $request->username . '%');
        });
    });

        $query->when($request->start_date && $request->end_date, function ($q) use ($request) {
            return $q->whereBetween('loan_date', [$request->start_date, $request->end_date]);
        });

        $reports = $query->latest()->get();
        return view('petugas.report', compact('reports'));
    }

    public function edit($id)
    {
        // conf 
        $loan = loan::with(['borrower', 'tool'])->findOrFail($id);
        $users = User::where('role', 'borrower')->get();
        $tools = tool::all();
        // ret
        return view('admin.loans.edit', compact('loan', 'users', 'tools'));
    }

    public function update(Request $request, $id)
    {
        // conf
        $loan = loan::findOrFail($id);
        $user = Auth::user();
        // if (!$user) {
        //     $user = Auth::user();
        // }

        // cond
        if (!$user) return redirect()->route('login')->with('error', 'Login!');

        if ($request->has('action') && $request->action == 'return') {
            return $this->returnTool($id);
        }

        $data = $request->all();
        // rew
        $data['approved_by'] = $user->id;
        // res
        $loan->update($data);
        return redirect()->route('admin.loans.index')->with('success', 'Data peminjaman diperbarui.');
    }

    public function destroy($id)
    {
        // conf
        $loan = loan::findOrFail($id);
        // condition - stock, stock++
//        if ($loan->status != 'return') {
//            // inc
//            tool::where('id', $loan->tool_id)->increment('stock');
//        }
//
        // res
        $loan->delete();
        return back()->with('success', 'Data transaksi dihapus & stok disesuaikan.');
    }

    public function requestReturn($id)
{
    $loan = loan::findOrFail($id);

    if ($loan->borrower_id != Auth::id()) {
        return back()->with('error', 'Tidak diizinkan.');
    }

    if ($loan->status === 'borrow' && !$loan->request_return_date) {
        $loan->update([
            'request_return_date' => Carbon::now()
        ]);

        return back()->with('success', 'Permintaan pengembalian dikirim. Tunggu verifikasi petugas.');
    }

    return back()->with('error', 'Permintaan sudah diajukan atau tidak valid.');
}

}
