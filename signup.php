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
                    <input type="password" class="form-control" id="password" name="password" placeholder="enter password" autocomplete="current-password">
                    <div class="showerror" id="passwordError"></div>

                </div>

                <button type="submit" class="btn btn-primary btn-block w-100" id="btnSignup">signup</button>
            </form>
        </div>

    </main>
    <script>
        let singupForm = document.querySelector('#singupForm');
        successMessage.style.display = 'none';
        singupForm.onsubmit = (e) => {
            e.preventDefault();
            var formData = new FormData(singupForm);

            fetch('./controllers/auth-controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(response => {
                    if (response.state) {
                        fullNameError.style.display = 'none';
                        emailError.style.display = 'none';
                        passwordError.style.display = 'none';
                        successMessage.style.display = 'block';
                        successMessage.innerText = response.message;
                        fullName.value = '';
                        email.value = '';
                        password.value = '';

                    } else {
                        if (response.message == "All fields are required") {
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
                        if (response.loc == "fullname") {
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = response.message;
                        }
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