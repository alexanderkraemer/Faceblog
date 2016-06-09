<?php

    class Session
    {

        public static function start_session ()
        {
            // Sessionnamen vergeben
            $session_name = 'src_project';
            // Wenn "SECURE" als true definiert ist, dann
            // werden Session-Cookies nur über eine HTTPS Verbindung gesetzt
            $secure = false;
            // Damit wird verhindert, dass JavaScript auf die session id zugreifen
            // kann.
            $httponly = true;
            // Zwingt die Sessions nur Cookies zu benutzen.
            if ( ini_set ( 'session.use_only_cookies', 1 ) === false )
            {
                echo 'Use only cookies in session!';
                exit();
            }

            // Holt Cookie-Parameter.
            $cookieParams = session_get_cookie_params ();
            session_set_cookie_params ( $cookieParams[ "lifetime" ],
                                        $cookieParams[ "path" ],
                                        $cookieParams[ "domain" ], $secure,
                                        $httponly );
            // Setzt den Session-Name zu oben angegebenem.
            session_name ( $session_name );
            // Startet die PHP-Sitzung
            session_start ();
            // Erneuert die Session, löscht die alte.
            session_regenerate_id ();
        }

        public static function stop_session ()
        {
            // Setze alle SESSEION Werte zurück
            $_SESSION = [ ];

            // hole Session-Parameter
            $params = session_get_cookie_params ();

            // Lösche das aktuelle Cookie
            setcookie ( session_name (), '', time () - 60 * 60, $params[ 'path' ],
                        $params[ 'domain' ], $params[ 'secure' ],
                        $params[ 'httponly' ] );

            // Vernichte die Session
            session_destroy ();
        }
    }