<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username     = $_POST['username'];
    $email        = $_POST['email'];
    $pass         = $_POST['password'];
    $blood_group  = $_POST['blood_group'];
    $role         = $_POST['role'];
    $department   = $_POST['department'];

    
    $sql = "INSERT INTO users(user_name, email, password, role, blood_group, department)
            VALUES('$username', '$email', '$pass', '$role', '$blood_group', '$department')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user_id = mysqli_insert_id($conn);

        
        if ($role == 'student') {
            $sql_student = "INSERT INTO student(student_id,name,email) 
                            VALUES('$user_id', '$username', '$email')";
            mysqli_query($conn, $sql_student);
        } elseif ($role == 'faculty') {
            $sql_faculty = "INSERT INTO faculty(faculty_id,name,email) 
                            VALUES('$user_id', '$username', '$email')";
            mysqli_query($conn, $sql_faculty);
        }

        echo "Data inserted successfully";
        echo "<br>";
        echo '<a href="../controler/adduser.html">Previous page</a>';
    } else {
        die(mysqli_error($conn));
    }
}
?>
