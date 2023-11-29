<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class User extends Controller
{
    public function showLoginForm()
    {
        return view('../pengguna/loginuser');
    }

    public function login(Request $request)
    {
        $nama = $request->input('nama');
        $password = $request->input('password');

        $pelanggan = DB::table('pelanggan') // Ganti dengan nama tabel yang sudah Anda buat
            ->where('customer_name', $nama)
            ->where('password', $password)
            ->first();

        if ($pelanggan) {
            // Menyimpan informasi sesi bahwa pengguna sudah login
            Session::put('pelanggan', true);

            // Authentication passed...
            return redirect()->intended('/user/dashboarduser');
        }

        // Jika login gagal, meneruskan pesan kesalahan ke halaman login
        return back()->withInput()->withErrors(['login' => 'Login gagal. Silakan cek kembali nama dan password Anda.']);
    }



    public function showDashboard()
    {
        // Pengecekan apakah pengguna sudah login
        if (!Session::has('pelanggan')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginuser');
        }

        // Tampilkan halaman dashboard pengguna
        return view('../pengguna/dashboarduser');
    }



    public function logout()
    {
        // Membersihkan semua data sesi
        Session::flush();

        // Redirect ke halaman login setelah logout
        return redirect('/loginuser');
    }
}
