<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: ' . dirname(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) . '/dashboard');
    exit;
}
require('./views/layout/header.php');
?>

<body>
    <?php require('./views/layout/navbar.php'); ?>
    <main>
        <div class="w-25 mx-auto mt-5 pb-5">
            <div class="col text-center">
                <h1 class=""> signup</h1>
                <div class="alert alert-success" id="successMessage">

                </div>
            </div>

            <form action="/controllers/auth_controller.php" class="form-group" id="singupForm" name="singupForm">
                <input type="hidden" name="action" value="signup">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="enter full name">
                    <div class="showerror" id="fullNameError"></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="enter email">
                    <div class="showerror" id="emailError"></div>

                </div>
                <div class="mb-5">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="enter password" autocomplete="current-password">
                    <div class="showerror" id="passwordError"></div>

                </div>

                <button type="submit" class="btn btn-primary btn-block w-100" id="btnSignup">signup</button>
            </form>
        </div>

    </main>
    <script>
    let form = document.querySelector('#singupForm');
    successMessage.style.display = 'none';
    form.onsubmit = (e) => {
        e.preventDefault();
        var formData = new FormData(form);

        fetch('./controllers/auth-controller.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if (res.status == 1) {
                    fullNameError.style.display = 'none';
                    emailError.style.display = 'none';
                    passwordError.style.display = 'none';
                    successMessage.style.display = 'block';
                    successMessage.innerText = res.msg;
                    fullName.value = '';
                    email.value = '';
                    password.value = '';

                } else {
                    if (res.msg == "All fields are required") {
                        // Display error message for all fields
                        fullNameError.style.display = 'block';
                        emailError.style.display = 'block';
                        passwordError.style.display = 'block';
                        fullNameError.style.color = 'red';
                        emailError.style.color = 'red';
                        passwordError.style.color = 'red';
                        fullNameError.innerText = 'Full name is required';
                        emailError.innerText = 'Email is required';
                        passwordError.innerText = 'Password is required';
                    }
                    if (res.loc == "fullname") {
                        fullNameError.style.display = 'block';
                        fullNameError.style.color = 'red';
                        fullNameError.innerText = res.msg;
                    }
                    if (res.loc == "email") {
                        emailError.style.display = 'block';
                        emailError.style.color = 'red';
                        emailError.innerText = res.msg;
                    }
                    if (res.loc == "password") {
                        passwordError.style.display = 'block';
                        passwordError.style.color = 'red';
                        passwordError.innerText = res.msg;
                    }

                }
                setTimeout(() => {

                    fullNameError.style.display = 'none';
                    emailError.style.display = 'none';
                    passwordError.style.display = 'none';

                }, 7000);
            });
    }
    </script>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>