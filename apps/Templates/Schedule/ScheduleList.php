<?php

use Absoft\Line\Core\HTTP\Route;

$loadTemplate("/Layouts/header");
?>
<div class="d-flex">
    <div class="col">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Driver</th>
                <th scope="col">Client</th>
                <th scope="col">Route</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
//                print_r($request);
                if(count($request) > 0){
                    foreach($request as $key => $schedule){
                        print '
                        <tr>
                            <th scope="row">'.$schedule["driver_id"].'</th>
                            <td>'.$schedule["client"].'</td>
                            <td>'.$schedule["route"].'</td>
                            <td><a href="'.Route::get_view("/view_schedule", ["id" => $schedule["id"]]).'">view</a></td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="col-3">

        <div class="p-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                <label class="form-check-label" for="gridRadios2">
                    Free
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                <label class="form-check-label" for="gridRadios3">
                    Scheduled
                </label>
            </div>
        </div>

        <div class="btn-group-vertical w-100">
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "m"]) ?>" class="btn btn-lg btn-primary btn-block">Monday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "t"]) ?>" class="btn btn-lg btn-primary btn-block">Tuesday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "w"]) ?>" class="btn btn-lg btn-primary btn-block">Wednesday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "th"]) ?>" class="btn btn-lg btn-primary btn-block">Thursday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "f"]) ?>" class="btn btn-lg btn-primary btn-block">Friday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "sa"]) ?>" class="btn btn-lg btn-primary btn-block">Saturday</a>
            <a href="<?php print Route::get_view("/schedule_list", ["day" => "su"]) ?>" class="btn btn-lg btn-primary btn-block">Sunday</a>
        </div>

    </div>
</div>

<?php
$loadTemplate("/Layouts/footer")
?>