
for DB connection:
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "university_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

code for selection:
<?php
require_once "../config/db.php";

function getUserByEmail($email) {
    global $conn;

    $sql = "SELECT * FROM users WHERE email='$email'";
    return mysqli_query($conn, $sql);
}

how we will use in controller:
require_once "../models/userModel.php";
