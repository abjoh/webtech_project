<?php
session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = "Admin";
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
<title>Assign Course</title>
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
            width: 550px;
            background: #f6f5edfa;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 30px;
        }


    /* Header Box */
        .dashboard-header {
            background: #2c3e50;
            color: #ffffff;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
            border-radius: 10px;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 35px;
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
        vertical-align: middle;
    }

    select {
        width: 100%;
        padding: 8px;       
        border-radius: 8px; 
        border: 1px solid #ccc;
        font-size: 16px;    
        box-sizing: border-box;
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
        margin: 10px auto 0 auto;
        display: block;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-assign {
        background: #27ae60;
    }

    .btn-back {
        background: #21abeb;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    /* Footer Logout */
    .dashboard-footer {
        margin-top: 30px;
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
        Assign Course
    </div>

    <!-- Form -->
    <form method="post">
        <table>
            <tr>
                <td>Select Course:</td>
                <td>
                    <select id="courseSelect">
                        <option value="" disabled selected>Select course</option>
                        <option value="Math101">Math 101</option>
                        <option value="CS102">Computer Graphics CSC102</option>
                        <option value="Eng201">English Reading Skills</option>
                        <option value="SWQ_CSC4271">Software Quality & Testing CSC4271</option>
                        <option value="COMPILER_CSC3216">Compiler Design CSC3216</option>
                        <option value="WEB_CSC3215">Web Technologies CSC3215</option>
                        <option value="NETWORK_COE3206">Computer Networks COE3206</option>
                        <option value="CHEM1101">Chemistry CHEM1101</option>
                        <option value="PHY1203">Physics 2 PHY1203</option>
                        <option value="CSC1102">Introduction to Programming CSC1102</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Select Faculty:</td>
                <td>
                    <select id="facultySelect">
                        <option value="" disabled selected>Select faculty</option>
                    </select>
                </td>
            </tr>
        </table>

        <!-- Buttons -->
        <button type="submit" class="btn btn-assign">Assign</button>
        <button type="button" class="btn btn-back" onclick="window.location='admin.php'">Back to Dashboard</button>
    </form>

    <!-- Footer Logout -->
    <div class="dashboard-footer">
        <form method="post">
            <button class="logout" name="logout">Logout</button>
        </form>
    </div>

</main>

<script>
    // Courses with corresponding faculties
    const courseFacultyMap = {
        "Math101": ["Dr. Khan", "Prof. Ali", "Dr.Madhobi Islam" , "Naznin Sultana"],
        "CS102": ["Dr. Rahman", "Prof. Karim", "Dipta Gomes"],
        "Eng201": ["Dr. Sultana", "Md. Hossain", "Risala Ahmed"],
        "SWQ_CSC4271": ["Dr. Kamrul Islam", "Mehedi Hasan", "Prof. Sabikun Nahar"],
        "COMPILER_CSC3216": ["Dr. Karim","Sakila Rahman ", "Emrul Kayes"],
        "WEB_CSC3215": ["Prof. Sultana", "Mir Md Kawser","Md. Al-Amin"],
        "NETWORK_COE3206": ["Dr. Rahman","Saikat Das", "Rajosri Roy"],
        "CHEM1101": ["Dr. Alam", "Saleh Ahmed"],
        "PHY1203": ["Dr. Habib","Niron Akondo"],
        "CSC1102": ["Prof. Karim", "Solimullah Sheikh"]
    };

    const courseSelect = document.getElementById('courseSelect');
    const facultySelect = document.getElementById('facultySelect');

    courseSelect.addEventListener('change', function() {
        const selectedCourse = this.value;

        // Clear previous options
        facultySelect.innerHTML = '';

        if(selectedCourse && courseFacultyMap[selectedCourse]) {
            const faculties = courseFacultyMap[selectedCourse];

            // Populate faculties dynamically
            faculties.forEach(function(faculty, index) {
                const option = document.createElement('option');
                option.value = faculty;
                option.textContent = faculty;

                if(index === 0) {
                    option.selected = true; // auto-select first faculty
                }

                facultySelect.appendChild(option);
            });
        } else {
            // fallback
            const placeholder = document.createElement('option');
            placeholder.textContent = 'Select faculty';
            placeholder.disabled = true;
            placeholder.selected = true;
            facultySelect.appendChild(placeholder);
        }
    });
</script>

</body>
</html>
