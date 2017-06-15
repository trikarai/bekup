<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Resources\ErrorMessage;

class AddTutorService extends AddPersonnelServiceAbstract{
    protected $trackRdoRepository;
    protected $cityRdoRepository;
    
    public function __construct(
            \Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository,
            \Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository,
            \Superclass\DomainModel\City\ICityRdoRepository $cityRdoRepository
    ) {
        parent::__construct($personnelRepository);
        $this->trackRdoRepository = $trackRdoRepository;
        $this->cityRdoRepository = $cityRdoRepository;
    }
    
    protected function _addPersonnelToRepository(\Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject $request) {
        $id = $this->repository->nextIdentity();
        $password = PersonnelPassword::fromNative($request->getPassword());
        $cityRDO = $this->cityRdoRepository->ofId($request->getCityId());
        $trackRDO = $this->trackRdoRepository->ofId($request->getTrackId());
        
        $msg = true;
        if(empty($trackRDO)){
            $msg = ErrorMessage::error404_NotFound(['track not found or already removed']);
        }else if(empty($cityRDO)){
            $msg = ErrorMessage::error404_NotFound(['track not found or already removed']);
        }else{
            $personnel = Personnel::createTutor($id, $request, $password, $cityRDO, $trackRDO);
            $this->repository->add($personnel);
        }
        return $msg;
    }
}
