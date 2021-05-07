<?php
// Author: Davis Umana
// Purpose: main page - processes login credentials

include "account.php";
// echo "password " . $email ." Username " . $password . "<br />";
if (isset($_POST['email']) && !empty($_POST['email']) &&
   isset($_POST['password']) && !empty($_POST['password']) )
   {
		$email=$_POST['email'];
		$password=$_POST['password'];
		// hash password from the password field
		$hashVal=hash("sha256", $password);
		// Create SQL statement to  select the account based on email
		$sql="SELECT * FROM `users` WHERE `email` = '$email' ";
		include "connectToDB.php";
                 echo "$sql <br>";
		$record=mysqli_fetch_array($sql_results);
        //  echo "password " . $record['password_hash'] ." Username " . $record['email'];
		if (isset($record['email']) && !empty($record['email'])  
			&& ($record['email'] == $email)
			&& ($record['password_hash'] == $hashVal)) {
				// session stuff here
				session_start();
				// Some bug was happening where seesion_id was not changing on login/logout
				// added session)regenerate to fix that
				$_SESSION['destroyed'] = time();
				session_regenerate_id();
				unset($_SESSION['destroyed']);

				$session_id=session_id();
				$_SESSION['email'] = $email;
				$sql = "UPDATE `users`
				SET `session_id` = '$session_id'
				WHERE `email` = '$email' LIMIT 1" ;		
				include "connectToDB.php";
				header("Location: admin-dashboard.php");
		} else {
				header("Location: login.php?error=true");
                // echo "errrror 1";
		}
} else {
	header("Location: login.php?error=true");
    // echo "errrror 12";
}
?>


