<?php
class Mysql extends mysqli {
	private $db_connection = True;

	public function __construct($host, $username, $password, $dbname, $port=3306) {
		parent::__construct($host, $username, $password, $dbname, $port);

		if (mysqli_connect_error()) {
			die('Connection error: '. mysqli_connect_errno() .' - '. mysqli_connect_error());
		}
	}

	public function select($dbConnection, $tableName, $where, $values="*") {
		$select_query = "SELECT $values FROM $tableName WHERE $where";
		$res = $dbConnection->query($select_query);
		if (!$res)
			return $dbConnection->errno .' - '. $dbConnection->error;
		else
			return $res;
	}

	public function insert($dbConnection, $tableName, $columnNames, $values) {
		$insert_query = "INSERT INTO $tableName $columnNames VALUES $values";
		if (!$dbConnection->query($insert_query))
			return $dbConnection->errno .' - '. $dbConnection->error;
		return $dbConnection->insert_id;
	}

	public function update($dbConnection, $tableName, $values, $where) {
		$update_query = "UPDATE $tableName SET $values WHERE $where";
		if (!$dbConnection->query($update_query))
			return $dbConnection->errno .' - '. $dbConnection->error;
		return $dbConnection->affected_rows;
	}

	public function delete($dbConnection, $tableName, $values) {
		$delete_query = "DELETE FROM $tableName WHERE $values";
		if (!$dbConnection->query($delete_query))
			return $dbConnection->errno .' - '. $dbConnection->error;
		return true;
	}
}
?>