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
    public function onConstruct(){
        parent::initialize();
    }

    public function indexAction(){
        Tag::setTitle("Admin");
    }
}

