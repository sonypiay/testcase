<?php

namespace Model;

use Model\Connection;
use PDO;

class Fakultas {

	protected $table = 'T_Fakultas';
	protected $connection;

	public function __construct()
	{
		$this->connection = new Connection;
	}

	public function getAllData( $query )
	{
		$open = $this->connection::up();
		try {
			$stmt = $open->prepare($query);
			$stmt->execute();

			$result = $stmt->fetchAll( PDO::FETCH_OBJ );

			$this->connection::down();
			return $result;

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

	public function store( $request )
	{
		$nama_fakultas = isset( $_REQUEST['nama_fakultas'] ) ? $_REQUEST['nama_fakultas'] : '';
		$keterangan = isset( $_REQUEST['keterangan'] ) ? $_REQUEST['keterangan'] : '';
		$publis = isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : '';
		$currentDate = date('Y-m-d H:i:s');

		try {
			$open = $this->connection::up();
			$stmt = $open->prepare('insert into ' . $this->table . ' (title, description, publish, create_date) value ( :nama, :keterangan, :publis, :created_at )');
			$stmt->execute([
				'nama' => $nama_fakultas,
				'keterangan' => $keterangan,
				'publis' => $publis,
				'created_at' => $currentDate,
			]);
			echo '<div class="uk-alert-success" uk-alert>Data berhasil ditambah.</div>';
		} catch (\Exception $e) {
			die( $e->getMessage() );
		}
	}

	public function update( $id, $request )
	{
		$nama_fakultas = isset( $_REQUEST['nama_fakultas'] ) ? $_REQUEST['nama_fakultas'] : '';
		$keterangan = isset( $_REQUEST['keterangan'] ) ? $_REQUEST['keterangan'] : '';
		$publis = isset( $_REQUEST['publis'] ) ? $_REQUEST['publis'] : '';
		$currentDate = date('Y-m-d H:i:s');

		try {
			$open = $this->connection::up();
			$stmt = $open->prepare('update ' . $this->table . ' set title=:nama, description=:keterangan, publish=:publis where id=:id');
			$stmt->execute([
				'nama' => $nama_fakultas,
				'keterangan' => $keterangan,
				'publis' => $publis,
				'id' => $id,
			]);
			echo '<div class="uk-alert-success" uk-alert>Data berhasil disimpan.</div>';
		} catch (\Exception $e) {
			die( $e->getMessage() );
		}
	}

	public function destroy( $id )
	{
		global $base_url;
		try {
			$open = $this->connection::up();
			$checkStmt = $open->prepare('select id from ' . $this->table . ' where id = ' . $id);
			$checkStmt->execute();
			if( $checkStmt->rowCount() == 0 )
			{
				die('Data tidak ditemukan');
			}
			else
			{
				try {
					$deleteStmt = $open->prepare('delete from ' . $this->table . ' where id=' . $id);
					$deleteStmt->execute();
				} catch (\Exception $e) {
					die( $e->getMessage() );
				}
			}
			$this->connection::down();
			header('location: ' . $base_url . '/fakultas/?delete=success');
		} catch (\Exception $e) {
			die( $e->getMessage() );
		}
	}
}
?>
