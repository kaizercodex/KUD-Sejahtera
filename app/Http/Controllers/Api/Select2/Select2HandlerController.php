<?php

namespace App\Http\Controllers\Api\Select2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\PesertaPlasma;
use App\Models\Petani;
use App\Models\Blok;

class Select2HandlerController extends Controller
{
    public function getDataKelompok(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        $perPage = 10;

        $query = Kelompok::select('id', 'nama_kelompok');

        if (!empty($search)) {
            $query->where('nama_kelompok', 'like', '%' . $search . '%');
        }

        $kelompok = $query->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'data' => $kelompok->items(),
            'current_page' => $kelompok->currentPage(),
            'last_page' => $kelompok->lastPage(),
            'total' => $kelompok->total()
        ]);
    }

    public function getDataPeserta(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        $perPage = 10;

        $query = PesertaPlasma::select('id', 'nama', 'no_reg');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('no_reg', 'like', '%' . $search . '%');
            });
        }

        $peserta = $query->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'data' => $peserta->items(),
            'current_page' => $peserta->currentPage(),
            'last_page' => $peserta->lastPage(),
            'total' => $peserta->total()
        ]);
    }

    public function getDataPetani(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        $perPage = 10;

        $query = Petani::select('id', 'nama');

        if (!empty($search)) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $petani = $query->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'data' => $petani->items(),
            'current_page' => $petani->currentPage(),
            'last_page' => $petani->lastPage(),
            'total' => $petani->total()
        ]);
    }

    public function getDataBlok(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        $perPage = 10;

        $query = Blok::with('kelompok')->select('id', 'kode_blok', 'kelompok_id');

        if (!empty($search)) {
            $query->where('kode_blok', 'like', '%' . $search . '%');
        }

        $blok = $query->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'data' => $blok->items(),
            'current_page' => $blok->currentPage(),
            'last_page' => $blok->lastPage(),
            'total' => $blok->total()
        ]);
    }
}
