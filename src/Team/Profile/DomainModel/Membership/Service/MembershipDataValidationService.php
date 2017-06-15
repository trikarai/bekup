<?php

namespace Team\Profile\DomainModel\Membership\Service;

use Resources\DataValidationServiceAbstract;
use Resources\ErrorMessage;

class MembershipDataValidationService extends DataValidationServiceAbstract{
    
    /**
     * @param type $position
     * @param type $isAdmin
     * @return true||ErrorMessage
     */
    function isValidToProcees($position, $isAdmin = false){
        $this->_checkNotEmtpyOrNull($position, 'member position');
        if(false === is_bool($isAdmin)){
            $this->_setStatusFalse();
            $this->_appendMessage("member 'admin flag' must be boolean");
        }
        return $this->_generateResponse();
    }
}
