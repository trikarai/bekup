<?php

namespace Programme\Description\ApplicationService\Programme;

class TransactionalAddProgrammeService {
    protected $service;
    protected $session;
    
    public function __construct(AddProgrammeService $service, Resources\ITransactionalSession $session) {
        $this->service = $service;
        $this->session = $session;
    }
    
    
    function execute($personnelId, ProgrammeWriteDataObject $request){
        $operation = function () use($personnelId, $request){
            return $this->service->execute($personnelId, $request);
        };
        return $this->session->executeAtomically($operation);
    }
}
