<!DOCTYPE html>
<html lang="en">
<?php require('./views/layout/header.php'); ?>

<body>
    <?php require('./views/layout/navbar.php'); ?>
    <main>
        <div class="w-25 mx-auto mt-5 ">
            <div class="col text-center">
                <h1 class=""> Reset Password</h1>
                <p>if your email exist you will recive a password reset link as an email</p>
            </div>

            <form action="">
                <div class="mb-5">
                    <label for="formGroupExampleInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="enter email">
                </div>
                
                <button type="button" class="btn btn-primary btn-block w-100">Search for Email</button>

            </form>
        </div>
    </main>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>