<?php

namespace Talent\Profile\DomainModel\Talent;

use Superclass\DomainModel\Talent\TalentAbstract;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Talent\Profile\DomainModel\Talent\ValueObject\TalentPassword;

use Superclass\DomainModel\City\CityReadDataObject as CityRDO;
use Superclass\DomainModel\Track\TrackReadDataObject as TrackRDO;

class Talent extends TalentAbstract{
    protected $password;
    
    /**
     * @return TalentPassword
     */
    function password(){
        return $this->password;
    }
    
    public function __construct($id, TalentWriteDataObject $request, CityRDO $cityRDO, TrackRDO $trackRDO) {
        $this->id = $id;
        
        $this->name = $request->getName();
        $this->userName = $request->getUserName();
        $this->email = $request->getEmail();
        $this->phone = $request->getPhone();
        $this->cityOfOrigin = $request->getCityOfOrigin();
        $this->birthDate = new \DateTime($request->getBirthDate());
        $this->password = TalentPassword::fromNative($request->getPassword());
        $this->cityRDO = $cityRDO;
        $this->trackRDO = $trackRDO;
    }
    
    function change(TalentWriteDataObject $request){
        $this->name = $request->getName();
        $this->email = $request->getEmail();
        $this->phone = $request->getPhone();
        $this->cityOfOrigin = $request->getCityOfOrigin();
        $this->birthDate = new \DateTime($request->getBirthDate());
    }
    
}
