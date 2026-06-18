<!--
/**
 * CS 4342 Database Management
 * @author Instruction team with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
-->

<?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['IID'])){

    $iid = isset($_POST['IID']) ? intval($_POST['IID']) : 0;
    $iname = isset($_POST['iname']) ? $_POST['iname'] : " ";
    $idescription = isset($_POST['idescription']) ? $_POST['idescription'] : " ";
    $iprice = isset($_POST['iprice']) ? floatval($_POST['iprice']) : 0.0;
    $iinstock = isset($_POST['iinstock']) ? intval($_POST['iinstock']) : 0;

    $stmt = $conn->prepare("UPDATE Item SET IName = ?, IDescription = ?, IPrice = ?, IInStock = ? WHERE IID = ?");
    if ($stmt === false) {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }
    $stmt->bind_param("ssdii", $iname, $idescription, $iprice, $iinstock, $iid);

    if ($stmt->execute()) {
        header("Location: view_items.php");
        exit;
      } else {
        echo "Error updating record: " . htmlspecialchars($stmt->error);
      }

    $stmt->close();
}
else {
  echo "No item id received on request at update item";
  die();
}

?>