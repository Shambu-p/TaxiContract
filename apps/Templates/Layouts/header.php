<html>
<head>
    <title>Driver Contract</title>
    <link rel="stylesheet" href="<?php use Absoft\Line\Core\HTTP\Route;

    print $main_path ?>/css/bootstrap.min.css">
    <link rel="icon" href="<?php print $main_path ?>/favicon.png">
</head>
<body>
<div class="d-flex pl-3 pr-3 pt-2 pb-2 justify-content-between mb-4 border-bottom shadow-sm bg-white" style="position: sticky; z-index: 1020; top: 0;">

    <div class="d-flex">
        <img src="<?php print $main_path ?>/favicon.png" alt="image" style="width: 70px; height: 70px">
        <h5 class="navbar-brand" style="margin: auto; font-size: 30px;">Go To School</h5>
    </div>

    <div class="d-flex justify-content-start">
        <a href="/" class="btn btn-link btn-lg mr-2">Home</a>
        <a href="/schedule_list" class="btn btn-link btn-lg mr-2">Schedules</a>
        <a href="/upload" class="btn btn-link btn-lg mr-2">Upload</a>
        <a href="<?php print Route::get_view("/free_drivers", []); ?>" class="btn btn-link btn-lg mr-2">Free Drivers</a>
    </div>

</div>