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

        // Mengambil data produk dari tabel dengan Query Builder dengan filter pencarian dan softdelete
        $produk = DB::table('produk')
            ->select('produk_id', 'produk_nama', 'harga')
            ->where('produk_nama', 'like', "%$searchTerm%")
            ->where('softdelete', 0) // Hanya tampilkan data yang softdelete = 0
            ->get();

        // Tampilkan halaman dashboard admin dengan data produk
        return view('../admin/dashboardadmin', ['produk' => $produk]);
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
            ->select('produk_id', 'produk_nama', 'harga')
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


    public function logout()
    {
        // Membersihkan semua data sesi
        Session::flush();

        // Redirect ke halaman login setelah logout
        return redirect('/loginadmin');
    }
}
