<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaAPIControlller extends Controller
{
    public function index() {
        $berita = Berita::all();
        return response()->json([
            'message'=>'Berhasil mengambil data berita',
            'status'=>'sukses',
            'data'=>$berita], 200);
    }

    public function store(Request $request) {
        $input = $request->all();
        $berita = Berita::create($input);
        return response()->json([
            'messagge'=>'Data berhasil ditambahkan',
            'status'=>'sukses',
            'data'=>$berita], 201);
    }

    public function show($id) {
        $berita = Berita::find($id);
        return response()->json([
            'message'=>'Berhasil mengambil data berita',
            'status'=>'sukses',
            'data'=>$berita], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $berita = Berita::find($id);
        if (empty($berita)) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'status' => 'gagal'], 404);
        }
        $berita->update($input);
        return response()->json([
            'message'=>'Data berhasil di update',
            'status'=>'sukses',
            'data' => $berita
            ], 200);
    }

    public function destroy($id) {
        $berita = Berita::find($id);
        if (empty($berita)) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'status' => 'gagal'], 404);
        }
        $berita->delete();
        return response()->json([
            'message'=>'Data berhasil di hapus',
            'status'=>'sukses',
            'data' => $berita
        ], 200);
    }
}
