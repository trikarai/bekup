<?php

namespace Programme\Description\DomainModel\Programme\ValueObject;

use Resources\ValueObject\CommonDateIntervalAbstract;
use Resources\Exception\CatchableException;

class ProgrammeRegistrationDateRange extends CommonDateIntervalAbstract{

    protected function _throwInvalidArgumentException(\DateTime $startDate, \DateTime $endDate) {
        throw new CatchableException("Programme Registration 'end date': '{$endDate->format('Y-m-d')}' must be after 'start date': '{$startDate->format('Y-m-d')}'");
    }

}
