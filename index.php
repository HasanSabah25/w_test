<!DOCTYPE html>
<html lang="en">
<?php include('./views/layout/header.php'); ?>

<body>
    <?php include('./views/layout/navbar.php'); ?>
    <main>

        <?php
        $account = true;
        if ($account) {
            include('./views/pages/account.php');
        } else {
            include('./views/pages/dashboard.php');
        }
        ?>
    </main>

</body>
<?php require('./views/layout/footer.php'); ?>

</html>