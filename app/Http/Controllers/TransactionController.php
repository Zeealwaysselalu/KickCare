<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log, Mail};

use App\Mail\InvoiceMail;
use App\Models\{DetailTransaction, Outlet, Transaction, TransactionItem, User};

class TransactionController extends Controller
{
    public function index()
    {
        $dataTransaction = Transaction::with([
            'outlet',
            'transaction_item',
            'detail_transaction'
        ])->where('user_id', Auth::id())->latest()->get();

        return view('profile.role.user.transaction-history', [
            'allTransactions' => $dataTransaction
        ]);
    }

    public function create(Request $request)
    {
        $allOutlet = Outlet::all();
        $selectedService = $request->service;
        if (Auth::user()->role === "cashier") {
            return view('profile.role.cashier.transaction', compact('selectedService', 'allOutlet'));
        } elseif (Auth::user()->role === "user") {
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
            'payment_mock' => 'required|in:qris,balance',
        ]);

        // 1. Jalankan proses penyimpanan ke Database
        $transaction = DB::transaction(function () use ($request) {
            $user = Auth::user();

            $prices = [
                'wash' => 65000,
                'unyellowing' => 80000,
                'repaint' => 150000
            ];

            $basePrice = $prices[$request->service];
            $discountPercent = 0;

            if ($user->status_member === 'bronze') $discountPercent = 0.05;
            elseif ($user->status_member === 'silver') $discountPercent = 0.10;
            elseif ($user->status_member === 'gold') $discountPercent = 0.20;

            $finalPrice = $basePrice - ($basePrice * $discountPercent);

            // Generate Kode Transaksi
            $today = now()->format('Ymd');
            $lastTransaction = Transaction::whereDate('created_at', now()->today())
                ->orderBy('id', 'desc')
                ->first();

            $nextNumber = $lastTransaction
                ? str_pad((int)substr($lastTransaction->transaction_code, -4) + 1, 4, '0', STR_PAD_LEFT)
                : '0001';

            $transactionCode = 'KC-' . $today . '-' . $nextNumber;

            // Simpan Transaksi Utama
            $newTransaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'outlet_id' => $request->outlet_id,
                'user_id' => $user->id,
                'total_price' => $finalPrice,
            ]);

            // Simpan Item
            TransactionItem::create([
                'transaction_id' => $newTransaction->id,
                'customer_name' => $request->customer_name,
                'shoes_name' => $request->shoes_name,
                'shoes_color' => $request->shoes_color,
                'service' => $request->service,
                'price' => $finalPrice,
            ]);

            // LOGIC ATUR STATUS BERDASARKAN METODE PEMBAYARAN
            $isQris = $request->payment_mock === 'qris';

            DetailTransaction::create([
                'transaction_id' => $newTransaction->id,
                'status' => 'pending',
                'payment_method' => $request->payment_mock,
                'progress_status' => $isQris ? 'paying' : 'pending', // QRIS = paying, Balance = pending
            ]);

            return $newTransaction;
        }); // Kurung penutup closure DB::transaction yang benar

        // 2. Kirim Email Notifikasi secara Asinkronus/Background
        try {
            Mail::to(Auth::user()->email)->send(new InvoiceMail($transaction));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        // 3. Kembalikan respons sesuai dengan tipe request yang masuk (AJAX / Form biasa)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'payment_method' => $transaction->detail_transaction->payment_method,
                'transaction_code' => $transaction->transaction_code,
                'total_price' => $transaction->total_price,
                'redirect_url' => route('pesanan'),
                'message' => 'Pesanan berhasil dibuat!'
            ]);
        }

        // Fallback jika disubmit tanpa AJAX
        return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function storeByCashier(Request $request)
    {
        $outlet = Outlet::where('user_id', Auth::id())->first();

        $request->validate([
            'customer_name' => 'required',
            'shoes_name'    => 'required',
            'shoes_color'   => 'required',
            'service'       => 'required',
            'payment_method'=> 'nullable|in:qris,balance',
        ]);

        $data = DB::transaction(function () use ($request, $outlet) {
            $prices = ['wash' => 65000, 'unyellowing' => 80000, 'repaint' => 150000];
            $basePrice = $prices[$request->service] ?? 0;

            $userId = null;
            $discountRate = 0;
            $emailCustomer = null;

            if ($request->has_account == 'yes' && $request->email) {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    $userId = $user->id;
                    $emailCustomer = $user->email;
                    $rates = ['gold' => 0.20, 'silver' => 0.10, 'bronze' => 0.05];
                    $discountRate = $rates[strtolower($user->status_member)] ?? 0;
                }
            }

            $finalPrice = $basePrice - ($basePrice * $discountRate);

            $today = now()->format('Ymd');
            $lastTransaction = Transaction::whereDate('created_at', now()->today())->orderBy('id', 'desc')->first();
            $nextNumber = $lastTransaction ? str_pad((int)substr($lastTransaction->transaction_code, -4) + 1, 4, '0', STR_PAD_LEFT) : '0001';
            $transactionCode = 'KC-' . $today . '-' . $nextNumber;

            $newTransaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'user_id'          => $userId,
                'outlet_id'        => $outlet->id,
                'total_price'      => $finalPrice,
            ]);

            TransactionItem::create([
                'transaction_id' => $newTransaction->id,
                'customer_name'  => $request->customer_name,
                'shoes_name'     => $request->shoes_name,
                'shoes_color'    => $request->shoes_color,
                'service'        => $request->service,
                'price'          => $finalPrice,
            ]);

            DetailTransaction::create([
                'transaction_id' => $newTransaction->id,
                'status' => 'pending',
                'progress_status' => 'pending',
                'payment_method' => $request->payment_method ?? 'qris',
            ]);

            return ['transaction' => $newTransaction, 'email' => $emailCustomer];
        }); // Kurung penutup closure DB::transaction kasir yang benar

        if ($data['email']) {
            try {
                Mail::to($data['email'])->send(new InvoiceMail($data['transaction']));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Pesanan Kasir Berhasil Dicatat!');
    }

    public function cancel(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $transaction = Transaction::with('detail_transaction')->findOrFail($id);

            if ($transaction->user_id !== Auth::id()) {
                abort(403);
            }

            $detail = $transaction->detail_transaction;

            if ($detail->progress_status !== 'paying') {
                return back()->with('error', 'Pesanan sudah diproses dan tidak dapat dibatalkan.');
            }

            $detail->update([
                'status' => 'cancelled',
                'progress_status' => 'cancelled',
                'cancel_reason' => $request->cancel_reason,
            ]);

            return redirect()->route('pesanan')->with('success', 'Pesanan berhasil dibatalkan.');
        });
    }

    public function updateProgress(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $detail = $transaction->detail_transaction;

        $statusOrder = ['paying', 'pending', 'sorting', 'washing', 'drying', 'ready', 'cleared'];
        $currentIndex = array_search($detail->progress_status, $statusOrder);
        $newIndex = array_search($request->progress_status, $statusOrder);

        if ($newIndex <= $currentIndex) {
            return response()->json(['success' => false, 'message' => 'Status tidak dapat mundur!'], 422);
        }

        $detail->update(['progress_status' => $request->progress_status]);

        if ($request->progress_status === 'cleared') {
            $detail->update(['status' => 'completed']);
            $this->checkMemberUpgrade($transaction->user_id);
        }

        return response()->json(['success' => true, 'message' => 'Status diperbarui!']);
    }

    private function checkMemberUpgrade($userId)
    {
        if (!$userId) return;

        $user = User::find($userId);
        $completedCount = Transaction::where('user_id', $userId)
            ->whereHas('detail_transaction', fn($q) => $q->where('status', 'completed'))
            ->count();

        if ($completedCount >= 20) {
            $user->update(['status_member' => 'gold']);
        } elseif ($completedCount >= 10) {
            $user->update(['status_member' => 'silver']);
        } elseif ($completedCount >= 1) {
            if ($user->status_member === 'none' || !$user->status_member) {
                $user->update(['status_member' => 'bronze']);
            }
        }
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $detail = $transaction->detail_transaction;

        if ($detail->progress_status !== 'paying') {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        $detail->update([
            'status' => 'pending',
            'progress_status' => 'pending'
        ]);

        return back()->with('success', "Pesanan #{$transaction->transaction_code} diterima!");
    }

    public function show(string $id)
    {
        $transaction = Transaction::with(['outlet', 'transaction_item', 'detail_transaction'])->findOrFail($id);
        if (request()->ajax()) {
            return view('components.show-transaction', compact('transaction'))->render();
        }
        return view('profile.role.user.transaction-history', compact('transaction'));
    }
}
