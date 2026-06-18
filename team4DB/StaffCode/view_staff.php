<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file retrieves and displays the records of the table Student.
 */
-->


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <title>View Staff</title>
</head>

<body class="container" style="margin-top:20px">

<?php
$sql = "SELECT * FROM Staff";
$result = $conn->query($sql);

if ($result === false) {
    echo "<div class='alert alert-danger'>Query failed: " . $conn->error . "</div>";
} else {
    if ($result->num_rows === 0) {
        echo "<div class='alert alert-warning'>No staff records found.</div>";
    } else {
?>
        <table class="table table-striped" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Time Worked</th>
                    <th>DOB</th>
                    <th>Branch Name</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
        // 0: ID, 1: Name, 2: Salary, 3: Email, 4: Position, 5: Time Worked, 6: DOB, 7: BName
        while ($row = $result->fetch_row()) {
?>
                <tr>
                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                    <td><?php echo htmlspecialchars($row[1]); ?></td>
                    <td><?php echo htmlspecialchars($row[2]); ?></td>
                    <td><?php echo htmlspecialchars($row[3]); ?></td>
                    <td><?php echo htmlspecialchars($row[4]); ?></td>
                    <td><?php echo htmlspecialchars($row[5]); ?></td>
                    <td><?php echo htmlspecialchars($row[6]); ?></td>
                    <td><?php echo htmlspecialchars($row[7]); ?></td>

                    <td><a href="update_staff_interface.php?ID=<?php echo urlencode($row[0]); ?>">Update</a></td>
                    <td><a href="delete_staff.php?ID=<?php echo urlencode($row[0]); ?>">Delete</a></td>
                </tr>
<?php
        }
?>
            </tbody>
        </table>
<?php
    }
}
?>

    <a href="staff_menu.php">Back to Staff Menu</a><br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
