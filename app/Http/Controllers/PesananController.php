<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        return response()->json($pesanan);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|unique:layanans,nama',
            ]);
            
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
}
