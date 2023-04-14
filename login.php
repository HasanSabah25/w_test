<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(0);

if (isset($_SESSION['user'])) {
    header('Location: ' . dirname(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) . '/dashboard');
    exit;
}
require('./views/layout/header.php');
?>

<body>
    <?php require('./views/layout/navbar.php'); ?>
    <main>
        <div class="w-25 mx-auto mt-5">
            <div class="col text-center">
                <h1 class=""> login</h1>
            </div>

            <form action="./controllers/auth-controller.php" id="loginForm" name="loginForm">
                <input type="hidden" name="action" value="login">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="enter email">
                    <div class="showerror" id="emailError"></div>

                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="enter password">
                    <div class="showerror" id="passwordError"></div>

                </div>

                <div class="form-group mb-3 ">
                    <a href="./forget.php">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary btn-block w-100" id="btnlogin">Login</button>

            </form>



        </div>

    </main>
    <?php require('./views/layout/footer.php'); ?>
    <script>
        let loginForm = document.querySelector('#loginForm');
        loginForm.onsubmit = (e) => {
            e.preventDefault();

            var formData = new FormData(loginForm);

            fetch('./controllers/auth-controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(response => {
                    if (response.state) {
                        window.location.href = "dashboard";
                    } else {
                        if (response.loc == "email") {
                            emailError.style.display = 'block';
                            emailError.style.color = 'red';
                            emailError.innerText = response.message;
                        }
                        if (response.loc == "password") {
                            passwordError.style.display = 'block';
                            passwordError.style.color = 'red';
                            passwordError.innerText = response.message;
                        }
                        if (response.loc == "all") {
                            emailError.style.display = 'block';
                            emailError.style.color = 'red';
                            emailError.innerText = response.emailmessage;
                            // passwrod
                            passwordError.style.display = 'block';
                            passwordError.style.color = 'red';
                            passwordError.innerText = response.passwordmessage;
                        }

                    }
                    setTimeout(() => {
                        emailError.style.display = 'none';
                        passwordError.style.display = 'none';

                    }, 6000);
                });
        }
    </script>
</body>



</html>