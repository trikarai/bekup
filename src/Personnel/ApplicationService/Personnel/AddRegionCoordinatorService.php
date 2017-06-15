<?php

namespace Personnel\ApplicationService\Personnel;

use Personnel\DomainModel\Personnel\Personnel;
use Personnel\DomainModel\Personnel\ValueObject\PersonnelPassword;
use Resources\ErrorMessage;

class AddRegionCoordinatorService extends AddPersonnelServiceAbstract{
    protected $cityRdoRepository;
    
    /**
     * @param \Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository
     * @param \Superclass\DomainModel\City\ICityRdoRepository $cityRdoRepository
     */
    public function __construct(
            \Personnel\DomainModel\Personnel\IPersonnelRepository $personnelRepository,
            \Superclass\DomainModel\City\ICityRdoRepository $cityRdoRepository
    ) {
        parent::__construct($personnelRepository);
        $this->cityRdoRepository = $cityRdoRepository;
    }
    
    protected function _addPersonnelToRepository(\Personnel\DomainModel\Personnel\DataObject\PersonnelWriteDataObject $request) {
        $id = $this->repository->nextIdentity();
        $password = PersonnelPassword::fromNative($request->getPassword());
        $cityRDO = $this->cityRdoRepository->ofId($request->getCityId());
        
        $msg = true;
        if(empty($cityRDO)){
            $msg = ErrorMessage::error404_NotFound(["city not found or already removed"]);
        }else{
            $personnel = Personnel::createRegionCoordinator($id, $request, $password, $cityRDO);
            $this->repository->add($personnel);
        }
        return $msg;
    }
}
