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
    <link rel="stylesheet" href="../view/manageuser.css">

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
