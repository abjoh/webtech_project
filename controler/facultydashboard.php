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
            font-size: 28px;
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

        /* Body container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            gap: 25px;
            padding: 50px;
        }

        .container button {
            width: 250px;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #0077cc;
            color: white;
            transition: background-color 0.3s;
        }

        .container button:hover {
            background-color: #005fa3;
        }
    </style>
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
