<?php

namespace Team;

use Team\Profile\ApplicationService\Talent\QueryMembershipService;
use Team\Profile\ApplicationService\Team\QueryMemberService;
use Superclass\DomainModel\Team\TeamMemberReadDataObject;

class InvitationController extends \TalentControllerBase{
    function indexAction(){
        $this->view->pick('team/invitation/index');
        $talentRepository = $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
        $service = new QueryMembershipService($talentRepository);
        $response = $service->showInvitedMembership($this->_getTalentId());
        $this->view->notificationDTOs = $response->arrayOfReadDataObject();
    }
}

