<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Validasi captcha hanya jika production atau menggunakan key asli
        if (
            app()->environment('production') ||
            (
                config('captcha.secret') &&
                !str_contains(config('captcha.secret'), 'your_') &&
                !str_contains(config('captcha.secret'), '6LdCvEUt')
            )
        ) {
            $validator->addRules([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $request->filled('remember'))
        ) {

            $user = Auth::user();

            // Email verification disabled for development
            // if (!$user->hasVerifiedEmail()) {
            //     Auth::logout();
            //     return back()->withErrors([
            //         'email' => 'Silakan verifikasi email Anda terlebih dahulu.'
            //     ]);
            // }

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Validasi captcha hanya jika production atau memakai key asli
        if (
            app()->environment('production') ||
            (
                config('captcha.secret') &&
                !str_contains(config('captcha.secret'), 'your_') &&
                !str_contains(config('captcha.secret'), '6LdCvEUt')
            )
        ) {
            $validator->addRules([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);
        event(new Registered($user));

        return redirect()
            ->route('customer.login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan cek email Anda untuk melakukan verifikasi sebelum login.'
            );
    }

    public function verifyEmail(Request $request)
    {
        $user = User::findOrFail($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect('/')
                ->with('success', 'Email sudah diverifikasi.');
        }

        if ($user->markEmailAsVerified()) {
            return redirect('/')
                ->with('success', 'Email berhasil diverifikasi!');
        }

        return redirect('/')
            ->with('error', 'Verifikasi email gagal.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}