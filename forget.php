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
        <div class="w-25 mx-auto mt-5 ">
            <div class="col text-center">
                <h1 class="">Forget Password</h1>
                <p>if your email exist you will recive a password reset link as an email</p>
            </div>
            <div class="alert alert-success" id="successMessage">

            </div>
            <form action="./controllers/email.php" id="forgetForm" method="post">
                <div class="mb-5">
                    <input type="hidden" name="action" value="forget">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="enter email">
                    <div class="showerror" id="emailError"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-block w-100">Search for Email</button>

            </form>
        </div>
    </main>
</body>
<?php require('./views/layout/footer.php'); ?>

<script>
let forgetForm = document.querySelector('#forgetForm');
successMessage.style.display = 'none';
forgetForm.onsubmit = (e) => {
    e.preventDefault();

    var formData = new FormData(forgetForm);

    fetch('./controllers/email.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(response => {
            if (response.state) {
                successMessage.style.display = 'block';
                successMessage.innerText = response.message;
                email.value = '';
            } else {
                if (response.loc == "email") {
                    emailError.style.display = 'block';
                    emailError.style.color = 'red';
                    emailError.innerText = response.message;
                }

            }
            setTimeout(() => {
                emailError.style.display = 'none';
                successMessage.style.display = 'none';

            }, 6000);
        });
}
</script>

</html>