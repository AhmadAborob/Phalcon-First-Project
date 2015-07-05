<?php
use \Phalcon\Tag;
class IndexController extends ControllerBase
{

    public function indexAction()
    {
        Tag::setTitle("Home");
        parent::initialize();
    }

    public function startSessionAction(){

        $this->session->set('user',[
            'name'=>'Ahmad',
            'age'=>'20',
            'soOn'=>'bla bla'
        ]);
    }

    public function getSessionAction(){

        echo $this->session->get('name');
    }

    public function removeSessionAction(){

        echo $this->session->remove('name');
    }

    public function destroySessionAction(){

        echo $this->session->destroy();
    }

}

