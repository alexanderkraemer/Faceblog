<?php
    // default home route
    $route->add ( '/', 'Index@index' );

    
    // auth route
    $route->add( '/login', 'Login@index');
    $route->add( '/register', 'Register@register');


    // protected routes only accessible when logged in
    if(Auth::isAuthenticated())
    {
        $route->add('/logout', 'Logout@index');

        // routes for blog
        $route->add( '/myblog', 'MyBlog@index');
        $route->add( '/myblog/{id}', 'MyBlog@show');
        $route->add( '/myblog/create', 'MyBlog@create');
        $route->add( '/myblog/{id}/edit', 'MyBlog@edit');
        $route->add( '/myblog/{id}/delete', 'MyBlog@delete');
        $route->add( '/myblog/{postid}/like/user/{userid}', 'MyBlog@like');
        $route->add( '/myblog/{postid}/like', 'MyBlog@like');



        // routes for people
        $route->add( '/people', 'People@index');
        $route->add( '/people/search', 'People@search');
        $route->add( '/people/search/{searchstring}', 'People@result');
    }