<?php
class Default_Model_Events extends Zend_Db_Table_Abstract {
	
	protected $_name = 'event_types';
	
	public function getAllEventsSelect(){
		$select = $this->getAdapter()->select()
    		->from($this->_name, array('id', 'event_name'))
    		;
    	return $this->getAdapter()->fetchPairs($select);
	}
	
	
	public function getEvent($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addEvent($eventName)
    {
        $data = array(
            'event_name' => $eventName,
            );
        $this->insert($data);
    }

    public function updateEvent($id, $eventName)
    {
        $data = array(
            'event_name' => $eventName,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteEvent($id)
    {
        $this->delete('id =' . (int)$id);
    }
}