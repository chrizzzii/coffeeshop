<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        h1 {
            color: #4CAF50;
        }

        p {
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <p>Manage your coffee shop with ease!</p>

    <a href="{{ url('/admin/logout') }}">Logout</a>
    <a href="{{ url('/admin/dashboardadmin') }}">dashboardadmin</a>


    <h2>Product List</h2>

    <!-- Formulir Pencarian -->
    <form action="{{ url('/admin/dashboardadminsoftdelete') }}" method="GET">
        <label for="search">Search by Product Name:</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>


    <!-- Tabel Produk -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $key => $p)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $p->produk_nama }}</td>
                <td>${{ $p->harga }}</td>
                <td>
                    <a href="{{ url('/admin/edit-product/'.$p->produk_id) }}">Edit</a>
                    <a href="{{ url('/admin/restore/'.$p->produk_id) }}">Restore</a>
                    <a href="{{ url('/admin/harddelete/'.$p->produk_id) }}" onclick="return confirm('Are you sure?')">Hard Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>