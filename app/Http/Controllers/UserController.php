<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Borrower;

class UserController extends Controller
{
// lower ver func
    /*private function getModel($role)
{
    return match ($role) {
        'admin' => \App\Models\Admin::class,
        'officer' => \App\Models\Officer::class,
        'borrower' => \App\Models\Borrower::class,
        default => abort(404, "Role tidak valid"),
    };
}*/
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all comp user
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //ret
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //valid 
        $rules = [
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];
    
        if (auth()->user()->role === 'admin') {
        $rules['role'] = 'required|in:admin,officer,borrower';
        } else if (auth()->user()->role === 'officer') {
        $rules['role'] = 'required|in:officer,borrower';
        }
        
        $validated = $request->validate($rules);

        $finalRole = $validated['role'] ?? 'borrower';

        //create data
       User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($request->password),
        'role' => $finalRole,
    ]);

    if (auth()->user()->role === 'admin') {
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    return redirect()->route('officer.dashboard')->with('success', 'Peminjam berhasil diregistrasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id, Request $request)
    {

        //lower ver var
        //$modelName = $this->getModel($role);
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($user->role === 'admin' && $request->role !== 'admin') {
        return back()->with('error', 'Role Admin tidak boleh diubah menjadi role lain!');
    }

    // rules dasar
    $rules = [
        'username' => 'required|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
    ];

    // password optional
    if ($request->filled('password')) {
        $rules['password'] = 'string|min:8|confirmed';
    }

    // role hanya diizinkan untuk non-admin
    if ($user->role !== 'admin') {
        $rules['role'] = 'required|in:borrower,officer,admin';
    }

    $validated = $request->validate($rules);

    $user->username = $validated['username'];
    $user->email = $validated['email'];

    if (isset($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    if (isset($validated['role'])) {
        $user->role = $validated['role'];
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
}


   public function destroy(Request $request, $id)
{
    $user = User::findOrFail($id);
    if ($user->id === auth()->id()) {
        return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
    }
    $hasActiveLoans = $user->loans()->exists(); 

    if ($hasActiveLoans) {
        return back()->with('error', 'User tidak bisa dihapus karena memiliki riwayat atau transaksi peminjaman!');
    }

    // Jika lolos pengecekan, hapus user
    $user->delete();
    
    return back()->with('success', 'User berhasil dihapus');
}

public function showProfile($id)
{
    $user = User::with('Borrower')->findOrFail($id);
    
    // Logic View : it own
    $isOwner = (auth()->id() == $id);
    
    // role up view logic
    $isStaff = in_array(auth()->user()->role, ['admin', 'officer']);

    // protec
    if (!$isOwner && !$isStaff) {
        return redirect()->back()->with('error', 'error cannt view another profile except you.');
    }

    return view('profile.show', compact('user', 'isOwner', 'isStaff'));
}

public function updateProfile(Request $request, $id)
{
    // protec
    if (auth()->id() != $id) {
        abort(403, 'Unauthorized action.');
    }

//valid
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:250',
        'no_hp' => 'required|numeric',
    ]);

    
    // updateOrCreate   
    Borrower::updateOrCreate(
        ['user_id' => $id], // for key
        [
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ] 
    );

    return redirect()->back()->with('success', 'Profile updated successfully! Sekarang kamu bisa meminjam alat.');
}
}
