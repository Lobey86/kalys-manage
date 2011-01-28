<?php
class Default_Form_SearchClients extends Zend_Form
{
    public function init()
    {
        $this->setName('searchclients');

        /*
        
        client name, contact name
        address, city, zipcode
        client data type, client data
        event type, event deadline, event expired
        agent
        
        
        + has X type of event
        + X type of event has deadline aproaching within X days
        + has event dealine aproaching within X days
        + has any event deadline expired
        + has X event type deadline expired
        
        */
        
/*       
        $clientName = new Zend_Form_Element_Text('clientName');
        $clientName->setLabel('Client Name')
        		->addFilter('StripTags')
        		->addFilter('StringTrim');
        		
        $contactName = new Zend_Form_Element_Text('contactName');
        $contactName->setLabel('Contact Person')
        		->addFilter('StripTags')
        		->addFilter('StringTrim');
        		
        $address = new Zend_Form_Element_Text('address');
        $address->setLabel('Address')
        		->addFilter('StripTags')
        		->addFilter('StringTrim'); 
        		
        $city = new Zend_Form_Element_Select('city');
        $city->setLabel('City');
        
        $zipcode = new Zend_Form_Element_Text('zipcode');
        $zipcode->setLabel('Zip Code')
        		->addFilter('StripTags')
        		->addFilter('StringTrim');
        		
        $datatype = new Zend_Form_Element_Select('dataType');
        $datatype->setLabel('Select Data Type');

        $data = new Zend_Form_Element_Text('data');
        $data->setLabel('Data')
        		->addFilter('StripTags')
        		->addFilter('StringTrim'); 
        		
        $eventType = new Zend_Form_Element_Select('eventType');
        $eventType->setLabel('Select');
        		
        $eventExpired = new Zend_Form_Element_Checkbox('eventExpired');
        $eventExpired->setLabel('Event is Expired');
        		
$clientName,$contactName,
$address, $city, $zipcode,
$datatype, $data,
$eventType, $eventExpired,    		
        		
*/        		
        		
        $eventDeadline = new Zend_Form_Element_Text('eventDeadline');
        $eventDeadline->setLabel('Deadline')
        		->addFilter('StripTags')
        		->addFilter('StringTrim');

        
        $agent = new Zend_Form_Element_Select('agent');
        $agent->setLabel('Agent Assigned');
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(
        			array(
        			$eventDeadline,
        			$agent,
        			$submit)
        			);
    }
}