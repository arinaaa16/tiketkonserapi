<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konser;

class KonserController extends Controller
{
    
    public function index()
    {
        $konser = Konser::all();

        return response()->json([
            'message' => 'Data Konser Berhasil Ditampilkan',
            'data' => $konser,
        ], 200);
    }

    public function show($id)
    {
        $konser = Konser::find($id);

        if ($konser) {
            return response()->json([
                'message' => 'Data Konser Berhasil Ditampilkan',
                'data' => $konser,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data Konser Tidak Ditemukan',
            ], 404);
        }
    }
}