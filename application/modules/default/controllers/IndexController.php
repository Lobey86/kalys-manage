<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $clients = new Default_Model_Clients();
        $this->view->clients = $clients->fetchAll();
    }
    
    public function viewClientsAction(){
    	
    	$clients = new Default_Model_Clients();
        $this->view->clients = $clients->fetchAll();
        
        $cities = new Default_Model_City();
        $cityRes = $cities->getAllCitiesSelect();
        $cityRes[0] = "No city";
        $this->view->cities = $cityRes;
        
        $agents = new Default_Model_Agents();
        $agentRes = $agents->getAllAgentsSelect();
        $agentRes[0] = "No Agent Assigned";
        $this->view->agents = $agentRes;
    }
    
    public function viewEventTypesAction()
    {
    	$eventTypes = new Default_Model_Events();
    	$this->view->events = $eventTypes->fetchAll();    	
    }
    
    public function addEventTypeAction()
    {
    	$form = new Default_Form_Events();
    	$form->submit->setLabel('Add Event');
    	
    	if ($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData))
    		{
    			$eventName = $form->getValue('eventName');
    			$event = new Default_Model_Events();
    			$event->addEvent($eventName);
    			
    			$this->_helper->redirector('index');
    		}
    		else {
    			$form->populate($formData);
    		}
    	}
    	$this->view->form = $form;
    	
    }
    
    public function deleteEventTypeAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $event = new Default_Model_Events();
                $event->deleteEvent($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $event = new Default_Model_Events();
            $this->view->event = $event->getEvent($id);
        }
    	
    }
    
    public function viewDataTypesAction(){
    	
    	$datatypes = new Default_Model_Datatype();
        $this->view->datatypes = $datatypes->fetchAll();
    }


    public function addDataTypeAction()
    {
        $form = new Default_Form_Datatype();
        $form->submit->setLabel('Add');
        
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $datatypeName = $form->getValue('datatypeName');
                $datatype = new Default_Model_Datatype();
                $datatype->addDatatype($datatypeName);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        $this->view->form = $form;    
    }
    
    public function deleteDataTypesAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $datatype = new Default_Model_Datatype();
                $datatype->deleteDatatype($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $datatype = new Default_Model_Datatype();
            $this->view->datatype = $datatype->getDatatype($id);
        }
    }   
    
    
    public function viewAgentsAction(){
    	
    	$agents = new Default_Model_Agents();
        $this->view->agents = $agents->fetchAll();
    }


    public function addAgentAction()
    {
        $form = new Default_Form_Agent();
        $form->submit->setLabel('Add');
        
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $agentName = $form->getValue('agentName');
                $agentActive = $form->getValue('agentActive');
                $agentDefault = $form->getValue('agentDefault');
                $agents = new Default_Model_Agents();
                $agents->addAgent($agentName, $agentActive,$agentDefault);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        $this->view->form = $form;    
    }
    
    public function editAgentAction()
    {
    	$form = new Default_Form_Agent();
        $form->submit->setLabel('Save');
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                
                $agentName = $form->getValue('name');
                $agentActive = $form->getValue('active');
                $agentDefault = $form->getValue('default');
                
                $agent = new Default_Model_Agents();
                $agent->updateAgent($id,$agentName, $agentActive, $agentDefault);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $agent = new Default_Model_Agents();
                $form->populate($agent->getAgent($id));
            }
        }
        $this->view->form = $form;
    }
    
    
    public function deleteAgentAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $agent = new Default_Model_Agents();
                $agent->deleteAgent($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $agent = new Default_Model_Agents();
            $this->view->agent = $agent->getAgent($id);
        }
    }   


    public function viewIndustriesAction()
    {
    	
    	$industries = new Default_Model_Industry();
    	$this->view->industries = $industries->fetchAll();
    	
    }


    public function deleteIndustryAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $industry = new Default_Model_Industry();
                $industry->deleteIndustry($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $industry = new Default_Model_Industry();
            $this->view->industry = $industry->getIndustry($id);
        }
    }

    
    public function addIndustryAction()
    {
        $form = new Default_Form_Industry();
        $form->submit->setLabel('Add');
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$name = $form->getValue('industryName');
                $industry = new Default_Model_Industry();
                $industry->addIndustry($name);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        
        $this->view->form = $form;
            
    }
    
    
    
    
    public function viewCitiesAction()
    {
    	
    	$cities = new Default_Model_City();
    	$this->view->cities = $cities->fetchAll();
    	
    }


    public function deleteCityAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $city = new Default_Model_City();
                $city->deleteCity($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $city = new Default_Model_City();
            $this->view->city = $city->getCity($id);
        }
    }

    
    public function addCityAction()
    {
        $form = new Default_Form_City();
        $form->submit->setLabel('Add');
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$name = $form->getValue('cityName');
                $city = new Default_Model_City();
                $city->addCity($name);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        
        $this->view->form = $form;
            
    }
    
    public function addClientEventAction()
    {
    	$formDataType = new Default_Form_AddEvent();
    	$formDataType->submit->setLabel('Add Client Event');
    	
    	$events = new Default_Model_Events();
    	$formDataType->getElement('eventName')->setMultiOptions($events->getAllEventsSelect());
    	
    	$id = $this->_getParam('id', 0);

    	if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($formDataType->isValid($formData)) {
				$type = $formDataType->getValue('eventName');
				$timeStart = $formDataType->getValue('timeStart');
				$timeEnd = $formDataType->getValue('timeEnd');
				
				if ($timeEnd=="") $timeEnd = "0000-00-00";
				
                $data = new Default_Model_ClientEvents();
                $data->addEvent($id,$type, $timeStart,$timeEnd);
                
                $this->_helper->redirector('edit-client', null, null, array('id' => $id));
            } else {
                $formDataType->populate($formData);
            }
        }
        $this->view->formDataType = $formDataType;
    	
    }

    public function addClientDataAction()
    {
    	    	
        $formDataType = new Default_Form_AddDatatype();
        $formDataType->submit->setLabel('Add Extra Client Data');
		
        $datatypes = new Default_Model_Datatype();
        $formDataType->getElement('datatypeName')->setMultiOptions($datatypes->getAllDataTypesSelect());
        
    	$id = $this->_getParam('id', 0);

    	if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($formDataType->isValid($formData)) {
				$name = $formDataType->getValue('datatypeName');
				$value = $formDataType->getValue('datatypeValue');
				
                $data = new Default_Model_ClientData();
                $data->addData($id,$name, $value);
                
                $this->_helper->redirector('edit-client', null, null, array('id' => $id));
            } else {
                $formDataType->populate($formData);
            }
        }
        
        
        $this->view->formDataType = $formDataType;
    }
    
    public function deleteClientDataAction()
    {
    	if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $clientdata = new Default_Model_ClientData();
                $clientdata->deleteData($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $clientdata = new Default_Model_ClientData();
            $this->view->clientDataTypes = $clientdata->getDataItem($id);
        }
    	
    	
    }
    
    
    public function addClientAction()
    {
        $form = new Default_Form_Client();
        $form->submit->setLabel('Add');
        
        $cities = new Default_Model_City();
        $form->getElement('city')->setMultiOptions($cities->getAllCitiesSelect());

        $agents = new Default_Model_Agents();
        $form->getElement('agent_id')->setMultiOptions($agents->getAllAgentsSelect());
        
        $industry = new Default_Model_Industry();
        $form->getElement('industry')->setMultiOptions($industry->getAllIndustriesSelect());
        
        if ($this->getRequest()->isPost()) {
            $formData= $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
				$name = $form->getValue('businessName');
				$phone = $form->getValue('businessPhone');
				$fax = $form->getValue('businessFax');
				$address = $form->getValue('businessAddress');
				$contact = $form->getValue('businessContact');
				$hours = $form->getValue('businessHours');
				$days = $form->getValue('businessDays');
				$closing = $form->getValue('businessClosing');
				$city = $form->getValue('businessCity');
				$industry = $form->getValue('businessIndustry');
				$zipcode = $form->getValue('businessZip');
				$active = $form->getValue('businessActive');
				$agent = $form->getValue('businessAgent');
                $clients = new Default_Model_Clients();
                $clients->addClient($name, $phone,$fax, $address, $contact, $hours, $days, $closing, $city, $industry, $zipcode, $active, $agent);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
        
        $this->view->form = $form;
            
    }

    public function editClientAction()
    {
        $form = new Default_Form_Client();
        $form->submit->setLabel('Save');
        
        $formDataType = new Default_Form_AddDatatype();
        $formDataType->submit->setLabel('Add Data Type');
		
        $datatypes = new Default_Model_Datatype();
        $formDataType->getElement('datatypeName')->setMultiOptions($datatypes->getAllDataTypesSelect());
        
        $this->view->formDataType = $formDataType;
        
        
        $cities = new Default_Model_City();
        $form->getElement('city')->setMultiOptions($cities->getAllCitiesSelect());

        $agents = new Default_Model_Agents();
        $form->getElement('agent_id')->setMultiOptions($agents->getAllAgentsSelect());
        
        $industry = new Default_Model_Industry();
        $form->getElement('industry')->setMultiOptions($industry->getAllIndustriesSelect());
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                
                $businessName = $form->getValue('name');
                $businessPhone = $form->getValue('phone');
                $businessFax = $form->getValue('fax');
                $businessAddress = $form->getValue('address');
                $businessContact = $form->getValue('contact_name');
                $businessHours = $form->getValue('working_hours');
                $businessDays = $form->getValue('working_days');
                $businessClosing = $form->getValue('closing_day');
                $businessCity = $form->getValue('city');
                $businessIndustry = $form->getValue('industry');
                $businessZip = $form->getValue('zip_code');
                $businessActive = $form->getValue('active');
                $businessAgent = $form->getValue('agent_id');
                
                $client = new Default_Model_Clients();
                $client->updateClient($id,$businessName,$businessPhone, $businessFax, $businessAddress, 
                $businessContact, $businessHours, $businessDays, $businessClosing, $businessCity, 
                $businessIndustry, $businessZip, $businessActive, $businessAgent);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $client = new Default_Model_Clients();
                $clientData = $client->getClient($id);
                
                $form->populate($client->getClient($id));
            }
        }
        $this->view->form = $form;

        
        $clientData = new Default_Model_ClientData();
        $clientDataTypes = $clientData->getClientData($id);
        $this->view->clientDataTypes = $clientDataTypes;
        
        $clientEvent = new Default_Model_ClientEvents();
        $clientEvents = $clientEvent->getClientEvents($id);
        $this->view->clientEvents = $clientEvents;
        
        $this->view->id = $id;
    }
    
    public function searchClientsAction()
    {
    	$form = new Default_Form_SearchClients(); 
        $form->submit->setLabel('Export Search Results in PDF format');
    	
        $agents = new Default_Model_Agents();
        $form->getElement('agent')->setMultiOptions($agents->getAllAgentsSelect());
        
    	if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $date = $form->getValue('eventDeadline');
                $agent = $form->getValue('agent');
                
                $result = new Default_Model_Clients();
                
                $document = $result->fetchSearchResults($date,$agent);
                $this->_helper->layout()->resetMvcInstance();
                $this->getResponse()
                ->setHeader('Content-type', 'application/x-pdf')
                ->setHeader('Content-Disposition', 'inline; filename=kalys-report.pdf')
                ->setBody($document);
            } else {
                $form->populate($formData);
            }
        } else {
        	$this->view->form = $form;
        }
    }
    
    

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Default_Model_Clients();
                $albums->deleteClient($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $clients = new Default_Model_Clients();
            $this->view->client = $clients->getClient($id);
        }
    }


}