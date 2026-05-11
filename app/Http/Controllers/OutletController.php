<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Outlet;

class OutletController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $outlet = Outlet::where("user_id", Auth::id())->first();

        if (!$outlet) {
            return redirect()->route('login')->with('error', 'Outlet tidak ditemukan.');
        }

        $thisMonthTransactions = $outlet->transactions()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $latestTransactions = $outlet->transactions()
            ->with(['detail_transaction', 'transaction_item'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('transaction_code', 'LIKE', "%{$search}%")
                        ->orWhereHas('transaction_item', function ($itemQ) use ($search) {
                            $itemQ->where('customer_name', 'LIKE', "%{$search}%")
                                ->orWhere('shoes_name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('profile.role.cashier.dashboard', [
            "allTransactions" => $latestTransactions,
            "totalOrdersMonth"   => $thisMonthTransactions->count(),
            "processingOrders"   => $thisMonthTransactions->where('detail_transaction.status', 'pending')->count(),
            "totalRevenueMonth"  => $thisMonthTransactions->sum("total_price")
        ]);
    }
}
