<?php

namespace App\Http\Controllers;
//use ilmuna/ http/ req, ilumna/supp/fasc/auth
use Illuminate\Support\Facades\Auth; // conf auth user, prov as mod, guard as gate
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ActivityLog;
use App\Models\User;

class authController extends Controller
{
    //
public function showlogin()
    {
        //
    return view('auth.login');
    }

//req param
//$ validt, if credentials auth attmp, regret sesio, =>
// $ role, role return
// else back

public function login(Request $request) {
    // conf
    // valid inp
    $credentials = $request->only('username', 'password');

//    $role = $request->role; // 'admin', 'officer',  'borrower'
//$roleValid = ['admin', 'officer', 'borrower'];

// loc
//if(!in_array($role, $roleValid)){
//return back()->with('eror', 'choose role or role invalid');
//}

    // guard on $, att $
    //req ses genert
if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();
        $role = $user->role;
        $msg = "[AUTH] User [ id : " . $user->id . " ] dengan [ usn : ". $request->username. "] login sebagai [" . strtoupper($role) . "]";

//if($role == 'admin') {
//$msg  = "bos ada yang mantau";
//};

// resl
ActivityLog::create([
            'data' => $msg
        ]);


        // Redirect rel $ role
//Route::get('/admin/logs', [ActivityLogController::class, 'index'])->name('admin.logs.index');
/*if ($role == 'admin'){
        return redirect()->route('admin.logs.index');    
    } else {
        }*/

        // red
return redirect()->route($role . '.dashboard');
   }
    return back()->with('error', 'Login fail, ' . $request->username . ' doesnt registered in database or wrong password ');
}

public function logout(Request $request) {
   Auth::logout();
    return redirect()->route('login');

//    $request->session()->invalidate();
  //  $request->session()->regenerateToken();
// red
    return redirect()->route('login');
    }
}
