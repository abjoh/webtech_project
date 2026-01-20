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
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f4f4; }
        .header { background:#0077cc; color:white; padding:20px 40px; display:flex; justify-content:space-between; align-items:center; }
        .header a { color:white; text-decoration:none; font-weight:bold; }
        .container { padding:40px; display:flex; flex-direction:column; align-items:center; }
        table { border-collapse: collapse; width:90%; max-width:900px; background:white; box-shadow:0 4px 12px rgba(0,0,0,0.15); }
        th, td { padding:12px 15px; border:1px solid #ddd; text-align:center; }
        th { background:#0077cc; color:white; }
        tr:nth-child(even) { background:#f9f9f9; }
        tr:hover { background:##555; }
        .back-btn { display:inline-block; padding:10px 20px; background:#0077cc; color:white; text-decoration:none; border-radius:6px; margin:20px 0; }
        .back-btn:hover { background:#005fa3; }
    </style>
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
