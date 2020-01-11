<?php

$method = $_SERVER['REQUEST_METHOD'];

if( $method === 'POST' )
{
	if( ! isset( $studentClass ) ) $studentClass = new Model\Students;
	$errors = [];

  $nama_lengkap = isset( $_REQUEST['nama_lengkap'] ) ? $_REQUEST['nama_lengkap'] : '';
  $nim 					= isset( $_REQUEST['nim'] ) ? $_REQUEST['nim'] : '';
  $gender 			= isset( $_REQUEST['gender'] ) ? $_REQUEST['gender'] : '';
  $tempat_lahir = isset( $_REQUEST['tempat_lahir'] ) ? $_REQUEST['tempat_lahir'] : '';
  $tanggal 			= isset( $_REQUEST['tanggal'] ) ? $_REQUEST['tanggal'] : '';
  $bulan 				= isset( $_REQUEST['bulan'] ) ? $_REQUEST['bulan'] : '';
  $tahun 				= isset( $_REQUEST['tahun'] ) ? $_REQUEST['tahun'] : '';
  $publis 			= isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : '';
  $telepon			= isset( $_REQUEST['telepon'] ) ? $_REQUEST['telepon'] : '';
  $fakultas			= isset( $_REQUEST['fakultas'] ) ? $_REQUEST['fakultas'] : '';

  if( empty( $fakultas ) )
  {
    array_push( $errors, 'Harap pilih fakultas' );
  }
	if( empty( $nama_lengkap ) )
	{
		array_push( $errors, 'Nama lengkap harap diisi');
	}
	if( empty( $nim ) )
	{
		array_push( $errors, 'NIM harap diisi');
	}
  if( empty( $telepon ) )
  {
    array_push( $errors, 'No. Telepon harap diisi');
  }
  if( empty( $tempat_lahir ) )
  {
    array_push( $errors, 'Tempat lahir harap diisi');
  }
  if( empty( $tanggal ) && empty( $bulan ) && empty( $tahun ) )
  {
    array_push( $errors, 'Tanggal lahir harap diisi');
  }
  if( ( ! is_numeric( $tanggal ) && ! empty( $tanggal ) ) || ( ! is_numeric( $bulan ) && ! empty( $bulan ) ) || ( ! is_numeric( $tahun ) && ! empty( $tahun ) ) )
  {
	array_push( $errors, 'Masukkan format tanggal lahir dengan benar.');  
  }
  if( ! is_numeric( $nim ) && ! empty( $nim ) )
  {
	array_push( $errors, 'Masukkan format nim dengan benar.');    
  }

	if( count( $errors ) === 0 ) $studentClass->store( $_REQUEST );

}
