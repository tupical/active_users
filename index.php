
Онлайн пользователей: <span class="online_cnt"></span>

<script>
function timer(action){
    fetch('timer.php?action='+action).then(response => (
        response.json().then(data => ({
            data: data,
            status: response.status
        })
        )
    ).then(res => {
        document.querySelector('.online_cnt').textContent = res.data.cnt;
        console.log(res.status)
    }));
}
timer('init');
setInterval(() => timer('update'), 1000);
</script>