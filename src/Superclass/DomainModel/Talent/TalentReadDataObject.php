<?php

namespace Superclass\DomainModel\Talent;

use Resources\IReadDataObject;
use Superclass\DomainModel\City\CityReadDataObject;

class TalentReadDataObject extends TalentQueryAbstract implements IReadDataObject{
    public function __construct($id, $name, $userName, $email, $phone, $cityOfOrigin, \Datetime $birthDate, CityReadDataObject $cityRdo, \Superclass\DomainModel\Track\TrackReadDataObject $trackRdo, $gender, $bekupType, $motivation) {
        parent::__construct($id, $name, $userName, $email, $phone, $cityOfOrigin, $birthDate, $cityRdo, $trackRdo, $gender, $bekupType, $motivation);
    }
}
