<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../controler/Login.html");
    exit();
}
$sql = "SELECT course_id, course_name, section, time, day, room FROM courses ORDER BY course_id, section";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Courses</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            padding: 40px;
            flex-direction: column;
            align-items: center;
        }

        table {
            width: 100%;
            max-width: 900px;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #0077cc;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6f0ff;
        }

        .back-btn {
            margin-top: 20px;
            text-align: center;
        }

        .btn {
            padding: 10px 25px;
            background-color: #555;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            display: inline-block;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #005fa3;
        }

        .no-data {
            font-weight: bold;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Available Courses</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">

    <table>
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Section</th>
                <th>Time</th>
                <th>Day</th>
                <th>Room</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['course_id']}</td>";
                    echo "<td>{$row['course_name']}</td>";
                    echo "<td>{$row['section']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td>{$row['day']}</td>";
                    echo "<td>{$row['room']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='no-data'>No courses found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="back-btn">
        <a href="javascript:history.back()" class="btn">← Back</a>
    </div>

</div>

</body>
</html>
