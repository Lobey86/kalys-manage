<?php
class Default_Model_Clients extends Zend_Db_Table_Abstract {
	
	protected $_name = 'clients';
	
	public function getClient($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addClient($businessName, $businessPhone, $businessFax, $businessAddress, $businessContact, $businessHours, $businessDays, $businessClosing, $businessCity, $businessIndustry, $businessZip, $businessActive, $businessAgent)
    {
        $data = array(
            'name' => $businessName,
            'phone' => $businessPhone,
        	'fax' => $businessFax,
        	'address' => $businessAddress,
        	'contact_name' => $businessContact,
        	'working_hours' => $businessHours,
        	'working_days' => $businessDays,
        	'closing_day' => $businessClosing,
        	'city' => $businessCity,
        	'industry' => $businessIndustry,
        	'zip_code' => $businessZip,
        	'active' => $businessActive,
        	'agent_id' => $businessAgent,
        );
        $this->insert($data);
    }

    public function updateClient($id, $businessName, $businessPhone, $businessFax, $businessAddress, $businessContact, $businessHours, $businessDays, $businessClosing, $businessCity, $businessIndustry, $businessZip, $businessActive, $businessAgent)
    {
        $data = array(
            'name' => $businessName,
            'phone' => $businessPhone,
        	'fax' => $businessFax,
        	'address' => $businessAddress,
        	'contact_name' => $businessContact,
        	'working_hours' => $businessHours,
        	'working_days' => $businessDays,
        	'closing_day' => $businessClosing,
        	'city' => $businessCity,
        	'industry' => $businessIndustry,
        	'zip_code' => $businessZip,
        	'active' => $businessActive,
        	'agent_id' => $businessAgent,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteClient($id)
    {
        $this->delete('id =' . (int)$id);
    }
    
	public function fetchSearchResults($date,$agent){
		 
		$sql = "SELECT
*
from clients left join events on clients.id=events.client_id
WHERE
month(events.time_start) = month('$date')
and
clients.agent_id = $agent";
		$stmt = $this->getAdapter()->query($sql);

		$data = $stmt->fetchAll();
		
		return $data;
	}	
	
	
	
}