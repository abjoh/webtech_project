<?php
session_start();
require_once "../model/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

$sql = "SELECT course_id, quiz1, quiz2, mid, final, grade
        FROM marks
        WHERE student_id = '$student_id'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Grades</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .header .links a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        .header .links a:hover {
            text-decoration: underline;
        }

        .container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background-color: #0077cc;
            color: white;
            padding: 12px;
            font-size: 15px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        tr:hover {
            background-color: #f1f7ff;
        }

        .grade {
            font-weight: bold;
            color: #0077cc;
        }

        .no-data {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>

<body>
<header>
<div class="header">
    <h1>My Grades</h1>
    <div class="links">
        <a href="../controler/studentdashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>
</header>

<div class="container">

<?php if (mysqli_num_rows($result) > 0) { ?>

    <table>
        <tr>
            <th>Course ID</th>
            <th>Quiz 1</th>
            <th>Quiz 2</th>
            <th>Mid</th>
            <th>Final</th>
            <th>Grade</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['course_id']; ?></td>
                <td><?php echo $row['quiz1']; ?></td>
                <td><?php echo $row['quiz2']; ?></td>
                <td><?php echo $row['mid']; ?></td>
                <td><?php echo $row['final']; ?></td>
                <td class="grade"><?php echo $row['grade']; ?></td>
            </tr>
        <?php } ?>

    </table>

<?php } else { ?>

    <p class="no-data">No marks uploaded yet.</p>

<?php } ?>

</div>
</body>
</html>
