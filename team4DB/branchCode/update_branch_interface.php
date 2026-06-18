<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 * This file provides an example of how to separate the interface for the user , e.g., PhP from from the program logic, e.g., PhP statements.
 */
-->


<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['BName'])) {
    $bName = $_GET['BName'];
    $sql = "SELECT * FROM Branch where BName = '$bName'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No branch name received on request at update_branch_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Branch Update</title>

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
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #f57c00;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-group label {
            color: #f57c00;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #ffb74d;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            color: #e65100;
        }
        .form-control:focus {
            border-color: #ff9800;
            box-shadow: 0 0 0 0.2rem rgba(255, 152, 0, 0.25);
            outline: none;
        }
        .btn-primary {
            background: #ff9800;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 152, 0, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
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
    <div class="form-container">
        <div class="form-card">
        <h1>Update Branch</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the branch so values can be modified 
             Note that the Branch Name is not shown to be modified, only other attributes. -->

        <form action="update_branch.php" method="post">
            <input type="hidden" name="BName" id="BName" value="<?php echo htmlspecialchars($row['BName']) ?>">
            <div class="form-group">
                <label for="bemail">Branch Email</label>
                <input class="form-control" type="email" id="bemail" name="bemail" value="<?php echo htmlspecialchars($row['BEmail'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bphone">Branch Phone Number</label>
                <input class="form-control" type="text" id="bphone" name="bphone" value="<?php echo htmlspecialchars($row['BPhoneNumber'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bstreet">Street Address</label>
                <input class="form-control" type="text" id="bstreet" name="bstreet" value="<?php echo htmlspecialchars($row['BStreet'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bcity">City</label>
                <input class="form-control" type="text" id="bcity" name="bcity" value="<?php echo htmlspecialchars($row['BCity'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bstate">State (2 characters)</label>
                <input class="form-control" type="text" id="bstate" name="bstate" maxlength="2" value="<?php echo htmlspecialchars($row['BState'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bzip">ZIP Code</label>
                <input class="form-control" type="text" id="bzip" name="bzip" value="<?php echo htmlspecialchars($row['BZip'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bfirstname">Branch Manager First Name</label>
                <input class="form-control" type="text" id="bfirstname" name="bfirstname" value="<?php echo htmlspecialchars($row['BFirstName'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="bmidname">Branch Manager Middle Name</label>
                <input class="form-control" type="text" id="bmidname" name="bmidname" value="<?php echo htmlspecialchars($row['BMidName'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="blastname">Branch Manager Last Name</label>
                <input class="form-control" type="text" id="blastname" name="blastname" value="<?php echo htmlspecialchars($row['BLastName'] ?? '') ?>">
            </div>
            <div class="form-group">
                <label for="iid">Item ID</label>
                <input class="form-control" type="number" id="iid" name="iid" value="<?php echo htmlspecialchars($row['IID'] ?? '') ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div class="back-link">
            <a href="branch_menu.php">Back to Branch Menu</a>
        </div>
        </div>
    </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

