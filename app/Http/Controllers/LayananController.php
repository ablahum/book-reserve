<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::all();
        return response()->json($layanan);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|unique:layanans,nama',
            ]);
            
            Layanan::create($data);

            return response()->json([
                'message' => 'layanan successfully added',
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
        try {
            $data = $request->validate([
                'nama' => 'required|string|unique:layanans,nama',
            ]);
    
            Layanan::find($id)->update($data);
            
            return response()->json([
                'message' => 'layanan successfully updated',
                'data' => $data
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'internal error',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            Layanan::destroy($id);

            return response()->json([
                'message' => 'layanan successfully deleted',
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'internal error',
                'error' => $err->getMessage()
            ], 500);
        }
    }
}
