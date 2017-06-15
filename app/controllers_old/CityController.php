<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Phalcon\Tag as Tag;

use Managerial\Application\Service\City\CityDTO;
use Managerial\Application\Service\City\AddCityService;
use Managerial\Application\Service\City\UpdateCityService;
use Managerial\Application\Service\City\ShowCityService;
use Managerial\Application\Service\City\RemoveCityService;
use Managerial\Application\Service\Personnel\PersonnelFinderHelper;

class CityController extends ControllerBase{
    public function indexAction(){
	$this->tag->setTitle('Manage City');
        
        $id = 'b656cc1c-184e-4733-a2cc-d409ffd14606';
        
        $cityR = $this->em->getRepository('\Managerial\Domain\Model\City\City');
        $personnelR = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $personnel = new PersonnelFinderHelper($personnelR);
        
        $service = new ShowCityService($cityR, $personnel);
        $cityDTOs = $service->showAll($id);
        $this->view->cities = $cityDTOs; 
                
    }
    
	public function newAction(){
           echo "New City";          
        }
        
        public function editAction($id){
            $this->view->idcity = $id;
        }

        public function updateAction(){

            $id = $this->request->get('id'); 
            $name = $this->request->get('name'); 
            
            $request = CityDTO::updateRequest($id, $name);
            $cityRepository = $this->em->getRepository('\Managerial\Domain\Model\City\City');
            $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
            $personnelFinder = new PersonnelFinderHelper($personnelRepository);
            $service = new UpdateCityService($cityRepository, $personnelFinder);
            $service->execute($request, 'b656cc1c-184e-4733-a2cc-d409ffd14606');
            if($service){
                echo "City Updated";
            }else{
                echo "Fail to Update";
            }
            
	}
	public function deleteAction($id){            
            $iduser = 'b656cc1c-184e-4733-a2cc-d409ffd14606';
       
            $cityRepository = $this->em->getRepository('\Managerial\Domain\Model\City\City');
            $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
            $personnelFinder = new PersonnelFinderHelper($personnelRepository);
            $service = new RemoveCityService($cityRepository, $personnelFinder);
            $service->execute($id,$iduser);
            
            if($service){
                echo "City Deleted";
            }else{
                echo "Fail to Delete";
            }
            
	}
    
        public function addAction(){
        
        $name = $this->request->get('name'); 
        
        $request = CityDTO::addRequest($name);

        $cityRepository = $this->em->getRepository('\Managerial\Domain\Model\City\City');
        $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $personnelFinder = new PersonnelFinderHelper($personnelRepository);
        $service = new AddCityService($cityRepository, $personnelFinder);
        $service->execute($request, 'b656cc1c-184e-4733-a2cc-d409ffd14606');
		//$service->execute($request, $this->session->get('auth')['id']);
        
    }
    
    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($personnelData)
    {
        $this->session->set('auth', array(
            'id' => $personnelData->id(),
            'name' => $personnelData->name(),
        ));
    }
    
    
}

?>
