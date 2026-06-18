<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica and K. Apodaca
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file creates the user for the DB, that can create students, e.g., the admin creating student records in the system.
 */



-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create User Account</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #556b2f;
        }
        .form-container {
            max-width: 450px;
            margin: 60px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #556b2f;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-group label {
            color: #556b2f;
            font-weight: 500;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #c8e6c9;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            color: #556b2f;
        }
        .form-control:focus {
            border-color: #81c784;
            box-shadow: 0 0 0 0.2rem rgba(129, 199, 132, 0.25);
            outline: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
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
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(129, 199, 132, 0.4);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        a {
            color: #6b8e23;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        a:hover {
            color: #556b2f;
            text-decoration: underline;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #c8e6c9;
        }
        .alert {
            border-radius: 8px;
            margin-top: 20px;
            border: none;
        }
        .alert-success {
            background-color: #c8e6c9;
            color: #2e7d32;
        }
        .alert-danger {
            background-color: #ffcdd2;
            color: #c62828;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Create User</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <form action="create_user.php" method="post">
                <div class="form-group">
                <label for="username">User Name</label>
                <input class="form-control" type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Submit">
            </div>
        </form>
        <div class="back-link">
            <a href="index.php">Back to User Login Menu</a>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    
        <!-- PhP code starts here -->
    <?php
        require_once('config.php');
        
        if (isset($_POST['Submit'])){

    
    /**
     * Grab information from the form submission and store values into variables.
     */
    $username = isset($_POST['username']) ? $_POST['username'] : " ";
    $password = isset($_POST['password']) ? $_POST['password'] : " ";

    //Insert into Student table;
    $queryUser  = "INSERT INTO User (Uusername, Upassword)
                VALUES ('".$username."', '".$password."');";
    if ($conn->query($queryUser) === TRUE) {
       echo "<div class='alert alert-success'>New user created successfully with the username: ".htmlspecialchars($username)."</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . htmlspecialchars($conn->error) . "</div>";
    }
    // If you want to redirect without seeing messages printed, uncomment the following line:
    //header("Location: index.php");
}
?>


</body>

</html>