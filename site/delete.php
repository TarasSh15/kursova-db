<?php

include "dbConn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$sql = "DELETE FROM disp_list WHERE disp_name = '$id' LIMIT 1";
$conn->query($sql);
$conn->close(); // Close connection
header("location:index.php"); // redirects to all records page
exit;	
?>