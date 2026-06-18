
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

<?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_POST['BName'])){

    $bName = isset($_POST['BName']) ? $_POST['BName'] : " ";
    $bEmail = isset($_POST['bemail']) ? $_POST['bemail'] : "";
    $bPhoneNumber = isset($_POST['bphone']) ? $_POST['bphone'] : "";
    $bStreet = isset($_POST['bstreet']) ? $_POST['bstreet'] : "";
    $bCity = isset($_POST['bcity']) ? $_POST['bcity'] : "";
    $bState = isset($_POST['bstate']) ? $_POST['bstate'] : "";
    $bZip = isset($_POST['bzip']) ? $_POST['bzip'] : "";
    $bFirstName = isset($_POST['bfirstname']) ? $_POST['bfirstname'] : "";
    $bMidName = isset($_POST['bmidname']) ? $_POST['bmidname'] : "";
    $bLastName = isset($_POST['blastname']) ? $_POST['blastname'] : "";
    $iid = isset($_POST['iid']) ? $_POST['iid'] : "";

    // Handle NULL for IID - IID is an integer, so no quotes needed
    $iidValue = ($iid === "" || $iid === null) ? "NULL" : $iid;

    $query = "UPDATE Branch SET BEmail='$bEmail', BPhoneNumber='$bPhoneNumber', BStreet='$bStreet', BCity='$bCity', BState='$bState', BZip='$bZip', BFirstName='$bFirstName', BMidName='$bMidName', BLastName='$bLastName', IID=$iidValue WHERE BName = '$bName'";
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_branches.php");
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }

}
else {
  echo "No branch name received on request at update branch";
  die();
}

?>

