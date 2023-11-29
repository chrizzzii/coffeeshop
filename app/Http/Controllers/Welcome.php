<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Welcome extends Controller
{
    public function index()
    {
        // Mengambil data produk dari tabel dengan Query Builder
        $produk = DB::table('produk')
            ->select('produk_id', 'produk_nama', 'harga')
            ->get();

        // Mengirim data produk ke view welcome
        return view('welcome', ['produk' => $produk]);
    }
}
