<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ComplaintMessage;

class ComplaintMessageController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'administrator') {
            $complaints = ComplaintMessage::with('user')->latest()->paginate(10);
            return view('profile.role.admin.complaints', compact('complaints'));
        } elseif (Auth::user()->role === 'user') {
            return view('profile.role.user.customer-service');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_code' => 'max:100',
            'subject' => 'required|max:255',
            'message' => 'required|max:255',
        ]);
        $userId = Auth::id();
        ComplaintMessage::create([
            'user_id' => $userId,
            'subject' => ($request->subject),
            'transaction_code' => $request->transaction_code,
            'message' => $request->message,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Aduan berhasil dibuat!');
    }
}
