<?php
class Default_Form_Datatype extends Zend_Form
{
    public function init()
    {
        $this->setName('datatype');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $datatypeName = new Zend_Form_Element_Text('datatypeName');
        $datatypeName->setLabel('Data Type')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->addValidator('Db_NoRecordExists', false,  array('table' => 'client_data_types', 'field' => 'data_type_name'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $datatypeName, $submit));
    }
}