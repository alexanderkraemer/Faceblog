<?php

    class BlogPost extends Model
    {
        protected static $table      = 'blogentry';
        protected static $primaryKey = 'id';

        public function __construct ()
        {
            parent::__construct ();
        }

        protected static $fillable = [
            'title',
            'content'
        ];

    }