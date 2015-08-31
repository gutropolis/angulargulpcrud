<?php 
include('lib/class_core.php');

if(isset($_REQUEST)){
	
	$object = new Core();
	
	$data = array(
		'book_name'		=>		$_REQUEST['book_name'],
		'author_name'	=>		$_REQUEST['author_name'],
		'department'	=>		$_REQUEST['department_name'],
		'in_stock'		=>		$_REQUEST['in_stock']
	);
	
	$result = $object->insert($data, $object->table_name);
	
	if(intval($result)){
		$response = array(
			'R'	=>	1,
			'M'	=>	'Succeess! Book has been added.'
		);
	}else{
		$response = array(
			'R'	=>	0,
			'M'	=>	'Error! Unable to add new book please try again!'
		);
	}
	echo json_encode($response);
}
?>