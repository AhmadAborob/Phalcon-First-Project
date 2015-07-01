<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 01/07/15
 * Time: 14:50
 */

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->setVars([
            'single' => User::findFirstById(1),
            'all'=>User::find()
        ]);

    }

    public function createAction(){
        $user=new User();
        $user->email='test@test.com';
        $user->password='test';
        $result=$user->save();
        if(!$result){
            print_r($user->getMessages());
        }
    }

    public function createAssocAction(){
        $user=User::findFirst(1);
        $project=new Project();
        $project->title='AHMAAAAAAD';
        $project->user=$user;
        $result=$project->save();
    }

    public function updateAction(){
        $user=User::findFirstById(4);
        if(!$user){
            echo 'User Doesn\'t Exist';
            die;
        }

        $user->email='updated@test.com';
        $result=$user->save();
        if(!$result){
            print_r($user->getMessages());
        }
    }

    public function deleteAction(){

        $user=User::findFirstById(3);
        if(!$user){
            echo 'User Doesn\'t Exist';
            die;
        }
        $user->delete();

    }
}
