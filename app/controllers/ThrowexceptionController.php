<?php

use Resources\Exception\CustomException;

class ThrowexceptionController extends ControllerBase{
    function indexAction(){
        throw new CustomException("custom exception");
    }
}
