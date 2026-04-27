<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Models\Outlet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome1');
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

Route::get('/benefits', function () {
    return view('profile.role.user.benefits');
})->middleware(['auth', 'verified'])->name('benefits');

Route::get('/about', function () {
    return view('profile.role.user.about');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/service', function () {
    return view('profile.role.user.customer-service');
})->middleware(['auth', 'verified'])->name('service');

Route::get('/pesanan', function () {
    return view('profile.role.user.order')
        ->with('allTransactions', Transaction::where('user_id', Auth::id())->latest()->get());
})->middleware(['auth', 'verified'])->name('pesanan');

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
            ->with('latestTransactions', Transaction::where('user_id', Auth::id())->latest()->take(5)->get());
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transaksi/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->middleware(['auth', 'verified'])->name('transaksi.show');

Route::middleware('auth')->group(function(){
    Route::get('/transaction', [TransactionController::class, 'create'])
    ->name('transactions.create');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transactions.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
