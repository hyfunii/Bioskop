<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;
            if ($role == 'admin') {
                return redirect()->route('admin.home')->with('success', 'Login successful as Admin!');
            } else {
                return redirect()->route('user.home')->with('success', 'Login successful as User!');
            }
        }

        return redirect()->back()->with('error', 'Invalid login details');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Validate unique email
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Jika email sudah ada, Laravel akan otomatis menampilkan pesan error
        // Buat user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user'; // Default role is user
        $user->save();

        Auth::login($user);

        $showtimes = Showtime::with('film')->get();
        return redirect()->route('user.home')->with('success', 'Registration successful as User!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
