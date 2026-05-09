<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
{
    $outlet = Outlet::with(['transactions.detail_transaction', 'transactions.transaction_item'])
        ->where("user_id", Auth::id())
        ->first();

    if (!$outlet) {
        return redirect()->route('login')->with('error', 'Outlet tidak ditemukan.');
    }

    $thisMonthTransactions = $outlet->transactions()
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->get();

    return view('profile.role.cashier.dashboard', [
        "latestTransactions" => $outlet->transactions()->latest()->paginate(5),
        "totalOrdersMonth"   => $thisMonthTransactions->count(),
        "processingOrders"   => $thisMonthTransactions->where('detail_transaction.status', 'pending')->count(),
        "totalRevenueMonth"  => $thisMonthTransactions->sum("total_price")
    ]);
}
}