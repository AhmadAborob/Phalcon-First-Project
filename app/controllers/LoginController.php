<?php

class LoginController extends \Phalcon\Mvc\Controller
{

    public function initialize(){

    }

    public function indexAction(){
        echo "Login!";
    }

    public function processAction( $username=false, $age=12){

        $this->view->setVar('username',$username);
        $this->view->setVar('age',$age);

    }
}

