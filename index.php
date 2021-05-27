<?php
session_start();

require('database.php');

$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "REPLACE INTO activities(sessid,last_action) VALUES ('".session_id()."','".time()."')";
mysqli_query($conn,$sql);
mysqli_close($conn);

print_r(session_id());
echo '<br>';
print_r(time());
?>  