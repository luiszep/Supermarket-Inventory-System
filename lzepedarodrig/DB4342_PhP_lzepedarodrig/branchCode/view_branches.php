<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 * This file retrieves and displays the records of the table Branch.
 */
-->


<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #ffe0b2;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f57c00;
            padding: 40px 0;
        }
        .table-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .table-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        h1 {
            color: #f57c00;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        thead {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }
        thead td {
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border: none;
        }
        tbody tr {
            background: white;
            transition: background 0.3s ease;
        }
        tbody tr:nth-child(even) {
            background: #fff3e0;
        }
        tbody tr:hover {
            background: #ffe0b2;
        }
        tbody td {
            padding: 15px;
            color: #e65100;
            border-bottom: 1px solid #ffb74d;
        }
        .action-link {
            color: #ff9800;
            text-decoration: none;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .action-link:hover {
            background: #ffb74d;
            color: white;
            text-decoration: none;
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            color: #f57c00;
            text-decoration: none;
            font-weight: 600;
            padding: 12px 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .back-link a:hover {
            background: white;
            color: #f57c00;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php $sql = "SELECT * FROM Branch";
if (!$result = $conn->query($sql)) {
    die("SQL Error: " . $conn->error);
}
if ($result->num_rows === 0) {
    die("<b>No rows found in Branch table.</b>");
}
    if ($result = $conn->query($sql)) {
    ?>
    <div class="table-container">
        <div class="table-card">
        <table class="table" width=50%>
            <thead>
                <td> Branch Name</td>
                <td> Email</td>
                <td> Phone Number</td>
                <td> Street</td>
                <td> City</td>
                <td> State</td>
                <td> ZIP</td>
                <td> Manager First Name</td>
                <td> Manager Middle Name</td>
                <td> Manager Last Name</td>
                <td> Item ID</td>
                <td colspan="2">Actions</td>
  
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                        <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1] ?? ""); ?></td>
                        <td><?php printf("%s", $row[2] ?? ""); ?></td>
                        <td><?php printf("%s", $row[3] ?? ""); ?></td>
                        <td><?php printf("%s", $row[4] ?? ""); ?></td>
                        <td><?php printf("%s", $row[5] ?? ""); ?></td>
                        <td><?php printf("%s", $row[6] ?? ""); ?></td>
                        <td><?php printf("%s", $row[7] ?? ""); ?></td>
                        <td><?php printf("%s", $row[8] ?? ""); ?></td>
                        <td><?php printf("%s", $row[9] ?? ""); ?></td>
                        <td><?php printf("%s", $row[10] ?? ""); ?></td>
                        <td><a href="update_branch_interface.php?BName=<?php echo urlencode($row[0]) ?>">Update</a></td>
                        <td><a href="delete_branch.php?BName=<?php echo urlencode($row[0]) ?>">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </div>
        <div class="back-link"><a href="branch_menu.php">Back to Branch Menu</a><br></div>
            </div>
    <?php
    }
    ?>
    <!-- Link to return to branch_menu-->
     
    
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

