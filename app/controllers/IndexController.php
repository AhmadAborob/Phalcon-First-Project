<?php
use \Phalcon\Tag;
class IndexController extends ControllerBase
{

    public function onConstruct(){
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle("Home");
    }

    public function signoutAction(){
        $this->session->destroy();
        $this->response->redirect('/xampp/phalcon-learning');
    }

    public function generatePasswordAction($password){
        echo $this->security->hash($password);
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

