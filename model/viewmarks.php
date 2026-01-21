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

    <link rel="stylesheet" href="../view/viewmarks.css">
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
