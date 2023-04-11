<!DOCTYPE html>
<html lang="en">
<?php require('./views/layout/header'); ?>

<body>
    <?php require('./views/layout/navbar'); ?>
    <main>
        <?php
        if ($account) {
            require('./views/pages/account');
        } else {
            require('./views/pages/dashboard');
        }
        ?>
    </main>
</body>
<?php require('./views/layout/footer'); ?>

</html>