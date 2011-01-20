<?php
class Default_Form_Industry extends Zend_Form
{
    public function init()
    {
        $this->setName('industry');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $industryName = new Zend_Form_Element_Text('industryName');
        $industryName->setLabel('Industry Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty')
               ->addValidator('Db_NoRecordExists', false,  array('table' => 'industry', 'field' => 'name'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $industryName, $submit));
    }
}