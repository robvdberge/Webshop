<?php
// Session class
class Session{
    
    public static function init(){
        session_start();
    }

    public static function set($key, $val){
        $_SESSION[$key] = $val;
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else{ return FALSE;}
    }

    public static function checkLogin(){
        self::init();
        if (self::get("adminLogin") == TRUE ) {
            header('location: dashboard.php');
            exit();
        }
    }

    public static function checkSession(){
        self::init();
        if (self::get("adminLogin") == FALSE ){
            self::destroy();
            header('location: login.php');
            exit();
        }
    }

    public static function destroy(){
        session_destroy();
        header('location: login.php');
        exit();
    }
}
