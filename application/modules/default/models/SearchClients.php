<?php
class Default_Model_SearchClients extends Zend_Db_Table_Abstract {
	public function fetchSearchResults($date,$agent){
		$data = array();
		
		$sql = "select * from clients where ";
		
		$datatypes = $this->fetchAll();
		
		foreach ($datatypes as $datatype) {
			$data[$datatype->id]=$datatype->data_type_name;			
		}
		return $data;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}