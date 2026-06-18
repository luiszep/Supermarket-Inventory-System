<?php
/**
 * CS 4342 Database Management
 * Create Item (with 5-digit string barcode generation).
 *
 * NOTE: This version preserves your original styling and removes debug file links.
 */

session_start();
require_once('../config.php');
require_once('../validate_session.php');

$success = false;
$error_message = "";

// repopulation values
$iname_val = "";
$idescription_val = "";
$iprice_val = "";
$iinstock_val = "";

/**
 * Generate a 5-digit zero-padded string barcode and check uniqueness.
 * Returns string barcode on success, or null on failure.
 */
function generate_unique_barcode_str($conn, $length = 5, $maxAttempts = 12) {
    if ($length < 1) $length = 5;
    $max = (int) pow(10, $length) - 1;
    $min = 0;

    $checkStmt = $conn->prepare("SELECT 1 FROM Item WHERE IBarcode = ? LIMIT 1");
    if ($checkStmt === false) {
        return null;
    }

    for ($i = 0; $i < $maxAttempts; $i++) {
        $rand = mt_rand($min, $max);
        $cand = sprintf('%0' . $length . 'd', $rand); // zero-padded string
        if (!$checkStmt->bind_param("s", $cand)) {
            continue;
        }
        if (!$checkStmt->execute()) {
            continue;
        }
        $res = $checkStmt->get_result();
        if ($res === false) {
            continue;
        }
        if ($res->num_rows === 0) {
            $checkStmt->close();
            return $cand;
        }
        // else collision, try again
    }

    $checkStmt->close();
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Submit'])) {
    $iname = isset($_POST['iname']) ? trim($_POST['iname']) : "";
    $idescription = isset($_POST['idescription']) ? trim($_POST['idescription']) : "";
    $iprice_raw = isset($_POST['iprice']) ? trim($_POST['iprice']) : "";
    $iinstock_raw = isset($_POST['iinstock']) ? trim($_POST['iinstock']) : "";

    // store for repopulation
    $iname_val = $iname;
    $idescription_val = $idescription;
    $iprice_val = $iprice_raw;
    $iinstock_val = $iinstock_raw;

    // validation
    if ($iname === "") {
        $error_message = "Item name is required.";
    } elseif ($iprice_raw !== "" && !is_numeric($iprice_raw)) {
        $error_message = "Price must be numeric.";
    } elseif ($iinstock_raw !== "" && !ctype_digit($iinstock_raw)) {
        $error_message = "In Stock must be a non-negative integer.";
    } else {
        $iprice = ($iprice_raw === "") ? 0.0 : (float)$iprice_raw;
        $iinstock = ($iinstock_raw === "") ? 0 : (int)$iinstock_raw;

        if (!isset($conn) || !$conn) {
            $error_message = "Database connection is not available.";
        } else {
            // attempt to insert, retrying for duplicate-key (unique barcode) up to attempts
            $maxInsertAttempts = 6;
            $insertAttempt = 0;
            $inserted = false;

            while ($insertAttempt < $maxInsertAttempts && !$inserted) {
                $insertAttempt++;

                // generate barcode string (5 digits)
                $barcode = generate_unique_barcode_str($conn, 5, 8);
                if ($barcode === null) {
                    // fallback: take low 5 digits of timestamp (zero-padded)
                    $fallback = (int) (microtime(true) * 1000) % 100000;
                    $barcode = sprintf('%05d', $fallback);
                }

                // prepare insert
                $sql = "INSERT INTO Item (IBarcode, IName, IDescription, IPrice, IInStock) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    $error_message = "Database error: prepare failed.";
                    break;
                }

                // bind types: s (IBarcode), s (IName), s (IDescription), d (IPrice), i (IInStock)
                $bind_ok = $stmt->bind_param("sssdi", $barcode, $iname, $idescription, $iprice, $iinstock);
                if (!$bind_ok) {
                    $error_message = "Database error: bind failed.";
                    $stmt->close();
                    break;
                }

                $exec_ok = $stmt->execute();
                if ($exec_ok) {
                    if ($stmt->affected_rows > 0) {
                        $inserted = true;
                        $success = true;
                        $stmt->close();
                        header('Location: view_items.php');
                        exit;
                    } else {
                        $error_message = "No rows were inserted. Please check the database.";
                        $stmt->close();
                        break;
                    }
                } else {
                    $errno = $stmt->errno;
                    $errstr = $stmt->error;
                    $stmt->close();
                    // if duplicate (unique) barcode, try again
                    if ($errno == 1062) { // duplicate entry
                        // retry loop
                        continue;
                    } else {
                        $error_message = "Insert failed: " . htmlspecialchars($errstr);
                        break;
                    }
                }
            } // end insert attempts

            if (!$inserted && $error_message === "") {
                $error_message = "Could not insert item after {$insertAttempt} attempts.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create Item</title>
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
    <div class="form-card">
        <h1>Create Item</h1>

        <form action="create_item.php" method="post" id="createItemForm">
            <div class="form-group">
                <label for="iname">Name</label>
                <input class="form-control" type="text" id="iname" name="iname" value="<?php echo htmlspecialchars($iname_val); ?>" required>
            </div>
            <div class="form-group">
                <label for="idescription">Description</label>
                <textarea class="form-control" id="idescription" name="idescription" rows="3"><?php echo htmlspecialchars($idescription_val); ?></textarea>
            </div>
            <div class="form-group">
                <label for="iprice">Price</label>
                <input class="form-control" type="number" step="0.01" min="0" id="iprice" name="iprice" value="<?php echo htmlspecialchars($iprice_val); ?>" required>
            </div>
            <div class="form-group">
                <label for="iinstock">In Stock</label>
                <input class="form-control" type="number" step="1" min="0" id="iinstock" name="iinstock" value="<?php echo htmlspecialchars($iinstock_val); ?>" required>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name="Submit" type="submit" value="Submit">
            </div>
        </form>

        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

    </div>

    <div class="back-link">
        <a href="item_menu.php">Back to Item Menu</a>
    </div>
</div>
</body>
</html>