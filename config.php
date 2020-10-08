<?php

    session_start();
    
    $dbhost = "localhost";
    $dbname = "image_app";
    $dbpass = "nahojs2630!";
    $dbuser = "winjohan";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) 
    {
        die("Could not connect to the database" . mysqli_connect_error());
    }

    define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://localhost/phpsandbox/php-con-to-pro/image_app/');