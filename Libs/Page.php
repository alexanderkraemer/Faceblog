<?php

    class Page
    {
        private $params;

        function __construct ( $param = [ ] )
        {
            $this->params = $param;
        }

        public function view ( $name, $parameter = [ ] )
        {
            // vom controller an die View übergebenen Variablen
            foreach ( $parameter as $key => $value )
            {
                ${$key} = $value;
            }

            require_once 'views/layout/head.php';
            require_once 'Views/layout/navbar.php';
            require_once 'views/' . $name . '.php';
            require_once 'views/layout/foot.php';
        }
    }