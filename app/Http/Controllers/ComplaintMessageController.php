<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ComplaintMessage;

class ComplaintMessageController extends Controller
{
    public function index()
    {
        return view('profile.role.user.customer-service');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'max:100',
            'subject' => 'required|max:255',
            'massage' => 'required|max:255',
        ]);
        $userId = Auth::id();
        ComplaintMessage::create([
            'user_id' => $userId,
            'subject' => strtolower($request->subject),
            'transaction_code' => $request->transaction_code,
            'massage' => $request->massage,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Aduan berhasil dibuat!');
    }
}
