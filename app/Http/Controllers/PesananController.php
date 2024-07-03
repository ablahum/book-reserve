<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Layanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        return response()->json($pesanan);
    }

    // public function get_specific()
    // {
    //     $pesanan = Pesanan::all();
    //     return response()->json($pesanan);
    // }
    
    public function store(Request $request)
    {
        $request['user_id'] = (int) $request['user_id'];
        $request['layanan_id'] = (int) $request['layanan_id'];

        try {            
            $data = $request->validate([
                'hari_jam' => 'required|date|date_format:Y-m-d H:i:s',
                'user_id' => 'required|integer',
                'layanan_id' => 'required|integer'
            ]);
            
            $data['status'] = 'menunggu';
            $user = User::find($data['user_id']);
            $layanan = Layanan::find($data['layanan_id']);

            if (!$user || !$layanan) {
                return response()->json([
                    'message' => 'user or layanan not found',
                ]);
            }

            Pesanan::create($data);

            return response()->json([
                'message' => 'pesanan successfully added',
                'data' => $data
            ], 201);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'internal error',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $request['user_id'] = (int) $request['user_id'];
        $request['layanan_id'] = (int) $request['layanan_id'];

        try {            
            $data = $request->validate([
                'hari_jam' => 'required|date|date_format:Y-m-d H:i:s',
                'user_id' => 'required|integer',
                'layanan_id' => 'required|integer',
                'status' => 'required|string'
            ]);
            
            $user = User::find($data['user_id']);
            $layanan = Layanan::find($data['layanan_id']);

            if (!$user || !$layanan) {
                return response()->json([
                    'message' => 'user or layanan not found',
                ]);
            }

            Pesanan::find($id)->update($data);

            return response()->json([
                'message' => 'pesanan successfully updated',
                'data' => $data
            ], 201);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'internal error',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
