<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 05/07/15
 * Time: 17:47
 */
use Phalcon\Tag;

class AdminController extends ControllerBase
{
    public function indexAction(){
        Tag::setTitle("Admin");
        parent::initialize();
        echo 1;
        die;
    }
}

