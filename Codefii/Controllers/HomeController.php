<?php
namespace Codefii\Controllers;
use Network\Controller\Controller;
use Network\View\View;
use Network\Error\GeneralError;
use Codefii\Models\BlogModel;
use Network\Request\Request;
use Network\Location\Redirect;
use Network\Token\Token;
use Network\Validation\Validation;
use Network\Auth\Login;
use Network\Session\Session;
use Codefii\Database\Config\Config;
use Codefii\Models\UserModel;
use Network\Model\Model;
class HomeController extends Controller {
  public $session;
  public $pages = array(
    "index"=>"Welcome to my blog",
    "create"=>"Create a blog posts",
    "view"=>"View blog post"
  );
  public function index(){
    GeneralError::getWhiteScreenError();
    $posts = BlogModel::viewPosts()->results();
    $comments = BlogModel::viewComments()->results();
    if(Session::exists('name')){

        $user = UserModel::getUser(Session::get('name'))->results();
    }

    View::render('Home/index',
    ['index'=>$this->pages['index']]);
    View::render('header/header');
    View::render('body/indexbody',['posts'=>$posts,'comments'=>
    $comments,'user'=>$user]);
    View::render('footer/footer');

  }
  public function createPosts(){
  $f = UserModel::getby()->results();
  foreach($f as $ff){
    echo $ff->username;
  }
    if(Request::exists()){
       $title = Request::get('title');
       $body = Request::get('body');
      try{
        BlogModel::createPost($title,$body);
       throw new RuntimeException();
      }catch(LogicException $e){
        die($e->getMessage());
      }finally{
        Redirect::to('/new-framework');
      }





    }
    View::render('body/indexbody');
        View::render('Home/create',['create'=>$this->pages['create']]);
    View::render('footer/footer');
  }
  public function viewPosts()
  {
   $data = BlogModel::getById($this->route_params['id'])->results();
   View::render('Home/view',['datas'=>$data]);
  }

  public function deletePosts(){
    try{
      BlogModel::deletePosts($this->route_params['id']);
      throw new RuntimeException();
    }catch(LogicException $e){
      die($e->getMessage());
    }
    finally{
      Redirect::to('/new-framework');
    }
  }
  public function updatePosts(){

    if(Request::exists()){
      $title =Request::get('title');
      $body = Request::get('body');
      $id = $this->route_params['id'];
      echo"<script>alert('$body');</script>";
       try{
      BlogModel::updatePosts($title,$body,$id);
      throw new RuntimeException();
    }catch(LogicException $e){
      die($e->getMessage());
    }
    finally{
      Redirect::to('/new-framework');
    }
    }
    View::render('Home/update');
  }

  public function commentposts(){
    if(Request::exists()){
      if($this->route_params['id']){
        $id = $this->route_params['id'];
           try{
      BlogModel::addComments(Request::get('comment'),$id);
      throw new RuntimeException();
    }catch(LogicException $e){
      die($e->getMessage());
    }
    finally{
      Redirect::to('/new-framework');
    }
      }
    }
    View::render('Home/comment');
  }
  public function createUser()
  {
   if(Request::exists()){

      $username = Request::get('username');
      $role = Request::get('role');
      $password = Request::get('password');

      try{
        BlogModel::addUser($username,$role,$password);
       throw new RuntimeException();
      }catch(LogicException $e){
        die($e->getMessage());
      }finally{
        Redirect::to('/new-framework/login');
      }


    // echo"<script>alert('$password');</script>";


   }
    View::render('Home/register',['errors'=>$errors]);
  }
  public function login(){
    if(Request::exists()){

      $username = Request::get('username');

      if(Login::process(Request::get('username'),Request::get('password'))==true){
        Session::startSession();
        Session::set('name',Request::get('username'));
        Redirect::to('/new-framework');
      }

    }
    View::render('Home/login');
  }
  public function allusers(){

  }

}
