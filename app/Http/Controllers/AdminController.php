<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\{ComplaintMessage, Transaction};

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $totalRevenueMonth = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->whereHas('detail_transaction', function ($query) {
                $query->where('status', 'completed');
            })
            ->sum('total_price');

        $totalComplaints = ComplaintMessage::count();

        $processingOrders = Transaction::whereHas('detail_transaction', function ($query) {
            $query->whereIn('progress_status', ['pending', 'sorting', 'washing', 'drying']);
        })->count();

        $readyOrdersCount = Transaction::whereHas('detail_transaction', function ($query) {
            $query->where('progress_status', 'ready');
        })->count();

        $allTransactions = Transaction::with(['transaction_item', 'detail_transaction'])
            ->when($search, function ($query, $search) {
                return $query->where('transaction_code', 'like', "%{$search}%")
                    ->orWhereHas('transaction_item', function ($q) use ($search) {
                        $q->where('shoes_name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.role.admin.dashboard', compact(
            'totalRevenueMonth',
            'totalComplaints',
            'processingOrders',
            'readyOrdersCount',
            'allTransactions'
        ));
    }
}
