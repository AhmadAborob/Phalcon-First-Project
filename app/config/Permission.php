<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 05/07/15
 * Time: 16:25
 */

use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Events\Event;
use \Phalcon\Acl;

class Permission extends \Phalcon\Mvc\User\Plugin {

    /**
     * Constants to prevent a typo
     * */
    const GUEST='guest';
    const USER='user';
    const ADMIN='admin';

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

    public function beforeExecuteRoute(Event $event,Dispatcher $dispatcher){
        //return;
        //$this->session->destroy();

        $role=$this->session->get('role');
        if(!$role){
            $role=self::GUEST;
        }

        //Get the current Controller & Action from the dispatcher
        $controller=$dispatcher->getControllerName();
        $action=$dispatcher->getActionName();

        //Get the ACL rule list
        $acl=$this->_getAcl();

        //See if they have permission
        $allowed=$acl->isAllowed($role, $controller,$action);
        if($allowed!=Acl::ALLOW){
            $this->flash->error('You Don\'t Have Permission To Access This Area');
            $this->response->redirect('index');

            //Stops the dispatcher at current operation
            return false;
        }
    }

    protected function _getAcl(){
        if(!isset($this->persistent->acl)){
            $acl=new Acl\Adapter\Memory();
            $acl->setDefaultAction(Acl::DENY);

            $roles=[
                self::GUEST => new Acl\Role(self::GUEST),
                self::USER => new Acl\Role(self::USER),
                self::ADMIN => new Acl\Role(self::ADMIN)
            ];

            foreach($roles as $role){
                $acl->addRole($role);
            }
            //Public Resources
            foreach($this->_publicResources as $resource => $action){
                $acl->addResource(new Acl\Resource($resource),$action);
            }
            //User Resources
            foreach($this->_userResources as $resource => $action){
                $acl->addResource(new Acl\Resource($resource),$action);
            }
            //Admin Resources
            foreach($this->_adminResources as $resource => $action){
                $acl->addResource(new Acl\Resource($resource),$action);
            }
            //Allow all resources to access the Public Resources
            foreach($roles as $role){
                foreach($this->_publicResources as $resource=> $action){
                    $acl->allow($role->getName(), $resource,'*');
                }
            }
            //Allow User and Admin to access the User Resources
            foreach($this->_userResources as $resource => $actions){
                foreach($actions as $action){
                    $acl->allow(self::USER,$resource,$action);
                    $acl->allow(self::ADMIN,$resource,$action);
                }
            }
            //Allow admin to access the Admin Resources
            foreach($this->_adminResources as $resource => $actions){
                foreach($actions as $action){
                    $acl->allow(self::ADMIN,$resource,$action);
                }
            }

            $this->persistent->acl=$acl;
        }

        return $this->persistent->acl;
    }
}