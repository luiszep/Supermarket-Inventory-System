<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 * This file deletes a record  from the table Student of your DB.
 */
-->

<?php 

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['IID'])){

    $iid = intval($_GET['IID']);
    // Prepared delete statement
    $stmt = $conn->prepare("DELETE FROM Item WHERE IID = ?");
    if ($stmt === false) {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }
    $stmt->bind_param("i", $iid);
    if ($stmt->execute()) {
        // redirect back to list
        header("Location: view_items.php");
        exit;
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
} else{
    echo "No IID received";
    header("Location: view_items.php");
    exit;
}

?>