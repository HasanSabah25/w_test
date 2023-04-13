<!-- index -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid px-5">

        <a class="navbar-brand" href="#">
            <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24"
                class="d-inline-block align-text-top">
            Simple Authentication
        </a>





        <div class="d-flex align-items-center">
            <button class="btn btn-light me-2" type="button "> <i class="bi bi-menu-button"></i>
                Dashboard</button>

            <div class="dropdown me-5">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="15"
                        height="15" class="rounded-circle">
                    Name
                </button>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenu2">
                    <li><button class="dropdown-item" type="button"><i class="bi bi-person-circle"></i> Account</button>
                    </li>
                    <li><button class="dropdown-item" type="button"><i class="bi bi-power"></i> Logout</button></li>
                </ul>
            </div>
        </div>
        <?php
        } else {
        ?>
        <div class="d-flex align-items-center">
            <button class="btn btn-light me-2" type="button ">Login</button>
            <button class="btn btn-light me-2" type="button "> Signup</button>
        </div>
        <?php
        }
        ?>

    </div>
</nav>