<?php

require dirname( dirname( __DIR__ ) ) . '/autoload.php';

$fakultasClass = new Model\Fakultas;

$fakultasClass->destroy( $_REQUEST['id'] );
