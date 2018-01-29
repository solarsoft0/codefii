<?php

namespace Codefii\Models;
use Network\Model\Model;
class UserModel extends Model {
  public static function getUser($username){

    return self::getDb()->find('users',array(
      "username","=","{$username}"
    ));
  }
  public static function findById($id){
      // $db = Model::getDb();
      return self::getDb()->find('users',array(
        "id","=","{$id}"
      ));

  }
  public static function getby(){
    return self::getDb()->hasMany(array("users","comments"),5);
  }
}
