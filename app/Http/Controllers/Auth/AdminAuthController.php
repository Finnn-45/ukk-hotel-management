<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Anhskohbo\NoCaptcha\NoCaptcha;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Validasi captcha hanya wajib di production
        if (app()->environment('production')) {
            $validator->addRules([
                'g-recaptcha-response' => 'required|captcha',
            ]);
        } else {
            // Di development/local, captcha tetap dicek jika diisi
            $validator->addRules([
                'g-recaptcha-response' => 'sometimes|captcha',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->filled('remember'))) {

            $user = Auth::user();
            
            // Check if user is admin or staff
            if (!in_array($user->role, ['admin', 'staff'])) {
                Auth::logout();
                return back()->withErrors(['email' => 'Akses ditolak. Anda bukan admin/staff.']);
            }

            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}