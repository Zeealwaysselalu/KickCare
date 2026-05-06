<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Outlet;

class OutletController extends Controller
{

    public function index()
    {
        $outlet = Outlet::where("user_id", Auth::id())->first();

        if (!$outlet) {
            dd("Outlet tidak ditemukan untuk user ini");
        }

        $allTransaction = $outlet->transactions;

        return view('profile.role.cashier.dashboard', [
            "latestTransactions" => $allTransaction,
            "totalOrders" => $allTransaction->count(),
            "processingOrders" => $allTransaction->where("status", "pending")->count(),
            "totalRevenue" => $allTransaction->sum("total_price")
        ]);
    }

    public function create() {}
    public function store(Request $request) {}

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
