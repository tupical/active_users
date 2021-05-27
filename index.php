<!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <title>Тестовое</title>
  </head>
  <body>
    <div class="container">
        <p>Онлайн пользователей: <span class="online_cnt"></span></p>

        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary update_activity">Я еще тут</button>
            <button type="button" class="btn btn-success add_1">+1 посетитель</button>
            <button type="button" class="btn btn-dark add_50">+50 посетителей</button>
        </div>
        
    </div>
    <script>
        const cnt = document.querySelector('.online_cnt');
        function timer(action = 'update'){
            fetch('timer.php?action='+action).then(response => (
                response.json().then(data => ({
                    data: data,
                    status: response.status
                })
                )
            ).then(res => {
                cnt.textContent = res.data.cnt;
                console.log(res.status)
            }));
        }
        function add(count){
            for(let i=0;i<count;i++){
                fetch('timer.php?action=addUser')
                .then((response) => {
                })
                .then((data) => {
                });
                
                cnt.textContent = parseInt(cnt.textContent)+1;
            }
        }
        document.querySelector('.update_activity').addEventListener("click", function(){
            timer('init')
        }, false);
        
        document.querySelector('.add_1').addEventListener("click", function(){
            add(1)
        }, false);
        
        document.querySelector('.add_50').addEventListener("click", function(){
            add(50)
        }, false);
        
        timer('init');
        setInterval(() => timer('update'), 1000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>



