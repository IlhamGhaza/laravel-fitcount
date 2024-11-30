<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/account')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }
    }

    // Menangani registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('account')->with('success', 'Registrasi berhasil!');
    }

    // Menampilkan form reset password
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Menangani reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required',
        ]);

        // Cek apakah token valid
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();

                // Log in user after password reset
                Auth::login($user);
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login.');
        }

        return back()->withErrors(['email' => 'Terjadi kesalahan. Periksa token atau email Anda dan coba lagi.']);
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
