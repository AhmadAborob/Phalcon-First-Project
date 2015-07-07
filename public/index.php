<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    //Autoloader
    $loader=new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers',
        '../app/models',
        '../app/config'
    ]);

    $loader->registerClasses([
        'Component\User'=>'../app/components/User.php',
        'Component\Helper'=>'../app/components/Helper.php',
    ]);

    $loader->register();

    //Dependency Injection
    $di=new \Phalcon\Di\FactoryDefault();

    //Set Base URL
    $di->set('url', function() {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('');
        return $url;
    }, true);

    //Database
    $di->set('db',function(){
        $db=new \Phalcon\Db\Adapter\Pdo\Mysql([
            'host'=>'localhost',
            'username'=>'root',
            'password'=>'',
            'dbname'=>'phalcon-learning'
        ]);
        return $db;
    });

    //Load Views
    $di->set('view',function(){
        $view=new \Phalcon\Mvc\View();
        $view->setViewsDir('../app/views');
        $view->registerEngines([
            '.volt'=> 'Phalcon\Mvc\View\Engine\Volt'
        ]);
        return $view;
    });

    //Router
    $di->set('router', function(){
        $router =new \Phalcon\Mvc\Router();
        $router->mount(new GlobalRoutes());
        return $router;
    });

    //Session
    $di->setShared('session', function(){
        $session=new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });

    $di->setShared('component',function(){
        $obj=new stdClass();
        $obj->helper= new \Component\Helper();
        $obj->user=new \Component\User();
        return $obj;
    });

    $di->set('flash',function(){
        $flash=new \Phalcon\Flash\Session([
            'error'=>'alert alert-danger',
            'success'=>'alert alert-success',
            'notice'=>'alert alert-info',
            'warning'=>'alert alert-warning'
        ]);
        return $flash;
    });

    //Meta-Data
    $di['modelsMetadata']=function(){
        $metaData=new \Phalcon\Mvc\Model\MetaData\Memory([
            'lifetime'=>86400,
            'prefix'=>'metaData'
        ]);

        return $metaData;
    };

    //Custom Dispatcher (Override the default)
    $di->set('dispatcher',function() use ($di){
        $eventsManager=$di->getShared('eventsManager');

        //Custom ACL Class
        $permission=new Permission();

        //Listen for events from permission class
        $eventsManager->attach('dispatch', $permission);

        $dispatcher=new Phalcon\Mvc\Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;


    });

    //Deploy the App
    $app=new \Phalcon\Mvc\Application($di);
    echo $app->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
