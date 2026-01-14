<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = "Admin"; // demo admin session
}

// Logout
if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script>window.location='index.php';</script>";
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
            background: #4a6485;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

    /* Main box */
    .dashboard {
            width: 500px;
            background: #f6f5edfa;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 25px;
        }

    /* Header */
     .dashboard-header {
            background: #2c3e50;
            color: #f8f4f4;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    /* Form Table */
    form table {
            width: 100%;
            border-collapse: collapse;
            
            
        }

        td {
            padding: 5px 5px;
            font-weight: bold;
            font-size: 16px;
            vertical-align:middle;
            
        }

    input[type="text"], input[type="number"], select {
        width: 100%;
        padding: 5px;   /* thin input boxes */
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 15px;
        box-sizing: border-box;
    }

    select {
        color: #666;
    }

    /* Buttons */
    .btn {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: #fff;
    margin: 10px auto 0 auto; /* top margin 10px, left/right auto */
    display: block;            /* make button a block element */
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

    .btn-add {
        background: #27ae60;
    }

    .btn-cancel {
        background: #21abeb;
        float: right;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    /* Footer Logout */
    .dashboard-footer {
    margin-top: 40px;   /* space above footer */
    padding-top: 20px;  /* additional padding inside footer */
    text-align: right;
}

    .logout {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 6px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        font-size: 13px;
    }

    .logout:hover {
        background: #491812;
    }
</style>
</head>
<body>
<main class="dashboard">

    <!-- Header -->
    <div class="dashboard-header">
        Create Course
    </div>

    <!-- Form -->
    <form method="post">
        <table>
            <tr>
                <td>Course Name:</td>
                <td><input type="text" name="course_name" placeholder="Enter course name"></td>
            </tr>
            <tr>
                <td>Course Code:</td>
                <td><input type="text" name="course_code" placeholder="Enter course code"></td>
            </tr>
            <tr>
                <td>Credit:</td>
                <td><input type="number" name="credit" placeholder="Enter credit"></td>
            </tr>
            <tr>
                <td>Semester:</td>
                <td>
                    <select name="semester">
                        <option value="" disabled selected>Select the semester</option>
                        <option>Spring</option>
                        <option>Summer</option>
                        <option>Fall</option>
                    </select>
                </td>
            </tr>
        </table>

        <!-- Buttons -->
        <button type="submit" class="btn btn-add">Add Course</button>
        <button type="button" class="btn btn-cancel" onclick="window.location='admin.php'">Back To Dashboard</button>
    </form>

    <!-- Footer Logout -->
    <div class="dashboard-footer">
        <form method="post">
            <button class="logout" name="logout">Logout</button>
        </form>
    </div>

</main>

<script>
    // You can add JS here if needed later
</script>

</body>
</html>
