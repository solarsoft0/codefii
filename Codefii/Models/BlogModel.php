<?php

namespace Codefii\Models;
use Libraries\Auth\Auth;
use Network\Model\Model;
use Network\Hash\Hash;
class BlogModel extends Model {
    public static function createPost($title,$body){
    // $add =
    $auth = new Auth();
    Model::getDb()->create('blog',array(
    'title'=>$title,
    'body'=>$body
    ));
    }
    public static function viewPosts()
    {
    return Model::getDb()->query("SELECT * FROM blog");
    }
    public static function viewComments(){
     return Model::getDb()->query("SELECT * FROM blog LEFT JOIN comments
    ON blog.id=comments.blogid");
    }
    public static function getById($id){
     return Model::getDb()->get('blog',array(
            "id","=","{$id}"
        ));
    }
    public function deletePosts($id){
    return Model::getDb()->delete('blog',array(
        "id","=","{$id}"
    ));

    }
      public function updatePosts($f1,$f2,$id){
    return Model::getDb()->update('blog',$id,array(
        'title'=>$f1,
        'body'=>$f2
    ));

    }
     public static function addComments($body,$id){
    // $add =
    $auth = new Auth();
    Model::getDb()->create('comments',array(
    'comment'=>$body,
    'blogid'=>$id
    ));
    }

    public static function addUser($username,$role,$password){
        $auth = new Auth();
        $salt = Hash::salt(10);
        Model::getDb()->create('users',array(
        'username'=>$username,
        'password'=>Hash::make($password,$salt),
        'salt'=>$salt,
        'role'=>$role
        ));
    }
    public static function logUserIn($username,$password){
        $login  = new Auth();

        $login->login($username,$password);
        Model::getDb()->get('users',array(
            "username","=","{$username}",
            "password",

        ));
    }
}
