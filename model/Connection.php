<?php

namespace Model;

use PDO;

class Connection
{

	// Include database connection settings
	const USERNAME = "root";
	const PASSWORD = "";
	const HOSTNAME = "localhost";
	const DATABASE = "eannovate";
	const PORT			= 3306;

	protected static $connection;

	public static function up()
	{
		try {
			Connection::$connection = new PDO('mysql:host=' . Connection::HOSTNAME . ';dbname=' . Connection::DATABASE . ';port=' . Connection::PORT
			, Connection::USERNAME
			, Connection::PASSWORD
			);
			Connection::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return Connection::$connection;
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public static function down()
	{
		Connection::$connection = null;
	}
}
?>
