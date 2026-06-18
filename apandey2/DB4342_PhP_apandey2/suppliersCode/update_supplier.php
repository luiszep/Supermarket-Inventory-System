
<!--
/**
 * CS 4342 Database Management
 * Description: The purpose of this file is to update a supplier in Supplier Table.
 * Modified by: Aadvika Pandey
 */
-->

<?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['company-name'])){
    $sName = isset($_POST['company-name']) ? $_POST['company-name'] : " ";  
    $sOwner = isset($_POST['company-owner']) ? $_POST['company-owner'] : " ";
    $sCountry = isset($_POST['country']) ? $_POST['country'] : " ";
    $sItemId = isset($_POST['item-id']) ? $_POST['item-id'] : " ";
    $sEmail = isset($_POST['email']) ? $_POST['email'] : " ";
    $sPhoneNumber = isset($_POST['phone-number']) ? $_POST['phone-number'] : " ";

    $query = "UPDATE Supplier SET Owner='$sOwner', RepEmail='$sEmail', RepPhoneNumber='$sPhoneNumber', IID='$sItemId',Country='$sCountry' WHERE CompanyName = '$sName'";
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_suppliers.php");
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }

}
else {
  echo "No supplier name received on request at update supplier";
  die();
}

?>
<!doctype html>
<html lang="en">
<title>CS 4342 Update Suppliers</title>
</html>
