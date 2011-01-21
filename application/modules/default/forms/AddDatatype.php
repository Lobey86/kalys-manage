<?php
class Default_Form_AddDatatype extends Zend_Form
{
    public function init()
    {
        $this->setName('adddatatype');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $datatypeName = new Zend_Form_Element_Select('datatypeName');
        $datatypeName->setLabel('Data Type Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim');

        $datatypeValue = new Zend_Form_Element_Textarea('datatypeValue',array('rows'=>'10', 'cols'=>'50'));
        $datatypeValue->setLabel('Data Type Value')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim');
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $datatypeName, $datatypeValue, $submit));
    }
}