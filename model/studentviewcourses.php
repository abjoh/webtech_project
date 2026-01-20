<?php
session_start();
require_once 'db.php';

/* ---------- STUDENT ONLY ---------- */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../controler/Login.html");
    exit();
}

$student_id = $_SESSION['user_id'];

/* ---------- FETCH REGISTERED COURSES + FACULTY ---------- */
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

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f4f4f4;
}

/* HEADER */
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

/* CONTAINER */
.container {
    max-width: 1000px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
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
} else {
    echo "<tr><td colspan='7' class='no-data'>No registered courses found</td></tr>";
}
?>

    </tbody>
</table>

</div>

</body>
</html>
