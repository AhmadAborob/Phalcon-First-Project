<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 07/07/15
 * Time: 13:34
 */

namespace Component;

class User extends \Phalcon\Mvc\User\Component {

    public function createSession(\User $user){
        $this->session->set('id',$user->id);
        $this->session->set('role',$user->role);
    }

}