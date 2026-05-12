<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $transactions = Transaction::query()
            ->with(['transaction_item', 'detail_transaction'])
            ->where('transaction_code', $search)
            ->latest()
            ->paginate(1);

        return view('cekstatus', [
            'transactions' => $transactions
        ]);
    }
}
