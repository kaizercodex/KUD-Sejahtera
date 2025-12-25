<?php

namespace App\Http\Controllers\Datamaster;

use App\Models\Blok;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BlokController extends Controller
{
    public function index()
    {
        return view('datamaster.blok.index');
    }

    public function getDatatablesBlok()
    {
        $blok = Blok::with('kelompok')
            ->select('blok.id', 'blok.kode_blok', 'blok.kelompok_id', 'blok.created_at', 'blok.updated_at');
        
        return DataTables::of($blok)
            ->addColumn('nama_kelompok', function($row) {
                return $row->kelompok ? $row->kelompok->nama_kelompok : '-';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_blok' => 'required|string|max:255',
            'kelompok_id' => 'required|exists:kelompok,id',
        ], [
            'kode_blok.required' => 'Kode blok wajib diisi',
            'kode_blok.max' => 'Kode blok maksimal 255 karakter',
            'kelompok_id.required' => 'Kelompok wajib dipilih',
            'kelompok_id.exists' => 'Kelompok tidak valid',
        ]);

        Blok::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data blok berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $blok = Blok::with('kelompok')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $blok
        ]);
    }

    public function update(Request $request, $id)
    {
        $blok = Blok::findOrFail($id);

        $validated = $request->validate([
            'kode_blok' => 'required|string|max:255',
            'kelompok_id' => 'required|exists:kelompok,id',
        ], [
            'kode_blok.required' => 'Kode blok wajib diisi',
            'kode_blok.max' => 'Kode blok maksimal 255 karakter',
            'kelompok_id.required' => 'Kelompok wajib dipilih',
            'kelompok_id.exists' => 'Kelompok tidak valid',
        ]);

        $blok->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data blok berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $blok = Blok::findOrFail($id);
        $blok->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data blok berhasil dihapus'
        ]);
    }
}
