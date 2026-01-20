<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../controler/Login.html");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $course_id  = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $quiz1      = $_POST['quiz1'];
    $quiz2      = $_POST['quiz2'];
    $mid        = $_POST['mid'];
    $final      = $_POST['final'];
    $grade      = $_POST['grade'];

    $studentCheck = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$student_id' AND role='student'");
    
    if (mysqli_num_rows($studentCheck) == 0) {
        $error = "Error: Student ID not found or not a student.";
    }

    $courseCheck = mysqli_query($conn, "SELECT * FROM courses WHERE course_id='$course_id'");
    
    if (mysqli_num_rows($courseCheck) == 0) {
        $error = "Error: Course ID not found.";
    }

    if (!$error) {
        
        $insertSql = "INSERT INTO marks (course_id, student_id, quiz1, quiz2, mid, final, grade)
                      VALUES ('$course_id', '$student_id', $quiz1, $quiz2, $mid, $final, '$grade')";

        if (mysqli_query($conn, $insertSql)) {
            $success = "Marks uploaded successfully.";
        } else {
            $error = "Insert Failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Marks & Grades</title>
    <link rel="stylesheet" href="../view/uploadgrades.css">

    <script>
        function validateForm() {
            let studentId = document.getElementById('student_id').value;
            let courseId  = document.getElementById('course_id').value;
            let quiz1 = document.getElementById('quiz1').value;
            let quiz2 = document.getElementById('quiz2').value;
            let mid   = document.getElementById('mid').value;
            let final = document.getElementById('final').value;
            let grade = document.getElementById('grade').value;

            let errors = [];

            if (!studentId) errors.push("Student ID required");
            if (!courseId) errors.push("Course ID required");

            [quiz1, quiz2, mid, final].forEach((val, i) => {
                if (val === "") errors.push(["Quiz1","Quiz2","Mid","Final"][i] + " required");
                else if (isNaN(val) || val < 0 || val > 100) errors.push(["Quiz1","Quiz2","Mid","Final"][i]+" must be 0-100");
            });

            if (!grade) errors.push("Grade must be selected");

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
<header>
<div class="header">
    <h1>Upload Marks & Grades</h1>
    <a href="logout.php">Logout</a>
</div>
</header>

<div class="container">
    <?php
    if (!empty($message)) echo "<div class='success'>$message</div>";
    if (!empty($errors)) echo "<div class='error'>" . implode("<br>", $errors) . "</div>";
    ?>

    <form method="POST" onsubmit="return validateForm()">
        <input type="text" id="student_id" name="student_id" placeholder="Student ID">
        <input type="text" id="course_id" name="course_id" placeholder="Course ID">
        <input type="text" id="quiz1" name="quiz1" placeholder="Quiz 1 (0-100)">
        <input type="text" id="quiz2" name="quiz2" placeholder="Quiz 2 (0-100)">
        <input type="text" id="mid" name="mid" placeholder="Mid Exam (0-100)">
        <input type="text" id="final" name="final" placeholder="Final Exam (0-100)">
        <select id="grade" name="grade">
            <option value="">Select Grade</option>
            <option>A+</option><option>A</option>
            <option>B+</option><option>B</option>
            <option>C+</option><option>C</option>
            <option>D+</option><option>D</option>
            <option>F</option>
        </select>
        <button type="submit">Upload Marks</button>
    </form>
</div>
</body>
</html>