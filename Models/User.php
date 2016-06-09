<?php

    class User extends Model
    {
        protected static $table      = 'user';
        protected static $primaryKey = 'id';

        public function __construct ()
        {
            parent::__construct ();
        }

        protected static $fillable = [
            'name',
            'first_name',
            'last_name',
            'email',
            'password',
            'status',
        ];

    }