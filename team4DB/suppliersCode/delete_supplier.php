<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Modified by: Aadvika Pandey
 * This file deletes a record  from the table Student of your DB.
 */
-->


<?php 

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['CompanyName'])){

    $companyName = $_GET['CompanyName'];
    $query = "DELETE from Supplier where CompanyName = '$companyName'";

    if ($conn->query($query) === TRUE) {
        //echo "Supplier deleted successfuly";
        header("Location: view_suppliers.php");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No company name received";
    header("Location: view_suppliers.php");
}

?>