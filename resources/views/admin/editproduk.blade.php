<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form action="{{ url('/admin/updateproduct/'.$product->produk_id) }}" method="post">
        @csrf
        <h1>Edit Produk</h1>

        <label for="produk_nama">Nama Produk:</label>
        <input type="text" id="produk_nama" name="produk_nama" value="{{ $product->produk_nama }}" required>

        <label for="deskripsi">Deskripsi:</label>
        <input type="text" id="deskripsi" name="deskripsi" value="{{ $product->deskripsi }}" required>

        <label for="kategori">Kategori:</label>
        <input type="text" id="kategori" name="kategori" value="{{ $product->kategori }}" required>

        <label for="harga">Harga:</label>
        <input type="text" id="harga" name="harga" value="{{ $product->harga }}" required>

        <!-- Add other fields as needed -->

        <button type="submit">Update Produk</button>
    </form>
</body>

</html>