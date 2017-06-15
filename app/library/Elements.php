<?php
class Elements extends Phalcon\Mvc\User\Component{
    private $_publicHeaderMenu = array(
        'navbar-left' => array(
            'About' => ['caption' => 'About Us', 'action' => 'index'],
            'Contact' => ['caption' => 'Contact Us', 'action' => 'index'],
			'CorporateAdministrator' => ['caption' => 'Manage Corporate Resources', 'action' => 'index'],
			'CorporateUser' => ['caption' => 'Access Corporate Resources', 'action' => 'index'],
		),
    );
	private $_systemAdminHeaderMenu = array(
        'navbar-left' => array(
            'SystemDashboard' => ['caption' => 'Dashboard', 'action' => 'index'],
            'Corporate' => ['caption' => 'Manage Corporate', 'action' => 'index'],
            'CorporateAdmin' => ['caption' => 'Manage Corporate Admin', 'action' => 'index'],
            'SystemUser' => ['caption' => 'Manage System Users', 'action' => 'index'],
            'CorporateType' => ['caption' => 'Manage System Resources', 'action' => 'index'],
		),
		'navbar-right' => array(
			'SystemAdministrator' => ['caption' => 'Log Out', 'action' => 'end']
		)
    );
	private $_systemSUHeaderMenu = array(
        'navbar-left' => array(
            'SystemDashboard' => ['caption' => 'Dashboard', 'action' => 'index'],
            'Corporate' => ['caption' => 'Manage Corporate', 'action' => 'index'],
            'CorporateAdmin' => ['caption' => 'Manage Corporate Admin', 'action' => 'index'],
            'CorporateType' => ['caption' => 'Manage System Resources', 'action' => 'index'],
		),
		'navbar-right' => array(
			'SystemAdministrator' => ['caption' => 'Log Out', 'action' => 'end']
		)
    );
	private $_corporateAdminHeaderMenu = array(
        'navbar-left' => array(
            'About' => ['caption' => 'About Us', 'action' => 'index'],
            'Contact' => ['caption' => 'Contact Us', 'action' => 'index'],
            'CorporateDashboard' => ['caption' => 'Dashboard', 'action' => 'index'],
            'UnitType' => ['caption' => 'Manage Organization', 'action' => 'index'],
            'UserType' => ['caption' => 'Manage User', 'action' => 'index'],
            'Form' => ['caption' => 'Manage Workflow', 'action' => 'index'],
			'ManageAdmin' => ['caption' => 'Manage Admin', 'action' => 'index'],
		),
		'navbar-right' => array(
			'CorporateAdministrator' => ['caption' => 'Log Out', 'action' => 'end']
		)
    );
	private $_corporateSUHeaderMenu = array(
        'navbar-left' => array(
            'About' => ['caption' => 'About Us', 'action' => 'index'],
            'Contact' => ['caption' => 'Contact Us', 'action' => 'index'],
            'CorporateDashboard' => ['caption' => 'Dashboard', 'action' => 'index'],
            'UnitType' => ['caption' => 'Manage Organization', 'action' => 'index'],
            'UserType' => ['caption' => 'Manage User', 'action' => 'index'],
            'Form' => ['caption' => 'Manage Workflow', 'action' => 'index'],
		),
		'navbar-right' => array(
			'CorporateAdministrator' => ['caption' => 'Log Out', 'action' => 'end']
		)
    );
	private $_corporateUserHeaderMenu = array(
		'navbar-left' => array(
            'About' => ['caption' => 'About Us', 'action' => 'index'],
            'Contact' => ['caption' => 'Contact Us', 'action' => 'index'],
            'UserDashboard' => ['caption' => 'Dashboard', 'action' => 'index'],
            'ManageTask' => ['caption' => 'Task', 'action' => 'activeTask'],
		),
		'navbar-right' => array(
			'CorporateUser' => ['caption' => 'Log Out', 'action' => 'end']
		)
	);
	
	private $_manageSystemResources = array(
		'Corporate Type' => ['controller' => 'CorporateType', 'action' => 'index', 'any' => false],
		'Corporate Status' => ['controller' => 'CorporateStatus', 'action' => 'index', 'any' => false],
	);
    private $_manageOrganization = array(
		'Unit Type' => ['controller' => 'UnitType', 'action' => 'index', 'any' => false],
		'Hierarchy' => ['controller' => 'Hierarchy', 'action' => 'index', 'any' => false],
		'Unit' => ['controller' => 'Unit', 'action' => 'index', 'any' => false],
	);
	private $_manageUser = array(
		'User Type' => ['controller' => 'UserType', 'action' => 'index', 'any' => false],
		'User' => ['controller' => 'User', 'action' => 'index', 'any' => false],
	);
	private $_manageWorkflow = array(
		'Form' => ['controller' => 'Form', 'action' => 'index', 'any' => false],
		'View' => ['controller' => 'View', 'action' => 'index', 'any' => false],
		'Flow' => ['controller' => 'Flow', 'action' => 'index', 'any' => false],
	);
	private $_manageTask = array(
		'Current Task' => ['controller' => 'ManageTask', 'action' => 'activeTask', 'any' => false],
		'Task History' => ['controller' => 'ManageTask', 'action' => 'taskHistory', 'any' => false],
		'New Task' => ['controller' => 'ManageTask', 'action' => 'newTask', 'any' => false],
	);
	private function renderHeaderMenu($resources){
		$controllerName = $this->view->getControllerName();
        foreach ($resources as $position => $menu) {
			echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
				//echo "<a href='http://localhost/dart/$controller/$option[action]'>$option[caption]</a>";
                echo Phalcon\Tag::linkTo($controller.'/'.$option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
			echo '</div>';
        }
	}
    public function getMenu(){
        $session = $this->session->get('auth');
		$auth = $session['access_type_id'];
        if (!$session) {//public
            $this->renderHeaderMenu($this->_publicHeaderMenu);
        } else if($auth == 1){
            $this->renderHeaderMenu($this->_systemAdminHeaderMenu);
        } else if($auth == 2){
            $this->renderHeaderMenu($this->_systemSUHeaderMenu);
        } else if($auth == 3){
            $this->renderHeaderMenu($this->_corporateAdminHeaderMenu);
        } else if($auth == 4){
            $this->renderHeaderMenu($this->_corporateSUHeaderMenu);
        } else {
            $this->renderHeaderMenu($this->_corporateUserHeaderMenu);
        }
    }

    public function getTabs($menuTabs)
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->$menuTabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo Phalcon\Tag::linkTo($option['controller'].'/'.$option['action'], $caption), '<li>';
        }
        echo '</ul>';
    }
}
