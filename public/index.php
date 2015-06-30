<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    //Autoloader
    $loader=new \Phalcon\Loader();
    $loader->registerDirs([
        '../app/controllers',
        '../app/models'
    ]);
    $loader->register();

    //Dependency Injection
    $di=new \Phalcon\Di\FactoryDefault();
    $di->set('view',function(){
        $view=new \Phalcon\Mvc\View();
        $view->setViewsDir('../views');
        return $view;
    });

    //Deploy the App
    $app=new \Phalcon\Mvc\Application($di);
    echo $app->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
