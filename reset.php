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
        <div class="w-25 mx-auto mt-5 ">
            <div class="col text-center">
                <h1 class=""> Reset Password</h1>
            </div>

            <form action="">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="enter password">
                </div>
                <div class="mb-5">
                    <label for="formGroupExampleInput" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="Confirmpassword" placeholder="enter password">
                </div>

                <button type="button" class="btn btn-danger btn-block w-100">Reset Password</button>

            </form>
        </div>
    </main>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>