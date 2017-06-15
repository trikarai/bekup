<?php

namespace Talent\WorkingExperience\DomainModel\WorkingExperience\ValueObject;

use Resources\ValueObject\CommonYearIntervalStartFromPastTimeAbstract;
use Resources\Exception\CatchableException;

class WorkingExperienceTime extends CommonYearIntervalStartFromPastTimeAbstract{

    protected function _throwCathableException($fieldName, $message) {
        throw new CatchableException("working experience time '$fieldName' is invalid - $message");
    }

}
