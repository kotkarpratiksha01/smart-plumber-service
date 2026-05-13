<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        session(['user_id' => $user->id]);

        // redirect based on role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->role === 'plumber') {
            return redirect()->route('plumber.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        return redirect('/');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:user,plumber,admin',
            'plumber_id' => 'nullable|exists:plumbers,id',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'user',
            'plumber_id' => $data['plumber_id'] ?? null,
        ]);

        // If an admin is creating a user from admin dashboard, don't switch session to the new user.
        $currentId = session('user_id');
        if ($currentId) {
            $current = User::find($currentId);
            if ($current && $current->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('status', 'User created.');
            }
        }

        // For regular self-registration, log the new user in and redirect based on role
        session(['user_id' => $user->id]);
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'plumber') return redirect()->route('plumber.dashboard');
        return redirect()->route('user.dashboard');
    }
}
