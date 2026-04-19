<?php

use App\Http\Controllers\ProfileController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wel', function () {
    return view('welcome1');
});

Route::get('/bar', function () {
    return view('testbarcode');
});

Route::get('/status', function () {
    return view('cekstatus');
});

Route::get('/dashboard1', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == 'administrator') {
        return view('profile.role.admin.dashboard');
    }
    if ($role == 'cashier') {
        return view('profile.role.cashier.dashboard');
    }
    if ($role == 'user') {
        return view('profile.role.user.dashboard')
            ->with('allTransactions', Transaction::where('user_id', Auth::id())->get());
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
