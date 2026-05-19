<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Menampilkan Form Pembayaran
     */
    public function show($id)
    {
        $transaction = Transaction::with(['transaction_item', 'detail_transaction'])->findOrFail($id);

        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Akses tidak sah.');
        }

        if ($transaction->detail_transaction->progress_status !== 'paying') {
            return redirect()->route('pesanan')->with('error', 'Pesanan ini tidak memerlukan pembayaran saat ini.');
        }

        return view('profile.role.user.payment', compact('transaction'));
    }

    /**
     * Memproses Eksekusi Pembayaran Menggunakan Saldo
     */
    public function process(Request $request, $id)
    {
        // Karena QRIS ditahan di front-end, request yang masuk ke sini wajib 'balance'
        $request->validate([
            'payment_mock' => 'required|in:balance',
        ]);

        $transaction = Transaction::with('detail_transaction')->findOrFail($id);
        $user = Auth::user();

        if ($transaction->user_id !== $user->id || $transaction->detail_transaction->progress_status !== 'paying') {
            abort(403, 'Proses pembayaran ditolak.');
        }

        // Jalankan pemotongan Saldo Akun
        if ($user->balance < $transaction->total_price) {
            return redirect()->back()->with('error', 'Gagal memproses. Saldo Anda tidak mencukupi.');
        }

        DB::transaction(function () use ($user, $transaction) {
            // 1. Potong Saldo Akun User
            $user->decrement('balance', $transaction->total_price);

            // 2. Naikkan status transaksi menjadi 'pending'
            $transaction->detail_transaction->update([
                'progress_status' => 'pending',
            ]);
        });

        return redirect()->route('pesanan')->with('success', 'Pembayaran via Saldo Akun berhasil dipotong otomatis!');
    }
}
