<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 01/07/15
 * Time: 14:48
 */

class User extends BaseModel {

    public function initialize(){

        $this->hasMany('id','Project','user_id');
    }

}