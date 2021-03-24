<?php
include "account.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];

// Create SQL statement to insert into the user table
$sql = "INSERT INTO  `customers` 
(`first_name`, `last_name`) 
VALUES 
('$first_name', '$last_name')";
print_r($sql);
// echo "$sql</br>";
// connectToDBID to insert and retrieve the id.
include "connectToDB.php";
header('Location: ../index.php');
?>
