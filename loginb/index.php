<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .alert{color:red; display: none;}
    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="controller/user.php" method="post" id="login-form">
        <input type="hidden" name="op" value="login">
        <div>
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="*******">
        </div>
        <button id="login">Login</button>
        <div class="alert" id="msg"></div>
        <a href="signup.php">Signup</a>
    </form>
    <script>
        let form = document.querySelector('#login-form');
        form.onsubmit = (e) => {
            e.preventDefault();

            var formData = new FormData(form);
            // formData.append('op','login');

            login.setAttribute('disabled','disabled');
            login.style.background = '#222';

            fetch('controller/user.php', {
                method: 'POST',
                body: formData
            })
            .then(res=>res.json())
            .then(res=>{
                if(res.status == 1){
                    // redirect dashboard
                    window.location = 'dashboard.php';
                } else {
                    msg.style.display = 'block';
                    msg.innerText = res.msg;
                }
                login.removeAttribute('disabled','disabled');
                login.style.background = 'initial';
            });
        }
    </script>
</body>
</html>