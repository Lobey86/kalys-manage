<?php

class Default_Form_Client extends Zend_Form
{
    public function init()
    {
        $this->setName('client');

        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Company Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
               
        $phone = new Zend_Form_Element_Text('phone');
        $phone->setLabel('Company Phone Number')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
              
        $fax = new Zend_Form_Element_Text('fax');
        $fax->setLabel('Company Fax Number')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
              
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Company Address')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $contact = new Zend_Form_Element_Text('contact_name');
        $contact->setLabel('Company Contact Person')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $workinghours = new Zend_Form_Element_Text('working_hours');
        $workinghours->setLabel('Company Business Hours')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $workingdays = new Zend_Form_Element_Text('working_days');
        $workingdays->setLabel('Company Business Days')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $closingday = new Zend_Form_Element_Text('closing_day');
        $closingday->setLabel('Company Closing Days')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $city = new Zend_Form_Element_Text('city');
        $city->setLabel('City')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $industry = new Zend_Form_Element_Select('industry');
        $industry->setLabel('Industry')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $zipcode = new Zend_Form_Element_Text('zip_code');
        $zipcode->setLabel('Zip Code')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $active = new Zend_Form_Element_Checkbox('active');
        $active->setLabel('Active')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
                            
        $agent = new Zend_Form_Element_Select('agent_id');
        $agent->setLabel('Associated Agent')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(
        		array($id,
        		$name,$phone,$fax,$contact,$workingdays,$workinghours,$closingday,
        		$address,$city,$zipcode,$industry,$active,$agent,        		
        		$submit));
        		
    }
}