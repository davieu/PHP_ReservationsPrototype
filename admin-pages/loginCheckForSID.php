<?php
// --------FILENAME: admin-pages/loginCheckForSID.php ---------
// Purpose: confirm session ID

include "account.php";
if (session_start())
   {
		$email= $_SESSION['email'] ;
		// Create SQL statement to select the account based on email
		$sql="SELECT * FROM `users` WHERE `email` = '$email' ";
		include "connectToDB.php";
		$record=mysqli_fetch_array($sql_results);
		if (isset($record['session_id']))
		{
				// session stuff here
				$session_id=session_id();
				$db_session_id = $record['session_id'];
				if (!isset($db_session_id) || strcmp($session_id, $db_session_id) !== 0) {
					// session ids do not match
                        echo("session ids do not match");
					header("Location: ../index.php");
				}
		} else {
				// issue with empty session email
                echo("issue with empty session email");
				header("Location: ../index.php");
		}
} else {
	// issue with session not working
    echo("issue with session not working");
	header("Location: ../index.php");
}
?>
