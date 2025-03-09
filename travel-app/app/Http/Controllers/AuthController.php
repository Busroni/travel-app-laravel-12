<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // REGISTER CUSTOMER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Role 'customer'
        ]);

        return redirect()->route('travel')->with('success', 'Akun Baru telah berhasil dibuat!');
    }
    
    /** @var \App\Models\User $user **/
    
    // LOGIN CUSTOMER
    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // ✅ Simpan session
        
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $token = $user->createToken('auth_token')->plainTextToken; // ✅ Buat token

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token, // ✅ Kirim token ke frontend
            'role' => $user->role,
        ]);
    }

    return response()->json(['message' => 'Login gagal! Periksa username dan password.'], 401);
}
    
    



    // PROFILE USER
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }


    public function logout(Request $request)
    {
        Auth::logout(); // ✅ Logout session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('home')->with('success', 'Logout Akun berhasil!');
    }
}
