<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <title>View Staff</title>

    <style>
        body {
            background: #e6d9ff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4b3c72;
            padding: 40px 0;
        }

        .menu-container {
            max-width: 1100px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #7a57c6;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .table-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        table {
            border-radius: 15px;
            overflow: hidden;
        }

        thead {
            background: #9c7df5;
            color: white;
        }

        tbody tr:hover {
            background: #f2ebff;
        }

        .btn-lavender {
            background: #9c7df5;
            color: white !important;
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-block;
            margin-top: 25px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-lavender:hover {
            background: linear-gradient(135deg, #b9a4ff 0%, #8d6ce8 100%);
            transform: translateY(-2px);
            text-decoration: none;
            color: white !important;
            box-shadow: 0 6px 20px rgba(156, 125, 245, 0.45);
        }

        a.action-link {
            color: #7a57c6;
            font-weight: 600;
        }

        a.action-link:hover {
            color: #9c7df5;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="menu-container">
    <h1>View Staff Records</h1>

    <div class="table-card">
        <?php
        $sql = "SELECT * FROM Staff";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "<div class='alert alert-danger'>Query failed: " . $conn->error . "</div>";
        } else {
            if ($result->num_rows === 0) {
                echo "<div class='alert alert-warning'>No staff records found.</div>";
            } else {
        ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Time Worked</th>
                        <th>DOB</th>
                        <th>Branch</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                <?php while ($row = $result->fetch_row()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row[0]); ?></td>
                        <td><?= htmlspecialchars($row[1]); ?></td>
                        <td><?= htmlspecialchars($row[2]); ?></td>
                        <td><?= htmlspecialchars($row[3]); ?></td>
                        <td><?= htmlspecialchars($row[4]); ?></td>
                        <td><?= htmlspecialchars($row[5]); ?></td>
                        <td><?= htmlspecialchars($row[6]); ?></td>
                        <td><?= htmlspecialchars($row[7]); ?></td>

                        <td><a class="action-link"
                               href="update_staff_interface.php?ID=<?= urlencode($row[0]); ?>">
                               Update</a></td>

                        <td><a class="action-link"
                               href="delete_staff.php?ID=<?= urlencode($row[0]); ?>">
                               Delete</a></td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        <?php
            }
        }
        ?>

        <a href="staff_menu.php" class="btn-lavender">? Back to Staff Menu</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
