<?php
// Session Variable: userLogin, userId, userName
//                    Boolean     int    varchar
// Session class
class Session{
    
    public static function init(){
        session_start();
    }   // Start a new session

    public static function set($key, $val){
        $_SESSION[$key] = $val;
        // Create a Session Variable
    }

    public static function get($key){
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }else{ return FALSE;}
    }   // Read a Session Variable

    public static function checkLogin(){
        self::init(); // start new session
        if (self::get("adminLogin") == TRUE ) {
            header('location: dashboard.php');
            exit();
        } // if already login in -> send to dashboard.php
    }

    public static function checkSession(){
        self::init();
        if (self::get("adminLogin") == FALSE ){
            self::destroy();
            header('location: login.php');
            exit();
        } // if !logged in -> send to login.php
    }

    public static function destroy(){
        session_destroy();
        header('location: login.php');
        exit();
    } // end session and destroy sessionrecord on server
}
