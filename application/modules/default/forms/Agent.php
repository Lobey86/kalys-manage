<?php
//class Default_Form_Agent extends Artgroup_Form
class Default_Form_Agent extends Zend_Form
{
    public function init()
    {
        $this->setName('agent');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $agentName = new Zend_Form_Element_Text('name');
        $agentName->setLabel('Agent Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->addValidator('Db_NoRecordExists', false,  array('table' => 'agents', 'field' => 'name'));

        //$agentActive = new Zend_Form_Element_Text('clientPhone');
        $agentActive = new Zend_Form_Element_Checkbox('active');
        $agentActive->setLabel('Active Agent')
              ->setRequired(true)
              ->addValidator('NotEmpty');
              
        $agentDefault = new Zend_Form_Element_Checkbox('default');
        $agentDefault->setLabel('Default Agent')
              ->setRequired(true)
              ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $agentName, $agentActive , $agentDefault, $submit));
    }
}