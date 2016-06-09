<?php

    class Like extends Model
    {
        protected static $table = 'likes';

        public function __construct ()
        {
            parent::__construct ();
        }

        protected static $fillable = [
            'user_id',
            'post_id'
        ];

        public static function exists ( $postid )
        {
            if ( self::countWhere ( 'post_id = ? and user_id = ?', [
                $postid,
                Auth::user ()->id
            ] )
            )
            {
                return true;
            }

            return false;
        }
    }