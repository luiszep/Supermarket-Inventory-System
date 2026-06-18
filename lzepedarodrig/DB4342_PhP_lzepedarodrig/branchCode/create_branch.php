<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica and K. Apodaca
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 * This file inserts a new record into the table Branch of your DB.
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
    <title>CS4342 Create Branch</title>

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
        textarea.form-control {
            resize: vertical;
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
        .alert {
            border-radius: 8px;
            margin-top: 20px;
            border: none;
        }
        .alert-success {
            background-color: #fff3e0;
            color: #e65100;
        }
        .alert-danger {
            background-color: #ffcdd2;
            color: #c62828;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-card">
        <h1>Create Branch</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_branch.php" method="post">
        <div class="form-group">
                <label for="bname">Branch Name *</label>
                <input class="form-control" type="text" id="bname" name="bname" required>
            </div>
            <div class="form-group">
                <label for="bemail">Branch Email</label>
                <input class="form-control" type="email" id="bemail" name="bemail">
            </div>
            <div class="form-group">
                <label for="bphone">Branch Phone Number</label>
                <input class="form-control" type="text" id="bphone" name="bphone">
            </div>
            <div class="form-group">
                <label for="bstreet">Street Address</label>
                <input class="form-control" type="text" id="bstreet" name="bstreet">
            </div>
            <div class="form-group">
                <label for="bcity">City</label>
                <input class="form-control" type="text" id="bcity" name="bcity">
            </div>
            <div class="form-group">
                <label for="bstate">State (2 characters)</label>
                <input class="form-control" type="text" id="bstate" name="bstate" maxlength="2">
            </div>
            <div class="form-group">
                <label for="bzip">ZIP Code</label>
                <input class="form-control" type="text" id="bzip" name="bzip">
            </div>
            <div class="form-group">
                <label for="bfirstname">Branch Manager First Name</label>
                <input class="form-control" type="text" id="bfirstname" name="bfirstname">
            </div>
            <div class="form-group">
                <label for="bmidname">Branch Manager Middle Name</label>
                <input class="form-control" type="text" id="bmidname" name="bmidname">
            </div>
            <div class="form-group">
                <label for="blastname">Branch Manager Last Name</label>
                <input class="form-control" type="text" id="blastname" name="blastname">
            </div>
            <div class="form-group">
                <label for="iid">Item ID</label>
                <input class="form-control" type="number" id="iid" name="iid">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div class="back-link">
            <a href="branch_menu.php">Back to Branch Menu</a>
        </div>
    
    <?php

        if (isset($_POST['Submit'])){

    
            /**
             * Grab information from the form submission and store values into variables.
             */
            $bName = isset($_POST['bname']) ? $_POST['bname'] : "";  
            $bEmail = isset($_POST['bemail']) ? $_POST['bemail'] : "";
            $bPhoneNumber = isset($_POST['bphone']) ? $_POST['bphone'] : "";
            $bStreet = isset($_POST['bstreet']) ? $_POST['bstreet'] : "";
            $bCity = isset($_POST['bcity']) ? $_POST['bcity'] : "";
            $bState = isset($_POST['bstate']) ? $_POST['bstate'] : "";
            $bZip = isset($_POST['bzip']) ? $_POST['bzip'] : "";
            $bFirstName = isset($_POST['bfirstname']) ? $_POST['bfirstname'] : "";
            $bMidName = isset($_POST['bmidname']) ? $_POST['bmidname'] : "";
            $bLastName = isset($_POST['blastname']) ? $_POST['blastname'] : "";
            $iid = isset($_POST['iid']) ? $_POST['iid'] : "";
            
            //Insert into Branch table;
            // Handle NULL for IID - IID is an integer, so no quotes needed
            $iidValue = ($iid === "" || $iid === null) ? "NULL" : $iid;
            
            $queryBranch  = "INSERT INTO Branch (BName, BEmail, BPhoneNumber, BStreet, BCity, BState, BZip, BFirstName, BMidName, BLastName, IID)
                        VALUES ('".$bName."', '".$bEmail."', '".$bPhoneNumber."', '".$bStreet."', '".$bCity."', '".$bState."', '".$bZip."', '".$bFirstName."', '".$bMidName."', '".$bLastName."', ".$iidValue.");";

            // The query sent to the DB can be printed by not commenting the following row
            //echo $queryBranch;
            if ($conn->query($queryBranch) === TRUE) {
            echo "<div class='alert alert-success'><br> New record created successfully for branch: ".htmlspecialchars($bName)."</div>";
            } else {
                echo "<div class='alert alert-danger'><br> The record was not created, the query: <br>" . htmlspecialchars($queryBranch) . "  <br> Generated the error <br>" . htmlspecialchars($conn->error) . "</div>";
            }

            // To redirect the page to the branch menu right after the query is executed, use the following statement 
            // header("Location: branch_menu.php");
}
?>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

