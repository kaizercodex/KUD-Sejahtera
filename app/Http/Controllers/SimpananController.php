<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SimpananController extends Controller
{
    public function index()
    {
        return view('datamaster.simpanan.index');
    }

    public function getDatatablesSimpanan()
    {
        $simpanan = Simpanan::with('peserta')->select('id', 'peserta_id', 'jenis', 'nominal', 'tanggal', 'created_at', 'updated_at');
        
        return DataTables::of($simpanan)
            ->addColumn('peserta_nama', function($row) {
                return $row->peserta->nama ?? '-';
            })
            ->addColumn('nominal_formatted', function($row) {
                return 'Rp ' . number_format($row->nominal, 0, ',', '.');
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peserta_id' => 'required|exists:peserta_plasma,id',
            'jenis' => 'required|in:Simpanan Pokok,Simpanan Wajib,Simpanan Sukarela',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ], [
            'peserta_id.required' => 'Peserta wajib dipilih',
            'peserta_id.exists' => 'Peserta tidak valid',
            'jenis.required' => 'Jenis simpanan wajib dipilih',
            'jenis.in' => 'Jenis simpanan tidak valid',
            'nominal.required' => 'Nominal wajib diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'nominal.min' => 'Nominal minimal 0',
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
        ]);

        Simpanan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Simpanan berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $simpanan = Simpanan::with('peserta')->findOrFail($id);
        
        $data = [
            'id' => $simpanan->id,
            'peserta_id' => $simpanan->peserta_id,
            'peserta' => $simpanan->peserta,
            'jenis' => $simpanan->jenis,
            'nominal' => $simpanan->nominal,
            'tanggal' => $simpanan->tanggal->format('Y-m-d'),
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $simpanan = Simpanan::findOrFail($id);

        $validated = $request->validate([
            'peserta_id' => 'required|exists:peserta_plasma,id',
            'jenis' => 'required|in:Simpanan Pokok,Simpanan Wajib,Simpanan Sukarela',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ], [
            'peserta_id.required' => 'Peserta wajib dipilih',
            'peserta_id.exists' => 'Peserta tidak valid',
            'jenis.required' => 'Jenis simpanan wajib dipilih',
            'jenis.in' => 'Jenis simpanan tidak valid',
            'nominal.required' => 'Nominal wajib diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
            'nominal.min' => 'Nominal minimal 0',
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
        ]);

        $simpanan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Simpanan berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $simpanan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Simpanan berhasil dihapus'
        ]);
    }
}
