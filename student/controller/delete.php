<?php

require dirname( dirname( __DIR__ ) ) . '/autoload.php';

$studentClass = new Model\Students;

$studentClass->destroy( $_REQUEST['id'] );
