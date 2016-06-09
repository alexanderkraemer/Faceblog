<?php

    class Logout extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }

        function index ()
        {
            Session::stop_session ();
            Tools::redirect ( '/login' );
        }
    }