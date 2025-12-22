<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name'    => 'required|max:50',
                'phone'   => 'nullable|max:20',
                'address' => 'nullable|max:255',
                'role'    => 'required|in:admin,user',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'role.required' => 'Role wajib dipilih',
            ]
        );

        $user->update($request->only('name', 'phone', 'address', 'role'));

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Akun admin tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
