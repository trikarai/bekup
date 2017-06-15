<?php

class ManagerialController extends ManagerialControllerBase {

	public function dashboardAction(){
            $this->view->rolebekup = $this->session->get('auth')['role'];
	}
}