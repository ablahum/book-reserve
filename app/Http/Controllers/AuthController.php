<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string',
                'nomor_hp' => 'required|string',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string',
            ]);
            
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = 2;

            User::create($data);

            return response()->json([
                'message' => 'register successful',
                'data' => $data
            ], 201);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'registration failed',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
        $data = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])
        ->first();

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $request->session()->regenerate();

                return response()->json([
                    'message' => 'login successful',
                    'token' => $request->session()->get('_token'),
                ], 200);
            } else {
                return response()->json([
                    'message' => 'wrong email or password',
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'user not found'
            ], 400);
        }
        } catch (Exception $err) {
            return response()->json([
                'message' => 'login failed',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
