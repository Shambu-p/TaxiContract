<?php

use Absoft\Line\Core\HTTP\Route;

$loadTemplate("/Layouts/header");
$schedules = $request["schedules"] ?? [];
$days = $request["days"];
$driver_id = $request["driver_id"];
$constant_days = ["m" => "Mon", "t" => "Tue", "w" => "Wed", "th" => "Thu", "f" => "Fri", "sa" => "Sat", "su" => "Sun"];
?>

<div class="container">
    <ul class="list-group">
        <li class="list-group-item">Driver ID: <?php print $driver_id; ?></li>
        <?php
        foreach ($constant_days as $d => $day_name){
            print '
            <li class="list-group-item">
                <span class="card-title mb-2"><b>'.$day_name.'</b></span>
                <div class="btn-group mb-3 w-100 border-top border-bottom border-left border-right">';

            if(isset($schedules[$d])){
                foreach ($schedules[$d] as $schedule){
                    print '
                        <div class="btn btn-warning">'.$schedule["pick_up"].'</div>
                        <div class="btn btn-success">'.$schedule["drop_off"].'</div>
                    ';
                }
            }

            print '
                </div>
                <a href="'.Route::get_view("/day_driver_schedules", ["driver_id" => $driver_id, "day" => $d]).'" class="btn btn-sm btn-primary ml-3">view</a>
            </li>
            ';
        }
        ?>
    </ul>
</div>

<?php
$loadTemplate("/Layouts/footer")
?>