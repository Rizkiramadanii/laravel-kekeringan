<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses login pengguna.
     */
    public function processLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Ambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Coba login menggunakan guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation

            // Arahkan ke halaman yang dituju setelah login
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal, kembalikan pesan error dan input
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        // Logout pengguna dan hapus session
        Auth::guard('admin')->logout();

        // Hapus session dan regenerasi token untuk mencegah CSRF reuse
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }
}
