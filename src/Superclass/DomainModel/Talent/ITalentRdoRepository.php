<?php

namespace Superclass\DomainModel\Talent;

interface ITalentRdoRepository {
    /**
     * @param type $id
     * @return TalentReadDataObject
     */
    function ofId($id);
    /**
     * 
     * @param type $cityId
     * @return TalentReadDataObject[]
     */
    function ofCity($cityId);
    /**
     * 
     * @return TalentReadDataObject[]
     */
    function all();
}
