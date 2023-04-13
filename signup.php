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

            <form action="/controllers/auth_controllers.php" id="singupForm" name="singupForm">
                <input type="hidden" name="action" value="signup">
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Full name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="enter full name">
                    <div class="test-denger " id="fullNameError"></div>
                </div>
                example:dana kareem

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="enter email">
                    <div class="test-denger " id="emailError"></div>

                </div>
                please dont forget your email
                <div class="mb-5">
                    <label for="formGroupExampleInput2" class="form-label">password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="enter password">
                    <div class="test-denger " id="passwordError"></div>

                </div>
                minimum password length is 8 charachres


                <button type="submit" class="btn btn-primary btn-block w-100" id="btnSignup">signup</button>

            </form>
        </div>

    </main>
    <script>
        let form = document.querySelector('#singupForm');

        form.onsubmit = (e) => {
            e.preventDefault();
            var formData = new FormData(form);

            fetch('./controllers/auth_controllers.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status == 1) {
                        // redirect dashboard
                        msg.style.display = 'block';
                        msg.style.color = 'green';
                        msg.innerText = res.msg;
                    } else {
                        if (res.loc == "fullname") {
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = res.msg;
                        }
                         if (res.loc == "email"){
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = res.msg;
                        }
                        if(res.loc == "password"){
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = res.msg;
                        }

                    }
                    setTimeout(() => {
                        msg.style.display = 'none';
                    }, 5000);
                });
        }
    </script>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>