<?php
use Phalcon\Tag;

/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 06/07/15
 * Time: 14:49
 */

class DashboardController extends ControllerBase {

    public function onConstruct(){
        parent::initialize();
    }

    public function indexAction(){
        Tag::setTitle("Dashboard");
    }
}