<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <title>Neumorphism Login Form UI | CodingNepal</title> -->
    <link href="../css/daftar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .content {
            position: relative;
        }

        .back-icon {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="back-icon">
            <a href="{{ url('/') }}"><i class="fas fa-chevron-left"></i></a>
        </div>

        <div class="text">
            Register User
        </div>

        @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/pengguna/terimauser') }}">
            @csrf
            <div class="field">
                <input type="text" name="nama" required>
                <span class="fas fa-user"></span>
                <label for="nama">Nama</label>
            </div>

            <div class="field">
                <input type="email" name="email" required>
                <span class="fas fa-user"></span>
                <label for="email">Email:</label>
            </div>

            <div class="field">
                <input type="password" name="password" required>
                <span class="fas fa-lock"></span>
                <label for="password">Password</label>
            </div>
            <button type="submit">Register</button>

            <div class="sign-up">
                Have a member?
                <a href="{{ url('/loginuser') }}">Login</a>
            </div>
        </form>
    </div>
</body>

</html>