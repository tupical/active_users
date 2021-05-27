<?php
session_start();

require('database.php');

$sql = "REPLACE INTO activities(sessid,last_action) VALUES ('".session_id()."','".time()."')";
mysqli_query($conn,$sql);
mysqli_close($conn);



print_r(session_id());
echo '<br>';
print_r(time()); 
?>  
<br>
Онлайн пользователей: <span class="online_cnt"></span>

<script>
fetch('timer.php').then(response => (
    response.json().then(data => ({
        data: data,
        status: response.status
    })
    )
).then(res => {
    document.querySelector('.online_cnt').textContent = res.data.cnt;
    console.log(res.status)
}));
</script>