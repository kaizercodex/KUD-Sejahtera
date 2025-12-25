<?php

namespace App\Http\Controllers\Datamaster;

use App\Models\Lahan;
use App\Models\PesertaPlasma;
use App\Models\Petani;
use App\Models\Blok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LahanController extends Controller
{
    public function index()
    {
        return view('datamaster.lahan.index');
    }

    public function getDatatablesLahan()
    {
        $lahan = Lahan::with(['peserta', 'petani', 'blok.kelompok'])
            ->select('id', 'peserta_id', 'petani_id', 'no_shm', 'tanggal_shm', 'alamat_jaminan', 'luas_jumlah', 'blok_id', 'created_at', 'updated_at');
        
        return DataTables::of($lahan)
            ->addColumn('peserta_nama', function($row) {
                return $row->peserta ? $row->peserta->nama : '-';
            })
            ->addColumn('petani_nama', function($row) {
                return $row->petani ? $row->petani->nama : '-';
            })
            ->addColumn('blok_kode', function($row) {
                return $row->blok ? $row->blok->kode_blok : '-';
            })
            ->editColumn('tanggal_shm', function($row) {
                return $row->tanggal_shm ? $row->tanggal_shm->format('d/m/Y') : '-';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peserta_id' => 'required|exists:peserta_plasma,id',
            'petani_id' => 'required|exists:petani,id',
            'no_shm' => 'required|string|max:255',
            'tanggal_shm' => 'required|date',
            'alamat_jaminan' => 'required|string',
            'luas_jumlah' => 'required|numeric|min:1',
            'blok_id' => 'required|exists:blok,id',
        ], [
            'peserta_id.required' => 'Peserta wajib dipilih',
            'peserta_id.exists' => 'Peserta tidak valid',
            'petani_id.required' => 'Petani wajib dipilih',
            'petani_id.exists' => 'Petani tidak valid',
            'no_shm.required' => 'No SHM wajib diisi',
            'no_shm.max' => 'No SHM maksimal 255 karakter',
            'tanggal_shm.required' => 'Tanggal SHM wajib diisi',
            'tanggal_shm.date' => 'Format tanggal tidak valid',
            'alamat_jaminan.required' => 'Alamat jaminan wajib diisi',
            'luas_jumlah.required' => 'Luas jumlah wajib diisi',
            'luas_jumlah.numeric' => 'Luas jumlah harus berupa angka',
            'luas_jumlah.min' => 'Luas jumlah minimal 1',
            'blok_id.required' => 'Blok wajib dipilih',
            'blok_id.exists' => 'Blok tidak valid',
        ]);

        Lahan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data lahan berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $lahan = Lahan::with(['peserta', 'petani', 'blok'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $lahan
        ]);
    }

    public function update(Request $request, $id)
    {
        $lahan = Lahan::findOrFail($id);

        $validated = $request->validate([
            'peserta_id' => 'required|exists:peserta_plasma,id',
            'petani_id' => 'required|exists:petani,id',
            'no_shm' => 'required|string|max:255',
            'tanggal_shm' => 'required|date',
            'alamat_jaminan' => 'required|string',
            'luas_jumlah' => 'required|numeric|min:1',
            'blok_id' => 'required|exists:blok,id',
        ], [
            'peserta_id.required' => 'Peserta wajib dipilih',
            'peserta_id.exists' => 'Peserta tidak valid',
            'petani_id.required' => 'Petani wajib dipilih',
            'petani_id.exists' => 'Petani tidak valid',
            'no_shm.required' => 'No SHM wajib diisi',
            'no_shm.max' => 'No SHM maksimal 255 karakter',
            'tanggal_shm.required' => 'Tanggal SHM wajib diisi',
            'tanggal_shm.date' => 'Format tanggal tidak valid',
            'alamat_jaminan.required' => 'Alamat jaminan wajib diisi',
            'luas_jumlah.required' => 'Luas jumlah wajib diisi',
            'luas_jumlah.numeric' => 'Luas jumlah harus berupa angka',
            'luas_jumlah.min' => 'Luas jumlah minimal 1',
            'blok_id.required' => 'Blok wajib dipilih',
            'blok_id.exists' => 'Blok tidak valid',
        ]);

        $lahan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data lahan berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $lahan = Lahan::findOrFail($id);
        $lahan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data lahan berhasil dihapus'
        ]);
    }
}
