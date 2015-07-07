<?php

use Phalcon\Tag;

class SigninController extends ControllerBase
{
    public function onConstruct(){
        parent::initialize();
    }

    public function indexAction(){
        Tag::setTitle("Signin");
        $this->assets->collection("additional")->addCss("css/signin.css");
    }

    public function doSigninAction(){

        $this->view->disable();

        $this->component->helper->csrf('/xampp/phalcon-learning/signin');

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByEmail($email);
        if ($user) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->component->user->createSession($user);
                $this->response->redirect('/xampp/phalcon-learning/dashboard');
                return;
            }
        }

        $this->flash->error('Incorrect Credentials');
        $this->response->redirect('/xampp/phalcon-learning/signin');
        //$this->response->redirect('signin/index');
    }

    public function registerAction(){
        Tag::setTitle('Register');
        $this->assets->collection("additional")->addCss("/xampp/phalcon-learning/css/signin.css");
    }

    public function doRegisterAction(){
        if($this->security->checkToken()==false) {
            $this->flash->error('Invalid CSRF Token');
            $this->response->redirect('/xampp/phalcon-learning/signin/register');
            return;
        }

        $this->view->disable();

        $email=$this->request->getPost('email');
        $password=$this->request->getPost('password');
        $confirm_password=$this->request->getPost('confirm_password');

        if($password != $confirm_password){
            $this->flash->error("The Password Does not Match !");
            $this->response->redirect('/xampp/phalcon-learning/signin/register');
            return;
        }

        $user= new User();
        $user->role='user';
        $user->email=$email;
        $user->password=$password;
        $result=$user->save();

        if(!$result){
            $output=[];
            foreach($user->getMessages() as $message){
                $output[]=$message;
            }
            $output=implode(',',$output);
            $this->flash->error($output);
            $this->response->redirect('/xampp/phalcon-learning/signin/register');
            return;
        }
        $this->_createUserSession($user);
        return;
    }
}

