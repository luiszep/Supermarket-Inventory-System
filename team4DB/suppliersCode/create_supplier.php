<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica and K. Apodaca
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Aadvika Pandey
 * This file inserts a new record  into the table Student of your DB.
 */
-->
<?php
  session_start();
        require_once('../config.php');
        require_once('../validate_session.php');
 ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create Supplier</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
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
            color: #0496C7;
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
            border: 2px solid #46b3deff;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            color: #0496C7;
        }
        .form-control:focus {
            border-color: #bbeaff;
            box-shadow: 0 0 0 0.2rem rgba(129, 151, 199, 0.25);
            outline: none;
        }
        textarea.form-control {
            resize: vertical;
        }
        .btn-primary {
            background: #5ca8deff;
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
            background: linear-gradient(118deg,rgba(88, 170, 243, 0.91) 63%, rgba(157, 202, 235, 0.88) 100%);
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
            color: #0496C7;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .alert {
            border-radius: 8px;
            margin-top: 20px;
            border: none;
        }
        .alert-success {
            background-color: #c8e0e6ff;
            color: #2e7d32;
        }
        .alert-danger {
            background-color: #ffcdd2;
            color: #c62828;
        }
    </style>
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Create Supplier</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_supplier.php" method="post">
        <div class="form-group">
                <label for="company-name">Company Name</label>
                <input class="form-control" type="text" id="company-name" name="company-name">
            </div>
            <div class="form-group">
                <label for="company-owner">Company Owner</label>
                <input class="form-control" type="text" id="company-owner" name="company-owner">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input class="form-control" type="text" id="country" name="country">
            </div>
            <div class="form-group">
                <label for="phone-number">Phone Number</label>
                <input class="form-control" type="text" id="phone-number" name="phone-number">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email">
            </div>
	    <div class="form-group">
                <label for="item-id">Item Id</label>
                <input class="form-control" type="text" id="item-id" name="item-id">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div>
            <br>
            <a href="supplier_menu.php">Back to Supplier Menu</a></br>
        </div>
    
    
    <?php

        if (isset($_POST['Submit'])){

    
            /**
             * Grab information from the form submission and store values into variables.
             */
            $sName = isset($_POST['company-name']) ? $_POST['company-name'] : " ";  
            $sOwner = isset($_POST['company-owner']) ? $_POST['company-owner'] : " ";
            $sCountry = isset($_POST['country']) ? $_POST['country'] : " ";
            $sItemId = isset($_POST['item-id']) ? $_POST['item-id'] : " ";
            $sEmail = isset($_POST['email']) ? $_POST['email'] : " ";
            $sPhoneNumber = isset($_POST['phone-number']) ? $_POST['phone-number'] : " ";
            //Insert into Supplier table;
            
            $querySupplier  = "INSERT INTO Supplier (CompanyName,RepPhoneNumber,Country,IId,Owner,RepEmail)
                        VALUES ('".$sName."', '".$sPhoneNumber."', '".$sCountry."', '".$sItemId."','".$sOwner."','".$sEmail."');";

            // The query sent to the DB can be printed by not commenting the following row
            //echo $querySupplier;
            if ($conn->query($querySupplier) === TRUE) {
            echo "<br> New record created successfully for supplier: ".$sName;
            } else {
                echo "<br> The record was not created, the query: <br>" . $querySupplier . "  <br> Generated the error <br>" . $conn->error;
            }

            // To redirect the page to the student menu right after the query is executed, use the following statement 
            // header("Location: supplier_menu.php");
}
?>


</body>

</html>