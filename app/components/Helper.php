<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 07/07/15
 * Time: 13:34
 */

namespace Component;

class Helper extends \Phalcon\Mvc\User\Component {

    public function csrf($redirect = false){
        if($this->security->checkToken()==false){
            $this->flash->error('Invalid CSRF Token');
            if($redirect) {
                $this->response->redirect('/xampp/phalcon-learning/signin');
            }
            return;
        }
    }
}