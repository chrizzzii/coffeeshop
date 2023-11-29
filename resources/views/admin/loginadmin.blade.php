<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>

<body>

    <h2>Login Admin</h2>

    <form method="POST" action="{{ url('/loginadmin') }}">
        @csrf

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    @error('login')
    <div style="color: red;">{{ $message }}</div>
    @enderror

    <a href="{{ url('/') }}">Home</a>

</body>

</html>