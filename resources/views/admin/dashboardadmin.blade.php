<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>

    <style>
        .activity-data {
            width: 80%;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: justify;
        }

        .data-item {
            margin-bottom: 5px;
        }

        .aksi {
            display: flex;
        }

        .aksi a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            color: var(--text-color);
            border-radius: 3px;
        }

        .edit {
            background-color: greenyellow;
        }

        .softdelete {
            background-color: yellow;
        }

        .harddelete {
            background-color: red;
        }
    </style>

</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">COSHOP</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="{{ url('/admin/dashboardadmin') }}">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="{{ url('/admin/dashboardadminsoftdelete') }}">
                        <i class="uil uil-trash"></i>
                        <span class="link-name">Soft Delete</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Analytics</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">Like</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Comment</span>
                    </a></li>
                <li><a href="#">
                        <i class="uil uil-share"></i>
                        <span class="link-name">Promotion</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="{{ url('/admin/logout') }}">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <form action="{{ url('/admin/dashboardadmin') }}" method="GET">
                    <input type="text" name="search" placeholder="Search here..." value="{{ request('search') }}">
                    <button type="submit">Search</button>
                </form>
            </div>

            <img src="../img/testimonial-1.jpg" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Likes</span>
                        <span class="number">30.000</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comments</span>
                        <span class="number">20.000</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Promotion</span>
                        <span class="number">10.000</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-coffee"></i>
                    <span class="text">PRODUK</span>
                </div>

                <div class="activity-data">
                    <table>
                        <thead>
                            <tr>
                                <th><span class="data-title">Nama Produk</span></th>
                                <th><span class="data-title">Deskripsi</span></th>
                                <th><span class="data-title">Kategori</span></th>
                                <th><span class="data-title">Harga</span></th>
                                <th><span class="data-title">Aksi</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produk as $p)
                            @if($p->softdelete == 0)
                            <tr>
                                <td>{{ $p->produk_nama }}</td>
                                <td>
                                    @php
                                    $words = str_word_count($p->deskripsi, 1);
                                    $firstFiveWords = implode(' ', array_slice($words, 0, 7));
                                    @endphp
                                    {{ $firstFiveWords }}
                                </td>
                                <td>{{ $p->kategori }}</td>
                                <td>{{ $p->harga }}</td>
                                <td class="aksi">
                                    <a class="edit" href="{{ url('/admin/editproduk/'.$p->produk_id) }}">Edit</a>
                                    <a class="softdelete" href="{{ url('/admin/softdelete/'.$p->produk_id) }}">Soft Delete</a>
                                    <a class="harddelete" href="{{ url('/admin/harddelete/'.$p->produk_id) }}" onclick="return confirm('Are you sure?')">Hard Delete</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="activity">
                <div class="title">
                    <i class="uil uil-truck"></i>
                    <span class="text">PESANAN</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Order ID</span>
                        @foreach($orderData as $order)
                        <span class="data-list">{{ $order->pesanan_id }}</span>
                        @endforeach
                    </div>

                    <div class="data email">
                        <span class="data-title">Nama Customer</span>
                        @foreach($orderData as $order)
                        <span class="data-list">{{ $order->customer_name }}</span>
                        @endforeach
                    </div>

                    <div class="data joined">
                        <span class="data-title">Nama Produk</span>
                        @foreach($orderData as $order)
                        <span class="data-list">{{ $order->produk_nama }}</span>
                        @endforeach
                    </div>

                    <div class="data type">
                        <span class="data-title">Total</span>
                        @foreach($orderData as $order)
                        <span class="data-list">{{ $order->total_amount }}</span>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </section>

    <script src="../js/dashboard.js"></script>
</body>

</html>