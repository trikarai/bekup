<?php

namespace Superclass\DomainModel\Track;

interface ITrackRdoRepository {
    /**
     * @param type $id
     * @return TrackReadDataObject
     */
    function ofId($id);
    
    /**
     * @return TrackReadDataObject[]
     */
    function all();
}
