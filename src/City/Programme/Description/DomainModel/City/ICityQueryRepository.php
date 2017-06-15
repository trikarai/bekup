<?php

namespace City\Programme\Description\DomainModel\City;

interface ICityQueryRepository {
    /**
     * 
     * @param type $id
     * @return CityQuery
     */
    function ofId($id);
}
