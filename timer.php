<?php
require('database.php');

$json = file_get_contents("./cnt.json");
$data = json_decode($json, true);
if($data['time'] <= time()-5){
    $timer = time()-30;
    $sql = "SELECT count(*) as cnt FROM activities WHERE last_action > '".$timer."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $row['time'] = time();
    file_put_contents("./cnt.json", json_encode($row));
    echo json_encode($row);
}else{
    echo $json;
}

?>