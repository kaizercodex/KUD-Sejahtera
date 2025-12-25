<?php

namespace App\Http\Controllers\Datamaster;

use App\Models\PesertaPlasma;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class PesertaPlasmaController extends Controller
{
    public function index()
    {
        return view('datamaster.peserta_plasma.index');
    }

    public function getDatatablesPesertaPlasma()
    {
        $pesertaPlasma = PesertaPlasma::with('kelompok')->select('id', 'no_reg', 'nama', 'nik_ktp', 'no_kk', 'alamat', 'no_hp', 'photo', 'kelompok_id', 'created_at', 'updated_at');
        
        return DataTables::of($pesertaPlasma)
            ->addColumn('photo_url', function($row) {
                if ($row->photo) {
                    return asset('uploads/peserta_plasma/' . $row->photo);
                }
                return null;
            })
            ->addColumn('kelompok', function($row) {
                return $row->kelompok->nama_kelompok;
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_reg' => 'required|string|max:255|unique:peserta_plasma,no_reg',
            'nama' => 'required|string|max:255',
            'nik_ktp' => 'required|string|size:16|unique:peserta_plasma,nik_ktp',
            'no_kk' => 'required|string|size:16',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:16',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'kelompok_id' => 'nullable|exists:kelompok,id',
        ], [
            'no_reg.required' => 'No Registrasi wajib diisi',
            'no_reg.unique' => 'No Registrasi sudah digunakan',
            'nama.required' => 'Nama wajib diisi',
            'nik_ktp.required' => 'NIK/KTP wajib diisi',
            'nik_ktp.size' => 'NIK/KTP harus 16 digit',
            'nik_ktp.unique' => 'NIK/KTP sudah terdaftar',
            'no_kk.required' => 'No KK wajib diisi',
            'no_kk.size' => 'No KK harus 16 digit',
            'alamat.required' => 'Alamat wajib diisi',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto harus jpg, jpeg, atau png',
            'photo.max' => 'Ukuran foto maksimal 1MB',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('uploads/peserta_plasma');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            $validated['photo'] = $filename;
        }

        PesertaPlasma::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peserta Plasma berhasil ditambahkan'
        ]);
    }

    public function show($id)
    {
        $pesertaPlasma = PesertaPlasma::with('kelompok')->findOrFail($id);
        
        $data = [
            'id' => $pesertaPlasma->id,
            'no_reg' => $pesertaPlasma->no_reg,
            'nama' => $pesertaPlasma->nama,
            'nik_ktp' => $pesertaPlasma->nik_ktp,
            'no_kk' => $pesertaPlasma->no_kk,
            'alamat' => $pesertaPlasma->alamat,
            'no_hp' => $pesertaPlasma->no_hp,
            'kelompok_id' => $pesertaPlasma->kelompok_id,
            'kelompok' => $pesertaPlasma->kelompok,
            'photo' => $pesertaPlasma->photo,
            'photo_url' => $pesertaPlasma->photo ? asset('uploads/peserta_plasma/' . $pesertaPlasma->photo) : null
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $pesertaPlasma = PesertaPlasma::findOrFail($id);

        $validated = $request->validate([
            'no_reg' => 'required|string|max:255|unique:peserta_plasma,no_reg,' . $id,
            'nama' => 'required|string|max:255',
            'nik_ktp' => 'required|string|size:16|unique:peserta_plasma,nik_ktp,' . $id,
            'no_kk' => 'required|string|size:16',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:16',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'kelompok_id' => 'nullable|exists:kelompok,id',
        ], [
            'no_reg.required' => 'No Registrasi wajib diisi',
            'no_reg.unique' => 'No Registrasi sudah digunakan',
            'nama.required' => 'Nama wajib diisi',
            'nik_ktp.required' => 'NIK/KTP wajib diisi',
            'nik_ktp.size' => 'NIK/KTP harus 16 digit',
            'nik_ktp.unique' => 'NIK/KTP sudah terdaftar',
            'no_kk.required' => 'No KK wajib diisi',
            'no_kk.size' => 'No KK harus 16 digit',
            'alamat.required' => 'Alamat wajib diisi',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto harus jpg, jpeg, atau png',
            'photo.max' => 'Ukuran foto maksimal 1MB',
        ]);

        if ($request->hasFile('photo')) {
            if ($pesertaPlasma->photo) {
                $oldPhotoPath = public_path('uploads/peserta_plasma/' . $pesertaPlasma->photo);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('uploads/peserta_plasma');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            $validated['photo'] = $filename;
        }

        $pesertaPlasma->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peserta Plasma berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $pesertaPlasma = PesertaPlasma::findOrFail($id);
        
        if ($pesertaPlasma->photo) {
            $photoPath = public_path('uploads/peserta_plasma/' . $pesertaPlasma->photo);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
        }

        $pesertaPlasma->delete();

        return response()->json([
            'success' => true,
            'message' => 'Peserta Plasma berhasil dihapus'
        ]);
    }
}
