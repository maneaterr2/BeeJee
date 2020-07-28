<?php

namespace BeeJee\config;


class DB_Connect{

	const USER = "topoil_user";
	const PASS = 'topoil_pass';
	const HOST = "localhost";
	const DB   = "bee_jee";

	public static function connToDB() {

		$user = self::USER;
		$pass = self::PASS;
		$host = self::HOST;
		$db   = self::DB;

		$conn = new \PDO("mysql:dbname=$db;host=$host", $user, $pass);
		return $conn;

    }
}
?>