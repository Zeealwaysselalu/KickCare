<?php

namespace App\Http\Controllers;

use App\Models\{Outlet, Transaction, User, DetailTransaction, TransactionItem};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $dataTransaction = Transaction::with([
            'outlet',
            'transaction_item',
            'detail_transaction'
        ])->where('user_id', Auth::id())->latest()->get();

        return view('profile.role.user.order', [
            'allTransactions' => $dataTransaction
        ]);
    }

    public function create(Request $request)
    {
        $allOutlet = Outlet::all();
        $selectedService = $request->service;
        return view('profile.role.user.transaction', compact('selectedService', 'allOutlet'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'customer_name' => 'required|string|max:255',
            'shoes_name' => 'required|string|max:255',
            'service' => 'required|in:wash,unyellowing,repaint',
            'shoes_color' => 'nullable|string|max:255',
        ]);

        return DB::transaction(function () use ($request) {
            $user = Auth::user();

            // 1. HITUNG HARGA AMAN (Server Side)
            $prices = [
                'wash' => 65000,
                'unyellowing' => 80000,
                'repaint' => 150000
            ];

            $basePrice = $prices[$request->service];
            $discountPercent = 0;

            // Sesuaikan dengan logic Benefit Page
            if ($user->status_member === 'bronze') $discountPercent = 0.05;
            elseif ($user->status_member === 'silver') $discountPercent = 0.10;
            elseif ($user->status_member === 'gold') $discountPercent = 0.20;

            $discountAmount = $basePrice * $discountPercent;
            $finalPrice = $basePrice - $discountAmount;

            // 2. GENERATE KODE TRANSAKSI
            $today = now()->format('Ymd');
            $lastTransaction = Transaction::whereDate('created_at', now()->today())
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = $lastTransaction
                ? str_pad((int)substr($lastTransaction->transaction_code, -4) + 1, 4, '0', STR_PAD_LEFT)
                : '0001';

            $transactionCode = 'KC-' . $today . '-' . $nextNumber;

            // 3. SIMPAN DATA
            $transaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'outlet_id' => $request->outlet_id,
                'user_id' => $user->id,
                'total_price' => $finalPrice, // Pakai hasil hitungan server
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'customer_name' => $request->customer_name,
                'shoes_name' => $request->shoes_name,
                'shoes_color' => $request->shoes_color,
                'service' => $request->service,
            ]);

            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'status' => 'pending',
                'progress_status' => 'pending',
            ]);

            // 4. LOGIKA UPGRADE MEMBER (Opsional: Hitung transaksi yang sudah selesai)
            $completedCount = Transaction::where('user_id', $user->id)
                ->whereHas('detail_transaction', function ($q) {
                    $q->where('status', 'completed');
                })->count();

            if ($completedCount >= 20) {
                User::where('id', $user->id)->update(['status_member' => 'gold']);
            } elseif ($completedCount >= 10) {
                User::where('id', $user->id)->update(['status_member' => 'silver']);
            }

            return redirect()->route('pesanan')
                ->with('success', 'Pesanan ' . $transactionCode . ' berhasil dibuat!');
        });
    }

    public function show(string $id)
    {
        $transaction = Transaction::with([
            'outlet',
            'transaction_item',
            'detail_transaction'
        ])->findOrFail($id);

        if (request()->ajax()) {
            return view('components.show-transaction', compact('transaction'))->render();
        }

        return view('profile.role.user.order', compact('transaction'));
    }

    public function cancel(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $transaction = Transaction::with('detail_transaction')->findOrFail($id);

            if ($transaction->user_id !== Auth::id()) {
                abort(403);
            }

            $detail = $transaction->detail_transaction;

            if ($detail->status !== 'pending') {
                return back()->with('error', 'Maaf, pesanan sudah diproses dan tidak bisa dibatalkan.');
            }

            $detail->update([
                'status' => 'cancelled',
                'progress_status' => 'cancelled',
                'cancel_reason' => $request->cancel_reason
            ]);

            $user = Auth::user();
            $completedCount = Transaction::where('user_id', $user->id)
                ->whereHas('detail_transaction', function ($q) {
                    $q->where('status', 'completed');
                })->count();

            if ($completedCount >= 20) {
                User::where('id', $user->id)->update(['status_member' => 'gold']);
            } elseif ($completedCount >= 10) {
                User::where('id', $user->id)->update(['status_member' => 'silver']);
            } else {
                User::where('id', $user->id)->update(['status_member' => 'bronze']);
            }

            return redirect()->route('pesanan')
                ->with('success', 'Pesanan dibatalkan. Progres member Anda telah diperbarui.');
        });
    }
}
