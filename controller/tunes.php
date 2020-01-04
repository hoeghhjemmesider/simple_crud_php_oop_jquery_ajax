<?php
class Tunes{
	private $conn;
	private $table;

	public function __construct(){
		$db = new conn();
		$this->conn = $db->getConnection();
		$this->table = "tunes";
	}
	public function getAll(){
		return $this->conn->query("SELECT * from $this->table JOIN category on $this->table.CategoryID=category.CategoryID");
	}
	
	public function save($name, $desk, $kategori, $tuneImg){
		echo $name;
		$this->conn->query("INSERT into $this->table( TuneTitle, TuneComposer, CategoryID, TuneImg) VALUES('$name', '$desk', '$kategori', '$tuneImg')");
		echo "sukses";
	}

	public function getOne($id){
		return $this->conn->query("SELECT * from $this->table JOIN category on $this->table.CategoryID=category.CategoryID WHERE $this->table.TuneID='$id'");
	}
	
	public function update($id, $name, $desk, $kategori, $tuneImg){
		$this->conn->query("UPDATE $this->table SET TuneTitle='$name', TuneComposer='$desk', CategoryID='$kategori', TuneImg='$tuneImg' WHERE TuneID='$id'");
	}

	public function delete($id){
		$this->conn->query("DELETE from $this->table WHERE TuneID = '$id'");
	}
}
?>