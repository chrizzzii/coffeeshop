<!-- resources/views/pengguna/edituser.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Edit User Profile</title>
</head>

<body>
    <h1>Edit User Profile</h1>

    <form method="POST" action="{{ url('/user/edituser') }}">
        @csrf

        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" value="{{ $userData->customer_name }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $userData->email }}" required>

        <label for="password">New Password:</label>
        <input type="password" name="password">

        <!-- You can add additional fields here -->

        <button type="submit">Save Changes</button>
    </form>

    <a href="{{ url('/user/dashboarduser') }}">Back to Dashboard</a>
</body>

</html>