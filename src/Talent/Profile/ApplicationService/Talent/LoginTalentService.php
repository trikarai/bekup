<?php

namespace Talent\Profile\ApplicationService\Talent;

use Resources\ErrorMessage;
use Talent\Profile\DomainModel\Talent\ValueObject\TalentPassword;

class LoginTalentService {
    protected $repository;
    
    public function __construct(\Talent\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $username
     * @param type $password
     * @return \Talent\Profile\ApplicationService\Talent\TalentQueryResponseObject
     */
    function execute($userName, $password){
        $response = new TalentQueryResponseObject();
        $talent = $this->repository->ofUserName($userName);
        if(empty($talent)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['invalid username/password']));
        }else if(false === $talent->password()->sameValueAs(TalentPassword::fromNative($password))){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['invalid username/password']));
        }else{
            $response->setReadDataObject($talent->toReadDataObject());
        }
        return $response;
    }
}
