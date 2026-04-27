<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTransaction = Transaction::with('outlet', 'user')->get();
        return view('profile.role.user.dashboard', ['allTransactions' => $dataTransaction]);
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
            'service' => 'required|string|in:wash,unyellowing,repaint',
            'shoes_color' => 'required|string|max:255',
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
        $data = $request->all();
        $data['transaction_code'] = $transactionCode;
        $data['user_id'] = auth()->id();

        Transaction::create($data);

        return redirect()->route('pesanan')->with('success', 'Transaksi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);

        if (request()->ajax()) {
            return view('components.show-transaction', compact('transaction'))->render();
        }
        return view('profile.role.user.order', compact('transaction'));
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
