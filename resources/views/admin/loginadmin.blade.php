<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link href="../css/login.css" rel="stylesheet">
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
            Login Admin
        </div>

        @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ url('/loginadmin') }}">
            @csrf
            <div class="field">
                <input type="text" name="nama" required>
                <span class="fas fa-user"></span>
                <label for="nama">Nama</label>
            </div>

            <div class="field">
                <input type="password" name="password" required>
                <span class="fas fa-lock"></span>
                <label for="password">Password</label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>