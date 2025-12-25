<?php

namespace App\Http\Controllers\Datamaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petani;
use Yajra\DataTables\Facades\DataTables;

class PetaniController extends Controller
{
    public function index()
    {
        return view('datamaster.petani.index');
    }

    public function getDatatablesPetani()
    {
        $petani = Petani::select('id', 'nama', 'alamat', 'no_hp', 'created_at', 'updated_at');
        
        return DataTables::of($petani)->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.max' => 'No HP maksimal 20 karakter',
        ]);

        Petani::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data petani berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $petani = Petani::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $petani
        ]);
    }

    public function update(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.max' => 'No HP maksimal 20 karakter',
        ]);

        $petani->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data petani berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data petani berhasil dihapus'
        ]);
    }
}
