<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\ToolController;      
use App\Http\Controllers\CategoryController;  
use App\Http\Controllers\LoanController;  
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityLogController;

//route get [authc class] -> name
// Halaman Landing / Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth Routes
Route::get('/login', [authController::class, 'showlogin'])->name('login');
Route::post('/login', [authController::class, 'login'])->name('login.post');
Route::post('/logout', [authController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile.show');

    // cek role in contr 
    Route::put('/loans/return/{id}', [LoanController::class, 'returnTool'])->name('loans.return');
    Route::put('/loans/approve/{id}', [LoanController::class, 'approve'])->name('loans.approve');
    Route::post('/pinjam.store', [LoanController::class, 'store'])->name('pinjam.store');

Route::middleware(['role:officer,admin'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:admin'])->group(function () {

Route::resource('tools', ToolController::class);
Route::resource('users', UserController::class)->except(['create', 'store']);
Route::resource('category', CategoryController::class);

//ro get (role das, func () {ret viw(role.i); })->name rol das
Route::get('/admin/dashboard', function() { return view('admin.index');   })-> name('admin.dashboard');
Route::get('/admin/logs', [ActivityLogController::class, 'index'])->name('admin.logs.index');

Route::delete('/loans/{id}', [LoanController::class, 'destroy'])->name('loans.destroy');
Route::get('/admin/loans', [LoanController::class, 'adminIndex'])->name('admin.loans.index');
Route::get('/admin/loans/{id}/edit', [LoanController::class, 'edit'])->name('admin.loans.edit');
Route::get('/admin/loans/create', [LoanController::class, 'create'])->name('admin.loans.create');
//ro rescr for crud tool
Route::put('/admin/loans/{id}', [LoanController::class, 'update'])->name('admin.loans.update');
    
});

//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['role:officer'])->group(function () {
//ro get (role das, func () {ret viw(role.i); })->name rol das
Route::get('/officer/dashboard', [LoanController::class, 'petugasIndex'])->name('officer.dashboard');
Route::get('/officer/report', [LoanController::class, 'report'])->name('officer.report');

//Route::get('/officer/register-borrower', [UserController::class, 'create'])->name('officer.user.create');
//Route::post('/officer/register-borrower', [UserController::class, 'store'])->name('officer.user.store');
});



//ro midl([aut, 'role:']) ->group(func(){  })
Route::middleware(['auth', 'role:borrower'])->group(function () {
    // Menu 1: Dashboard / Status Pinjaman (Gimmick Return ada di sini)
    Route::get('/borrower/dashboard', [LoanController::class, 'peminjamIndex'])->name('borrower.dashboard');
    
    // Menu 2: Form Pinjam Alat
    Route::get('/borrower/pinjam', [LoanController::class, 'peminjamCreate'])->name('borrower.pinjam');
    
    // Menu 3: Riwayat Pengembalian
    Route::get('/borrower/history', [LoanController::class, 'peminjamHistory'])->name('borrower.history');

    Route::put('/profile/{id}/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/loans/request-return/{id}', [LoanController::class, 'requestReturn'])->name('loans.requestReturn');
});

});

