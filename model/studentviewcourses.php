<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../controler/Login.html");
    exit();
}

$student_id = $_SESSION['user_id'];
$sql = "
    SELECT 
        c.course_id,
        c.course_name,
        e.section,
        c.day,
        c.time,
        c.room,
        u.user_id AS faculty_id,
        u.user_name AS faculty_name
    FROM enrolled_students e
    JOIN courses c
        ON e.course_id = c.course_id
        AND e.section = c.section
    LEFT JOIN course_assignment ca
        ON ca.course_id = c.course_id
        AND ca.section = c.section
    LEFT JOIN users u
        ON ca.faculty_id = u.user_id
        AND u.role = 'faculty'
    WHERE e.student_id = '$student_id'
    ORDER BY c.course_id
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Registered Courses</title>

<link rel="stylesheet" href="../view/studentviewcourses.css">
</head>

<body>
<header>
<div class="header">
    <h1>My Registered Courses</h1>
    <a href="../controler/studentdashboard.php">Dashboard</a>
</div>
</header>

<div class="container">

<table>
    <thead>
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Section</th>
            <th>Day</th>
            <th>Time</th>
            <th>Room</th>
            <th>Faculty</th>
        </tr>
    </thead>
    <tbody>

<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $facultyDisplay = "Not Assigned";

        if (!empty($row['faculty_id'])) {
            $facultyDisplay = $row['faculty_name'] . " (" . $row['faculty_id'] . ")";
        }

        echo "<tr>";
        echo "<td>{$row['course_id']}</td>";
        echo "<td>{$row['course_name']}</td>";
        echo "<td>{$row['section']}</td>";
        echo "<td>{$row['day']}</td>";
        echo "<td>{$row['time']}</td>";
        echo "<td>{$row['room']}</td>";
        echo "<td>$facultyDisplay</td>";
        echo "</tr>";
    }
} 

else {
    echo "<tr><td colspan='7' class='no-data'>No registered courses found</td></tr>";
}
?>
    </tbody>
</table>

</div>
</body>
</html>
