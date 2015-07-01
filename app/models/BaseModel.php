<?php
/**
 * Created by PhpStorm.
 * User: aaborob
 * Date: 01/07/15
 * Time: 15:49
 */

class BaseModel extends \Phalcon\Mvc\Model {

    public function initialize(){

    }

    public function beforeCreate(){

        $this->created_at=date('Y-m-d H:i:s');
    }

    public function beforeUpdate(){

        $this->updated_at=date('Y-m-d H:i:s');
    }

}