<!DOCTYPE html>
<html lang="en">

<?php include('./views/layout/header.php'); ?>

<body>
    <?php include('./views/layout/navbar.php'); ?>
    <main>

        <?php
        if (isset($_SESSION['user'])) {
            include('./config/router.php');
        } else {
            header('Location: login.php');
        }
        ?>
    </main>
</body>
<?php require('./views/layout/footer.php'); ?>

</html>