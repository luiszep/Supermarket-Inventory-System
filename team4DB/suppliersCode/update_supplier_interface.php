<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Aadvika Pandey
 * This file provides an example of how to separate the interface for the user , e.g., PhP from from the program logic, e.g., PhP statements.
 */
-->


<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['CompanyName'])) {
    $companyName = $_GET['CompanyName'];
    $sql = "SELECT * FROM Supplier where CompanyName = '$companyName'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No company name received on request at update_supplier_interface get";
    die();
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Supplier Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
     <body>
<style>
body {
            background:#a9cdfb;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #0496C7;
            padding: 40px 0;
        }
        .form-container {
            max-width: 600px;
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
            color:  #0496C7;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-group label {
            color: #0496C7;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #8fbce1ff;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            color:  #0496C7;
        }
        .form-control:focus {
            border-color: #76c0e8ff;
            box-shadow: 0 0 0 0.2rem rgba(127, 189, 213, 0.25);
            outline: none;
        }
        textarea.form-control {
            resize: vertical;
        }
        .btn-primary {
            background: linear-gradient(118deg,rgba(88, 170, 243, 0.91) 63%, rgba(157, 202, 235, 0.88) 100%);
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
            background:linear-gradient(118deg,rgba(70, 140, 201, 0.91) 63%, rgba(94, 147, 185, 0.88) 100%)
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(126, 165, 196, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            color: #0496C7;
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
            color:#0496C7;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update Supplier</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="update_supplier.php" method="post">
            <input type="hidden" name="company-name" id="company-name" value="<?php echo $row['CompanyName'] ?>">
            <div class="form-group">
                <label for="company-owner">Company Owner</label>
                <input class="form-control" type="text" id="company-owner" name="company-owner" value="<?php echo $row['Owner'] ?>">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input class="form-control" type="text" id="country" name="country" value="<?php echo $row['Country'] ?>">
            </div>
            <div class="form-group">
                <label for="phone-number">Phone Number</label>
                <input class="form-control" type="text" id="phone-number" name="phone-number" value="<?php echo $row['RepPhoneNumber'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="<?php echo $row['RepEmail'] ?>">
            </div>
	    <div class="form-group">
                <label for="item-id">Item Id</label>
                <input class="form-control" type="text" id="item-id" name="item-id" value="<?php echo $row['IID'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div>
            <br>
            <a href="supplier_menu.php">Back to Supplier Menu</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>