<!--
/**
 * CS 4342 Database Management
 * Staff Report: View staff according to branch.
 */
-->

<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

/*
 * Staff by Branch report
 * Shows all staff ordered by branch name, then staff name.
 */

$sql = "
    SELECT BName, ID, Name, Position, Salary, Email, `Time Worked`, DOB
    FROM Staff
    ORDER BY BName, Name;
";

$result = $conn->query($sql);

if ($result === false) {
    die("SQL Error: " . $conn->error);
}

if ($result->num_rows === 0) {
    die("<b>No staff records found.</b>");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #e6d9ff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4b3c72;
            padding: 40px 0;
        }

        .report-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .report-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #7a57c6;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: linear-gradient(118deg, #9c7df5 0%, #b9a4ff 100%);
            color: #ffffff;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border: none;
        }

        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #ede7ff;
            color: #4b3c72;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background: #f7f3ff;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #7a57c6;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            background: #ffffff;
            border-radius: 12px;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(156, 125, 245, 0.25);
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            background: linear-gradient(135deg, #b9a4ff 0%, #8d6ce8 100%);
            color: #ffffff;
            transform: translateY(-2px);
        }
    </style>

    <title>CS 4342 Staff Report</title>
</head>

<body>
    <div class="report-container">
        <div class="report-card">
            <h1>Staff by Branch Report</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th>Branch Name</th>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Email</th>
                        <th>Time Worked</th>
                        <th>DOB</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_row()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row[0]); ?></td>
                            <td><?php echo htmlspecialchars($row[1]); ?></td>
                            <td><?php echo htmlspecialchars($row[2]); ?></td>
                            <td><?php echo htmlspecialchars($row[3]); ?></td>
                            <td><?php echo htmlspecialchars($row[4]); ?></td>
                            <td><?php echo htmlspecialchars($row[5]); ?></td>
                            <td><?php echo htmlspecialchars($row[6]); ?></td>
                            <td><?php echo htmlspecialchars($row[7]); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="back-link">
                <a href="staff_menu.php">? Back to Staff Menu</a>
            </div>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
