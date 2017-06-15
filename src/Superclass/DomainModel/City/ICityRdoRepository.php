<?php

namespace Superclass\DomainModel\City;

interface ICityRdoRepository {
    /**
     * 
     * @param type $id
     * @return CityReadDataObject
     */
    function ofId($id);
    
    /**
     * @return CityReadDataObject
     */
    function all();
}
