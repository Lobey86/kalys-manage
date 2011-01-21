<?php
class Default_Model_Agents extends Zend_Db_Table_Abstract {
	
	protected $_name = 'agents';

	public function getAllAgentsSelect()
	{
		$select = $this->getAdapter()->select()
    		->from($this->_name, array('id', 'name'))
    		;
    	return $this->getAdapter()->fetchPairs($select);
	}
	
	public function getAgent($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addAgent($agentName, $agentActive, $agentDefault)
    {
        $data = array(
            'name' => $agentName,
        	'active' => $agentActive,
        	'default' => $agentDefault,
        );
        $this->insert($data);
    }

    public function updateAgent($id, $agentName, $agentActive, $agentDefault)
    {
        $data = array(
            'name' => $agentName,
            'active' => $agentActive,
        	'default' => $agentDefault,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteAgent($id)
    {
        $this->delete('id =' . (int)$id);
    }
	
		
	
	
	
	
}