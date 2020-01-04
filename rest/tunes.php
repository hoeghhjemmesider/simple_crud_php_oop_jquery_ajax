<?php
require_once "../conn.php";
require_once "../controller/tunes.php";

$mode = $_REQUEST['mode'];

$objTune = new Tunes();

if($mode=="insert"){
	$tuneTitle = $_REQUEST['tuneTitle'];
	$tuneComposer = $_REQUEST['tuneComposer'];
	$category = $_REQUEST['category'];

	$sourcePath = $_FILES['tuneImg']['tmp_name'];
	$fileName = $_FILES['tuneImg']['name'];
	
	if(empty($sourcePath)){
		$fileName = "default.jpg";
	}else{
		$targetPath = "../images/".$fileName; 
		move_uploaded_file($sourcePath,$targetPath) ; 
	} 

	$objTune->save($tuneTitle, $tuneComposer, $category, $fileName);
}else if($mode=="load"){
	$i=1;
	$result = "";
	$tunes = $objTune->getAll();
	while($row = $tunes->fetch_assoc()){ 
	$result.="<tr>";
		$result.="<td>".$i++."</td>";
		$result.="<td>".$row["TuneTitle"]."</td>";
		$result.="<td>".$row["CategoryName"]."</td>";
		$result.="<td>".$row["TuneComposer"]."</td>";
		$result.="<td><img src='images/".$row["TuneImg"]."'></td>";
		$result.="<td><a class='edit' href='#' data-id='".$row["TuneID"]."'>Edit</a> | <a class='delete' href='#' data-id='".$row["TuneID"]."'>Delete</a></td>";
	$result.="</tr>";
	};
	echo $result;
}else if($mode=="loadOne"){
	$id = $_REQUEST['id'];
	$result = $objTune->getOne($id)->fetch_assoc();
	echo json_encode($result);
}else if($mode=="update"){
	$tuneTitle = $_REQUEST['tuneTitle'];
	$tuneComposer = $_REQUEST['tuneComposer'];
	$category = $_REQUEST['category'];
	$id = $_REQUEST['id'];

	$sourcePath = $_FILES['tuneImg']['tmp_name'];
	$fileName = $_FILES['tuneImg']['name'];

	if(empty($sourcePath)){
		$fileName = "default.jpg";
	}else{
		$targetPath = "../images/".$fileName; 
		move_uploaded_file($sourcePath,$targetPath) ; 
	}

	$objTune->update($id, $tuneTitle, $tuneComposer, $category, $fileName);
}else if($mode=="delete"){
	$id = $_REQUEST['id'];
	$objTune->delete($id);
}
?>