<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file provides an example of how to separate the interface for the user , e.g., PhP from from the program logic, e.g., PhP statements.
 */
-->


<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);

    // Use prepared statement to avoid SQL issues
    $stmt = $conn->prepare("SELECT * FROM Staff WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Staff record not found.";
        exit;
    }

} else {
    echo "No Staff ID received on request at update Staff";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Staff Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update Staff</h1>

        <form action="update_staff.php" method="post">

            <!-- Hidden ID so we know which record to update -->
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

            <div class="form-group">
                <label for="id_display">ID</label>
                <input class="form-control" type="text" id="id_display" value="<?php echo $row['ID']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo $row['Name']; ?>">
            </div>

            <div class="form-group">
                <label for="salary">Salary</label>
                <input class="form-control" type="text" id="salary" name="salary" value="<?php echo $row['Salary']; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="<?php echo $row['Email']; ?>">
            </div>

            <div class="form-group">
                <label for="position">Position</label>
                <input class="form-control" type="text" id="position" name="position" value="<?php echo $row['Position']; ?>">
            </div>

            <div class="form-group">
                <label for="time_worked">Time Worked</label>
                <input class="form-control" type="text" id="time_worked" name="time_worked" value="<?php echo $row['Time Worked']; ?>">
            </div>

            <div class="form-group">
                <label for="dob">DOB (YYYY-MM-DD)</label>
                <input class="form-control" type="text" id="dob" name="dob" value="<?php echo $row['DOB']; ?>">
            </div>

            <div class="form-group">
                <label for="bname">Branch Name</label>
                <input class="form-control" type="text" id="bname" name="bname" value="<?php echo $row['BName']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update Staff</button>
        </form>

        <div>
            <br>
            <a href="view_staff.php">Back to Staff Menu</a><br>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    </div>
</body>

</html>
