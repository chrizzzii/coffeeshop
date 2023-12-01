<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link href="../css/user.css" rel="stylesheet">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <style>
        /* Add any additional styles here */
        .order-list {
            list-style-type: none;
            padding: 0;
        }

        .order-list li {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            overflow: hidden;
            /* Add overflow property */
        }

        .order-list li button {
            background-color: #e44d26;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .order-list li button:hover {
            background-color: #c44123;
        }

        /* Style for the table */
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .order-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <!-- Top navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ url('/user/logout') }}" target="_blank">Logout</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="{{ url('/user/edituser') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="../img/pasfotoo.jpg">
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{ $userData->customer_name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-settings-gear-65"></i>
                                <span>Settings</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-calendar-grid-58"></i>
                                <span>Activity</span>
                            </a>
                            <a href="../examples/profile.html" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Support</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#!" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(../img/carousel-2.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10">
                        <h1 class="display-2 text-white">Hello {{ $userData->customer_name }}</h1>
                        <p class="text-white mt-0 mb-5">
                            This page represents your account profile on the COSHOP. Here, you can access information specific to your account, allowing you to stay informed about your details and manage any personalized settings or preferences.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="{{ url('/user/edituser') }}">
                                        <img src="../img/pasfotoo.jpg" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/order/createpesanan') }}" class="btn btn-sm btn-info mr-4">Buat Pesanan</a>
                                <a href="{{ url('/user/hapususer') }}" class="btn btn-sm btn-danger float-right">Hapus Akun</a>
                            </div>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <div>
                                            <span class="heading">22</span>
                                            <span class="description">Friends</span>
                                        </div>
                                        <div>
                                            <span class="heading">10</span>
                                            <span class="description">Photos</span>
                                        </div>
                                        <div>
                                            <span class="heading">89</span>
                                            <span class="description">Comments</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    {{ $userData->customer_name }}
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>Jakarta, Indonesia
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Fullstack Engineer
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>Diponegoro University
                                </div>
                                <hr class="my-4">
                                <p>“Life is like riding a bicycle. To keep your balance, you must keep moving.” Albert Einstein</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-body">
                            <h2>Daftar Pesanan</h2>
                            @if ($pesananData->isEmpty())
                            <p>Tidak ada pesanan.</p>
                            @else
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Produk Nama</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesananData as $pesanan)
                                    @php
                                    $produk = DB::table('produk')->where('produk_id', $pesanan->produk_id)->first();
                                    @endphp

                                    <tr>
                                        <td>{{ $pesanan->pesanan_id }}</td>
                                        <td>{{ $produk->produk_nama }}</td>
                                        <td>{{ $pesanan->total_amount }}</td>
                                        <td>
                                            <form action="{{ url('/order/hapuspesanan') }}" method="post" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="pesanan_id" value="{{ $pesanan->pesanan_id }}">
                                                <button class="btn btn-sm btn-danger" type="submit">Hapus Pesanan</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6 m-auto text-center">
                <div class="copyright">
                    <p>Made with <a href="https://www.creative-tim.com/product/argon-dashboard" target="_blank">Argon Dashboard</a> by Creative Tim</p>
                </div>
            </div>
        </div>
    </footer> -->
</body>

</html>