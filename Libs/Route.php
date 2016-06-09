<?php

    class Route
    {
        private $controllerName;
        private $actionName;

        public function __construct ( $url, $controllerName )
        {
            $this->controllerName = explode ( '@', $controllerName )[ 0 ];
            $this->actionName     = explode ( '@', $controllerName )[ 1 ];
        }

        public function getActionName ()
        {
            return $this->actionName;
        }

        public function getControllerName ()
        {
            return $this->controllerName;
        }
    }