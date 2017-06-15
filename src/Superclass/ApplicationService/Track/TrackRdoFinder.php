<?php

namespace Superclass\ApplicationService\Track;

use Superclass\DomainModel\Track\TrackReadDataObject;

class TrackRdoFinder {
    protected $repository;
    
    public function __construct(\Superclass\DomainModel\Track\ITrackRdoRepository $trackRdoRepository) {
        $this->repository = $trackRdoRepository;
    }
    
    /**
     * @param type $id
     * @return TrackReadDataObject
     */
    function findById($id){
        return $this->repository->ofId($id);
    }
}
