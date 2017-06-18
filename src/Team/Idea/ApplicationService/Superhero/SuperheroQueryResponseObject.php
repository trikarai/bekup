<?php

namespace Team\Idea\ApplicationService\Superhero;

use Resources\QueryResponseObject;
use Team\Idea\DomainModel\Superhero\SuperheroRdo;

class SuperheroQueryResponseObject extends QueryResponseObject{
    /**
     * @return SuperheroRdo[]
     */
    public function arrayOfReadDataObject() {
        return $this->_arrayOfReadDataObject();
    }

    /**
     * @return SuperheroRdo
     */
    public function firstReadDataObject() {
        return $this->_firstReadDataObject();
    }
    
    function toListSelectionArray(){
        $arraySelection[''] = "Select Superhero";
        foreach($this->arrayOfReadDataObject() as $rdo){
            $arraySelection[$rdo->getId()] = $rdo->getName();
        }
        return $arraySelection;
    }
}
