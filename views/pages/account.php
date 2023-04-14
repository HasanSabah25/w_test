
<div>
    <form action="/controllers/update_profile_controller.php" enctype="multipart/form-data" id="updateProfileForm" name="updateProfileForm">
        <input type="hidden" name="action" value="update_profile">

        <div class="container mt-5">
            <h2>Account Sitting</h2>
            <div class="row mt-3">
                <div class="col-3 ">
                    <img src="" class="img-fluid border border-muted mb-4" id="profileImag" alt="Your Image">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" id="formFile" name="formFile">
                    </div>
                </div>
                <div class="col col-md-9">
                    <div class="">
                        <div class="alert alert-success" id="successMessage">

                        </div>
                        <h3>Basic Information</h3>
                        <div class="mb-3">
                            <p id="p"></p>
                            <label for="formGroupExampleInput2" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="enter full name">
                            <div class="showerror" id="fullNameError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Phone No.</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="enter phone">
                        </div>
                        <div class="mb-5">
                            <label for="formGroupExampleInput2" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="enter email">
                            <div class="showerror" id="emailError"></div>

                        </div>

                        <button type="submit" class="btn btn-primary float-end">Save changes</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var updateForm = document.getElementById('updateProfileForm');
            if (updateForm) {
                fetchUserData();
            }
        });

        function fetchUserData() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var user = JSON.parse(this.responseText);
                    document.getElementById('fullname').value = user.full_name;
                    document.getElementById('phone').value = user.phone_number;
                    document.getElementById('email').value = user.email;
                    document.getElementById('profileImag').src = user.profile_img;
                    
                }
            };
            xhttp.open("POST", "controllers/get_user_data_controller.php", true);
            xhttp.send();
        }



        let updateProfileForm = document.querySelector('#updateProfileForm');
        successMessage.style.display = 'none';
        updateProfileForm.onsubmit = (e) => {
            e.preventDefault();

            var formData = new FormData(updateProfileForm);

            fetch('./controllers/update_profile_controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(response => {
                    if (response.State ) {
                        document.getElementById("updateProfileForm").reset();
                        emailError.style.display = 'none';
                        fullNameError.style.display = 'none';
                        fetchUserData();
                        successMessage.style.display = 'block';
                        successMessage.innerText = response.message;
                    } else {
                        if (response.loc == "email") {
                            emailError.style.display = 'block';
                            emailError.style.color = 'red';
                            emailError.innerText = response.message;
                        }
                        if (response.loc == "fullname") {
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = response.message;
                        }
                        if (response.loc == "all") {
                            emailError.style.display = 'block';
                            emailError.style.color = 'red';
                            emailError.innerText = response.message;
                            // passwrod
                            fullNameError.style.display = 'block';
                            fullNameError.style.color = 'red';
                            fullNameError.innerText = response.message;
                        }

                    }
                    setTimeout(() => {
                        emailError.style.display = 'none';
                        fullNameError.style.display = 'none';
                        successMessage.style.display = 'none';

                    }, 6000);
                });
        }
    </script>
    <form action="/controllers/change_password.php" enctype="multipart/form-data" id="changePasswordForm" name="changePasswordForm">
        <input type="hidden" name="action" value="changePassword">

        <div class="container mt-3">
            <div class="row mt-3">
                <div class="row mt-1 mb-5">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <div class="alert alert-success" id="successchangepassword" style="display: none;"> </div>

                        <h3>Security</h3>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Current password</label>
                            <input type="password" class="form-control" id="currentpassword" name="currentpassword" placeholder="enter current password">
                            <div class="showerror" id="currentpasswordError"></div>

                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">New password</label>
                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="enter new password">
                            <div class="showerror" id="newpasswordError"></div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Save password</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let changepasswordform = document.querySelector('#changePasswordForm');

    changepasswordform.onsubmit = (e) => {
        e.preventDefault();

        var formData = new FormData(changepasswordform);

        fetch('./controllers/change_password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(response => {

                if (response.State) {
                    document.getElementById("changePasswordForm").reset();
                    successchangepassword.style.display = 'block';
                    successchangepassword.innerText = response.message;
                } else {
                    if (response.loc == "currentpassword") {
                        currentpasswordError.style.display = 'block';
                        currentpasswordError.style.color = 'red';
                        currentpasswordError.innerText = response.message;
                    }
                    if (response.loc == "newpassword") {
                        newpasswordError.style.display = 'block';
                        newpasswordError.style.color = 'red';
                        newpasswordError.innerText = response.message;
                    }
                }
                setTimeout(() => {
                    currentpasswordError.style.display = 'none';
                    newpasswordError.style.display = 'none';
                    successchangepassword.style.display = 'none';

                }, 6000);
            });
    }
</script>