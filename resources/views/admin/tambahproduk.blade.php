<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        h1 {
            color: #4CAF50;
        }

        form {
            width: 50%;
            margin: 20px auto;
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
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
    <h1>Add Product</h1>

    <form action="{{ url('/admin/simpanproduk') }}" method="post">
        @csrf

        <label for="produk_nama">Product Name:</label>
        <input type="text" id="produk_nama" name="produk_nama" required>

        <label for="harga">Product Price:</label>
        <input type="text" id="harga" name="harga" required>

        <!-- Add other fields as needed -->

        <button type="submit">Add Product</button>
    </form>
</body>

</html>