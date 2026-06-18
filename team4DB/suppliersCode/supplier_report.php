<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file retrieves and displays the records of the table Supplier.
 * Modified by: Aadvika Pandey
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
      background: #a9cdfb;
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color:  #0496C7;
      padding: 40px 0;
    }
    .report-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .report-card { background: rgba(255,255,255,0.95); border-radius:20px; padding:30px; box-shadow:0 10px 40px rgba(0,0,0,0.1); overflow-x:auto; }
    h1 { text-align:center; margin-bottom:20px; color:#0496C7; font-weight:600; }
    table { width:100%; border-collapse:collapse; }
    thead th { background:linear-gradient(118deg,rgba(88, 170, 243, 0.91) 63%, rgba(157, 202, 235, 0.88) 100%); color:#fff; padding:12px; text-align:left; font-weight:600; border:none; }
    tbody td { padding:12px; border-bottom:1px solid #e6f3e8; color:#0496C7; vertical-align:top; }
    tbody tr:nth-child(even){ background:#f7faf6; }
    .back-link { text-align:center; margin-top:20px; }
    .back-link a { color:#0496C7; text-decoration:none; font-weight:600; padding:10px 20px; background:#fff; border-radius:8px; display:inline-block; }
  </style>
<title>CS 4342 Supplier Report</title>
</head>

<body>
<div class="report-container">
    <div class="report-card">
      <h1>Suppliers by Branch Report</h1>


    <?php $sql = "SELECT RepEmail,RepPhoneNumber,BFirstName,BMidName,BLastName FROM SUPPLIER NATURAL JOIN Item NATURAL JOIN Branch;";
if (!$result = $conn->query($sql)) {
    die("SQL Error: " . $conn->error);
}
if ($result->num_rows === 0) {
    die("<b>No rows found in Supplier table.</b>");
}
    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                                
                <th> Email of Representative</th>
                <th> Phone Number of Representative</th>
                 <th> Branch Manager's First Name</th>
                <th> Branch Manager's Middle Name</th>
                <th> Branch Manager's Last Name</th>


                            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                        <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                        <td><?php printf("%s", $row[3]); ?></td>
                        <td><?php printf("%s", $row[4]); ?></td>
                        <td><?php printf("%s", $row[5]); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <!-- Link to return to student_menu-->
 <div class="back-link">
    <a href="supplier_menu.php">Back to Supplier Menu</a><br>
</div></div></div>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>