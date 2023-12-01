<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admin extends Controller
{
    public function showLoginForm()
    {
        return view('../admin/loginadmin');
    }

    public function login(Request $request)
    {
        $nama = $request->input('nama');
        $password = $request->input('password');

        $admin = DB::table('admin') // Ganti dengan nama tabel yang sudah Anda buat
            ->where('nama', $nama)
            ->where('password', $password)
            ->first();

        if ($admin) {
            // Menyimpan informasi sesi bahwa admin sudah login
            Session::put('admin', true);

            // Authentication passed...
            return redirect()->intended('/admin/dashboardadmin');
        }

        // Jika login gagal, meneruskan pesan kesalahan ke halaman login
        return back()->withInput()->withErrors(['login' => 'Login gagal. Silakan cek kembali nama dan password Anda.']);
    }

    public function showDashboard(Request $request)
    {
        // Pengecekan apakah admin sudah login
        if (!Session::has('admin')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginadmin');
        }

        // Mendapatkan data pencarian dari formulir
        $searchTerm = $request->input('search');

        // Query Join untuk mendapatkan data pesanan, pelanggan, dan produk
        $orderDataQuery = DB::table('pesanan')
            ->join('pelanggan', 'pesanan.customer_id', '=', 'pelanggan.customer_id')
            ->join('produk', 'pesanan.produk_id', '=', 'produk.produk_id')
            ->select('pesanan.pesanan_id', 'pelanggan.customer_name', 'produk.produk_nama', 'pesanan.total_amount');

        // Jika terdapat pencarian, tambahkan kondisi where
        if ($searchTerm) {
            $orderDataQuery->where(function ($query) use ($searchTerm) {
                $query->where('pelanggan.customer_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('produk.produk_nama', 'like', '%' . $searchTerm . '%');
            });
        }

        // Eksekusi query dan ambil hasil
        $orderData = $orderDataQuery->get();

        // Query untuk mendapatkan data produk
        $produkQuery = DB::table('produk');

        // Jika terdapat pencarian, tambahkan kondisi where
        if ($searchTerm) {
            $produkQuery->where('produk_nama', 'like', '%' . $searchTerm . '%');
        }

        // Eksekusi query dan ambil hasil
        $produk = $produkQuery->get();

        // Mengirimkan data ke view
        return view('/admin/dashboardadmin', ['orderData' => $orderData, 'produk' => $produk]);
    }


    public function showSoftdelete(Request $request)
    {
        // Pengecekan apakah admin sudah login
        if (!Session::has('admin')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginadmin');
        }

        // Mendapatkan data pencarian dari formulir
        $searchTerm = $request->input('search');

        // Mengambil data produk dari tabel dengan Query Builder dengan filter pencarian dan softdelete
        $produk = DB::table('produk')
            ->select('produk_id', 'produk_nama', 'deskripsi', 'kategori', 'harga')
            ->where('produk_nama', 'like', "%$searchTerm%")
            ->where('softdelete', 1) // Hanya tampilkan data yang softdelete = 0
            ->get();

        // Tampilkan halaman dashboard admin dengan data produk
        return view('../admin/softdelete', ['produk' => $produk]);
    }

    public function softdelete($id)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Ubah nilai kolom softdelete menjadi 1 berdasarkan ID
        DB::table('produk')->where('produk_id', $id)->update(['softdelete' => 1]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect('/admin/dashboardadmin')->with('softdelete', 'Produk di-soft delete');
    }

    public function restore($id)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Ubah nilai kolom softdelete menjadi 1 berdasarkan ID
        DB::table('produk')->where('produk_id', $id)->update(['softdelete' => 0]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect('/admin/dashboardadmin')->with('softdelete', 'Produk di-soft delete');
    }

    public function harddelete($id)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Lakukan hard delete berdasarkan ID
        DB::table('produk')->where('produk_id', $id)->delete();

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect('/admin/dashboardadmin')->with('harddelete', 'Produk dihapus secara permanen');
    }

    public function editProduct($id)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Mengambil data produk berdasarkan ID
        $product = DB::table('produk')->where('produk_id', $id)->first();

        // Tampilkan halaman edit produk dengan data produk
        return view('../admin/editproduk', ['product' => $product]);
    }

    public function updateProduct(Request $request, $id)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Validasi form jika diperlukan

        // Update data produk berdasarkan ID
        DB::table('produk')
            ->where('produk_id', $id)
            ->update([
                'produk_nama' => $request->input('produk_nama'),
                'harga' => $request->input('harga'),
                // Add other fields as needed
            ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect('/admin/dashboardadmin')->with('update', 'Produk berhasil diupdate');
    }

    public function tambahProduk()
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Tampilkan halaman tambah produk
        return view('../admin/tambahproduk');
    }

    public function simpanProduk(Request $request)
    {
        // Pastikan admin sudah login
        if (!Session::has('admin')) {
            return redirect('/loginadmin');
        }

        // Validasi form jika diperlukan

        // Simpan data produk baru
        DB::table('produk')->insert([
            'produk_nama' => $request->input('produk_nama'),
            'harga' => $request->input('harga'),
            'softdelete' => 0,
            // Add other fields as needed
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect('/admin/dashboardadmin')->with('addproduct', 'Product added successfully');
    }




    public function logout()
    {
        // Membersihkan semua data sesi
        Session::flush();

        // Redirect ke halaman login setelah logout
        return redirect('/loginadmin');
    }
}
