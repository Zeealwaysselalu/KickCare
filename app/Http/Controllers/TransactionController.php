<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\{Outlet, Transaction};

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
        $selectedService = $request->service; // ambil dari URL

        return view('profile.role.user.transaction', compact('selectedService', 'allOutlet'));
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
            'user_id' => auth()->id(),
            'total_price' => $request->total_price,
        ]);

        \App\Models\TransactionItem::create([
            'transaction_id' => $transaction->id,
            'customer_name' => $request->customer_name,
            'shoes_name' => $request->shoes_name,
            'shoes_color' => $request->shoes_color,
            'service' => $request->service,
        ]);

        \App\Models\DetailTransaction::create([
            'transaction_id' => $transaction->id,
            'status' => 'pending',
            'progress_status' => 'pending',
            'cancel_reason' => null,
        ]);

        return redirect()->route('pesanan')
            ->with('success', 'Transaksi berhasil dibuat.');
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
