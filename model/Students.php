<?php

namespace Model;

use Model\Connection;
use PDO;

class Students
{
  protected $table = 'T_Student';
  protected $connection;

  public function __construct()
  {
    $this->connection = new Connection;
  }

  public function getAllData( $request = [] )
  {
    $open = $this->connection::up();
		try {

			$stmt = $open->prepare($query);
      $stmt->execute();

			$result = $stmt->fetchAll( PDO::FETCH_OBJ );

			$this->connection::down();
			$result = implode(' ', $query);
      return $result;
		} catch (\Exception $e) {
			die( $e->getMessage() );
		}
  }

  public function store( $request )
  {
    $nama_lengkap = $request['nama_lengkap'];
    $nim 					= $request['nim'];
    $gender 			= $request['gender'];
    $tempat_lahir = $request['tempat_lahir'];
    $tanggal 			= $request['tanggal'];
    $bulan 				= $request['bulan'];
    $tahun 				= $request['tahun'];
    $publis 			= $request['publis'];
    $telepon			= $request['telepon'];
    $fakultas			= $request['fakultas'];

    $open = $this->connection::up();
    try {
      $stmt = $open->prepare('insert into ' . $this->table . '(fakultas_id,name,nim,gender,birth_place,dob,phone,publish,create_date) values(
        :fakultas,
        :name,
        :nim,
        :gender,
        :birth_place,
        :dob,
        :phone,
        :publish,
        :create_date
      )');
      $stmt->execute([
        'fakultas' => $fakultas,
        'name' => $nama_lengkap,
        'nim' => $nim,
        'gender' => $gender,
        'birth_place' => $tempat_lahir,
        'dob' => $tahun . '-' . $bulan . '-' . $tanggal,
        'phone' => $telepon,
        'publish' => $publis,
        'create_date' => date('Y-m-d H:i:s'),
      ]);
      echo '<div class="uk-alert-success" uk-alert>Data berhasil ditambah.</div>';

    } catch (\Exception $e) {
      die( $e->getMessage() );
    }
  }

  public function show( $id )
  {
    $open = $this->connection::up();
		try {
			$stmt = $open->prepare('select * from ' . $this->table . ' where id=' . $id);
			$stmt->execute();

			$result = $stmt->fetch( PDO::FETCH_OBJ );
			$this->connection::down();

			return $result;
		} catch (\Exception $e) {
			die( $e->getMessage() );
		}
  }

  public function update( $id, $request )
  {
    $nama_lengkap = $request['nama_lengkap'];
    $nim 					= $request['nim'];
    $gender 			= $request['gender'];
    $tempat_lahir = $request['tempat_lahir'];
    $tanggal 			= $request['tanggal'];
    $bulan 				= $request['bulan'];
    $tahun 				= $request['tahun'];
    $publis 			= $request['publis'];
    $telepon			= $request['telepon'];
    $fakultas			= $request['fakultas'];

    $open = $this->connection::up();
    try {
      $stmt = $open->prepare('update ' . $this->table . ' set
      fakultas_id = :fakultas,
      name = :name,
      nim = :nim,
      gender = :gender,
      birth_place = :birth_place,
      dob = :dob,
      phone = :phone,
      publish = :publish
      where id = :id');
      $stmt->execute([
        'fakultas' => $fakultas,
        'name' => $nama_lengkap,
        'nim' => $nim,
        'gender' => $gender,
        'birth_place' => $tempat_lahir,
        'dob' => $tahun . '-' . $bulan . '-' . $tanggal,
        'phone' => $telepon,
        'publish' => $publis,
        'id' => $id,
      ]);
      echo '<div class="uk-alert-success" uk-alert>Data berhasil disimpan.</div>';

    } catch (\Exception $e) {
      die( $e->getMessage() );
    }
  }

  public function destroy( $id )
  {

  }
}
