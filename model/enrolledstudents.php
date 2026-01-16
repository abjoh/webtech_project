<?php
session_start();
require_once '../model/db.php';

// ---------- Access Control ----------
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'faculty') {
    header("Location: Login.html");
    exit();
}

$faculty_name = $_SESSION['user_name']; // Get faculty name from session

/* ---------- Fetch Students Enrolled in Faculty Courses ---------- */
$sql = "
SELECT u.user_id AS student_id, u.user_name AS student_name, ce.course_id, ce.section
FROM course_assignment ca
JOIN enrolled_students ce ON ca.course_id = ce.course_id AND ca.section = ce.section
JOIN users u ON u.user_name = ce.student_name AND u.role = 'student'
WHERE ca.faculty_name = '$faculty_name'
ORDER BY ce.course_id, ce.section, u.user_id
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
    <title>Enrolled Students</title>
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

        /* Header */
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

        .header .links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .header .links a:hover {
            text-decoration: underline;
        }

        /* Table container */
        .container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
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

        .no-data {
            text-align: center;
            font-weight: bold;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Enrolled Students</h1>
        <div class="links">
            <a href="facultydashboard.php">Dashboard</a>
            <a href="#">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <!-- Table -->
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Section</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['student_id']}</td>";
                        echo "<td>{$row['student_name']}</td>";
                        echo "<td>{$row['course_id']}</td>";
                        echo "<td>{$row['section']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td class='no-data' colspan='4'>No students enrolled in your courses.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
