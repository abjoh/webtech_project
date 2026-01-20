<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location:../controler/Login.html");
    exit();
}

$message = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $course_id  = $_POST['course_id'];
    $faculty_id = $_POST['faculty_id'];

    $courseCheck = mysqli_query($conn, "SELECT * FROM courses WHERE course_id='$course_id'");
    if (!$courseCheck || mysqli_num_rows($courseCheck) === 0) {
        $errors[] = "Course ID does not exist.";
    }

    $facultyCheck = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$faculty_id' AND role='faculty'");
    if (!$facultyCheck || mysqli_num_rows($facultyCheck) === 0) {
        $errors[] = "Faculty ID does not exist or is not a faculty.";
    }

    if (empty($errors)) {
        $course = mysqli_fetch_assoc($courseCheck);

        $section = $course['section'];
        $time    = $course['time'];
        $day     = $course['day'];
        $room    = $course['room'];

        $insertSql = "
            INSERT INTO course_assignment (section, time, course_id, day, room, faculty_id)
            VALUES ('$section','$time','$course_id','$day','$room','$faculty_id')
        ";

        if (mysqli_query($conn, $insertSql)) {
            $message = "Course assigned to faculty successfully!";
        } else {
            $errors[] = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Course</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin:0; padding:0; }

        .header { background: #0077cc; color: white; padding: 20px 40px; display:flex; justify-content: space-between; align-items:center; }

        .header a { color:white; text-decoration:none; font-weight:bold; }

        .container { max-width: 500px; margin: 50px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.15); }

        input, button { width: 100%; padding:12px; margin-top:15px; font-size:15px; border-radius:6px; border:1px solid #ccc; }

        button { background:#0077cc; color:white; border:none; cursor:pointer; font-weight:bold; }

        button:hover { background:#005fa3; }

        .error { color:red; margin-bottom:15px; }

        .success { color:green; margin-bottom:15px; }

        .back-btn { background:#555; margin-top:10px; }
        .back-btn:hover { background:#333; }
    </style>

    <script>
        function validateForm() {
            let courseId  = document.getElementById('course_id').value;
            let facultyId = document.getElementById('faculty_id').value;

            let errors = [];

            if (!courseId) errors.push("Course ID is required");
            if (!facultyId) errors.push("Faculty ID is required");

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }

            return true;
        }

        function goBack() {
            window.history.back();
        }
  </script>
</head>
<body>
<header>
<div class="header">
    <h1>Assign Course to Faculty</h1>
    <a href="logout.php">Logout</a>
</div>
</header>

<div class="container">
    <?php
    if (!empty($message)) echo "<div class='success'>$message</div>";
    if (!empty($errors)) echo "<div class='error'>" . implode("<br>", $errors) . "</div>";
    ?>

    <form method="POST" onsubmit="return validateForm()">
        <input type="text" id="course_id" name="course_id" placeholder="Course ID">
        <input type="text" id="faculty_id" name="faculty_id" placeholder="Faculty ID">

        <button type="submit">Assign Course</button>
        <button type="button" class="back-btn" onclick="goBack()">← Back</button>
    </form>
</div>

</body>
</html>
