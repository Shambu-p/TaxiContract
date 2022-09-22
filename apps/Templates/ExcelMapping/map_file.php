<?php

use Absoft\Line\App\Pager\Alert;
use Absoft\Line\Core\HTTP\Route;

?>
<html>
<head>
    <title>Driver Contract</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="icon" href="./favicon.png">
</head>
<body>
<div class="d-flex pl-3 pr-3 pt-2 pb-2 justify-content-between mb-4 border-bottom shadow-sm bg-white" style="position: sticky; z-index: 1020; top: 0;">
    <div class="d-flex">
        <img src="./favicon.png" alt="image" style="width: 70px; height: 70px">
        <h5 class="navbar-brand" style="margin: auto; font-size: 30px;">Go To School</h5>
    </div>

    <div class="d-flex justify-content-start">
        <a href="/" class="btn btn-link btn-lg mr-2">Home</a>
        <a href="/upload" class="btn btn-link btn-lg mr-2">Upload</a>
    </div>
</div>

<?php

    Alert::displayAlert();

    $alpha = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $option_str = '';

    foreach ($alpha as $char) {
        $option_str .= '<option value="'.$char.'">'.$char.'</option>';
    }

?>

<div class="row m-0">
    <div class="col" style="overflow-x: auto;">
        <table class="table">
            <tbody>
            <?php

            foreach ($request["data"] as $row){
                print "<tr>";
                foreach($row as $col){
                    print "<th>$col</th>";
                }
                print "</tr>";
            }

            ?>
            </tbody>
        </table>
    </div>
    <div class="col-3">
        <form
            action="<?php print Route::route_address("/import") ?>"
            method="post"
            class="container"
        >
            <h4 class="card-title mb-5">Configure Cells</h4>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Driver Id</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="driver_id">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect02">Client</label>
                </div>
                <select class="custom-select" id="inputGroupSelect02" name="client">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect03">Pick Up</label>
                </div>
                <select class="custom-select" id="inputGroupSelect03" name="pick_up">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect04">Drop Off</label>
                </div>
                <select class="custom-select" id="inputGroupSelect04" name="drop_off">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect05">Start Date</label>
                </div>
                <select class="custom-select" id="inputGroupSelect05" name="start_date">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect06">End Date</label>
                </div>
                <select class="custom-select" id="inputGroupSelect06" name="end_date">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect07">Route</label>
                </div>
                <select class="custom-select" id="inputGroupSelect07" name="route">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect08">Students</label>
                </div>
                <select class="custom-select" id="inputGroupSelect08" name="students">
                    <?php print $option_str; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect09">Days</label>
                </div>
                <select class="custom-select" id="inputGroupSelect09" name="days">
                    <?php print $option_str; ?>
                </select>
            </div>

            <input type="hidden" name="file_name" value="<?php print $request["file_name"]; ?>" />

            <button type="submit" class="btn btn-lg btn-block btn-primary">Import</button>

        </form>
    </div>
</div>


</body>
</html>