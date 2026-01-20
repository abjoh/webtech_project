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

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-left: 20px;
        }

        .header a:hover {
            text-decoration: underline;
        }

        /* ---------- CONTAINER (WIDTH FIXED) ---------- */
        .container {
            max-width: 500px;      /* 🔥 reduced width */
            margin: 50px auto;
            background: white;
            padding: 30px;         /* 🔥 matches other pages */
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
            text-align: center;
        }

        .dashboard-title {
            margin-bottom: 10px;
            font-size: 28px;
        }

        .welcome {
            color: #555;
            margin-bottom: 35px;
            font-size: 16px;
        }

        /* ---------- BUTTONS ---------- */
        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            margin: 14px 0;
            background-color: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #005fa3;
        }
    </style>
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
<!-- ---------- CONTENT ---------- -->
<div class="container">
    <h2 class="dashboard-title">Welcome</h2>
    <p class="welcome">Student ID: <strong><?php echo $user_id; ?></strong></p>

    <a class="btn" href="../model/registercourses.php">Course Registration</a>
    <a class="btn" href="../model/studentviewcourses.php">View Class Routine & Faculty</a>
    <a class="btn" href="../model/viewmarks.php">View Marks & Grades</a>
    
</div>

</body>
</html>
