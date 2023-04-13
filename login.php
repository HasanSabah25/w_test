<!DOCTYPE html>
<html lang="en">
<?php require('./views/layout/header.php'); ?>

<body>
    <?php require('./views/layout/navbar.php'); ?>
    <main>
        <div class="w-25 mx-auto mt-5">
            <div class="col text-center">
                <h1> login</h1>
            </div>

            <form action="./controllers/auth-controller.php" method="POST" id="loginForm">
                <input type="hidden" name="action" value="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="enter email">
                    <div class="text-danger" id="msg">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="enter password">
                    <div class="text-danger" id="password-error">

                    </div>
                </div>
                <div class="form-group mb-3 ">
                    <a href="./forget.php">Forgot password?</a>
                </div>

                <button type="submit" id="submit" class="btn btn-primary btn-block w-100">Log in</button>

            </form>
        </div>

    </main>
    <script>
    let form = document.querySelector('#loginForm');
    // let errorMessage = document.getElementById('#email-error');
    form.onsubmit = (e) => {
        e.preventDefault();

        var formData = new FormData(form);
        // formData.append('op','login');

        submit.setAttribute('disabled', 'disabled');
        submit.style.background = '#222';

        fetch('./controllers/auth-controller.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                console.log(res.status);
                console.log(res.msg);
                if (res.status == 1) {
                    // redirect dashboard
                    // window.location = 'index.php';
                    console.log(res.status);
                    console.log(res.msg);
                } else {
                    // msg.style.display = 'block';
                    // msg.innerText = res.msg;
                    console.log(res.status);
                    console.log(res.msg);
                }
                submit.removeAttribute('disabled', 'disabled');
                submit.style.background = 'initial';
            });
    }
    </script>
    <?php require('./views/layout/footer.php'); ?>

</body>


</html>