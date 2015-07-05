<?php

use Phalcon\Tag;

class SigninController extends ControllerBase
{
    public function indexAction(){
        Tag::setTitle("Signin");
        $this->assets->collection("additional")->addCss("css/signin.css");
        parent::initialize();
    }
}

