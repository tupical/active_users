
Онлайн пользователей: <span class="online_cnt"></span>

<script>
function timer(){
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
}
timer();
setInterval(() => timer(), 1000);
</script>