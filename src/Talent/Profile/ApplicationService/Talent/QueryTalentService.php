<?php

namespace Talent\Profile\ApplicationService\Talent;

use Talent\Profile\DomainModel\Talent\Talent;
use Talent\Profile\DomainModel\Talent\ValueObject\TalentPassword;
use Resources\ErrorMessage;

class QueryTalentService {
    protected $repository;
    
    public function __construct(\Superclass\DomainModel\Talent\ITalentRdoRepository $talentRdoRepository) {
        $this->repository = $talentRdoRepository;
    }
    
    /**
     * @param type $talentId
     * @return \Talent\Profile\ApplicationService\Talent\TalentQueryResponseObject
     */
    function showOneById($talentId){
        $response = new TalentQueryResponseObject();
        $talentRdo = $this->repository->ofId($talentId);
        
        if(empty($talentRdo)){
            $response->appendErrorMessage(ErrorMessage::error404_NotFound(['talent not found']));
        }else{
            $response->setReadDataObject($talentRdo);
        }
        return $response;
    }
}
