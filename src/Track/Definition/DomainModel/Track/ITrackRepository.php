<?php

namespace Track\Definition\DomainModel\Track;

interface ITrackRepository {
    /**
     * @return string
     */
    function nextIdentity();
    
    /**
     * @param \Track\Definition\DomainModel\Track\Track $track
     */
    function add(Track $track);
    
    function update();
    
    /**
     * @param string $id
     * @return Track
     */
    function ofId($id);
    
    /**
     * @param string $name
     * @return Track
     */
    function ofName($name);
    
    /**
     * @return Track[]
     */
    function all();
}
