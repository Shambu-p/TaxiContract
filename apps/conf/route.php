<?php

use Absoft\Line\Core\HTTP\Route;
use Application\Controllers\ExcelMapperController;
use Application\Controllers\ScheduleController;

// use Application\Controllers\UsersController;


// Route::post(
//     "/api/create_cashier",
//     [new UsersController(), 'createCashier'],
//     [
//         "token" => ["required"],
//         "username" => ["required"],
//         "email" => ["required"],
//         "password" => ["required"],
//         "branch_id" => ["required"]
//     ]
// );

Route::post(
    "/save_excel",
    [new ExcelMapperController(), "save"]
);

//Route::get(
//    "/driver_detail",
//    "/DriverDetail"
//);

Route::get(
    "/free_drivers",
    [new ScheduleController(), "freeDrivers"],
    [
        "day" => []
    ]
);

Route::get(
    "/view_driver_schedule",
    [new ScheduleController(), "driverScheduleDetail"],
    [
        "driver_id" => ["required"]
    ]
);

Route::get(
    "/day_driver_schedules",
    [new ScheduleController(), "driverSchedules"],
    [
        "driver_id" => ["required"],
        "day" => ["required"]
    ]
);

Route::get(
    "/schedule_list",
    [new ScheduleController(), "show"],
    [
        "day" => []
    ]
);

Route::get(
    "/view_schedule",
    [new ScheduleController(), "view"],
    [
        "id" => ["required"]
    ]
);

Route::post(
    "/import",
    [new ExcelMapperController(), "import"],
    [
        "pick_up" => ["required"],
        "drop_off" => ["required"],
        "start_date" => ["required"],
        "end_date" => ["required"],
        "driver_id" => ["required"],
        "client" => ["required"],
        "route" => ["required"],
        "days" => ["required"],
        "students" => ["required"],
        "file_name" => ["required"]
    ]
);


//route doesn't work yet
Route::get("/map", "/ExcelMapping/map_file");
Route::get("/about_us", "/about_us");
Route::get("/upload", "/ExcelMapping/upload_file");
Route::get("/", "/home");

Route::get("/404", "/not_found");
//Route::get("/api/404", function ($request) {
//    $response = new JSONResponse();
//    $response->prepareError("route not found");
//    return $response;
//});