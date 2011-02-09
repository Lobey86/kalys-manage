<?php
class Default_Model_City extends Zend_Db_Table_Abstract {
	
	protected $_name = 'city';
	

    public function getAllCitiesSelect()
    {
    	$select = $this->getAdapter()->select()
    		->from($this->_name, array('id', 'name'))
    		->order('name ASC')
    		;
    	return $this->getAdapter()->fetchPairs($select);
    }
    
    
    
    public function cityComplete($term)
    {
        $cities = $this->getAllCitiesSelect();
    	$results = '[';
    	foreach ($cities as $id=>$city){
    		if (stristr($city,$term)) {
    		$results .= '{ "id":"'.$id.'","label":"'.$city.'","value":"'.$city.'"},';
    		}
    	}
    	
    	$results .= ']';
    	
    	return $results;
    	
    }
    	
	public function getCity($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addCity($cityName)
    {
        $data = array(
            'name' => $cityName,
            );
        $this->insert($data);
    }

    public function updateCity($id, $cityName)
    {
        $data = array(
            'name' => $cityName,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteCity($id)
    {
        $this->delete('id =' . (int)$id);
    }
	
	
	
	
}