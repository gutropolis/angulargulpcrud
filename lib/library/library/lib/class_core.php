<?php 
	class Core
	{
		public $hostname = 'localhost';
		public $username = 'root';
		public $password = '';
		public $db_name  = 'demo_test_db';
		public $table_name='library_db';
		public $con = '';
		public $query_id = '';
		
		function __construct(){
			$this->db_connect();
		}
		
		public function db_connect(){
			$this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->db_name);
			mysqli_select_db($this->con, $this->db_name);
		}
		
		public function insert($data, $table_name){
			
			$q = "INSERT into ".$table_name." ";
			$v = '';
			$k = '';
			
			foreach($data as $key => $val):
				$k .= "$key, ";
				$v .= "'".$this->escape($val)."',";
			endforeach;
			$q .= "(" . rtrim($k, ', ') . ") VALUES (" . rtrim($v, ', ') . ");";
			
			if($this->query($q)){
				return $this->insertid();
			}else{
				return false;
			}
		}
		
		public function escape($string){
			return mysqli_real_escape_string($this->con, $string);
		}
		
		public function insertid(){
			return mysqli_insert_id($this->con);
		}
		
		public function query($sql){
			$this->query_id = mysqli_query($this->con, $sql);
			if($this->query_id){
				return $this->query_id;
			}else{
				return false;
			}
		}
		
		public function get_results($query){
			
			$result = $this->query($query);
			$out = $this->fetch_all($result);
			return $out;
		}
		
		public function fetch_all($sql){
			while($row = $this->fetch($sql)):
			$rows[] = $row;
			endwhile;
			return $rows;
		}
		
		public function fetch($sql){
			$record = mysqli_fetch_array($sql, MYSQL_ASSOC);
			return $record;
		}
		
		public function delete_row($table_name, $id){
			$q = "DELETE FROM ".$table_name." WHERE book_id='$id'";
			
			$result = $this->query($q);
			
			if($result){
				return $result;
			}else{
				return false;
			}
		}
		
		public function update_row($table_name, $id, $data){
			$q = "UPDATE ".$table_name." SET ";
			$k = '';
			$v = '';
			
			foreach($data as $key => $val):
				$k .= "$key, ";
				$v = "'".$this->escape($val)."', ";
				
				$q	.=	"$key = $v";
				
			endforeach;
			$q = rtrim($q, ', ') . " WHERE book_id = '$id' ";
			
			$update_result = $this->query($q);
			
				if($update_result){
					return $update_result;
				}else{
					return false;
				}
			
		}
	}
?>