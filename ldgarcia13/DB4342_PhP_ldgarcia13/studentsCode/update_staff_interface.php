<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['ID'])) {
    $id = intval($_GET['ID']);

    $stmt = $conn->prepare("SELECT * FROM Staff WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "Staff record not found.";
        exit;
    }

} else {
    echo "No Staff ID received on request at update Staff";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Staff Update</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #e6d9ff;
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4b3c72;
        }

        .update-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .update-card {
            background: #ffffff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        h1 {
            text-align: center;
            color: #7a57c6;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .btn-lavender {
            background: #9c7df5;
            color: white !important;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-lavender:hover {
            background: linear-gradient(135deg, #b9a4ff 0%, #8d6ce8 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(156, 125, 245, 0.45);
            color: white !important;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-weight: 600;
            color: #7a57c6;
        }

        .back-link:hover {
            color: #9c7df5;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="update-container">
    <div class="update-card">

        <h1>Update Staff</h1>

        <form action="update_staff.php" method="post">

            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

            <div class="form-group">
                <label>ID</label>
                <input class="form-control" type="text" value="<?php echo $row['ID']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input class="form-control" type="text" name="name" value="<?php echo $row['Name']; ?>">
            </div>

            <div class="form-group">
                <label>Salary</label>
                <input class="form-control" type="text" name="salary" value="<?php echo $row['Salary']; ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="text" name="email" value="<?php echo $row['Email']; ?>">
            </div>

            <div class="form-group">
                <label>Position</label>
                <input class="form-control" type="text" name="position" value="<?php echo $row['Position']; ?>">
            </div>

            <div class="form-group">
                <label>Time Worked</label>
                <input class="form-control" type="text" name="time_worked" value="<?php echo $row['Time Worked']; ?>">
            </div>

            <div class="form-group">
                <label>DOB (YYYY-MM-DD)</label>
                <input class="form-control" type="text" name="dob" value="<?php echo $row['DOB']; ?>">
            </div>

            <div class="form-group">
                <label>Branch Name</label>
                <input class="form-control" type="text" name="bname" value="<?php echo $row['BName']; ?>">
            </div>

            <button type="submit" class="btn btn-lavender">Update Staff</button>
        </form>

        <a class="back-link" href="view_staff.php">? Back to Staff Menu</a>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
