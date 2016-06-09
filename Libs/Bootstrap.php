<?php

    class Bootstrap
    {
        public $parameter = [ ];

        public static function getUrl ()
        {
            $urlnew = $_SERVER[ 'REQUEST_URI' ];

            // if directory is given in index.php, remove it from request_uri
            if ( substr ( $urlnew, 0, strlen ( DIR ) ) === DIR )
            {
                $urlnew = substr ( $urlnew, strlen ( DIR ) );
            }


            $urlnew = rtrim ( $urlnew, '/' );
            $urlnew = ltrim ( $urlnew, '/' );
            $urlnew = '/' . $urlnew;

            // remove all illegal characters from url
            $urlnew = filter_var ( $urlnew, FILTER_SANITIZE_URL );

            return $urlnew;
        }

        public function init ()
        {
            Session::start_session ();

            $route = new RouteList();

            require_once __DIR__ . '/../routes.php';

            $router = new Router( $route->getRoutes () );

            $router->route ( $this->getUrl () );
        }
    }