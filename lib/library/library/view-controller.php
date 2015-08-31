<?php 
include('lib/class_core.php');

$getObj = new Core();

	$result = $getObj->get_results("SELECT * FROM ".$getObj->table_name."");
	
	if($result){
		echo json_encode($result);
	}else{
		echo "Error!";
	}

?>