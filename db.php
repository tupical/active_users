<?php
function get_cnt($last_action,$db){
    $result = $db->query("SELECT count(*) as cnt FROM activities WHERE last_action > '".$last_action."'");
    $row = $result->fetch();
    $deads = time() - 30*60;
    $db->query("DELETE FROM activities WHERE last_action < '".$deads."'");
    return $row;
}

function add_activity($sessid,$last_action,$db){
    $result = $db->query("INSERT INTO activities(`sessid`,`last_action`) VALUES('".$sessid."','".$last_action."') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), `last_action` = '".$last_action."'");
    return $db->lastInsertId();
}