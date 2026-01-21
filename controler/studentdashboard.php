<?php
session_start();

/* ---------- STUDENT ACCESS ONLY ---------- */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../controler/Login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>

    <link rel="stylesheet" href="../view/studentdashboard.css">
</head>

<body>

<header>
<div class="header">
    <h1>Student Dashboard</h1>
    <div>
        <a href="../model/viewprofile.php">Profile</a>
        <a href="changepassword.html">Change Password</a>
        <a href="../model/logout.php">Logout</a>
    </div>
</div>
</header>

<div class="container">
    <h2 class="dashboard-title">Welcome</h2>
    <p class="welcome">Student ID: <strong><?php echo $user_id; ?></strong></p>

    <a class="btn" href="../model/registercourses.php">Course Registration</a>
    <a class="btn" href="../model/studentviewcourses.php">View Class Routine & Faculty</a>
    <a class="btn" href="../model/viewmarks.php">View Marks & Grades</a>
    
</div>
</body>
</html>
