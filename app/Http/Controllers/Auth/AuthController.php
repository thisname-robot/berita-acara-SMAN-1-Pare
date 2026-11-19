<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $message = 'Selamat datang kembali, '.$user->name.'!';

            // Pengarahan jalur masuk (redirect) berdasarkan role
            match ($user->role) {
                'admin' => $redirect = redirect()->intended(route('admin.dashboard'))->with('success', $message),
                'editor' => $redirect = redirect()->intended(route('pages.editor.dashboard'))->with('success', $message), // Atau route khusus editor
                'writer' => $redirect = redirect()->intended(route('home'))->with('success', $message),
                default => $redirect = redirect()->intended(route('home'))->with('success', $message),
            };

            return $redirect;
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))
            ->with('success', 'Anda telah berhasil keluar.');
    }
}
