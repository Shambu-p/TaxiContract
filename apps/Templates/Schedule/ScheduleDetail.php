<?php
$loadTemplate("/Layouts/header");

$detail = isset($request["detail"]) ? $request["detail"] : [];
$days = isset($request["days"]) ? $request["days"] : [];
$students = isset($request["students"]) ? $request["students"] : [];
$constant_days = ["m" => "Mon", "t" => "Tue", "w" => "Wed", "th" => "Thu", "f" => "Fri", "sa" => "Sat", "su" => "Sun"];

?>
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title"><b><?php print $detail["driver_id"] ?></b></h4>
            <span><b><?php print $detail["pick_up"]." | ".$detail["drop_off"] ?></b></span>
            <h4 class="card-title"><b><?php print $detail["client"] ?></b></h4>
        </div>
        <div class="card-body">

            <div class="btn-group mb-3 w-100 border-top border-bottom border-left border-right">
                <?php
                $temp_day = [];
                foreach($days as $day){
                    $temp_day[] = $day["day"];
                }

                foreach ($constant_days as $k => $v){
                    if(in_array($k, $temp_day)){
                        print '<div class="btn btn-dark col">'.$constant_days[$k].'</div>';
                    }else {
                        print '<div class="btn btn-light col">'.$constant_days[$k].'</div>';
                    }
                }
                ?>
            </div>

            <div class="d-flex justify-content-between">
                <div class="col">
                    <ul class="list-group">

                        <li class="list-group-item active">Students</li>

                        <?php
                        foreach ($students as $stud) {
                            print '<li class="list-group-item">'.$stud["name"].'</li>';
                        }
                        ?>

                    </ul>
                </div>

                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">route: <?php print $detail["route"]; ?></li>
                        <li class="list-group-item">Start: <?php print date("d-M-Y", $detail["start_date"]); ?></li>
                        <li class="list-group-item">End: <?php print date("d-M-Y", $detail["end_date"]); ?></li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>
<?php
$loadTemplate("/Layouts/footer");
?>