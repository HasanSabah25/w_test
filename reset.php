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
                <h1 class=""> Reset Password</h1>
            </div>
            <div class="alert alert-success" id="successMessage">

            </div>

            <form action="./controllers/email.php" id="resetForm" method="post">
                <input type="hidden" name="action" value="reset">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="enter password">
                    <div class="showerror" id="passwordError"></div>
                </div>
                <div class="mb-5">
                    <label for="Confirmpassword" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="Confirmpassword" placeholder="confirm password">
                    <div class="showerror" id="confirmPasswordError"></div>
                </div>

                <button type="submit" class="btn btn-danger btn-block w-100">Reset Password</button>

            </form>
        </div>
    </main>
</body>
<?php require('./views/layout/footer.php'); ?>
<script>
    let resetForm = document.querySelector('#resetForm');
    successMessage.style.display = 'none';

    resetForm.onsubmit = (e) => {
        e.preventDefault();

        var formData = new FormData(resetForm);

        // successchangepassword.style.display = 'none';

        fetch('./controllers/email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(response => {

                if (response.state) {
                    document.getElementById("resetForm").reset();
                    successMessage.style.display = 'block';
                    successMessage.innerText = response.message;
                } else {
                    if (response.loc == "confirmpassword") {
                        confirmPasswordError.style.display = 'block';
                        confirmPasswordError.style.color = 'red';
                        confirmPasswordError.innerText = response.message;
                    }
                    if (response.loc == "password") {
                        passwordError.style.display = 'block';
                        passwordError.style.color = 'red';
                        passwordError.innerText = response.message;
                    }
                    if (response.loc == "header") {
                        confirmPasswordError.style.display = 'block';
                        confirmPasswordError.style.color = 'red';
                        confirmPasswordError.innerText = response.message;
                        // 
                        passwordError.style.display = 'block';
                        passwordError.style.color = 'red';
                        passwordError.innerText = response.message;
                        // 

                    }
                }
                setTimeout(() => {
                    passwordError.style.display = 'none';
                    confirmPasswordError.style.display = 'none';
                    successMessage.style.display = 'none';

                }, 6000);
            });
    }
</script>

</html>