<?php 
	header('Content-type:text/html;charset=utf-8');
	class Model{
		private $tablename;
		private $link;
		private $pk = '';
		private $fields = array();
		public function __construct($tablename){
			$this->tablename = $tablename;
			$this->link = @mysqli_connect('localhost','root','333') or die('link failed');
			mysqli_select_db($this->link,'alex') or die('database failed');
			mysqli_set_charset($this->link,'utf8') or die('set charset failed');
			$this->getAllFiles();
		}
		private function getAllFiles(){
			$pk = '';
			$fields = array();
			$sql = "DESC ".$this->tablename;
			$result = mysqli_query($this->link,$sql);
			if($result){
				$list = array();
				while($row = mysqli_fetch_assoc($result)){
					if($row['Key'] == 'PRI')
						$pk = $row['Field'];
					$fields[] = $row['Field'];
				}
			}
			$this->pk = $pk;
			$this->fields = $fields;
		}
		public function add($arr){
			foreach($arr as $key=>$val){
				if(!in_array($key,$this->fields))
					die($key.' is wrong');
			}
			$keys = array_keys($arr);
			$values = array_values($arr);
			$keys_sql = implode(',',$keys);
			$values_sql = implode('","',$values);
			$values_sql = '"'.$values_sql.'"';
			$sql = "INSERT INTO ".$this->tablename."(".$keys_sql.") VALUES(".$values_sql.")";
			$result = mysqli_query($this->link,$sql);
			if($result){
				return mysqli_insert_id($this->link);
			}else{
				return false;
			}
		}
		public function del($id){
			$sql = "DELETE FROM ".$this->tablename." WHERE ".$this->pk."=".$id;
			$result = mysqli_query($this->link,$sql);
			if($result){
				return mysqli_affected_rows($this->link);
			}else{
				return false;
			}
		}
		public function save($arr){
			$keys = array_keys($arr);
			if(!in_array($this->pk,$keys))
				die('pk is wrong');
			$id = '';
			$values = array();
			foreach($arr as $key=>$value){
				if(!in_array($key,$this->fields))
					die($key.' is wrong');
				if($key == $this->pk){
					$id = $value;
				}else{
					$values[] = $key."='".$value."'";
				}
			}
			$values = implode(',',$values);
			$sql = "UPDATE ".$this->tablename." SET ".$values." WHERE ".$this->pk."=".$id;
			$result = mysqli_query($this->link,$sql);
			if($result){
				$ax = mysqli_affected_rows($this->link);
				if($ax == 0){
					return 'nothing changed';
				}else{
					return $ax;
				}
			}else{
				return false;
			}
		}
		public function find($id){
			$sql = "SELECT * FROM {$this->tablename} WHERE id={$id}";
			$result = mysqli_query($this->link,$sql);
			if($result){
				return mysqli_fetch_assoc($result);
			}else{
				return false;
			}
		}
		public function select(){
			$sql = "SELECT * FROM {$this->tablename}";
			$result = mysqli_query($this->link,$sql);
			if($result){
				$list = array();
				while($row = mysqli_fetch_assoc($result)){
					$list[] = $row;
				}
				return $list;
			}else{
				return false;
			}
		}
		public function __destruct(){
			mysqli_close($this->link);
		}
	}
 ?>