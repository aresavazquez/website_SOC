<?php
class PDOResult{
	private $result;
	public function __construct( $result ){
		$this->result = $result;
	}
	public function get($values_to_encode = null){
		if($values_to_encode){
			$decoded = explode(',', $values_to_encode);
			foreach ($decoded as $decoded_value) {
				$result = $this->result;
				foreach ($result as $key => $value) {
	          		$value->$decoded_value = utf8_encode($value->$decoded_value);
	        	}
			}
		}
		return $this->result;
	}
	public function first($values_to_encode = null){
		if(isset($this->result[0])){
			if($values_to_encode){
				$decoded = explode(',', $values_to_encode);
				$result = $this->result[0];
				foreach ($decoded as $decoded_value) {
					$result->$decoded_value = utf8_encode($result->$decoded_value);
				}
			}
			return $this->result[0];
		}
		return false;
	}
	public function count(){
		return count($this->result);
	}
	public function average( $field ){
		$total = 0;
		foreach($this->result as $value){
			$total += $value->$field;
		}
		if($this->count() <= 0) return 0;
		return $total/$this->count();
	}
}