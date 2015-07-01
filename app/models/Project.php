<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 01/07/15
 * Time: 14:49
 */

class Project extends BaseModel {

    public function initialize(){

        $this->belongsTo('user_id','User','id');
    }

}