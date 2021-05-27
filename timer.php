<?php
require('database.php');

$timer = time()-30;
$sql = "SELECT count(*) as cnt FROM activities WHERE last_action > '".$timer."'";
$result = mysqli_query($conn, $sql);

/* числовой массив */
$row = mysqli_fetch_assoc($result);
echo json_encode($row);

?>  