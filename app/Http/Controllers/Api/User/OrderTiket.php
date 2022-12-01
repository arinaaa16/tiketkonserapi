<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\User;

class OrderTiket extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $konser = Konser::find($request->konsers_id);

        if ($user->role == 'user') {
            $request->validate([
                'konsers_id' => 'required',
                'nama' => 'required',
                'email' => 'required',
                'no_hp' => 'required',
                'jumlah_tiket' => 'required',
            ]);
                            
            $order = Transaksi::create([
                'konser_id' => $request->konsers_id,
                'user_id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jumlah_tiket' => $request->jumlah_tiket,
                'total_harga' => $request->jumlah_tiket * $konser->harga,
                'status' => 'pending',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Order berhasil ditambahkan',
                'data' => $order,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda bukan user',
            ], 401);
        } 
    }
}
