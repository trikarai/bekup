<?php

namespace City\Profile\DomainModel\City;

interface ICityRepository {
    /**
     * @return string
     */
    function nextIdentity();
    
    /**
     * @param \City\Profile\DomainModel\City\City $city
     */
    function add(City $city);
    
    function update();
    
    /**
     * @param type $id
     * @return City
     */
    function ofId($id);
    
    /**
     * @param string $name
     * @return City
     */
    function ofName($name);
    
    /**
     * @return City[]
     */
    function all();
}
