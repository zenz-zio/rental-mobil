<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // REGISTER
public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'user',
    ]);

    // Buat data pelanggan otomatis
    Pelanggan::create([
        'nama' => $validated['name'],
        'nik' => 'TEMP' . $user->id,
        'no_hp' => '-',
        'alamat' => '-',
        'email' => $validated['email'],
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Registrasi berhasil. Silakan login.');
}

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // Kalau admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Kalau user
            if (Auth::user()->role === 'user') {
                return redirect()->route('user.dashboard');
            }

            // Kalau role tidak dikenal
            Auth::logout();

            return back()->withErrors([
                'email' => 'Role akun tidak valid.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout.');
    }
}