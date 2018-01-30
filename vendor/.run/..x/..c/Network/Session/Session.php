<?php
/**
 * Codefii PHP Framework https://codefii.com
 *
 * @link       https://github.com/codefii/codefiiphp
 * @author     Prince Ekemini Darlington <ekeminyd@gmail.com>
 * @copyright  Copyright (c) 2K18 Soodarsoft Inc. (http://soodarsoft.com)
 * @license    https://codefii.com/license    MIT
 */
namespace Network\Session;
class Session
  {
    private static $_started = false;
    public static function exists($name)
    {
      return (isset($_SESSION[$name])) ? true : false;
    }

    public static function set($name,$value)
    {
      $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
      if(isset($_SESSION[$name]))
        return $_SESSION[$name];
      else
      return false;

    }
 
    public static function flash($name,$string='')
    {
      if(self::exists($name))
      {
        $session = self::get($name);
        self::delete($name);
        return $session;
      }
      else {
        self::put($name,$string);
      }
      return '';
    }
    public static function startSession()
    {

      session_start();
      self::$_started = true;
    }

}
