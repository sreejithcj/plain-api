<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;
use Src\db\DBConnection;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

?>