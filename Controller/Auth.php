<?php
    class Auth
    {
        public static function isAuthenticated ()
        {
            if(!isset($_SESSION['user_id']))
            {
                return false;
            }
            return true;
        }

        public static function user ()
        {
            return User::find ( $_SESSION[ 'user_id' ] );
        }
    }