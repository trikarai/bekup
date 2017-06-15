<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Resources\ErrorMessage;

class LoginPersonnelService {
    protected $repository;
    
    public function __construct(\Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository) {
        $this->repository = $personnelRepository;
    }
    
    /**
     * @param type $email
     * @param type $password
     * @return \Personnel\ApplicationService\Personnel\PersonnelQueryReponseObject
     */
    function execute($email, $password){
        $response = new PersonnelQueryReponseObject();
        $personnel = $this->repository->ofEmail($email);
        
        if(empty($personnel)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['invalid personnel email/password']));
        }else if(false === $personnel->password()->sameValueAs(PersonnelPassword::fromNative($password))){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['invalid personnel email/password']));
        }else{
            $response->setReadDataObject($personnel->toReadDataObject());
        }
        return $response;
    }
}
