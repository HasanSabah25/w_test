<!DOCTYPE html>
<html lang="en">
<?php require('./views/layout/header.php'); ?>

<body>
    <?php require('./views/layout/navbar.php'); ?>
    <main>
        <div class="w-25 mx-auto mt-5">
            <div class="col text-center">
                <h1 class=""> signup</h1>
            </div>

            <form action="">

            <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Full name</label>
                    <input type="text" class="form-control" id="fullname" placeholder="enter full name">
                </div>
                example:dana kareem

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="enter email">
                </div>
                please dont forget your email
                <div class="mb-5">
                    <label for="formGroupExampleInput2" class="form-label">password</label>
                    <input type="text" class="form-control" id="password" placeholder="enter password">
                </div>
                minimum password length is 8 charachres
               

                <button type="button" class="btn btn-primary btn-block w-100">signup</button>

            </form>
        </div>

    </main>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>