<?php

namespace Programme\Description\DomainModel\Programme;

interface IProgrammeRdoRepository {
    
    /**
     * @param type $id
     * @return ProgrammeRdo
     */
    function ofId($id);
    
    /**
     * @return ProgrammeRdo[]
     */
    function all();
}
