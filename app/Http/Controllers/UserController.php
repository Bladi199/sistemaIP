<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'paternal' => 'required',
            'maternal' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

        User::create([
            ...$request->all(),
            'status' => $request->has('status') ? 'activo' : 'inactivo',
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('password'));
        return redirect()->route('users.index');
    }

    public function toggleStatus(User $user)
    {
        $user->status = $user->status === 'activo' ? 'inactivo' : 'activo';
        $user->save();

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
