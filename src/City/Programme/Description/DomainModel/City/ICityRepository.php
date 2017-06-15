<?php

namespace City\Programme\Description\DomainModel\City;

interface ICityRepository {
    /**
     * @param type $id
     * @return City
     */
    function ofId($id);
    
    /**
     * @return City
     */
    function all();
    
    function update();
    
}
