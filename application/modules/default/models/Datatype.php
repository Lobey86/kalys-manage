<?php
class Default_Model_Datatype extends Zend_Db_Table_Abstract {
	
	protected $_name = 'client_data_types';
	
	public function getAllDataTypesSelect(){
		$data = array();
		$datatypes = $this->fetchAll();
		foreach ($datatypes as $datatype) {
			$data[$datatype->id]=$datatype->data_type_name;			
		}
		return $data;
	}
	
	
	public function getDatatype($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addDatatype($datatypeName)
    {
        $data = array(
            'data_type_name' => $datatypeName,
            );
        $this->insert($data);
    }

    public function updateDatatype($id, $datatypeName)
    {
        $data = array(
            'data_type_name' => $datatypeName,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteDatatype($id)
    {
        $this->delete('id =' . (int)$id);
    }
}