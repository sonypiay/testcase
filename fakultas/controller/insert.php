<?php

$method = $_SERVER['REQUEST_METHOD'];

if( $method === 'POST' )
{
	$fakultasClass = new Model\Fakultas;
	$errors = [];

	if( isset( $_REQUEST['nama_fakultas'] ) && empty( $_REQUEST['nama_fakultas'] ) )
	{
		array_push( $errors, 'Nama fakultas harap diisi');
	}
	if( isset( $_REQUEST['keterangan'] ) && empty( $_REQUEST['keterangan'] ) )
	{
		array_push( $errors, 'Keterangan harap diisi');
	}

	if( count( $errors ) === 0 ) $fakultasClass->store( $_REQUEST );

}
