<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        .alert{color:red; display: none;}
    </style>
</head>
<body>
    <h1>Signup</h1>
    <form action="controller/user.php" method="post" id="signup-form">
        <input type="hidden" name="op" value="signup">
        <div>
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Username">
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="*******">
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="*******">
        </div>
        <button>Signup</button>
        <div class="alert" id="msg"></div>
        <a href="index.php">Login</a>
    </form>
    <script>
        let form = document.querySelector('#signup-form');
        form.onsubmit = (e) => {
            e.preventDefault();

            var formData = new FormData(form);
            // formData.append('op','Signup');

            fetch('controller/user.php', {
                method: 'POST',
                body: formData
            })
            .then(res=>res.json())
            .then(res=>{
                if(res.status == 1){
                    // redirect dashboard
                    msg.style.display = 'block';
                    msg.style.color = 'green';
                    msg.innerText = res.msg;
                } else {
                    msg.style.display = 'block';
                    msg.style.color = 'red';
                    msg.innerText = res.msg;
                }
                setTimeout(()=>{
                    msg.style.display = 'none';
                }, 5000);
            });
        }
    </script>
</body>
</html>