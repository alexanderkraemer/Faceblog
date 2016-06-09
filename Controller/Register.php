<?php

    class Register extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }

        public function register ()
        {
            if ( !empty($_POST) )
            {
                $errorArr = $this->checkValid ( $_POST );
                
                if ( empty($errorArr) )
                {
                    $user             = new User();
                    $user->name       = $_POST[ 'username' ];
                    $user->first_name = $_POST[ 'last_name' ];
                    $user->last_name  = $_POST[ 'last_name' ];
                    $user->email      = $_POST[ 'email' ];
                    $user->password   = Tools::bcrypt ( $_POST[ 'password' ] );
                    $userId           = $user->save ();
                    echo $user->password;
                    $_SESSION[ 'user_id' ] = $userId;

                    Tools::redirect ( '/' );
                }
                else
                {
                    $this->page->view ( 'auth/register', compact ( 'errorArr' ) );
                }
            }
            else
            {
                $errorArr = [ ];
                $this->page->view ( 'auth/register', compact ( 'errorArr' ) );
            }
        }

        public function checkValid ( $post )
        {
            $errorArr = [ ];
            // check if First Name and Last Name and
            // Username have at least 3 characters
            if ( strlen ( $post[ 'first_name' ] ) < 3 )
            {
                $errorArr[] = 'first_name_strlen';
            }
            if ( strlen ( $post[ 'last_name' ] ) < 3 )
            {
                $errorArr[] = 'last_name_strlen';
            }
            if ( strlen ( $post[ 'username' ] ) < 3 )
            {
                $errorArr[] = 'username_strlen';
            }

            // check if username exists
            if ( User::findOrFailWhere ( "name = ?", [ $post[ 'username' ] ] ) )
            {
                $errorArr[] = 'username_exists';
            }

            // check if password has more than 6 characters
            if ( strlen ( $post[ 'password' ] ) < 6 )
            {
                $errorArr[] = 'password_strlen';
            }

            // check if passwords match
            if ( $post[ 'password' ] !== $post[ 'password_confirmation' ] )
            {
                $errorArr[] = 'password_match';
            }

            // check if email is not taken
            if ( User::findOrFailWhere ( "email = ?", [ $post[ 'email' ] ] ) )
            {
                $errorArr[] = 'email_exists';
            }

            return $errorArr;
        }
    }