<!-- resources/views/pengguna/dashboarduser.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
</head>

<body>
    <h1>Welcome to the User Dashboard, {{ $userData->customer_name }}!</h1>

    <!-- Navigasi atau konten dashboard lainnya dapat ditambahkan di sini -->

    <p>Email: {{ $userData->email }}</p>

    <form method="POST" action="{{ url('/user/hapususer') }}" onsubmit="return confirm('Masukkan password akun Anda untuk menghapus akun.');">
        @csrf
        <input type="password" name="password" placeholder="Masukkan password">
        <button type="submit">Hapus Akun</button>
    </form>

    <h2>Daftar Pesanan</h2>
    @if ($pesananData->isEmpty())
    <p>Tidak ada pesanan.</p>
    @else
    <ul>
        @foreach ($pesananData as $pesanan)
        @php
        $produk = DB::table('produk')->where('produk_id', $pesanan->produk_id)->first();
        @endphp

        <li>ID Pesanan: {{ $pesanan->pesanan_id }}, Produk Nama: {{ $produk->produk_nama }}, Harga: {{ $pesanan->total_amount }}
            <form action="{{ url('/order/hapuspesanan') }}" method="post" style="display: inline;">
                @csrf
                <input type="hidden" name="pesanan_id" value="{{ $pesanan->pesanan_id }}">
                <button type="submit">Hapus Pesanan</button>
            </form>
        </li>
        @endforeach
    </ul>
    @endif




    <a href="{{ url('/user/edituser') }}">Edit Profil</a>
    <a href="{{ url('/order/createpesanan') }}">Buat Pesanan</a>
    <a href="{{ url('/user/logout') }}">Logout</a>
</body>

</html>