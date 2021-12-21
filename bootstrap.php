<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('API_URL',$_ENV['API_URL']);
define('API_KEY',$_ENV['API_KEY']);
define('PBX_NAME',$_ENV['PBX_NAME']);
define('WS_URL',$_ENV['WS_URL']);


