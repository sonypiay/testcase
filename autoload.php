<?php
error_reporting(E_ALL);

$fakultas_path = __DIR__ . '/fakultas';
$model_path = __DIR__ . '/model';
$controller_path = $fakultas_path . '/controller';

$base_path = basename( realpath( __DIR__ ) );

$base_url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $base_path;

require $model_path . '/Connection.php';
require $model_path . '/Fakultas.php';
