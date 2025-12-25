<?php

namespace App\Http\Controllers\Datamaster;

use App\Models\Kelompok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class KelompokController extends Controller
{
    public function index()
    {
        return view('datamaster.kelompok.index');
    }

    public function getDatatablesKelompok()
    {
        $kelompok = Kelompok::select('id', 'nama_kelompok', 'ketua_kelompok', 'created_at', 'updated_at');
        
        return DataTables::of($kelompok)->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'ketua_kelompok' => 'required|string|max:255',
        ], [
            'nama_kelompok.required' => 'Nama kelompok wajib diisi',
            'nama_kelompok.max' => 'Nama kelompok maksimal 255 karakter',
            'ketua_kelompok.required' => 'Ketua kelompok wajib diisi',
            'ketua_kelompok.max' => 'Ketua kelompok maksimal 255 karakter',
        ]);

        Kelompok::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $kelompok
        ]);
    }

    public function update(Request $request, $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        $validated = $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'ketua_kelompok' => 'required|string|max:255',
        ], [
            'nama_kelompok.required' => 'Nama kelompok wajib diisi',
            'nama_kelompok.max' => 'Nama kelompok maksimal 255 karakter',
            'ketua_kelompok.required' => 'Ketua kelompok wajib diisi',
            'ketua_kelompok.max' => 'Ketua kelompok maksimal 255 karakter',
        ]);

        $kelompok->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        $kelompok->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kelompok berhasil dihapus'
        ]);
    }
}
