<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject;
use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Resources\ErrorMessage;

class AddTrackCoordinatorService extends AddPersonnelServiceAbstract{
    protected $trackRdoRepository;
    
    /**
     * 
     * @param \Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository
     * @param \Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository
     */
    public function __construct(
            \Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository,
            \Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository
    ) {
        parent::__construct($personnelRepository);
        $this->trackRdoRepository = $trackRdoRepository;
    }

    protected function _addPersonnelToRepository(PersonnelWriteDataObject $request) {
        $id = $this->repository->nextIdentity();
        $password = PersonnelPassword::fromNative($request->getPassword());
        $trackRDO = $this->trackRdoRepository->ofId($request->getTrackId());
        
        $msg = true;
        if(empty($trackRDO)){
            $msg = ErrorMessage::error404_NotFound(['track not found or already removed']);
        } else{
            $personnel = Personnel::createTrackCoordinator($id, $request, $password, $trackRDO);
            $this->repository->add($personnel);
        }
        return $msg;
    }

}
