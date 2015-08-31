<?php 
include('lib/class_core.php');

$updtObj = new Core();

if(isset($_REQUEST)){
	$data = array(
		'book_name'	=>	$_REQUEST['book_name'],
		'author_name'=>	$_REQUEST['author'],
		'department'=>	$_REQUEST['dept'],
		'in_stock'	=>	$_REQUEST['stock']
	);
	
	$sql = $updtObj->update_row($updtObj->table_name, $_REQUEST['id'], $data);
	
	
	if($sql){
		$response = array(
			'R'	=>	1,
			'M'	=>	"Success! Details of book has been updated."
		);
	}else{
		$response = array(
			'R'	=>	0,
			'M'	=>	"Error! Unable to update a book"
		);
	}
	
	echo json_encode($response);
}
?>