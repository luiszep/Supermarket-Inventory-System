<!--
/**
 * CS 4342 Database Management
 * Description: This file inserts a new record into the Staff table.
 */
-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create Staff</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
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
                <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
            </div>
        </form>

        <div>
            <br>
            <a href="staff_menu.php">Back to Staff Menu</a><br>
        </div>
    </div>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['Submit'])) {

    $sid         = isset($_POST['id'])          ? $_POST['id']          : "";
    $sname       = isset($_POST['name'])        ? $_POST['name']        : "";
    $Ssalary     = isset($_POST['salary'])      ? $_POST['salary']      : "";
    $Semail      = isset($_POST['email'])       ? $_POST['email']       : "";
    $Sposition   = isset($_POST['position'])    ? $_POST['position']    : "";
    $Stimeworked = isset($_POST['time_worked']) ? $_POST['time_worked'] : "";
    $sDOB        = isset($_POST['dob'])         ? $_POST['dob']         : "";
    $sbname      = isset($_POST['bname'])       ? $_POST['bname']       : "";

    // NOTE: backticks around `Time Worked` because of the space
    $querystaff  = "
        INSERT INTO Staff (ID, Name, Salary, Email, Position, `Time Worked`, DOB, BName)
        VALUES ('".$sid."', '".$sname."', '".$Ssalary."', '".$Semail."', '".$Sposition."', '".$Stimeworked."', '".$sDOB."', '".$sbname."');
    ";

    // echo $querystaff; // debug if needed

    if ($conn->query($querystaff) === TRUE) {
        echo "<br>New record created successfully for staff id ".$sid;
    } else {
        echo "<br>The record was not created, the query: <br>" 
             . $querystaff . "  <br>Generated the error <br>" . $conn->error;
    }

    // header("Location: staff_menu.php"); // optional redirect
}
?>

</body>
</html>
