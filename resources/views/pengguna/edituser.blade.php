<!DOCTYPE html>
<html>

<head>
    <title>Edit Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <form method="POST" action="{{ url('/user/edituser') }}">
        @csrf
        <h1>Edit Akun</h1>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $userData->customer_name }}" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="{{ $userData->email }}" required>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="{{ $userData->password }}" required>

        <button type="submit">Update</button>
    </form>
</body>

</html>