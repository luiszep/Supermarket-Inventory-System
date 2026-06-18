<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file provides an example of how to separate the interface for the user , e.g., PhP from from the program logic, e.g., PhP statements.
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['IID'])) {
    $iid = intval($_GET['IID']);
    $stmt = $conn->prepare("SELECT IID, IName, IDescription, IPrice, IInStock FROM Item WHERE IID = ?");
    if ($stmt === false) {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        die();
    }
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (!$row) {
        echo "No item found with IID = " . htmlspecialchars($iid);
        die();
    }
}
else {
    echo "No item id received on request at update_item_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Item Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #556b2f;
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
        textarea.form-control {
            resize: vertical;
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
        .back-link {
            text-align: center;
            margin-top: 30px;
        }
        .back-link a {
            color: #6b8e23;
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
            color: #556b2f;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <div class="form-card">
            <h1>Update Item</h1>

            <form action="update_item.php" method="post">
                <input type="hidden" name="IID" id="IID" value="<?php echo htmlspecialchars($row['IID']) ?>">
                <div class="form-group">
                    <label for="iname">Name</label>
                    <input class="form-control" type="text" id="iname" name="iname" value="<?php echo htmlspecialchars($row['IName']) ?>">
                </div>
                <div class="form-group">
                    <label for="idescription">Description</label>
                    <textarea class="form-control" id="idescription" name="idescription" rows="3"><?php echo htmlspecialchars($row['IDescription']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="iprice">Price</label>
                    <input class="form-control" type="number" step="0.01" min="0" id="iprice" name="iprice" value="<?php echo htmlspecialchars($row['IPrice']) ?>">
                </div>
                <div class="form-group">
                    <label for="iinstock">In Stock</label>
                    <input class="form-control" type="number" step="1" min="0" id="iinstock" name="iinstock" value="<?php echo htmlspecialchars($row['IInStock']) ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" name='Submit' type="submit" value="Update">
                </div>
            </form>
        </div>
        <div class="back-link">
            <a href="item_menu.php">Back to Item Menu</a>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>