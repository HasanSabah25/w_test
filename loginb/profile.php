<?php
require('controller/auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>
    <p>Welcome <?= $_SESSION['user']->name ?></p>
    
    <form action="controller/user.php" method="post" id="signup-form">
        <input type="hidden" name="op" value="profile">
        <input type="hidden" name="id" value="<?= $_SESSION['user']->id ?>">
        <div>
            <label>Name</label>
            <input type="text" name="name" id="name" placeholder="Username" value="<?= $_SESSION['user']->name ?>">
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" id="username" placeholder="Username" value="<?= $_SESSION['user']->username ?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="*******">
        </div>
        <div>
            <label>Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="*******">
        </div>
        <button>Update Profile</button>
        <div class="alert" id="msg"></div>
    </form>

    <a href="controller/logout.php">Logout</a>
</body>
</html>