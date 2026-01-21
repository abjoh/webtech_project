<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {

    header("Location: Login.html"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Dashboard</title>
    <link rel="stylesheet" href=../view/facultydashboard.css>
</head>

<body>

<header>
    <div class="header">
        <h1>Faculty Dashboard</h1>
        <div class="links">
            <a href="../model/viewprofile.php">Profile</a>
            <a href="../model/logout.php">Logout</a>
        </div>
    </div>
</header>

    <div class="container">
        <button onclick="window.location.href='../model/assignedcourses.php'">Assigned Courses</button>
        <button onclick="window.location.href='../model/uploadgrades.php'">Upload Marks and Grades</button>
        <button onclick="window.location.href='../model/enrolledstudents.php'">View Enrolled Students</button>
    </div>
    
</body>
</html>
