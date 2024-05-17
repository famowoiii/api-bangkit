<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Franchise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Pastikan ini ditambahkan untuk validasi

class FranchiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Franchise::orderBy('id')->get();
        return response()->json([
            'status' => true,
            'message' => "Data ditemukan",
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $rules = [
            'nama' => 'required|string|max:255',
            
            'foto' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'harga' => 'required|integer',
            'paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memasukkan data',
                'data' => $validator->errors()
            ], 422);
        }

        // Membuat data franchise baru
        $dataFranchise = new Franchise;
        $dataFranchise->nama = $request->nama;
        
        $dataFranchise->foto = $request->foto;
        $dataFranchise->kontak = $request->kontak;
        $dataFranchise->harga = $request->harga;
        $dataFranchise->paket = $request->paket;
        $dataFranchise->deskripsi = $request->deskripsi;

        $dataFranchise->save();

        return response()->json([
            'status' => true,
            'message' => 'Sukses memasukkan data',
            'data' => $dataFranchise
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Implementasi metode show jika diperlukan
        $franchise = Franchise::find($id);

        if (!$franchise) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $franchise
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $rules = [
            'nama' => 'sometimes|required|string|max:255',
            
            'foto' => 'sometimes|required|string|max:255',
            'kontak' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|integer',
            'paket' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data',
                'data' => $validator->errors()
            ], 422);
        }

        $franchise = Franchise::find($id);

        if (!$franchise) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $franchise->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Sukses memperbarui data',
            'data' => $franchise
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $franchise = Franchise::find($id);

        if (!$franchise) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $franchise->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}
