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

        .restore {
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
                <li><a href="{{ url('/admin/tambahproduk') }}">
                        <i class="uil uil-plus"></i>
                        <span class="link-name">Tambah Produk</span>
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
                <form action="{{ url('/admin/dashboardadminsoftdelete') }}" method="GET">
                    <input type="text" name="search" placeholder="Search here..." value="{{ request('search') }}">
                    <button type="submit">Search</button>
                </form>
            </div>

            <img src="../img/testimonial-1.jpg" alt="">
        </div>

        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-trash"></i>
                    <span class="text">SOFT DELETE</span>
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
                                    <a class="edit" href="{{ url('/admin/restore/'.$p->produk_id) }}">Restore</a>
                                    <a class="harddelete" href="{{ url('/admin/harddelete/'.$p->produk_id) }}" onclick="return confirm('Are you sure?')">Hard Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/dashboard.js"></script>
</body>

</html>