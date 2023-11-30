<!-- resources/views/pengguna/tambahuser.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
</head>

<body>

    <h2>Daftar User</h2>

    @if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ url('/pengguna/terimauser') }}">
        @csrf

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Daftar</button>
    </form>

    <!-- Tampilkan pesan kesalahan jika ada -->

    <a href="{{ url('/') }}">Home</a>

</body>

</html>