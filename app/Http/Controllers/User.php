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

        $pelanggan = DB::table('pelanggan')
            ->where('customer_name', $nama)
            ->where('password', $password)
            ->first();

        if ($pelanggan) {
            // Menyimpan informasi sesi bahwa pengguna sudah login
            Session::put('pelanggan', $nama);

            // Authentication passed...
            return redirect()->intended('/user/dashboarduser');
        }

        // Jika login gagal, meneruskan pesan kesalahan ke halaman login
        return back()->withInput()->withErrors(['login' => 'Login gagal. Silakan cek kembali nama dan password Anda.']);
    }

    public function tambahuser()
    {
        return view('../pengguna/tambahuser');
    }

    public function terimauser(Request $request)
    {
        // Validasi formulir pendaftaran disini

        // Ambil data dari formulir
        $data = [
            'customer_name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'), // Hash the password
        ];

        // Insert data ke dalam tabel 'pelanggan' menggunakan Query Builder
        DB::table('pelanggan')->insert($data);

        // Redirect ke halaman login atau dashboard setelah pendaftaran
        return redirect('/loginuser')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }


    public function showDashboard()
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

        // Mendapatkan data pesanan dari tabel 'pesanan' berdasarkan customer_id
        $pesananData = DB::table('pesanan')
            ->where('customer_id', $userData->customer_id)
            ->get();

        // Tampilkan halaman dashboard pengguna dengan data pengguna dan pesanan
        return view('../pengguna/dashboarduser', ['userData' => $userData, 'pesananData' => $pesananData]);
    }


    public function hapususer(Request $request)
    {
        // Pengecekan apakah pengguna sudah login
        if (!Session::has('pelanggan')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginuser');
        }

        // Ambil data pengguna dari tabel 'pelanggan'
        $userData = DB::table('pelanggan')
            ->where('customer_name', Session::get('pelanggan'))
            ->first();

        if ($request->input('password') === $userData->password) {
            // Hapus akun
            DB::table('pelanggan')->where('customer_name', Session::get('pelanggan'))->delete();

            // Logout
            Session::forget('pelanggan');

            return redirect('/loginuser')->with('success', 'Akun berhasil dihapus. Silakan login kembali.');
        }
        return redirect()->back()->withErrors(['password' => 'Password salah. Akun tidak dihapus.']);
    }

    public function showEditForm()
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

        // Tampilkan halaman edit profil pengguna dengan data pengguna
        return view('pengguna.edituser', ['userData' => $userData]);
    }

    public function editUser(Request $request)
    {
        // Pengecekan apakah pengguna sudah login
        if (!Session::has('pelanggan')) {
            // Jika belum login, redirect ke halaman login
            return redirect('/loginuser');
        }

        // Ambil data pengguna dari tabel 'pelanggan'
        $userData = DB::table('pelanggan')
            ->where('customer_name', Session::get('pelanggan'))
            ->first();

        // Periksa apakah data pengguna ditemukan
        if (!$userData) {
            // Handle case when user data is not found
            return redirect('/loginuser')->withErrors(['message' => 'User data not found.']);
        }

        // Ambil data dari formulir
        $data = [
            'customer_name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        // Check if a new password is provided and update the password if needed
        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        // Update data pengguna di dalam tabel 'pelanggan'
        DB::table('pelanggan')
            ->where('customer_name', $userData->customer_name)
            ->update($data);

        // Update session data with new customer_name
        Session::put('pelanggan', $data['customer_name']);

        // Redirect ke halaman dashboard setelah berhasil mengedit profil
        return redirect('/user/dashboarduser')->with('success', 'Profil berhasil diperbarui.');
    }



    public function logout()
    {
        // Membersihkan semua data sesi
        Session::forget('pelanggan');

        // Redirect ke halaman login setelah logout
        return redirect('/loginuser');
    }
}
