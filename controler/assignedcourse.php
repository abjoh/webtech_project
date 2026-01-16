<?php
session_start();
require_once '../model/db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: Login.html");
    exit();
}

$faculty_name = $_SESSION['user_name'];

// Fetch assigned courses
$sql = "SELECT ac.course_id, ac.day, ac.time, ac.section, ac.room
        FROM course_assignment ac
        INNER JOIN users u ON ac.faculty_name = u.user_name
        WHERE u.user_name = '$faculty_name'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Courses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
            flex-grow: 1;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        table {
            width: 90%;
            max-width: 900px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        th, td {
            padding: 14px 18px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #0077cc;
            color: white;
            font-size: 16px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6f0ff;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            padding: 20px;
        }
    </style>
</head>
<body>

<header>
<div class="header">
    <h1>Assigned Courses</h1>
    <div class="links">
        <a href="facultydashboard.php">Dashboard</a>
        <a href="#">Profile</a>
        <a href="../model/logout.php">Logout</a>
    </div>
</div>
</header>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Day</th>
                <th>Time Duration</th>
                <th>Section</th>
                <th>Room</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['course_id']}</td>";
                    echo "<td>{$row['day']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td>{$row['section']}</td>";
                    echo "<td>{$row['room']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td class='no-data' colspan='5'>No courses assigned</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
