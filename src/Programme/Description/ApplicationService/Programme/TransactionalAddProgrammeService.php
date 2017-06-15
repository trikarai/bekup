<?php

namespace Programme\Description\ApplicationService\Programme;

use Resources\ResponseObject;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;

class TransactionalAddProgrammeService {
    protected $service;
    protected $session;
    
    /**
     * @param \Programme\Description\ApplicationService\Programme\AddProgrammeService $service
     * @param \Resources\ITransactionalSession $session
     */
    public function __construct(AddProgrammeService $service, \Resources\ITransactionalSession $session) {
        $this->service = $service;
        $this->session = $session;
    }
    
    /**
     * @param type $personnelId
     * @param ProgrammeWriteDataObject $request
     * @return ResponseObject
     */
    function execute($personnelId, ProgrammeWriteDataObject $request){
        $operation = function () use($personnelId, $request){
            return $this->service->execute($personnelId, $request);
        };
        return $this->session->executeAtomically($operation);
    }
}
