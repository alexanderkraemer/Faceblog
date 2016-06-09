<?php

    class Index extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }

        public function index ()
        {
            $postsLastHours = BlogPost::countWhere('created_at >= (now() - INTERVAL 1 DAY)');
            $lastPost = BlogPost::first('created_at desc');

            $this->page->view ( 'index/index', compact('postsLastHours', 'lastPost') );
        }
    }