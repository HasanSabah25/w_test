<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid px-5">

        <a class="navbar-brand" href="#">
            <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Simple Authentication
        </a>
        <?php
        if (isset($_SESSION['user'])) {
        ?>
            <div class="d-flex align-items-center">
                <a href="dashboard" onclick="replaceUrl(this.href); return false;" class="btn btn-light me-2">
                    <i class="bi bi-person-lines-fill"></i>
                    Dashboard
                </a>
                <div class="dropdown me-5">


                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src=" <?php echo ($_SESSION['user']->profile_img); ?>" alt="" width="15" height="15" class="rounded-circle">
                        <?php echo ($_SESSION['user']->full_name); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenu2">
                        <li><a href="account" onclick="replaceUrl(this.href); return false;" class="dropdown-item"><i class="bi bi-person-circle"></i> Account</a>
                        </li>
                        <li>
                            <form action="./controllers/auth-controller.php" method="post">
                                <input type="hidden" name="action" value="logout">
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-power"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="d-flex align-items-center">
                <a href="login.php" class="btn btn-light me-2">Login</a>
                <a href="signup.php" class="btn btn-light me-2">Signup</a>
            </div>
        <?php
        }
        ?>

    </div>
</nav>

<script>
    function replaceUrl(url) {
        var hrefValue = link.getAttribute('href');
        var currentUrl = window.location.href;
        var newUrl = currentUrl.replace(/dashboard$/, hrefValue);
        window.location.href = newUrl;
    }
</script>