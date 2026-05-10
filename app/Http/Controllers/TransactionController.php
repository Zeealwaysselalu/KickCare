<?php

namespace App\Http\Controllers;

use App\Models\{Outlet, Transaction};
use App\Models\TransactionItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DetailTransaction;

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
        if (Auth::User()->role === "cashier") {
            return view('profile.role.cashier.transaction', compact('selectedService', 'allOutlet'));
        } elseif (Auth::User()->role === "user") {
            return view('profile.role.user.transaction', compact('selectedService', 'allOutlet'));
        }
    }

    public function findUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'success' => true,
                'name' => $user->name,
                'status_member' => $user->status_member ?? 'none'
            ]);
        }

        return response()->json(['success' => false, 'message' => 'User tidak ditemukan']);
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
                'progress_status' => 'waiting',
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

    // Method baru khusus Kasir
    public function storeByCashier(Request $request)
    {
        $outlet = Outlet::where('user_id', Auth::id())->first();
        $request->validate([
            'customer_name' => 'required',
            'shoes_name'    => 'required',
            'shoes_color'   => 'required',
            'service'       => 'required',
        ]);

        $prices = ['wash' => 65000, 'unyellowing' => 80000, 'repaint' => 150000];
        $basePrice = $prices[$request->service] ?? 0;

        $userId = null;
        $discountRate = 0;
        if ($request->has_account == 'yes' && $request->email) {
            $user = \App\Models\User::where('email', $request->email)->first();
            if ($user) {
                $userId = $user->id;
                $rates = ['gold' => 0.20, 'silver' => 0.10, 'bronze' => 0.05];
                $discountRate = $rates[strtolower($user->status_member)] ?? 0;
            }
        }

        $today = now()->format('Ymd');
        $lastTransaction = Transaction::whereDate('created_at', now()->today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTransaction) {
            $lastNumber = substr($lastTransaction->transaction_code, -4);
            $nextNumber = str_pad((int)$lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0001';
        }

        $transactionCode = 'KC-' . $today . '-' . $nextNumber;

        $finalPrice = $basePrice - ($basePrice * $discountRate);

        DB::transaction(function () use ($request, $finalPrice, $userId, $transactionCode, $outlet) {
            $transaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'user_id'          => $userId,
                'outlet_id'        => $outlet->id,
                'total_price'      => $finalPrice,
                'status'           => 'pending',
                'payment_status'   => 'paid',
            ]);

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'customer_name'  => $request->customer_name,
                'shoes_name'     => $request->shoes_name,
                'shoes_color'    => $request->shoes_color,
                'service'        => $request->service,
                'price'          => $finalPrice,
            ]);

            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'status' => 'pending',
                'progress_status' => 'pending',
                'cancel_reason' => null,
            ]);
        });

        return redirect()->back()->with('success', 'Pesanan Kasir Berhasil Dicatat!');
    }

    /**
     * Display the specified resource.
     */
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

            if ($detail->progress_status !== 'waiting') {
                return back()->with('error', 'Pesanan sudah diproses dan tidak dapat dibatalkan.');
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

    public function updateProgress(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $detail = $transaction->detail_transaction;

        // 1. Definisikan urutan progres
        $statusOrder = ['waiting', 'pending', 'sorting', 'washing', 'drying', 'ready', 'cleared'];

        $currentStatus = $detail->progress_status;
        $newStatus = $request->progress_status;

        $currentIndex = array_search($currentStatus, $statusOrder);
        $newIndex = array_search($newStatus, $statusOrder);

        // 2. Validasi Sisi Server: Jangan izinkan status mundur
        if ($newIndex <= $currentIndex) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak dapat dikembalikan ke tahap sebelumnya!'
            ], 422);
        }

        // 3. Update Status
        $detail->update([
            'progress_status' => $newStatus
        ]);

        // 4. Update status global jika sudah 'cleared' (opsional)
        if ($newStatus === 'cleared') {
            $detail->update(['status' => 'completed']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui ke ' . strtoupper($newStatus)
        ]);
    }

    public function approve($id)
    {
        // 1. Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // 2. Ambil detail transaksi (asumsi relasi bernama detail_transaction)
        $detail = $transaction->detail_transaction;

        // 3. Validasi: Pastikan hanya status 'waiting' yang bisa di-approve
        if ($detail->progress_status !== 'waiting') {
            return back()->with('error', 'Transaksi ini sudah diproses sebelumnya.');
        }

        // 4. Update status
        $detail->update([
            'status' => 'pending',          // Status global menjadi aktif
            'progress_status' => 'pending'  // Progres masuk ke tahap pertama (Pesanan Diterima)
        ]);

        // 5. Kembalikan dengan pesan sukses
        return back()->with('success', "Pesanan #{$transaction->transaction_code} berhasil diterima!");
    }
}
