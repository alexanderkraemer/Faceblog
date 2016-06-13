<?php
    
    class Login extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }
        
        public function index ()
        {
            if ( !empty($_POST) )
            {
                if ( $user = $this->authenticate ( $_POST ) )
                {
                    $_SESSION[ 'user_id' ] = $user->id;
                    
                    Tools::redirect ( '/' );
                }
                $message = 'These credentials do not match our records.';
            }
            $this->page->view ( 'auth/login', compact ( 'message' ) );
        }
        
        private function authenticate ( $post )
        {
            $usernameEntered = $post[ 'username' ];
            $passwordEntered = $post[ 'password' ];
            
            // return false if user not found, and return object of user, if found
            if ( $user = User::findOrFailWhere ( 'name = ?', [ $usernameEntered ] ) )
            {
                if ( password_verify ( $passwordEntered, $user->password ) )
                {
                    return $user;
                }
                
                return false;
            }
            return false;
        }
    }