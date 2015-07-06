<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 01/07/15
 * Time: 14:48
 */

use \Phalcon\Mvc\Model\Validator;
use \Phalcon\Security;

class User extends BaseModel {

    public function initialize(){

        $this->hasMany('id','Project','user_id');
    }

    public function validation(){
        $this->validate(new Validator\Email([
            'field'=>'email',
            'message'=>'Your Email Is Invalid !'
        ]));
        $this->validate(new Validator\Uniqueness([
            'field'=>'email',
            'message'=>'Your Email Is In Use !'
        ]));
        $this->validate(new Validator\StringLength([
            'field'=>'password',
            'max'=>'30',
            'min'=>'4',
            'messageMaximum'=>'Your Password Must be Under 30 Characters',
            'messageMinimum'=>'Your Password Must be At Least 4 Characters'
        ]));

        if($this->validationHasFailed()){
            return false;
        }

        $security=new Security();
        $this->password=$security->hash($this->password);
    }

}