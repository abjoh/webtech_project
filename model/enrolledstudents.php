<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty') {
    header("Location: ../controler/Login.html");
    exit();
}

$faculty_id = $_SESSION['user_id'];
$sectionsSql = "
    SELECT course_id, section 
    FROM course_assignment 
    WHERE faculty_id='$faculty_id'
    ORDER BY course_id, section
";
$sectionsResult = mysqli_query($conn, $sectionsSql);

if (!$sectionsResult) {
    die("Query Failed: " . mysqli_error($conn));
}

$sections = [];
while ($row = mysqli_fetch_assoc($sectionsResult)) {
    $sections[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enrolled Students</title>
    
    <link rel="stylesheet" href="../view/enrolledstudents.css">
</head>

<body>
<header>
<div class="header">
    <h1>Enrolled Students</h1>
    <a href="logout.php">Logout</a>
</div>
</header>

<a class="back-btn" href="javascript:history.back()">← Back</a>

<div class="container">
    <?php if (empty($sections)): ?>
        <p>No courses assigned to you yet.</p>
    <?php else: ?>
        <?php foreach ($sections as $sec): 
            $course_id = $sec['course_id'];
            $section   = $sec['section'];

            $studentsSql = "
                SELECT s.user_id, s.user_name
                FROM enrolled_students e
                JOIN users s ON e.student_id = s.user_id
                WHERE e.course_id='$course_id' AND e.section='$section'
                ORDER BY s.user_name
            ";
            $studentsResult = mysqli_query($conn, $studentsSql);
        ?>
            <div class="section-box">
                <h3>Course ID: <?= $course_id ?> | Section: <?= $section ?></h3>
                <?php if (mysqli_num_rows($studentsResult) > 0): ?>
                    <ul>
                        <?php while($stu = mysqli_fetch_assoc($studentsResult)): ?>
                            <li><?= $stu['user_name'] ?> (<?= $stu['user_id'] ?>)</li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No students enrolled in this section.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
