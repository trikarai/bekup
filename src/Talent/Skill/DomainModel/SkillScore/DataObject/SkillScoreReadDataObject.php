<?php

namespace Talent\Skill\DomainModel\SkillScore\DataObject;

use Resources\IReadDataObject;
use Talent\Skill\DomainModel\Skill\DataObject\SkillReadDataObject;

class SkillScoreReadDataObject implements IReadDataObject{
    protected $id;
    protected $scoreValue;
    protected $skillRDO;
    
    function getId() {
        return $this->id;
    }
    function getScoreValue() {
        return $this->scoreValue;
    }
    /**
     * @return SkillReadDataObject
     */
    function skillRDO() {
        return $this->skillRDO;
    }
    
    function __construct($id, $scoreValue, SkillReadDataObject $skillRDO) {
        $this->id = $id;
        $this->scoreValue = $scoreValue;
        $this->skillRDO = $skillRDO;
    }

            
    public function toArray() {
       return array(
           'id' => $this->getId(),
           'score_value' => $this->getScoreValue(),
           'skill' => $this->skillRDO()->toArray(),
       ); 
    }
}
