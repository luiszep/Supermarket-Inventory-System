<?php

// index.php - login handler moved to top so header redirects can work reliably

// Updated to redirect to team_main.php (placed in team4DB folder alongside this file).

session_start();

require_once("config.php");

// Default not-logged-in

if (!isset($_SESSION['logged_in'])) {

    $_SESSION['logged_in'] = false;

}

$error_message = "";

// Handle POST login BEFORE any output so header() works

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])) {

    $input_username = isset($_POST['username']) ? $_POST['username'] : "";

    $input_password = isset($_POST['password']) ? $_POST['password'] : "";

    // Use prepared statement (safer) - table User with columns Uusername, UPassword

    if ($stmt = $conn->prepare("SELECT Uusername FROM User WHERE Uusername = ? AND UPassword = ?")) {

        $stmt->bind_param("ss", $input_username, $input_password);

        if ($stmt->execute()) {

            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {

                // login ok

                $_SESSION['user'] = $input_username;

                $_SESSION['logged_in'] = true;

                // Redirect to team_main.php (file must be in the same folder as this index.php)

                header("Location: team_main.php");

                exit;

            } else {

                $error_message = "User not found. Check username/password.";

            }

        } else {

            $error_message = "Database error: " . htmlspecialchars($stmt->error);

        }

        $stmt->close();

    } else {

        $error_message = "Database error: " . htmlspecialchars($conn->error);

    }

}

?>

<!doctype html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>CS 4342 User Login</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

  <style>

    body {

      background: linear-gradient(135deg, #F5E6D3 0%, #FFD7BA 100%);

      min-height: 100vh;

      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

      color: #8B6F47;

    }

    .login-container {

      max-width: 450px;

      margin: 80px auto;

      background: rgba(255, 255, 255, 0.95);

      padding: 40px;

      border-radius: 20px;

      box-shadow: 0 10px 40px rgba(139, 111, 71, 0.15);

    }

    h1 {

      color: #8B6F47;

      text-align: center;

      margin-bottom: 30px;

      font-weight: 600;

      letter-spacing: 0.5px;

    }

    .form-group label {

      color: #8B6F47;

      font-weight: 500;

      margin-bottom: 8px;

    }

    .form-control {

      border: 2px solid #E8D5C4;

      border-radius: 8px;

      padding: 12px 15px;

      transition: all 0.3s ease;

      color: #8B6F47;

    }

    .form-control:focus {

      border-color: #D4A574;

      box-shadow: 0 0 0 0.2rem rgba(212, 165, 116, 0.25);

      outline: none;

    }

    .btn-primary {

      background: linear-gradient(135deg, #D4A574 0%, #C8956A 100%);

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

      background: linear-gradient(135deg, #C8956A 0%, #B8855A 100%);

      transform: translateY(-2px);

      box-shadow: 0 5px 15px rgba(139, 111, 71, 0.3);

    }

    .btn-primary:active {

      transform: translateY(0);

    }

    a {

      color: #8B6F47;

      text-decoration: none;

      font-weight: 500;

      transition: color 0.3s ease;

    }

    a:hover {

      color: #6B5230;

      text-decoration: underline;

    }

    .create-account-link {

      text-align: center;

      margin-top: 20px;

      padding-top: 20px;

      border-top: 1px solid #E8D5C4;

    }

    .alert {

      border-radius: 8px;

      margin-top: 20px;

      border: none;

      padding: 15px;

    }

    .alert-danger {

      background-color: #FFE5D9;

      color: #8B4513;

    }

  </style>

</head>

<body>

  <div class="login-container">

    <h1>User Login</h1>

    <?php if ($error_message): ?>

      <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>

    <?php endif; ?>

    <form action="index.php" method="post">

      <div class="form-group">

        <label for="username">User Name</label>

        <input class="form-control" type="text" id="username" name="username" required>

      </div>

      <div class="form-group">

        <label for="password">Password</label>

        <input class="form-control" type="password" id="password" name="password" required>

      </div>

      <div class="form-group">

        <input class="btn btn-primary" name='Submit' type="submit" value="Submit">

      </div>

    </form>

    <div class="create-account-link">

      <a href="create_user.php">Don't have an account? Create one now!</a>

    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
