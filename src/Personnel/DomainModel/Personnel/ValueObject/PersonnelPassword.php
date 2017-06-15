<?php

namespace Personnel\DomainModel\Personnel\ValueObject;

use Resources\ValueObject\CommonPasswordAbstract;
use Resources\Exception\InvalidNativeArgumentException;

class PersonnelPassword extends CommonPasswordAbstract{
    protected function _throwInvalidArgumentExceptionStatement($hashedPassword, $fieldName, array $allowed_types) {
        throw new InvalidNativeArgumentException($hashedPassword, "personnel $fieldName", $allowed_types);
    }
}
