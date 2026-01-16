<?php
session_start();
require_once 'db.php';

// Only admin can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../controler/Login.html");
    exit();
}

$error = "";
$success = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];

    // Check if user exists
    $check = mysqli_query($conn, "SELECT role FROM users WHERE user_id='$user_id'");
    if ($check && mysqli_num_rows($check) > 0) {
        $user = mysqli_fetch_assoc($check);

        
        if ($user['role'] === 'admin' && $user['user_id']='a_1') {
            $error = "Cannot delete main admin!";
        } else {
            // Delete user
            $sql = "DELETE FROM users WHERE user_id='$user_id'";
            if (mysqli_query($conn, $sql)) {
                $success = "User deleted successfully!";
            } else {
                $error = "Error deleting user: " . mysqli_error($conn);
            }
        }
    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
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

        .header a:hover {
            text-decoration: underline;
        }

        /* Center form */
        .container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .card {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
        }

        h2 {
            color: #0077cc;
            margin-bottom: 20px;
        }

        input, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        button {
            background-color: #cc0000;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #a30000;
        }

        .back-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #555;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<header>
<div class="header">
    <h1>Delete User</h1>
    <a href="logout.php">Logout</a>
</div>
</header>

<div class="container">
    <div class="card">
        <?php if(!empty($error)) { ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <?php if(!empty($success)) { ?>
            <div class="success"><?= $success ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="user_id" placeholder="Enter User ID to delete" >
            <button type="submit">Delete User</button>
        </form>

        <a href="../controler/admindashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
