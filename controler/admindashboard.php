<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location:Login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
   <link rel="stylesheet" href="../view/admindashboard.css">
</head>
<body>
<header>

<div class="header">
    <h1>Admin Dashboard</h1>
    <div class="links">
        <a href="../model/viewprofile.php">Profile</a>
        <a href="../model/logout.php">Logout</a>
    </div>
</div>
</header>

<div class="container">
    <button onclick="window.location.href='manageuser.php'">Manage Users</button>
    <button onclick="window.location.href='../model/createcourse.php'">Create Courses</button>
    <button onclick="window.location.href='../model/assigncourses.php'">Assign Courses</button>
    <button onclick="window.location.href='../model/viewusers.php'">View Users</button>
     <button onclick="window.location.href='../model/viewcourses.php'">View Courses</button>
</div>

</body>
</html>
