<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    /**
     * Menampilkan halaman top up saldo.
     */
    public function index()
    {
        return view('profile.role.user.topup'); // Sesuaikan dengan nama blade file Anda
    }

    /**
     * Memproses pengisian saldo (Top Up).
     */
    public function store(Request $request)
    {
        // 1. Validasi input nominal top up
        $request->validate([
            'amount' => 'required|integer|min:10000|max:10000000',
        ], [
            'amount.required' => 'Nominal saldo wajib diisi.',
            'amount.integer' => 'Nominal harus berupa angka.',
            'amount.min' => 'Minimal top up adalah Rp 10.000.',
            'amount.max' => 'Maksimal top up adalah Rp 10.000.000.',
        ]);

        try {
            // 2. Menggunakan DB Transaction untuk memastikan keamanan data
            DB::transaction(function () use ($request) {
                /** @var \App\Models\User $user */
                $user = Auth::user();

                // Tambahkan nominal baru ke saldo lama (field 'balance' di tabel users)
                $user->balance += $request->amount;
                $user->save();
            });

            // 3. Kembalikan ke halaman dengan pesan sukses
            return redirect()->route('dashboard')
                ->with('success', 'Selamat! Top up saldo sebesar Rp ' . number_format($request->amount, 0, ',', '.') . ' berhasil.');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan sistem
            return back()->withErrors(['error' => 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.']);
        }
    }
}
