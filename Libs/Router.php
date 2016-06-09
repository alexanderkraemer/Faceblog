<?php

    class Router
    {
        private $route;
        private $routeArr;

        //singelton
        public function __construct ( $routelist )
        {
            $this->routeArr = $routelist;
        }

        function callMethod ( $method )
        {
            return function ( $obj ) use ( $method )
            {
                return $obj->{$method}();
            };
        }

        function routeExists ( $route )
        {
            // If the route is only /
            // was not possible with other function,
            // because of exploding by string '/'
            if ( key_exists ( $route, $this->routeArr ) )
            {
                return $route;
            }

            // if not found yet, there are parameters in the URL
            // which have to be verified with the routes list
            $allRoutes = [ ];
            foreach ( $this->routeArr as $key => $value )
            {
                if ( strlen ( $key ) !== 1 && $key !== '/' )
                {
                    $allRoutes[] = explode ( '/', ltrim ( $key, '/' ) );
                }
                else
                {
                    $allRoutes[] = $key;
                }
            }

            if ( strlen ( $route ) !== 1 && $route !== '/' )
            {
                $curRoute = explode ( '/', ltrim ( $route, '/' ) );
            }
            else
            {
                $curRoute = $route;
            }

            $selectedRoutes = [ ];
            for ( $i = 0; $i < count ( $allRoutes ); ++$i )
            {
                if ( count ( $allRoutes[ $i ] ) === count ( $curRoute ) )
                {
                    $selectedRoutes[] = $allRoutes[ $i ];
                }
            }
            foreach ( $selectedRoutes as $selRoute )
            {
                $resArr = [ ];
                for ( $i = 0; $i < count ( $selRoute ); ++$i )
                {

                    // if route paths are the same or selected has {} in it
                    if ( $selRoute[ $i ] == $curRoute[ $i ]
                         || ((strpos ( $selRoute[ $i ], '{' ) !== false)
                             && (strpos ( $selRoute[ $i ], '}' ) !== false))
                    )
                    {
                        $resArr[] = true;
                    }
                    else
                    {
                        $resArr[] = false;
                    }
                }

                if ( !in_array ( false, $resArr ) )
                {
                    return implode ( '/', $selRoute );
                }
            }

            return false;
        }

        private function getParamsFromRoute ( $route, $usedRoute )
        {
            $currRouteArr = [ ];
            foreach ( explode ( '/', $route ) as $key )
            {
                $currRouteArr[] = $key;
            }

            $usedRouteArr = [ ];
            foreach ( explode ( '/', $usedRoute ) as $key )
            {
                $usedRouteArr[] = $key;
            }

            $i      = 0;
            $varArr = [ ];
            foreach ( $usedRouteArr as $used )
            {
                if ( strpos ( $used, '{' ) === 0 )
                {
                    $varname            = ltrim ( $used, '{' );
                    $varname            = rtrim ( $varname, '}' );
                    $varArr[ $varname ] = $currRouteArr[ $i ];
                }
                $i++;
            }

            return $varArr;
        }

        public function route ( $url )
        {
            $routeError = '';
            if ( $routeTitle = $this->routeExists ( $url ) )
            {
                if ( substr ( $routeTitle, 0, 1 ) !== "/" )
                {
                    $routeTitle = '/' . $routeTitle;
                }
                
                $route = $this->routeArr[ $routeTitle ];

                $controller = $route->getControllerName ();
                $action     = $route->getActionName ();

                if ( file_exists ( 'Controller/' . $controller . '.php' )
                     && class_exists ( $controller )
                )
                {
                    if ( method_exists ( $controller, $action ) )
                    {
                        $param = $this->getParamsFromRoute ( $url, $routeTitle );

                        $this->render ( $route, $param );
                    }
                    else
                    {
                        $routeError = 'nomethod';
                    }
                }
                else
                {
                    $routeError = 'nocontroller';
                }
            }
            else
            {
                $routeError = 'noroute';
            }

            if ( DEVELOP )
            {
                switch ( $routeError )
                {
                    case 'nomethod':
                        $this->render ( $this->routeArr[ '/nomethod' ], [ ] );
                        break;
                    case 'nocontroller':
                        $this->render ( $this->routeArr[ '/nocontroller' ], [ ] );
                        break;
                    case 'noroute':
                        $this->render ( $this->routeArr[ '/noroute' ], [ ] );
                        break;
                }
            }
            else
            {
                if ( !empty($routeError) )
                {
                    // if error with route/method/controller show errorPage
                    $this->render ( $this->routeArr[ '/404' ], [ ] );
                }
            }
        }

        private function render ( $route, $params = [ ] )
        {
            $controller = $route->getControllerName ();
            $action     = $route->getActionName ( $params );

            // create instance of controller
            $controller = new $controller( $params );

            // call user func array calls the methode $action on
            // $controller instance and dynamically adds the params
            // listed in the $params array
            call_user_func_array ( [
                                       $controller,
                                       $action
                                   ], $params );
        }

        public function _getControllerClassName ()
        {
            return $this->route->getControllerClassName ();
        }


        public function _getActionName ()
        {
            return $this->route->getActionName ();
        }
    }