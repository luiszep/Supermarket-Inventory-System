<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Luis Zepeda Rodriguez
 * This file deletes a record from the table Branch of your DB.
 */
-->


<?php 

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['BName'])){

    $bName = $_GET['BName'];
    $query = "DELETE from Branch where BName = '$bName'";

    if ($conn->query($query) === TRUE) {
        //echo "Branch deleted successfully";
        header("Location: view_branches.php");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No BName received";
    header("Location: view_branches.php");
}

?>

