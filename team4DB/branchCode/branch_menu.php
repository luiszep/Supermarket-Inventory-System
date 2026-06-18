<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 */
-->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS 4342 Branch Menu</title>

    <!-- Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        body {
            background: #ffe0b2;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e65100;
            padding: 40px 0;
        }
        .menu-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        h1 {
            color: #f57c00;
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
            background: #ff9800;
            color: white;
            padding: 20px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
        }
        .menu-item:hover {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 152, 0, 0.4);
            color: white;
            text-decoration: none;
        }
        .menu-item:last-child {
            margin-bottom: 0;
        }
        .menu-icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Displaying a menu for CRUD operations in Branch table -->
    <div class="menu-container">
        <h1>Branch Menu</h1>
        <div class="menu-card">
        <a href="create_branch.php" class="menu-item">Create Branch</a><br>
        <a href="view_branches.php" class="menu-item">View, Modify, and Delete Branches</a><br>
        <a href="branch_report.php" class="menu-item">View Report</a><br>
        <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/apandey2/DB4342_PhP_apandey2/suppliersCode/supplier_menu.php" class="menu-item">View Suppliers Menu</a><br>
        <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/ldgarcia13/DB4342_PhP_ldgarcia13/studentsCode/staff_menu.php" class="menu-item">View Staff Menu</a><br>
        <a href="https://cssrvlab01.utep.edu/Classes/CS4342_5342%20Dr.%20Akbar/Team4%20Akbar/mxrioslozan/DB4342_PhP_mxrioslozan/itemsCode/item_menu.php" class="menu-item">View Items Menu</a><br>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>

