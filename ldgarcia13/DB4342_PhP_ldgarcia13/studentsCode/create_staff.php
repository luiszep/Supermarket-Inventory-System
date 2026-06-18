<?php
/**
 * CS 4342 Database Management
 * Description: This file inserts a new record into the Staff table.
 */

// Hide warnings/notices on the page output
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once('../config.php');
require_once('../validate_session.php');

$message = "";

// Handle form submission BEFORE HTML
if (isset($_POST['Submit'])) {

    $sid         = $_POST['id']          ?? "";
    $sname       = $_POST['name']        ?? "";
    $Ssalary     = $_POST['salary']      ?? "";
    $Semail      = $_POST['email']       ?? "";
    $Sposition   = $_POST['position']    ?? "";
    $Stimeworked = $_POST['time_worked'] ?? "";
    $sDOB        = $_POST['dob']         ?? "";
    $sbname      = $_POST['bname']       ?? "";

    $querystaff  = "
        INSERT INTO Staff (ID, Name, Salary, Email, Position, `Time Worked`, DOB, BName)
        VALUES ('".$sid."', '".$sname."', '".$Ssalary."', '".$Semail."', '".$Sposition."', '".$Stimeworked."', '".$sDOB."', '".$sbname."');
    ";

    if ($conn->query($querystaff) === TRUE) {
        $message = "<div class='alert alert-success mt-3'>
                        New record created successfully for staff id ".htmlspecialchars($sid)."
                    </div>";
    } else {
        $message = "<div class='alert alert-danger mt-3'>
                        The record was not created.<br>
                        Query: ".htmlspecialchars($querystaff)."<br>
                        Error: ".htmlspecialchars($conn->error)."
                    </div>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create Staff</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #e6d9ff;
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4b3c72;
        }

        .form-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .form-card {
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        h1 {
            text-align: center;
            color: #7a57c6;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .btn-lavender {
            background: #9c7df5;
            color: white !important;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-lavender:hover {
            background: linear-gradient(135deg, #b9a4ff 0%, #8d6ce8 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(156, 125, 245, 0.45);
            color: white !important;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
            color: #7a57c6;
        }

        .back-link:hover {
            color: #9c7df5;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-card">
            <h1>Create Staff</h1>

            <form action="create_staff.php" method="post">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input class="form-control" type="text" id="id" name="id">
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input class="form-control" type="text" id="salary" name="salary">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <input class="form-control" type="text" id="position" name="position">
                </div>

                <div class="form-group">
                    <label for="time_worked">Time Worked</label>
                    <input class="form-control" type="text" id="time_worked" name="time_worked">
                </div>

                <div class="form-group">
                    <label for="dob">DOB (YYYY-MM-DD)</label>
                    <input class="form-control" type="text" id="dob" name="dob">
                </div>

                <div class="form-group">
                    <label for="bname">Branch Name</label>
                    <input class="form-control" type="text" id="bname" name="bname">
                </div>

                <div class="form-group">
                    <input class="btn-lavender" name="Submit" type="submit" value="Submit">
                </div>
            </form>

            <a href="staff_menu.php" class="back-link">? Back to Staff Menu</a>

            <?php
                // Show result message (success or error) if form was submitted
                if (!empty($message)) {
                    echo $message;
                }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
