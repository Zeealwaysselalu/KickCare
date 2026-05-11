<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OutletController extends Controller
{
    public function listAllOutlets(Request $request)
    {
        $outlets = Outlet::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(9);

        return view('profile.role.admin.outlets', compact('outlets'));
    }

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

    public function create()
    {
        return view('profile.role.admin.outlets-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'outlet_name' => 'required|string|max:255',
            'address'     => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'username' => $request->username,
                    'name'     => $request->outlet_name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                    'role'     => 'cashier',
                ]);

                Outlet::create([
                    'user_id' => $user->id,
                    'name'    => $request->outlet_name,
                    'address' => $request->address,
                ]);
            });

            return redirect()->route('admin.outlets.index')->with('success', 'Akun Kasir dan Outlet berhasil dibuat!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $outlet = Outlet::with('user')->findOrFail($id);
        return view('profile.role.admin.outlets-edit', compact('outlet'));
    }

    public function update(Request $request, $id)
    {
        $outlet = Outlet::findOrFail($id);
        $user = $outlet->user;

        $request->validate([
            'username'    => 'required|string|unique:users,username,' . $user->id,
            'email'       => 'required|email|unique:users,email,' . $user->id,
            'password'    => 'nullable|min:8',
            'outlet_name' => 'required|string|max:255',
            'address'     => 'required|string',
        ]);

        try {
            DB::transaction(function () use ($request, $outlet, $user) {
                $userData = [
                    'username' => $request->username,
                    'name'     => $request->outlet_name,
                    'email'    => $request->email,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $user->update($userData);
                $outlet->update([
                    'name'    => $request->outlet_name,
                    'address' => $request->address,
                ]);
            });

            return redirect()->route('admin.outlets.index')->with('success', 'Data Outlet & Kasir berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        try {
            DB::transaction(function () use ($outlet) {
                $user = $outlet->user;
                $outlet->delete();
                $user->delete();
            });
            return redirect()->route('admin.outlets.index')->with('success', 'Outlet dan akun kasir berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus outlet: ' . $e->getMessage());
        }
    }
}
