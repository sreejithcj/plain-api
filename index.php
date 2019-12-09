<?php

    require "application/bootstrap.php";
    require "application/cors.php";

    use Src\router\Api;

    /* Ask the API router to process the request and invoke the 
    right controller function */
    $api = (new Api())->process();
?>