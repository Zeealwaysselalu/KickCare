<?php

use Illuminate\Support\Facades\{Auth, Route};

use App\Http\Controllers\{AdminController, ComplaintMessageController, OutletController, ProfileController, TransactionController};
use App\Models\Transaction;

// Public Routes
Route::get('/', fn() => view('welcome1'));
Route::get('/wel', fn() => view('welcome1'));
Route::get('/bar', fn() => view('testbarcode'));
Route::get('/status', fn() => view('cekstatus'));

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        if ($role == 'administrator') {
            return app(AdminController::class)->index(request());
        }
        if ($role == 'cashier') {
            return app(OutletController::class)->index(request());
        }
        if ($role === 'user') {
            $dataprofil = Auth::user();
            $latestTransactions = Transaction::with(['transaction_item', 'detail_transaction'])
                ->where('user_id', Auth::id())
                ->latest()->take(5)->get();
            return view('profile.role.user.dashboard', compact('dataprofil', 'latestTransactions'));
        }
    })->name('dashboard');

    Route::get('/service', [ComplaintMessageController::class, 'index'])->name('service');
    Route::post('/service/create', [ComplaintMessageController::class, 'store'])->name('service.store');

    Route::get('/transaksi', [TransactionController::class, 'index'])->name('pesanan');
    Route::get('/transaksi/{id}', [TransactionController::class, 'show'])->name('transaksi.show');
    Route::get('/transaction', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/cashier/transactions', [TransactionController::class, 'storeByCashier'])->name('transactions.cashier.store');
    Route::patch('/transaction/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::post('/kasir/approve/{id}', [TransactionController::class, 'approve'])->name('kasir.approve');
    Route::post('/transactions/{id}/update-progress', [TransactionController::class, 'updateProgress'])->name('transactions.update-progress');

    Route::get('/benefits', function () {
        $countTransaction = Transaction::where('user_id', Auth::id())->count();
        return view('profile.role.user.benefits', compact('countTransaction'));
    })->name('benefits');

    Route::get('/about', fn() => view('profile.role.user.about'))->name('about');
    Route::get('/api/find-user', [ProfileController::class, 'findUser'])->name('api.find-user');

    Route::get('/admin/outlets', [OutletController::class, 'listAllOutlets'])->name('admin.outlets.index');
    Route::get('/admin/outlets/create', [OutletController::class, 'create'])->name('admin.outlets.create');
    Route::post('/admin/outlets/store', [OutletController::class, 'store'])->name('admin.outlets.store');
    Route::delete('/admin/outlets/{id}/destroy', [OutletController::class, 'destroy'])->name('admin.outlets.destroy');
    Route::get('/admin/outlets/{id}/edit', [OutletController::class, 'edit'])->name('admin.outlets.edit');
    Route::put('/admin/outlets/{id}', [OutletController::class, 'update'])->name('admin.outlets.update');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
