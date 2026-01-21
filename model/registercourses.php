<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../controler/Login.html");
    exit();
}

$student_id = $_SESSION['user_id'];
$message = '';
$errors = [];

$courses = mysqli_query($conn, "SELECT course_id, course_name, section FROM courses ORDER BY course_id");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['courses'])) {
        $errors[] = "Please select at least one course.";
    } 

    else {

        foreach ($_POST['courses'] as $courseData) {

            list($course_id, $section) = explode('|', $courseData);

            $check = mysqli_query(
                $conn,
                "SELECT * FROM enrolled_students 
                 WHERE student_id='$student_id' 
                 AND course_id='$course_id'
                 AND section='$section'"
            );

            if (mysqli_num_rows($check) === 0) {
                mysqli_query(
                    $conn,
                    "INSERT INTO enrolled_students (student_id, course_id, section)
                     VALUES ('$student_id','$course_id','$section')"
                );
            }
        }

        $message = "Courses registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Course Registration</title>

<link rel="stylesheet" href="../view/registercourses.css">

<script>
function validateSelection() {
    const checkboxes = document.querySelectorAll('input[name="courses[]"]:checked');
    if (checkboxes.length === 0) {
        alert("Please select at least one course.");
        return false;
    }
    return true;
}
</script>

</head>

<body>
<header>
<div class="header">
    <h1>Course Registration</h1>
    <a href="../controler/studentdashboard.php">Dashboard</a>
</div>
</header>
<div class="container">

<?php
if (!empty($message)) echo "<div class='success'>$message</div>";
if (!empty($errors)) echo "<div class='error'>" . implode("<br>", $errors) . "</div>";
?>

<form method="POST" onsubmit="return validateSelection()">

<?php while ($row = mysqli_fetch_assoc($courses)) { ?>
    <div class="course-box">
        <input
            type="checkbox"
            name="courses[]"
            value="<?= $row['course_id'] . '|' . $row['section'] ?>"
        >
        <div>
            <strong><?= $row['course_name'] ?></strong><br>
            Course ID: <?= $row['course_id'] ?> |
            Section: <?= $row['section'] ?>
        </div>
    </div>
<?php } ?>

<button type="submit">Register Selected Courses</button>

</form>
</div>
</body>
</html>
