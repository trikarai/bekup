<?php

use Phalcon\Events\Event,
	Phalcon\Mvc\User\Plugin,
	Phalcon\Mvc\Dispatcher,
	Phalcon\Acl;

/**
 * Security
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class Bekupsecurity extends Plugin
{

	public function __construct($dependencyInjector)
	{
		$this->_dependencyInjector = $dependencyInjector;
	}

	public function getAcl()
	{
			$acl = new Phalcon\Acl\Adapter\Memory();

			$acl->setDefaultAction(Phalcon\Acl::DENY);

			//Register roles
			$roles = array(
				// 'directors' => new Phalcon\Acl\Role('Direktur'),
				// 'trackCoordinators' => new Phalcon\Acl\Role('Koordinator Track'),
                // 'regionCoordinators' => new Phalcon\Acl\Role('Koordinator Wilayah'),
				// 'guests' => new Phalcon\Acl\Role('guests'),
                // 'tutors' => new Phalcon\Acl\Role('Tutor'),
				// 'talents' => new Phalcon\Acl\Role('Talent'),
				
		'Direktur' => new Phalcon\Acl\Role('directors'),
		'Koordinator Track' => new Phalcon\Acl\Role('trackCoordinators'),
                'Koordinator Wilayah' => new Phalcon\Acl\Role('regionCoordinators'),
		'guests' => new Phalcon\Acl\Role('guests'),
                'Tutor' => new Phalcon\Acl\Role('tutors'),
				'Talent' => new Phalcon\Acl\Role('talents'),
			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			//Direktur resources
			$directorResources = array(
				'city' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				'personnel' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				'skill' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				'track' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				// 'session' => array('logout'),
				'manager' => array('logout','login'),
                                'managerial' => array('index','dashboard','city','track','personnel','skill'),
			);
			
			foreach ($directorResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
			
			//Koordinator Track resources
			$trackCoordResources = array(
				'course' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				'courseclass' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
                                'managerial' => array('dashboard'),
				);
			
			foreach ($trackCoordResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
                        
                        //Koordinator Track resources
			$regionCoordResources = array(
				'course' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
				'courseclass' => array('index', 'new', 'add', 'edit', 'update', 'remove'),
                                'managerial' => array('dashboard'),
				);
			
			foreach ($regionCoordResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
                        
                        
            //Talent resources
			$talentResources = array(
				'talent' => array('index', 'dashboard', 'edit', 'update', 'education', 'addEducation', 'saveEducation', 'editEducation', 'updateEducation', 'removeEducation', 'job', 
				'addJob', 'saveJob', 'editJob', 'updateJob', 'removeJob', 'certificate', 'addCertificate', 'editCertificate', 'saveCertificate', 'updateCertificate', 
				'removeCertificate', 'skill', 'addSkill', 'editSkill', 'saveSkill', 'updateSkill', 'removeSkill', 'training', 'addTraining', 'editTraining', 'saveTraining', 
				'updateTraining', 'removeTraining'),
				'team' => array('index', 'dashboardTeam', 'activeTeam', 'createTeam', 'saveTeam', 'editTeam', 'updateTeam', 'notification', 'acceptInvitation', 'rejectInvitation', 
				'resignTeam', 'kickMember', 'inviteMember', 'inviteTalent', 'cancelInvitation', 'sendInvitation', 'profileTalent'),
				'login' => array('logout'),
				'talentclass' => array ('index','new','apply','resign','cancel'),
                                
				);
			
			foreach ($talentResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
            
			//Public area resources
			$publicResources = array(
				'index' => array('index'),
				'register' => array('index'),
				// 'session' => array('index', 'login', 'logout'),
				'manager' => array('index', 'login', 'logout'),
				'login' => array('index', 'login', 'logout'),
                                'teamclass' => array('index'),
				 
			);
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Grant access to public areas to all roles
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					$acl->allow($role->getName(), $resource, '*');
				}
			}

			//Grant acsess Director area to role Director
			foreach ($directorResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('directors', $resource, $action);
				}
			}
			
			//Grant access Track Coordinator area to role trackCoordinator
			foreach ($trackCoordResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('trackCoordinators', $resource, $action);
				}
			}
                        
                        //Grant access Track Coordinator area to role trackCoordinator
			foreach ($regionCoordResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('regionCoordinators', $resource, $action);
				}
			}
                        
                        //Grant acsess talent area to role talent
			foreach ($talentResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('talents', $resource, $action);
				}
			}
			           
			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		
		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher){

		$auth = $this->session->get('auth');
                // $role = $auth['role'];
		
		if (!$auth){
			$role = 'guests';
		} else if('Talent' === $auth['role']){
			$role = 'talents';
		} else if('Direktur' === $auth['role']){
			$role = 'directors';
		} else if('Koordinator Track' === $auth['role']){
			$role = 'trackCoordinators';
		} else if('Koordinator Wilayah' === $auth['role']){
			$role = 'regionCoordinators';
		} else if('Tutor' === $auth['role']){
			$role = 'Tutor';
		}
		
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		$allowed = $acl->isAllowed($role, $controller, $action);
		if ($allowed != Acl::ALLOW) {
			//$this->flash->error("You're not allowed to access this resource");
			if($role == 'guests'){
				$dispatcher->forward(
				array(
					'controller' => 'index',
					'action' => 'index'
				)
			);	
			} else if($role == 'directors' || $role == 'trackCoordinators' || $role == 'regionCoordinators'){ //dispatch to director page
				$dispatcher->forward(
				array(
					'controller' => 'managerial',
					'action' => 'dashboard'
				)
			);	/*
			} else if($role == 'trackCoordinators'){// Dispatch to Track Coordinator page	
			$dispatcher->forward(
				array(
					'controller' => 'adminDashboard',
					'action' => 'index'
				)
			);*/
            } else if($role == 'talents'){// Dispatch to Talent page		
			$dispatcher->forward(
				array(
					'controller' => 'talent',
					'action' => 'dashboard'
				)
			);
            } 
			return false;
		}
	}
}
