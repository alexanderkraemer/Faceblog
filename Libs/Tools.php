<?php

    class Tools
    {
        // redirect s.o. using PHP header
        public static function redirect ( $link )
        {
            $link = DIR . $link;
            header ( 'Location: ' . $link );
        }

        // Hash password for Datbase storage
        public static function bcrypt ( $password )
        {
            $options = [
                // difficulty of password
                // the higher the value, the longer the hash will take to generate
                'cost' => 12,
                // salt the password with random 22 digit string
                'salt' => mcrypt_create_iv ( 22, MCRYPT_DEV_URANDOM ),
            ];

            return password_hash ( $password, CRYPT_BLOWFISH, $options );
        }

        // Timestamp to string
        public static function date ( $timestamp )
        {
            if ( $timestamp == null or $timestamp == '0000-00-00 00:00:00' )
            {
                return '';
            }
            else
            {
                $months = [
                    '01' => 'Januar',
                    '02' => 'Februar',
                    '03' => 'März',
                    '04' => 'April',
                    '05' => 'Mai',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Dezember'
                ];

                return strftime ( "%d. " . $months[ explode ( '-',
                                                              $timestamp )[ 1 ] ]
                                  . " %Y", strtotime ( $timestamp ) );
            }
        }

        public static function prepare ( $string )
        {
            $string = str_replace ( '<', '&lt;', $string );
            $string = str_replace ( '>', '&gt;', $string );

            return $string;
        }


        public static function dateTime ( $timestamp )
        {
            if ( $timestamp == null or $timestamp == '0000-00-00 00:00:00' )
            {
                return '';
            }

            $months = [
                '01' => 'Januar',
                '02' => 'Februar',
                '03' => 'März',
                '04' => 'April',
                '05' => 'Mai',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'August',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Dezember'
            ];

            return strftime ( "%d. " . $months[ explode ( '-', $timestamp )[ 1 ] ]
                              . " %Y - %H:%M", strtotime ( $timestamp ) );
        }
    }