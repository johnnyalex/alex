<?php 
	class Model{
		private static $obj = null;
		private static $dbname;
		private static $table;
		private static $pdo;
		private static $pk;
		private static $keys;
		private function __construct($dbname,$table){
			self::$dbname = $dbname;
			self::$table = $table;
			self::$pdo = new PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8;port=3306','root','333'); 
			self::desc($table);
		}
		private static function desc($table){
			$stmt = self::$pdo->query("DESC ".$table);
			$res = $stmt->fetchALL(PDO::FETCH_ASSOC);
			foreach($res as $key=>$value){
				if($value['Key'] == 'PRI')
					self::$pk = $value['Field'];
				self::$keys[] = $value['Field'];
			}
		}
		public static function mysql($dbname,$table){
			if(self::$obj == null)
				self::$obj = new Model($dbname,$table);
			return self::$obj;
		}
		public static function select($select,$where = ''){
			$stmt = self::$pdo->query("SELECT ".$select." FROM ".self::$table.' '.$where);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public static function insert($arr){
			foreach($arr as $key=>$value){
				if(!in_array($key,self::$keys))
					die($key.' is wrong');
			}
			$key = implode(array_keys($arr),',');
			$value = "'".implode(array_values($arr),"','")."'";
			$stmt = self::$pdo->query("INSERT INTO ".self::$table." (".$key.") VALUES(".$value.")");
			return self::$pdo->lastInsertId();
		}
		public static function update($arr){
			$str = '';
			if(!in_array(self::$pk,array_keys($arr)))
				die (self::$pk.' is missed');
			foreach($arr as $key=>$value){
				if(!in_array($key,self::$keys))
					die($key.' is wrong');
				if($key == self::$pk){
					$id = $value;
					continue;
				}
				$str .= $key.'='."'".$value."',";
			}
			$str = rtrim($str,',');
			return self::$pdo->exec("UPDATE ".self::$table." SET ".$str." WHERE ".self::$pk."=".$id);
		}
		public static function delete($id){
			return self::$pdo->exec("DELETE FROM ".self::$table." WHERE ".self::$pk.$id);
		}	
	}
	// Model::mysql('alex','users');
	// $stmt = Model::select('*','WHERE id>1 ORDER BY id DESC LIMIT 0,8');
	// $arr = array('name'=>'alex','age'=>'24','sex'=>'1','province'=>'shanghai');
	// $stmt = Model::insert($arr);
	// $arr = array('name'=>'alex','age'=>'24','sex'=>'1','id'=>'133');
	// echo Model::update($arr);
	// echo Model::delete('>133');
 ?>