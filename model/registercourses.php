<?php
session_start();
require_once 'db.php';

/* ---------- STUDENT ONLY ---------- */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../controler/Login.html");
    exit();
}

$student_id = $_SESSION['user_id'];
$message = '';
$errors = [];

/* ---------- FETCH COURSES ---------- */
$courses = mysqli_query($conn, "SELECT course_id, course_name, section FROM courses ORDER BY course_id");

/* ---------- HANDLE FORM SUBMIT ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['courses'])) {
        $errors[] = "Please select at least one course.";
    } else {

        foreach ($_POST['courses'] as $courseData) {

            list($course_id, $section) = explode('|', $courseData);

            // Prevent duplicate enrollment
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
    max-width: 700px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.course-box {
    display: flex;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.course-box:last-child {
    border-bottom: none;
}

.course-box input {
    margin-right: 15px;
}

button {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    background-color: #0077cc;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background-color: #005fa3;
}

.success {
    color: green;
    font-weight: bold;
    margin-bottom: 15px;
}

.error {
    color: red;
    margin-bottom: 15px;
}
</style>

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
