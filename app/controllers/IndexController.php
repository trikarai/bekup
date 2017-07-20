<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
		//echo "INDEX";
        $message = Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->view->message = $message;
    }
	public function error404Action(){
		
	}

}

