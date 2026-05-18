<?php

use Illuminate\Support\Facades\{Auth, Mail, Route};

use App\Http\Controllers\{AdminController, ComplaintMessageController, OutletController, ProfileController, SearchController, TransactionController, UserController};
use App\Models\Transaction;

// Public Routes
Route::get('/', fn() => view('welcome1'));
Route::get('/wel', fn() => view('welcome1'));
Route::get('/bar', fn() => view('testbarcode'));
Route::get('/status', [SearchController::class, 'index'])->name('cekstatus');
Route::get('/preview-invoice', function () {
    $transaction = Transaction::with(['transaction_item', 'detail_transaction'])->latest()->first();
    if (!$transaction) {
        return "Belum ada data transaksi di database. Buat satu dulu bos!";
    }
    return view('mail.invoice-mail', compact('transaction'));
});
Route::get('/test-mail', function () {
    $transaction = App\Models\Transaction::with(['transaction_item', 'detail_transaction', 'user'])->latest()->first();
    if (!$transaction) {
        return "Belum ada data transaksi di database!";
    }
    $emailTujuan = Auth::check() ? Auth::user()->email : 'your-email@example.com';
    try {
        Mail::to($emailTujuan)->send(new App\Mail\InvoiceMail($transaction));
        return "Email berhasil dikirim ke: " . $emailTujuan;
    } catch (\Exception $e) {
        return "Gagal kirim email. Error: " . $e->getMessage();
    }
});


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
    Route::get('/transaction-order', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transaction-order/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transaction-order/payment/{id}', [TransactionController::class, 'payment'])->name('transactions.payment');
    Route::post('/cashier/transactions-order', [TransactionController::class, 'storeByCashier'])->name('transactions.cashier.store');
    Route::patch('/transaction-order/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::post('/kasir/approve/{id}', [TransactionController::class, 'approve'])->name('kasir.approve');
    Route::post('/transaction-order/{id}/update-progress', [TransactionController::class, 'updateProgress'])->name('transactions.update-progress');

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
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::delete('/admin/users/{id}/destroy', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
