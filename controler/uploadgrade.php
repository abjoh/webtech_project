<?php
session_start();

// ---------- Access Control ----------
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    // User is not logged in or not a faculty
    header("Location: Login.html"); // redirect to login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Marks and Grades</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styling */
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

        /* Buttons styling */
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

    <div class="header">
        <h1>Upload Marks and Grades</h1>
        <div class="links">
            <a href="facultydashboard.php">Dashboard</a>
            <a href="#">Profile</a>
            <a href="../model/logout.php">Logout</a>
        </div>
    </div>

    <!-- Body buttons -->
    <div class="container">
        <button onclick="window.location.href='quiz1.php'">Quiz 1</button>
        <button onclick="window.location.href='quiz2.php'">Quiz 2</button>
        <button onclick="window.location.href='midterm.php'">Mid-term</button>
        <button onclick="window.location.href='finalterm.php'">Final-term</button>
        <button onclick="window.location.href='grade.php'">Grade</button>
    </div>

</body>
</html>
