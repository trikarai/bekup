<?php

namespace Talent\Profile\ApplicationService\Talent;

class LoginTalentDiloService {
    protected $repository;
    
    public function __construct(\Talent\Profile\DomainModel\Talent\ITalentRepository $talentRepository) {
        $this->repository = $talentRepository;
    }
    
    /**
     * @param type $userName
     * @return \Talent\Profile\ApplicationService\Talent\TalentQueryResponseObject
     */
    function execute($userName){
        $response = new TalentQueryResponseObject();
        $talent = $this->repository->ofUserName($userName);
        if(empty($talent)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['invalid username/password']));
        }else{
            $response->setReadDataObject($talent->toReadDataObject());
        }
        return $response;
    }
}
