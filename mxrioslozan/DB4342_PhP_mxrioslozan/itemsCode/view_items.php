<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file retrieves and displays the records of the table Student.
 */
-->

<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
        .table-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .table-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        h1 {
            color: #556b2f;
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
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
        }
        thead td {
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
            background: #f1f8f4;
        }
        tbody tr:hover {
            background: #e8f5e9;
        }
        tbody td {
            padding: 15px;
            color: #556b2f;
            border-bottom: 1px solid #c8e6c9;
        }
        .action-link {
            color: #6b8e23;
            text-decoration: none;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .action-link:hover {
            background: #c8e6c9;
            color: #556b2f;
            text-decoration: none;
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
        /* Custom Delete Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            animation: fadeIn 0.3s ease;
        }
        .modal-overlay.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .custom-modal {
            background: white;
            border-radius: 20px;
            padding: 0;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            overflow: hidden;
        }
        .modal-header {
            background: linear-gradient(135deg, #81c784 0%, #66bb6a 100%);
            padding: 25px 30px;
            color: white;
        }
        .modal-header h3 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 22px;
        }
        .modal-body {
            padding: 30px;
            color: #556b2f;
        }
        .modal-body p {
            margin: 0;
            font-size: 16px;
            line-height: 1.6;
        }
        .modal-footer {
            padding: 20px 30px;
            background: #f9f9f9;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        .modal-btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        .modal-btn-cancel {
            background: #e0e0e0;
            color: #555;
        }
        .modal-btn-cancel:hover {
            background: #d0d0d0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .modal-btn-delete {
            background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
            color: white;
        }
        .modal-btn-delete:hover {
            background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.4);
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <?php $sql = "SELECT IID, IName, IDescription, IPrice, IInStock FROM Item";
    if ($result = $conn->query($sql)) {
    ?>
        <div class="table-container">
            <h1>Items</h1>
            <div class="table-card">
                <table class="table" width=100%>
                    <thead>
                        <tr>
                            <td>IID</td>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Price</td>
                            <td>In Stock</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['IID']); ?></td>
                                <td><?php echo htmlspecialchars($row['IName']); ?></td>
                                <td><?php echo htmlspecialchars($row['IDescription']); ?></td>
                                <td>$<?php echo htmlspecialchars(number_format((float)$row['IPrice'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($row['IInStock']); ?></td>
                                <td><a href="update_item_interface.php?IID=<?php echo urlencode($row['IID']); ?>" class="action-link">Update</a></td>
                                <td><a href="#" class="action-link delete-link" data-iid="<?php echo htmlspecialchars($row['IID']); ?>" data-name="<?php echo htmlspecialchars($row['IName']); ?>">Delete</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="back-link">
                <a href="item_menu.php">Back to Item Menu</a>
            </div>
        </div>
    <?php
    }
    ?>
    
    <!-- Custom Delete Modal -->
    <div id="deleteModal" class="modal-overlay">
        <div class="custom-modal">
            <div class="modal-header">
                <h3>⚠️ Confirm Delete</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="itemName"></strong>?</p>
                <p style="margin-top: 10px; color: #999; font-size: 14px;">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <button class="modal-btn modal-btn-delete" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let deleteUrl = '';
        
        // Handle delete link clicks
        document.querySelectorAll('.delete-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const iid = this.getAttribute('data-iid');
                const name = this.getAttribute('data-name');
                deleteUrl = 'delete_item.php?IID=' + encodeURIComponent(iid);
                document.getElementById('itemName').textContent = name;
                document.getElementById('deleteModal').classList.add('show');
            });
        });
        
        // Close modal function
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
            deleteUrl = '';
        }
        
        // Confirm delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteUrl) {
                window.location.href = deleteUrl;
            }
        });
        
        // Close modal when clicking overlay
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>
