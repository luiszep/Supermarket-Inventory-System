<?php
/**
 * CS 4342 Item Report (Branch)
 * Displays Item name and Branch name using:
 *   SELECT IName, BName FROM Item NATURAL JOIN Branch;
 *
 * Keeps original styling and session checks.
 */
session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CS4342 Item - Branch Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #556b2f;
      padding: 40px 0;
    }
    .report-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .report-card { background: rgba(255,255,255,0.95); border-radius:20px; padding:30px; box-shadow:0 10px 40px rgba(0,0,0,0.1); overflow-x:auto; }
    h1 { text-align:center; margin-bottom:20px; color:#556b2f; font-weight:600; }
    table { width:100%; border-collapse:collapse; }
    thead th { background: linear-gradient(135deg,#81c784,#66bb6a); color:#fff; padding:12px; text-align:left; font-weight:600; border:none; }
    tbody td { padding:12px; border-bottom:1px solid #e6f3e8; color:#556b2f; vertical-align:top; }
    tbody tr:nth-child(even){ background:#f7faf6; }
    .back-link { text-align:center; margin-top:20px; }
    .back-link a { color:#6b8e23; text-decoration:none; font-weight:600; padding:10px 20px; background:#fff; border-radius:8px; display:inline-block; }
  </style>
</head>
<body>
  <div class="report-container">
    <div class="report-card">
      <h1>Items by Branch Report</h1>

<?php
// New query as requested
$sql = "SELECT IName, BName FROM Item NATURAL JOIN Branch";
if ($result = $conn->query($sql)) {
    if ($result->num_rows === 0) {
        echo "<div class=\"alert alert-info\">No rows found for the report.</div>";
    } else {
        echo "<table class=\"table\" width=\"100%\"><thead><tr>";
        // fixed headers for clarity
        echo "<th>Item Name</th><th>Branch Name</th>";
        echo "</tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars((string)($row['IName'] ?? '')) . "</td>";
            echo "<td>" . htmlspecialchars((string)($row['BName'] ?? '')) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    $result->free();
} else {
    echo "<div class=\"alert alert-danger\">Report query failed: " . htmlspecialchars($conn->error) . "</div>";
}
?>

      <div class="back-link">
        <a href="item_menu.php">Back to Item Menu</a>
      </div>
    </div>
  </div>
</body>
</html>