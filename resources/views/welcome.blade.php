<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Your Coffee Shop</title>
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

        .login-links {
            margin-top: 20px;
        }

        .login-links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h1>Welcome to Your Coffee Shop</h1>
    <p>Enjoy our delicious coffee and pastries!</p>

    <h2>Featured Products</h2>
    <ul>
        @foreach($produk as $p)
        <li>
            <strong>{{ $p->produk_nama }}</strong><br>
            IDR {{ $p->harga }}
        </li>
        @endforeach
    </ul>

    <div class="login-links">
        <a href="{{ url('/loginadmin') }}">Login as Admin</a>
        <a href="{{ url('/loginuser') }}">Login as User</a>
    </div>
</body>

</html>