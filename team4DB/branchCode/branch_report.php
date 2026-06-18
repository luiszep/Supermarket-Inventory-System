<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 * This file retrieves and displays a report showing total salaries per branch, ranked in descending order.
 */
-->


<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');

/*
 * Branch Salary Report
 * Shows total amount paid in salaries for each branch, ranked in descending order.
 */

$sql = "
    SELECT 
        B.BName AS BranchName,
        COALESCE(SUM(CAST(REPLACE(REPLACE(S.Salary, '$', ''), ',', '') AS DECIMAL(10,2))), 0) AS TotalSalary
    FROM Branch B
    LEFT JOIN Staff S ON B.BName = S.BName
    WHERE S.Salary IS NOT NULL AND S.Salary != ''
    GROUP BY B.BName
    ORDER BY TotalSalary DESC;
";

$result = $conn->query($sql);

if ($result === false) {
    die("SQL Error: " . $conn->error);
}

if ($result->num_rows === 0) {
    die("<b>No salary data found for branches.</b>");
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
            color: #f57c00;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        thead {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
        }
        thead th {
            color: white;
            font-weight: 600;
            padding: 15px;
            text-align: left;
            border: none;
        }
        tbody tr {
            background: white;
            transition: background 0.3s ease;
        }
        tbody tr:nth-child(even) {
            background: #fff3e0;
        }
        tbody tr:hover {
            background: #ffe0b2;
        }
        tbody td {
            padding: 15px;
            color: #e65100;
            border-bottom: 1px solid #ffb74d;
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
    </style>
    <title>CS 4342 Branch Report</title>
</head>

<body>
    <div class="report-container">
        <div class="report-card">
            <h1>Total Salaries by Branch Report</h1>

            <table class="table" width="100%">
                <thead>
                    <tr>
                        <th>Branch Name</th>
                        <th>Total Salary Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_row()) {
                    ?>
                        <tr>
                            <td><?php printf("%s", $row[0]); ?></td>
                            <td>$<?php printf("%.2f", $row[1]); ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="back-link">
                <a href="branch_menu.php">Back to Branch Menu</a>
            </div>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
