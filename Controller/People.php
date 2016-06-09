<?php

    class People extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }

        public function index ()
        {
            $users = User::all ();
            $this->page->view ( 'people/list', compact ( 'users' ) );
        }

        public function search ()
        {
            $searchstring = $_POST[ 'searchinput' ];
            if ( !empty($searchstring) )
            {
                Tools::redirect ( '/people/search/' . $searchstring );
            }
            else
            {
                Tools::redirect ( '/people' );
            }
        }

        public function result ( $searchstring )
        {
            
            $users =
                User::where ( 'name LIKE ? OR first_name LIKE ? 
                               OR last_name LIKE ?',
                              [
                                  '%' . $searchstring . '%',
                                  '%' . $searchstring . '%',
                                  '%' . $searchstring . '%'
                              ] );

            $this->page->view ( 'people/list',
                                compact ( 'users', 'searchstring' ) );
        }
    }