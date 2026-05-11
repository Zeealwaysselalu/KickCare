<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('role', 'user')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('profile.role.admin.users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        try {
            DB::transaction(function () use ($user) {
                $user->delete();
            });

            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus dari sistem.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.role.admin.users-edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'nullable|string|max:255',
            'status_member' => 'required|in:gold,silver,bronze',
            'balance' => 'required|integer|min:0',
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'status_member' => $request->status_member,
            'balance' => $request->balance,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }
}
