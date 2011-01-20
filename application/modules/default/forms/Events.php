<?php
class Default_Form_Events extends Zend_Form
{
    public function init()
    {
        $this->setName('events');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $eventName = new Zend_Form_Element_Text('eventName');
        $eventName->setLabel('Event Type')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->addValidator('Db_NoRecordExists', false,  array('table' => 'event_types', 'field' => 'event_name'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $eventName, $submit));
    }
}