<?php
class Default_Model_Industry extends Zend_Db_Table_Abstract {
	
	protected $_name = 'industry';

	public function getAllIndustriesSelect(){
		$data = array();
		$industries = $this->fetchAll();
		foreach ($industries as $industry) {
			$data[$industry->id]=$industry->name;			
		}
		return $data;
	}
	
	
	public function getIndustry($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addIndustry($industryName)
    {
        $data = array(
            'name' => $industryName,
        );
        $this->insert($data);
    }

    public function updateIndustry($id, $industryName)
    {
        $data = array(
            'name' => $industryName,
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteIndustry($id)
    {
        $this->delete('id =' . (int)$id);
    }	
}