<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class Pesanan extends Controller
{
    public function showCreatePesananForm()
    {
        if (Session::has('pelanggan')) {
            $userData = DB::table('pelanggan')
                ->where('customer_name', Session::get('pelanggan'))
                ->first();
        }

        // Pengecekan apakah pengguna sudah login
        if (!Session::has('pelanggan')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginuser');
        }

        // Mendapatkan customer_id dari sesi
        $customer_id = $userData->customer_id;

        // Mendapatkan daftar produk dari tabel 'produk'
        $produkList = DB::table('produk')->get();

        // Meneruskan customer_id dan produkList ke tampilan
        return view('order.createpesanan', ['customer_id' => $customer_id, 'produkList' => $produkList]);
    }



    public function tambahPesanan(Request $request)
    {
        // Pengecekan apakah pengguna sudah login
        if (!Session::has('pelanggan')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginuser');
        }

        // Mendapatkan data pengguna dari tabel 'pelanggan'
        $userData = DB::table('pelanggan')
            ->where('customer_name', Session::get('pelanggan'))
            ->first();

        // Jika data pengguna tidak ditemukan, handle sesuai kebutuhan
        if (!$userData) {
            return redirect('/loginuser')->withErrors(['message' => 'User data not found.']);
        }

        // Validasi formulir pesanan disini
        $request->validate([
            'produk_id' => 'required',
            'total_amount' => 'required|numeric|min:1',
        ]);

        // Ambil data dari formulir
        $produk_id = $request->input('produk_id');

        // Mendapatkan harga produk dari tabel 'produk'
        $produk_harga = DB::table('produk')
            ->where('produk_id', $produk_id)
            ->value('harga');

        // Perhitungan total_amount berdasarkan harga produk dan jumlah pesanan
        $total_amount = $produk_harga * $request->input('total_amount');

        // Ambil data dari formulir
        $data = [
            'customer_id' => $userData->customer_id,
            'produk_id' => $produk_id,
            'total_amount' => $total_amount,
            'pesanan_date' => now(), // Sesuaikan dengan struktur tabel Anda
        ];

        try {
            // Insert data ke dalam tabel 'pesanan'
            DB::table('pesanan')->insert($data);

            // Redirect ke halaman dashboard setelah berhasil menambahkan pesanan
            return redirect('/user/dashboarduser')->with('success', 'Pesanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Print pesan kesalahan untuk debug
            dd($e->getMessage());
            return redirect()->back()->withErrors(['message' => 'Gagal menambahkan pesanan.']);
        }
    }

    public function hapusPesanan(Request $request)
    {
        // Get pesanan_id from the form submission
        $pesanan_id = $request->input('pesanan_id');

        // Perform the deletion based on $pesanan_id
        DB::table('pesanan')->where('pesanan_id', $pesanan_id)->delete();

        // Redirect back to the dashboard or any other appropriate page
        return redirect('/user/dashboarduser')->with('success', 'Pesanan berhasil dihapus.');
    }
}
