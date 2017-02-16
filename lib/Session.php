<?php

/**
 * Created by PhpStorm.
 * User: Rakib
 * Date: 12-Jan-17
 * Time: 5:44 PM
 */
class Session
{
    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else
            return false;
    }

    public static function checkSession()
    {
        if (self::get("login") == false) {
            self::destroy();
            //header("Location: index.php"); //login.php to index.php
        }
    }

    public static function checkLogin()
    {
        if (self::get("login") == true) {
            header("Location: userhome.php");
        }
    }
    public static function checkRegister()
    {
        if (self::get("register") == true)
            header("Location: userhome.php");
        //echo "YOo";
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
        header("Location: userhome.php"); //login.php to index.php
    }


}

?>
