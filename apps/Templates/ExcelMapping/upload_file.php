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
<div class="d-flex pl-3 pr-3 pt-2 pb-2 justify-content-between mb-4 border-bottom shadow-sm bg-white" style="position: sticky; top: 0;">
    <div class="d-flex">
        <img src="./favicon.png" alt="image" style="width: 70px; height: 70px">
        <h5 class="navbar-brand" style="margin: auto; font-size: 30px;">Go To School</h5>
    </div>

    <div class="d-flex justify-content-start">
        <a href="/" class="btn btn-link btn-lg mr-2">Home</a>
        <a href="/upload" class="btn btn-link btn-lg mr-2">Upload</a>
    </div>
</div>

<form
    action="<?php print Route::route_address("/save_excel") ?>"
    method="post"
    enctype="multipart/form-data"
    class="container"
>
    <h2 class="display-2 mb-5">Map Excel File</h2>
    <?php Alert::displayAlert(); ?>
    <p class="mb-3" style="font-size: 25px">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, quam quos.
        Aspernatur blanditiis dolorum ea eius est excepturi fugiat harum illum ipsam minima nam nulla,
        omnis qui quia vel veniam.
    </p>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="excel_file">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>
    </div>
    <p style="font-size: 25px">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci, aliquid animi aspernatur,
        dolor dolorem est excepturi ipsam iure labore maxime odio placeat quasi quis repudiandae suscipit tenetur
        velit voluptate.
        <br>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci, aliquid animi aspernatur,
        dolor dolorem est excepturi ipsam iure labore maxime odio placeat quasi quis repudiandae suscipit tenetur
        velit voluptate.
    </p>
    <button type="submit" class="btn btn-lg btn-primary">Upload</button>
</form>
</body>
</html>