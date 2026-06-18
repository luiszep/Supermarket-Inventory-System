<?php
/*
/**
 * CS 4342 Item Menu
 * Updated: use inline SVG icons (no emoji) so icons always render.
 */
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS 4342 Item Menu</title>

    <!-- Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(135deg, #c8e6c9 0%, #a5d6a7 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #556b2f;
            padding: 40px 0;
        }
        .menu-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        h1 {
            color: #556b2f;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .menu-item {
            display: block;
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 4px 15px rgba(129, 199, 132, 0.3);
        }
        .menu-item:hover {
            background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(129, 199, 132, 0.4);
            color: white;
            text-decoration: none;
        }
        .menu-item:last-child {
            margin-bottom: 0;
        }
        .menu-icon {
            font-size: 24px;
            margin-right: 10px;
            display: inline-block;
            vertical-align: middle;
        }
    </style>

</head>

<body>
    <!-- Displaying a menu for CRUD operations in Item table -->
    <div class="menu-container">
        <h1>Item Menu</h1>
        <div class="menu-card">
            <a href="create_item.php" class="menu-item">
                <span class="menu-icon">&#10133;</span>Create Item
            </a>
            <a href="view_items.php" class="menu-item">
                <span class="menu-icon">&#128203;</span>View, Modify, and Delete Items
            </a>
            <a href="report_items.php" class="menu-item">
                <span class="menu-icon">&#128202;</span>View Report
            </a>
            <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/apandey2/DB4342_PhP_apandey2/suppliersCode/supplier_menu.php" class="menu-item" target="_blank">
                <span class="menu-icon">&#127981;</span>Supplier Menu
            </a>
            <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/ldgarcia13/DB4342_PhP_ldgarcia13/studentsCode/staff_menu.php" class="menu-item" target="_blank">
                <span class="menu-icon">&#128101;</span>Staff Menu
            </a>
            <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/lzepedarodrig/DB4342_PhP_lzepedarodrig/branchCode/branch_menu.php" class="menu-item" target="_blank">
                <span class="menu-icon">&#127970;</span>Branch Menu
            </a>
            <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/Team4DB/team_main.php" class="menu-item">
                <span class="menu-icon">&#127797;</span>Team Database Menu
            </a>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>