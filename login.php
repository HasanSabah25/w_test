<!DOCTYPE html>
<html lang="en">
<?php require('./views/layout/header');?>
<body>
    <?php require('./views/layout/navbar');?>
    <main>
        <div class="w-25 mx-auto mt-5">
            <div class="col text-center">
                <h1 class=""> login</h1>
            </div>

            <form action="">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="enter email">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">password</label>
                    <input type="text" class="form-control" id="password" placeholder="enter password">
                </div>
                <div class="form-group mb-3 ">
                    <a href="#">Forgot password?</a>
                </div>

                <button type="button" class="btn btn-primary btn-block w-100">Log in</button>

            </form>
        </div>

    </main>
</body>
<?php require('./views/layout/footer');?>
<script>
let form = document.querySelector('#login-form');
form.onsubmit = (e) => {
    e.preventDefault();

    var formData = new FormData(form);
    // formData.append('op','login');

    login.setAttribute('disabled', 'disabled');
    login.style.background = '#222';

    fetch('controller/user.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.status == 1) {
                // redirect dashboard
                window.location = 'dashboard.php';
            } else {
                msg.style.display = 'block';
                msg.innerText = res.msg;
            }
            login.removeAttribute('disabled', 'disabled');
            login.style.background = 'initial';
        });
}
</script>
</html>