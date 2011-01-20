<?php
class Default_Model_ClientEvents extends Zend_Db_Table_Abstract {
	
	protected $_name = 'events';
	
	public function getClientEvents($id)
    {
        $id = (int)$id;
        
        $select = $this->getAdapter()->select()
    		->from($this->_name, array('id','time_start','time_end'))
    		->joinLeft('event_types','events.type = event_types.id', array('event_name'))
    		->where($this->_name . '.client_id = ?', $id);
    	
        return $this->getAdapter()->fetchAll($select);
    }
    
    public function getEventItem($id)
    {
    	$select = $this->getAdapter()->select()
    		->from($this->_name,array('data_value','id'))
    		->joinLeft('client_data_types','client_data.data_type_id = client_data_types.id', array('data_type_name'))
    		->where($this->_name . '.id = ?',$id);
    	return $this->getAdapter()->fetchRow($select);
    	
    	
    }

    public function addEvent($eventClientId, $eventType, $timeStart,$timeEnd)
    {
        $data = array(
            'client_id' => $eventClientId,
            'type' => $eventType,
            'time_start' => $timeStart,
            'time_end' => $timeEnd,
            );
        $this->insert($data);
    }

    public function updateEvent($id, $dataClientId, $dataType, $dataValue)
    {
        $data = array(
            'client_id' => $dataClientId,
            'data_type_id' => $dataType,
            'data_value' => $dataValue,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteEvent($id)
    {
        $this->delete('id =' . (int)$id);
    }
}