<?php 
include('lib/class_core.php');

$dltObj = new Core();

if(isset($_REQUEST)){
	$id = $_REQUEST['id'];
	if(intval($id)){
		//$sql = "DELETE * FROM ".$dltObj->table_name." WHERE id=".$id."";
		$sql = $dltObj->delete_row($dltObj->table_name, $id);
		
		if($sql){
			$response = array(
				'R'	=>	1,
				'M'	=>	"Book has been deleted successfully!"
			);
		}else{
			$response = array(
				'R'	=>	0,
				'M'	=>	"Unable to delete the book sorry!"
			);
		}
		echo json_encode($response);
	}
}
?>