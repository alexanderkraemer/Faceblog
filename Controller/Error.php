<?php

class Error extends Base
{
    function __construct ()
    {
        parent::__construct ();
    }

    public function method ()
    {
        $this->page->view ( 'error/method' );
    }

    public function controller ()
    {
        $this->page->view ( 'error/controller' );
    }

    public function route ()
    {
        $this->page->view ( 'error/route' );
    }

    public function viernullvier()
    {
        $this->page->view ( 'error/error' );
    }
}