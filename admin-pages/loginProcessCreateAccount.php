<?php
// --------FILENAME: admin-pages/loginProcessCreateAccount.php ---------
// Purpose: create a login account from login page

include "account.php";

$successful = TRUE;

$email=$_POST['email'];
$password=$_POST['password'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$phone_number=$_POST['phone_number'];

// parses the data to go in the Table
// include "dataParseHelper.php";
echo "$password<br />$email";
$password_hash=hash("sha256", $password);
echo "$password_hash";

$sql = "SELECT COUNT(`email`)
        FROM `users` WHERE `email` = '$email'";

include "connectToDB.php";
$record = mysqli_fetch_array($sql_results);

if ($record[0] > 0) {
    header("Location: login.php?duplicate=true&email=$email");
    return;
}


// Create SQL statement to insert into the user table
$sql="INSERT INTO  `users` 
(`account_id`, `first_name`, `last_name`, `email`, `phone_number`, `password_hash`, `session_id`) 
VALUES 
(NULL, '$first_name', '$last_name', '$email',  '$phone_number', '$password_hash', '1')";
// echo "$sql</br>";
// connectToDB to insert into the phone table.
include "connectToDBV2.php";

if ($successful) {
    // // redirect back to index
header("Location: login.php?email=$email&status=true");
} 




// // redirect back to index
// header("Location: login.php");
?>
