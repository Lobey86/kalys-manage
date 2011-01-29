<?php
class Default_Model_SearchClients extends Zend_Db_Table_Select {
	
	protected $_name = 'clients';
	
	public function fetchSearchResults($date,$agent){
		$data = array();
		
		$sql = "SELECT
*
from clients left join events on clients.id=events.client_id
WHERE
month(events.time_start) = month(".$date.")
and
clients.agent_id = ".$agent."";
		//print $sql;
		//return $sql;
		$data = $this->fetchAll($sql);
		
		return $data;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}