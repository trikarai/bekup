<?php

namespace Team;

use Team\Profile\ApplicationService\Talent\ActiveMembershipFinder;


class TeamControllerBase extends \TalentControllerBase{
    function _activeMembershipFinder(){
        $talentRepository = $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
        return new ActiveMembershipFinder($talentRepository);
    }
}
