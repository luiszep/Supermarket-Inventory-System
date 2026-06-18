<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS 4342 Staff Menu</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #e6d9ff;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #4b3c72;
            padding: 40px 0;
        }

        .menu-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h1 {
            color: #7a57c6;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .menu-card {
            background: rgba(255, 255, 255, 0.94);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            margin-bottom: 30px;
        }

        .menu-item {
            display: block;
            background: #9c7df5;
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(156, 125, 245, 0.3);
        }

        .menu-item:hover {
            background: linear-gradient(135deg, #b9a4ff 0%, #8d6ce8 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(156, 125, 245, 0.45);
            color: white;
            text-decoration: none;
        }

        .menu-item:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <div class="menu-container">
        <h1>Staff Menu</h1>
        <div class="menu-card">

            <a href="create_staff.php" class="menu-item">Create Staff</a>
            <a href="view_staff.php" class="menu-item">View, Modify, & Delete Staff</a>

            <!-- ? NEW BUTTON: Staff Report -->
            <a href="staff_report.php" class="menu-item">View Staff Report</a>

            <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/mxrioslozan/DB4342_PhP_mxrioslozan/itemsCode/item_menu.php" class="menu-item">
                View Items Menu
            </a>

            <a href="view_suppliers.php" class="menu-item">
                View Suppliers Menu
            </a>

            <a href="/CS4342_5342 Dr. Akbar/Team4 Akbar/lzepedarodrig/DB4342_PhP_lzepedarodrig/studentsCode/student_menu.php" class="menu-item">
                View Branch Menu
            </a>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
