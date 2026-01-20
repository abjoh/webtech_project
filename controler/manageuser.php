<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: Login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #0077cc;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header .links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .header .links a:hover {
            text-decoration: underline;
        }

        .container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 40px;
        }

        .container button {
            width: 280px;
            padding: 16px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #0077cc;
            color: white;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        .container button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Manage Users</h1>
    <div class="links">
        <a href="admindashboard.php">Dashboard</a>
        <a href="../model/viewprofile.php">Profile</a>
        <a href="../model/logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <button onclick="window.location.href='../model/createaccount.php'">
        Create Account
    </button>

    <button onclick="window.location.href='../model/deleteuser.php'">
        Deactivate Account
    </button>
</div>

</body>
</html>
