<?php

use Absoft\Line\App\Pager\Alert;
use Absoft\Line\Core\HTTP\Route;

$loadTemplate("/Layouts/header");
?>
<div class="row mt-5">
    <div class="col"></div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="card-title mb-0">Sign In</h3>
            </div>
            <form action="<?php print Route::route_address("/auth/login"); ?>" method="post" class="card-body">

                <?php Alert::displayAlert(); ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="username_span">
                    <div class="input-group-append">
                        <span class="input-group-text" id="username_span">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" aria-describedby="password_span">
                    <div class="input-group-append">
                        <span class="input-group-text" id="password_span">
                            <i class="bi bi-person-fill"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-door-open"></i> Login
                </button>
            </form>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
$loadTemplate("/Layouts/footer");
?>