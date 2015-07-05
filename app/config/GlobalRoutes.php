<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 02/07/15
 * Time: 14:32
 */

class GlobalRoutes extends \Phalcon\Mvc\Router\Group{

    public function initialize(){
        $this->add('/superhero/jump',[
            'controller'=> 'test',
            'action'=>'jump'
        ]);
    }
}