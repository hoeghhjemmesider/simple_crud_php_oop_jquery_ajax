<?php
class conn{
	private $server = "localhost";
	private $username = "root";
	private $pass = "";
	private $db = "crud_ajax";
	private $conn = null;

	public function __construct(){
		$this->conn = new mysqli($this->server, $this->username, $this->pass, $this->db);
	}

	public function getConnection(){
		return $this->conn;
	}
}
?>