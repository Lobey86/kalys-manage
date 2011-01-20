<?php
class Default_Form_City extends Zend_Form
{
    public function init()
    {
        $this->setName('city');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $cityName = new Zend_Form_Element_Text('cityName');
        $cityName->setLabel('City Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->addValidator('Db_NoRecordExists', false,  array('table' => 'city', 'field' => 'name'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $cityName, $submit));
    }
}