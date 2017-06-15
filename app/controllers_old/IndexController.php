<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $message = Ramsey\Uuid\Uuid::uuid4()->toString();
        $this->view->message = $message;
    }

}

