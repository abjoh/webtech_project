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
    
    <link rel="stylesheet" href="../view/viewcourses.css">
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
