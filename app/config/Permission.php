<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 05/07/15
 * Time: 16:25
 */

use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Events\Event;

class Permission extends \Phalcon\Mvc\User\Plugin {

    protected $_publicResources=[
        'index'=>'*',
        'signin'=>'*'
    ];

    protected $_userResources=[
        'dashboard'=>['*']
    ];

    protected $_adminResources=[
        'admin'=>['*']
    ];

    protected function _getAcl(){
        if(!isset($this->persistent->acl)){
            $acl=new \Phalcon\Acl\Adapter\Memory();
            $acl->setDefaultAction(\Phalcon\Acl::DENY);

            $roles=[
                'guest' => new \Phalcon\Acl\Role("guest"),
                'user' => new \Phalcon\Acl\Role("user"),
                'admin' => new \Phalcon\Acl\Role("admin")
            ];

            foreach($roles as $role){
                $acl->addRole($role);
            }
            //Public Resources
            foreach($this->_publicResources as $resource => $action){
                $acl->addResource(new \Phalcon\Acl\Resource($resource),$action);
            }
            //User Resources
            foreach($this->_userResources as $resource => $action){
                $acl->addResource(new \Phalcon\Acl\Resource($resource),$action);
            }
            //Admin Resources
            foreach($this->_adminResources as $resource => $action){
                $acl->addResource(new \Phalcon\Acl\Resource($resource),$action);
            }
            //Allow all resources to access the Public Resources
            foreach($roles as $role){
                foreach($this->_publicResources as $resource=> $actions){
                    $acl->allow($role->getName(), $resource,'*');
                }
            }
            //Allow User and Admin to access the User Resources
            foreach($this->_userResources as $resource => $actions){
                foreach($actions as $action){
                    $acl->allow("user",$resource,$action);
                    $acl->allow("admin",$resource,$action);
                }
            }
            //Allow admin to access the Admin Resources
            foreach($this->_adminResources as $resource => $actions){
                foreach($actions as $action){
                    $acl->allow("admin",$resource,$action);
                }
            }

            $this->persistent->acl=$acl;
        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher){
        //return;
        $role=$this->session->get('role');
        if(!$role){
            $role='guest';
        }

        //Get the current Controller & Action from the dispatcher
        $controller=$dispatcher->getControllerName();
        $action=$dispatcher->getActionName();

        //Get the ACL rule list
        $acl=$this->_getAcl();

        //See if they have permission
        $allowed=$acl->isAllowed($role, $controller,$action);
        if($allowed!=\Phalcon\Acl::ALLOW){
            $dispatcher->forward([
                'controller'=>'index',
                'action'=>'index'
            ]);
            //Stops the dispatcher at current operation
            return false;
        }
    }
}