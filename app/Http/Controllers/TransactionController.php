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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTransaction = Transaction::with([
            'outlet',
            'user',
            'transaction_item',
            'detail_transaction'
        ])->latest()->get();

        return view('profile.role.user.order', [
            'allTransactions' => $dataTransaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'outlet_id' => 'required|exists:outlets,id',
            'customer_name' => 'required|string|max:255',
            'shoes_name' => 'required|string|max:255',
            'service' => 'required|in:wash,unyellowing,repaint',
            'shoes_color' => 'nullable|string|max:255',
            'total_price' => 'required|numeric|min:0',
        ]);

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

        $transaction = Transaction::create([
            'transaction_code' => $transactionCode,
            'outlet_id' => $request->outlet_id,
            'user_id' => Auth::id(),
            'total_price' => $request->total_price,
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
            'cancel_reason' => null,
        ]);

        return redirect()->route('pesanan')
            ->with('success', 'Transaksi berhasil dibuat.');
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
            'user',
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
        $transaction = Transaction::findOrFail($id);

        if ($transaction->user_id !== Auth::id() && Auth::user()->role === 'user') {
            abort(403, 'Anda tidak memiliki akses untuk membatalkan pesanan ini.');
        }

        $detail = $transaction->detail_transaction;

        if ($detail->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah diproses.');
        }

        $detail->update([
            'status' => 'cancelled',
            'progress_status' => 'cancelled',
            'cancel_reason' => $request->cancel_reason
        ]);

        return redirect()->route('pesanan')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
