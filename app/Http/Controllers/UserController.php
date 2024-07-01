<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'nomor_hp' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            // 'role' => 'required|integer',
        ]);

        $user = User::where('nama', $data['nama'])
        ->where('nomor_sim', $data['nomor_sim'])
        ->first();
        
        if ($user) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'login berhasil',
                'token' => $request->session()->get('_token'),
            ]);
        } else {
            return response()->json([
                'message' => 'data pengguna tidak ditemukan'
            ], 400);
        }
    }
    
    public function register(Request $request)
    {        
        $data = $request->validate([
            'nama' => 'required|string',
            'nomor_hp' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            // 'role' => 'required|integer',
        ]);
        
        User::create($data);

        return response()->json([
            'messasge' => 'register successful',
            'data' => $data
        ], 201);
    }
}
