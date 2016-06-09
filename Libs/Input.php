<?php
    
    class Input
    {
        public static function old ( $string )
        {
            if ( isset($_POST[ $string ]) )
            {
                return $_POST[ $string ];
            }
            else
            {
                return '';
            }
        }
    }