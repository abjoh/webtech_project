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

/* ---------- HEADER ---------- */
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

/* ---------- MAIN CONTAINER ---------- */
.container {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 18px;
    padding: 40px;
}

/* ---------- DASHBOARD BUTTONS ---------- */
.container button,
.container a.btn {
    width: 260px;
    padding: 16px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    background-color: #0077cc;
    color: white;
    transition: background-color 0.3s;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
}

.container button:hover,
.container a.btn:hover {
    background-color: #005fa3;
}

    </style>
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
<!-- ---------- CONTENT ---------- -->
<div class="container">
    <button onclick="window.location.href='manageuser.php'">Manage Users</button>
    <button onclick="window.location.href='../model/createcourse.php'">Create Courses</button>
    <button onclick="window.location.href='../model/assigncourses.php'">Assign Courses</button>
    <button onclick="window.location.href='../model/viewusers.php'">View Users</button>
     <button onclick="window.location.href='../model/viewcourses.php'">View Courses</button>
</div>

</body>
</html>
