<?php
session_start();
require_once 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
    header("Location: ../controler/Login.html");
    exit();
}

$faculty_id = $_SESSION['user_id'];

$sql = "
    SELECT course_id, section, time, day, room
    FROM course_assignment
    WHERE faculty_id='$faculty_id'
    ORDER BY course_id, section
";
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
    
    <link rel="stylesheet" href="../view/assignedcourse.css">
</head>

<body>

<div class="header">
    <h1>My Assigned Courses</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <a class="back-btn" href="javascript:history.back()">← Back</a>

    <table>
        <thead>
            <tr>
                <th>Course ID</th>
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
                    echo "<td>{$row['section']}</td>";
                    echo "<td>{$row['time']}</td>";
                    echo "<td>{$row['day']}</td>";
                    echo "<td>{$row['room']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No courses assigned to you yet.</td></tr>";
            }
         ?>
        </tbody>
    </table>
</div>

</body>
</html>
