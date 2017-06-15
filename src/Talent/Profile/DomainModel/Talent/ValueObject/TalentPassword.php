<?php

namespace Talent\Profile\DomainModel\Talent\ValueObject;

use Resources\ValueObject\CommonPasswordAbstract;
use Resources\Exception\InvalidNativeArgumentException;

class TalentPassword extends CommonPasswordAbstract{
    protected function _throwInvalidArgumentExceptionStatement($hashedPassword, $fieldName, array $allowed_types) {
        throw new InvalidNativeArgumentException($hashedPassword, "Talent $fieldName", $allowed_types);
    }
}
