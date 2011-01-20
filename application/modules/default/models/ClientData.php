<?php
class Default_Model_ClientData extends Zend_Db_Table_Abstract {
	
	protected $_name = 'client_data';
	
	public function getClientData($id)
    {
        $id = (int)$id;
        
        $select = $this->getAdapter()->select()
    		->from($this->_name, array('data_value','id'))
    		->joinLeft('client_data_types','client_data.data_type_id = client_data_types.id', array('data_type_name'))
    		->where($this->_name . '.client_id = ?', $id);
    	
        return $this->getAdapter()->fetchAll($select);
    }
    
    public function getDataItem($id)
    {
    	$select = $this->getAdapter()->select()
    		->from($this->_name,array('data_value','id'))
    		->joinLeft('client_data_types','client_data.data_type_id = client_data_types.id', array('data_type_name'))
    		->where($this->_name . '.id = ?',$id);
    	return $this->getAdapter()->fetchRow($select);
    	
    	
    }

    public function addData($dataClientId, $dataType, $dataValue)
    {
        $data = array(
            'client_id' => $dataClientId,
            'data_type_id' => $dataType,
            'data_value' => $dataValue,
            );
        $this->insert($data);
    }

    public function updateData($id, $dataClientId, $dataType, $dataValue)
    {
        $data = array(
            'client_id' => $dataClientId,
            'data_type_id' => $dataType,
            'data_value' => $dataValue,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteData($id)
    {
        $this->delete('id =' . (int)$id);
    }
}