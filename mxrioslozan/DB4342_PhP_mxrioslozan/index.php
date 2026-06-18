<!--
/**
 * CS 4342 Database Management
 * @author Instruction team  with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Include your name here - ex. Modified by Villanueva for Assignment 2
 */
-->

<?php
session_start();
require_once("config.php");
$_SESSION['logged_in'] = false;

$error_message = "";

if (!empty($_POST)) {
  if (isset($_POST['Submit'])) {
    $input_username = isset($_POST['username']) ? $_POST['username'] : "";
    $input_password = isset($_POST['password']) ? $_POST['password'] : "";

    // Use prepared statement to avoid SQL injection
    if ($stmt = $conn->prepare("SELECT * FROM User WHERE Uusername = ? AND UPassword = ?")) {
        $stmt->bind_param("ss", $input_username, $input_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
          // user found
          $_SESSION['user'] = $input_username;
          $_SESSION['logged_in'] = true;

          // Redirect to the menu in the itemsCode folder (match your remote folder)
          header("Location: itemsCode/item_menu.php");
          exit;
        } else {
          $error_message = "<div class='alert alert-danger'>User not found.</div>";
        }

        $stmt->close();
    } else {
      // prepare failed
      $error_message = "<div class='alert alert-danger'>Database error: " . htmlspecialchars($conn->error) . "</div>";
    }
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CS 4342 User Login</title>

  <!-- Bootstrap CSS library https://getbootstrap.com/ -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #556b2f;
    }
    .login-container {
      max-width: 450px;
      margin: 80px auto;
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
    .create-account-link {
      text-align: center;
      margin-top: 20px;
      padding-top: 20px;
      border-top: 1px solid #c8e6c9;
    }
    .alert {
      border-radius: 8px;
      margin-top: 20px;
      border: none;
      padding: 15px;
    }
    .alert-danger {
      background-color: #ffcdd2;
      color: #c62828;
    }
  </style>
</head>

<body>
  <div class="login-container">
    
    <h1>User Login</h1>
    <form action="index.php" method="post">
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
    <?php if ($error_message): ?>
      <?php echo $error_message; ?>
    <?php endif; ?>
    
    <div class="create-account-link">
      <a href="create_user.php">Don't have an account? Create one now!</a>
    </div>
    
  </div>

  <!-- jQuery and JS bundle w/ Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>