<?php

namespace Talent;

class DashboardController extends \TalentControllerBase{
    function indexAction(){
        $this->view->pick('talent/dashboard/index');
    }
}
