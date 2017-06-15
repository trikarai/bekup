<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Talent\ITalentRepository;

class TestableTalentRepository implements ITalentRepository{
    protected $talents;
    
    function getAvailableTalentId(){
        return $this->talents[1]->getId();
    }
    function getAvailableCommanderTalentId(){
        return $this->talents[0]->getId();
    }
    /**
     * @return TestableTalent
     */
    function talent(){
        return $this->talent;
    }
    
    public function __construct() {
        $this->talents[] = new TestableTalent();
        $this->talents[] = new TestableTalent();
    }
    public function ofId($id) {
        if($id === $this->talent[0]->getId()){
            return $this->talents[0];
        }else if($id === $this->talent[1]->getId()){
            return $this->talents[1];
        }
        return null;
    }

    public function update() {
        
    }

    public function availableTalentToInvite(\Team\Profile\DomainModel\Team\Team $team) {
        
    }

}