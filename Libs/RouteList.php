<?php

    class RouteList
    {
        private $routeArray;
        
        public function __construct ()
        {
            // default routes for error handling
            $this->add ( 'noroute', 'Error@route' );
            $this->add ( 'nocontroller', 'Error@controller' );
            $this->add ( 'nomethod', 'Error@method' );
            $this->add ( '404', 'Error@viernullvier' );
        }

        public function add ( $url, $controllerAction )
        {
            $url                      = ltrim ( $url, '/' );
            $url                      = '/' . $url;
            $this->routeArray[ $url ] = new Route( $url, $controllerAction );
        }

        public function getRoute ( $key )
        {
            return $this->routeArray[ $key ];
        }

        public function getRoutes ()
        {
            return $this->routeArray;
        }
    }