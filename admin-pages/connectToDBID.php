<?php
$conn = mysqli_connect($host, $dbusername, $dbpassword, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql_results = mysqli_query($conn, $sql);
if (!$sql_results) {
  die("Query failed: " . mysqli_error());
}
$last_id = mysqli_insert_id($conn);

mysqli_close($conn);


?>