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
        /* if(version_compare(phpversion(),'5.4.0','<'))
         {
             if(session_id()=='')
             {
                 session_start();
             }
             else
             {
                 if(session_status()== PHP_SESSION_NONE)
                 {
                     session_start();
                 }
             }
         }*/
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
            header("Location: index.php"); //login.php to index.php
        }
    }

    public static function checkLogin()
    {
        if (self::get("login") == true) {
            header("Location: index.php");
        }
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
        header("Location: index.php"); //login.php to index.php
    }

}

?>