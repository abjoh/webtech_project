<?php
session_start();
require_once 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../controler/Login.html");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $course_id   = $_POST['course_id'];    
    $course_name = $_POST['course_name'];  
    $section     = $_POST['section'];
    $time        = $_POST['time'];
    $day         = $_POST['day'];
    $room        = $_POST['room'];        

    $checkSql = "SELECT course_id FROM courses WHERE course_id = $course_id";
    $checkRes = mysqli_query($conn, $checkSql);
    if (!$checkRes) {
        die("Check Query Failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($checkRes) > 0) {
        $message = "Error: Course ID already exists.";
    } else {
        $insertSql = "
            INSERT INTO courses (course_id, course_name, section, time, day, room)
            VALUES ($course_id, '$course_name', '$section', '$time', '$day', '$room')
        ";
        if (mysqli_query($conn, $insertSql)) {
            header("Location: viewcourses.php");
            exit();
        } else {
            $message = "Insert Failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Course</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

       
        .header {
            background-color: #0077cc;
            color: white;
            padding: 20px 40px;
            display: flex;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            text-align: left;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        button {
            background-color: #0077cc;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
        }

        button:hover {
            background-color: #005fa3;
        }

        .back-btn {
            background-color: #555;
        }

        .back-btn:hover {
            background-color: #333;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function validateForm() {
            const courseId = document.getElementById("course_id").value;
            const room = document.getElementById("room").value;

            if (!/^\d{4}$/.test(courseId)) {
                alert("Course ID must be exactly 4 digits");
                return false;
            }

            if (!/^\d{4}$/.test(room)) {
                alert("Room number must be exactly 4 digits");
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


<div class="header">
    <h1>Create Course</h1>
</div>


<div class="container">

    <?php if($message != ''): ?>
        <div class="error"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validateForm()">

        <input type="text" name="course_id" id="course_id" placeholder="Course ID (4 digits)">
        <input type="text" name="course_name" placeholder="Course Name">

        <select name="section">
            <option value="">Select Section</option>
            <?php
            for ($i = 65; $i <= 90; $i++) { 
                $char = chr($i);
                echo "<option value='$char'>$char</option>";
            }
            ?>
        </select>

        <select name="time">
            <option value="">Select Time</option>
            <option>8:00am-9:30am</option>
            <option>9:30am-11:00am</option>
            <option>11:00am-12:30pm</option>
            <option>12:30pm-2:00pm</option>
            <option>2:00pm-3:30pm</option>
            <option>3:30pm-5:00pm</option>
            <option>4:00pm-5:30pm</option>
        </select>

        <select name="day">
            <option value="">Select Day</option>
            <option>Sunday</option>
            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
        </select>

        <input type="text" name="room" id="room" placeholder="Room Number (4 digits)">

        <button type="submit">Create</button>
    </form>


    <button class="back-btn" onclick="goBack()">← Back</button>
</div>

</body>
</html>
