<?php

use Illuminate\Support\Facades\{Auth, Route};

use App\Http\Controllers\{OutletController, ProfileController, TransactionController};
use App\Models\{Outlet, Transaction};

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

Route::get('/transaksi', [App\Http\Controllers\TransactionController::class, 'index'])->middleware(['auth', 'verified'])->name('pesanan');

Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    if ($role == 'administrator') {
        return view('profile.role.admin.dashboard');
    }
    if ($role == 'cashier') {
        return app(OutletController::class)->index();
        }
    if ($role === 'user') {
        $latestTransactions = Transaction::with(['transaction_item'])
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('profile.role.user.dashboard')
            ->with('latestTransactions', $latestTransactions);
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transaksi/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->middleware(['auth', 'verified'])->name('transaksi.show');
Route::patch('/transaction/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');

Route::middleware('auth')->group(function () {
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
