<?php
class Default_Form_AddEvent extends Zend_Form
{
    public function init()
    {
        $this->setName('addevent');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $eventName = new Zend_Form_Element_Select('eventName');
        $eventName->setLabel('Event Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim');

        $eventTimeStart = new Zend_Form_Element_Text('timeStart');
        $eventTimeStart->setLabel('Event Time Start')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim');
               
        $eventTimeEnd = new Zend_Form_Element_Text('timeEnd');
        $eventTimeEnd->setLabel('Event Time Start')
               ->setRequired(false)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ;
               
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $eventName,$eventTimeStart,$eventTimeEnd, $submit));
    }
}