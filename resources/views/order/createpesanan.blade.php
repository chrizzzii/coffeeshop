<!-- resources/views/pengguna/createpesanan.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Create Pesanan</title>
</head>

<body>
    <h1>Create Pesanan</h1>

    <form method="POST" action="{{ url('/order/tambahpesanan') }}">
        @csrf

        <p>ID: {{$customer_id}}</p>

        <label for="produk_id">Produk:</label>
        <select name="produk_id" required>
            @foreach($produkList as $produk)
            <option value="{{ $produk->produk_id }}">{{ $produk->produk_nama }} - {{ $produk->harga }}</option>
            @endforeach
        </select>

        <label for="total_amount">Jumlah:</label>
        <input type="number" name="total_amount" required>

        <button type="submit">Tambah Pesanan</button>
    </form>

    <a href="{{ url('/user/dashboarduser') }}">Back to Dashboard</a>
</body>

</html>