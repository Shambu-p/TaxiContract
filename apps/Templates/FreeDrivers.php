<?php

use Absoft\Line\Core\HTTP\Route;

$loadTemplate("/Layouts/header");
?>
    <div class="d-flex">
        <div class="col">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Day</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(count($request) > 0){
                    $constant_days = ["m" => "Mon", "t" => "Tue", "w" => "Wed", "th" => "Thu", "f" => "Fri", "sa" => "Sat", "su" => "Sun"];
                    foreach($request as $schedule){
                        print '
                        <tr>
                            <td>'.$constant_days[$schedule["day"]].'</td>
                            <th scope="row">'.$schedule["driver_id"].'</th>
                            <td>Free</td>
                            <td>
                                <a href="'.Route::get_view("/view_driver_schedule", ["driver_id" => $schedule["driver_id"]]).'" class="btn btn-sm btn-primary ml-3">View Driver</a>
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-3">

            <div class="btn-group-vertical w-100">
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "m"]) ?>" class="btn btn-lg btn-primary btn-block">Monday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "t"]) ?>" class="btn btn-lg btn-primary btn-block">Tuesday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "w"]) ?>" class="btn btn-lg btn-primary btn-block">Wednesday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "th"]) ?>" class="btn btn-lg btn-primary btn-block">Thursday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "f"]) ?>" class="btn btn-lg btn-primary btn-block">Friday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "sa"]) ?>" class="btn btn-lg btn-primary btn-block">Saturday</a>
                <a href="<?php print Route::get_view("/free_drivers", ["day" => "su"]) ?>" class="btn btn-lg btn-primary btn-block">Sunday</a>
            </div>

        </div>
    </div>

<?php
$loadTemplate("/Layouts/footer")
?>