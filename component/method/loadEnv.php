<?php
/* Loading  Configure*/

$root = file_exists($_SERVER['DOCUMENT_ROOT'].'/portal') ? $_SERVER['DOCUMENT_ROOT'].'/portal': $_SERVER['DOCUMENT_ROOT'];
    //  本番と開発を切り分け
require_once $root.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($root);
$dotenv->load();

date_default_timezone_set('Asia/Tokyo');
