<?php
class PDODB{
	private $DBH;
	private $table;
	public function __construct($table){
		try{
			$this->DBH = new PDO("mysql:host=".Config::get('DB_HOST').";dbname=".Config::get('DB_NAME'), Config::get('DB_USER'), Config::get('DB_PASS'));
		}catch(Exception $e){
			echo $e->getMessage();
		}
		$this->table = $table;
	}
	public function _relationship( $q ){
		$STH = $this->DBH->exec( $q );
	}
	public function _query( $q ){
		$result = array();
		$STH = $this->DBH->query( $q );
		$STH->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $STH->fetch() ){
			$result[] = $row;
		}
		return new PDOResult( $result );
	}
	public function _insert( $data ){
		$fields = array();
		foreach($data as $key=>$value){
			$fields[] = $key;
		}
		$fieldsstr = implode( ', ', $fields );
		$fieldsval = ':' . implode( ', :', $fields );
		//echo "INSERT INTO " . $this->table . " ( $fieldsstr, created_at ) value ( $fieldsval, NOW() )";
		$STH = $this->DBH->prepare("INSERT INTO " . $this->table . " ( $fieldsstr, created_at ) value ( $fieldsval, NOW() )");
		$STH->execute( $data );
		return $this->DBH->lastInsertId();
	}
	public function _all( $fields ){
		$result = array();
		$STH = $this->DBH->query("SELECT $fields FROM " . $this->table);
		$STH->setFetchMode(PDO::FETCH_OBJ);
		while( $row = $STH->fetch() ){
			$result[] = $row;
		}
		return new PDOResult( $result );
	}
	public function _where( $fields, $condition ){
		$result = array();
		$STH = $this->DBH->query("SELECT $fields FROM " . $this->table . " WHERE $condition");
		//echo "SELECT $fields FROM " . $this->table . " WHERE $condition";
		if($STH){
			$STH->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $STH->fetch() ){
				$result[] = $row;
			}
			return new PDOResult( $result );
		}else{
			return new PDOResult( NULL );
		}
	}
	public function _where_in_join( $joins, $fields, $condition ){
		$result = array();
		$query = "SELECT $fields FROM " . $this->table;
		foreach ($joins as $join) {
			switch($join['join']){
				case 'L':
					$query .= " LEFT JOIN ";
					break;
				case 'R':
					$query .= " RIGHT JOIN ";
					break;
			}
			$query .= $join['table'] . " ON ";
			$query .= $join['relation'];
		}
		$query .= " WHERE $condition";
		//echo $query."<br /><br />";
		$STH = $this->DBH->query($query);
		if($STH){
			$STH->setFetchMode(PDO::FETCH_OBJ);
			while( $row = $STH->fetch() ){
				$result[] = $row;
			}
			return new PDOResult( $result );
		}else{
			return new PDOResult( NULL );
		}
	}
	public function _delete( $condition ){
		$this->DBH->exec("DELETE FROM " . $this->table . " WHERE $condition");
		return true;  
	}
	public function _update( $data, $condition ){
		$fields = array();
		foreach($data as $key=>$value){
			$fields[] = $key . '=:' . $key;
		}
		$fieldsstr = implode( ', ', $fields );
		//echo "UPDATE " . $this->table . " SET $fieldsstr WHERE $condition";
		$STH = $this->DBH->prepare("UPDATE " . $this->table . " SET $fieldsstr WHERE $condition");
		$STH->execute( $data );
		return $STH->rowCount();	
	}
}