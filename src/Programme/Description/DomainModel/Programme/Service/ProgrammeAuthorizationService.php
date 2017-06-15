<?php

namespace Programme\Description\DomainModel\Programme\Service;

use Resources\PersonnelAuthorizationServiceAbstract;

class ProgrammeAuthorizationService extends PersonnelAuthorizationServiceAbstract{

    protected function _authorizedPersonnelRoles_toAdd() {
        return array("Director");
    }

    protected function _authorizedPersonnelRoles_toRemove() {
        return array("Director");
    }

    protected function _authorizedPersonnelRoles_toUpdate() {
        return array("Director");
    }

}
