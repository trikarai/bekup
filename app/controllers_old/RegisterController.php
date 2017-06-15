<?php
use Phalcon\Filter;

use Usage\Application\Service\Talent\SignUpTalentService;
use Managerial\Application\Service\City\ShowCityService;
use Managerial\Application\Service\Personnel\PersonnelFinderHelper;
 
class RegisterController extends ControllerBase{    
    
    public function IndexAction() {
        $cityRepository = $this->em->getRepository('Managerial\Domain\Model\City\City');
        $cityHelper = new Managerial\Application\Service\City\ExternalCityFinderHelper($cityRepository);
        $cityDTOs = $cityHelper->showAll();
        $this->view->cities = $cityDTOs;
    }
    public function RegisterAction() {
        $cityRepository = $this->em->getRepository('Managerial\Domain\Model\City\City');
        $cityFinderHelper = new Managerial\Application\Service\City\CityFinderHelper($cityRepository);
        $repository = $this->em->getRepository('Usage\Domain\Model\Talent\Talent');
        $service = new SignUpTalentService($repository, $cityFinderHelper);
        
        $name;
        $userName;
        $email;
        $password;
        $phone;
        $birthDate;
        $address;
        $cityId;
        $request = Usage\Application\Service\Talent\TalentDTO::signUpRequest($name, $userName, $email, $password, $phone, $birthDate, $address, $cityId);
        $service->execute($request);
        
                
    }
}
    


