
<?php
use Absoft\Line\Core\HTTP\Route;
//print_r($_SERVER);
?>
<html>
<head>
    <title>Route Not Found</title>
    <link rel="stylesheet" href="<?php print "$main_path/css/bootstrap.min.css"; ?>">
    <style>
        .central_container{
            width: max-content;
            height: auto;
            position: relative;
            top: 50%;
            left: 50%;
            transform: translateY(-50%) translateX(-50%);
        }
        body{
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="text-center central_container">
        <h1 class="text-center display-1"> OOps! </h1>
        <p>Route Not Found</p>
        <a href="<?php print Route::get_view("/"); ?>"> Back to Home </a>
    </div>
</body>
</html>