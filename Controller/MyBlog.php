<?php

    class MyBlog extends Base
    {
        function __construct ()
        {
            parent::__construct ();
        }

        public function index ()
        {
            $blogposts = BlogPost::where ( 'user_id = ? order by created_at desc',
                                           [ Auth::user ()->id ] );

            foreach ( $blogposts as $post )
            {
                // get Likes and generate String to return
                $likeArr = Like::where ( 'post_id = ?', [ $post->id ] );
                $userArr = [ ];
                foreach ( $likeArr as $like )
                {
                    $user      = User::find ( $like->user_id );
                    $userArr[] = $user->name;
                }

                // create String to return
                $post->likestring = implode ( ', ', $userArr );
            }

            $this->page->view ( 'blog/list', compact ( 'blogposts' ) );
        }

        public function show ( $id )
        {
            $blogposts = BlogPost::where ( 'user_id = ? order by created_at desc',
                                           [ $id ] );

            foreach ( $blogposts as $post )
            {
                // get Likes and generate String to return
                $likeArr = Like::where ( 'post_id = ?', [ $post->id ] );
                $userArr = [ ];
                foreach ( $likeArr as $like )
                {
                    $user      = User::find ( $like->user_id );
                    $userArr[] = $user->name;
                }

                // create String to return
                $post->likestring = implode ( ', ', $userArr );
            }

            $this->page->view ( 'blog/userlist', compact ( 'blogposts' ) );
        }

        public function edit ( $id )
        {
            // redirect if user isn't creator of this blogpost
            if ( !BlogPost::findOrFailWhere ( 'id = ? AND user_id = ?', [
                $id,
                Auth::user ()->id
            ] )
            )
            {
                Tools::redirect ( '/myblog' );
            }

            $errorArr = [ ];
            if ( !empty($_POST) )
            {
                $errorArr = $this->checkValid ( $_POST );

                $post          = BlogPost::find ( $id );
                $post->title   = $_POST[ 'title' ];
                $post->content = $_POST[ 'content' ];
                $post->user_id = Auth::user ()->id;
                $post->update ();

                Tools::redirect ( '/myblog' );
            }

            $blogpost = BlogPost::find ( $id );

            $this->page->view ( 'blog/edit', compact ( 'blogpost', 'errorArr' ) );
        }

        public function delete ( $id )
        {
            // redirect if user isn't creator of this blogpost
            if ( !BlogPost::findOrFailWhere ( 'id = ? AND user_id = ?', [
                $id,
                Auth::user ()->id
            ] )
            )
            {
                Tools::redirect ( '/myblog' );
            }
            $blogpost = BlogPost::find ( $id );
            $blogpost->delete ();

            Tools::redirect ( '/myblog' );
        }

        public function like ( $postid, $user_id )
        {
            if ( Like::exists ( $postid ) )
            {
                $like = Like::where ( 'user_id = ? AND post_id = ?', [
                    Auth::user ()->id,
                    $postid
                ] )[ 0 ];
                $like->delete ( ' user_id = ? AND post_id = ?', [
                    Auth::user ()->id,
                    $postid
                ] );
                Tools::redirect ( '/myblog/' . $user_id );
            }
            else
            {
                $like          = new Like();
                $like->user_id = Auth::user ()->id;
                $like->post_id = $postid;
                $like->save ();


                Tools::redirect ( '/myblog/' . $user_id );
            }
        }

        public function create ()
        {
            $errorArr = [ ];
            if ( !empty($_POST) )
            {
                $errorArr = $this->checkValid ( $_POST );

                $post          = new BlogPost();
                $post->title   = Tools::prepare ( $_POST[ 'title' ] );
                $post->content = Tools::prepare ( $_POST[ 'content' ] );
                $post->user_id = Auth::user ()->id;
                // current time as timestamp for new blogposts
                $post->created_at = date ( 'y-m-d H:i:s' );
                $post->save ();

                Tools::redirect ( '/myblog' );
            }
            $this->page->view ( 'blog/create', compact ( 'errorArr' ) );
        }

        public function checkValid ( $post )
        {
            $errorArr = [ ];
            // check if Title and Content have at least 3 characters
            if ( strlen ( $post[ 'title' ] ) < 3 )
            {
                $errorArr[] = 'title_strlen';
            }
            if ( strlen ( $post[ 'content' ] ) < 3 )
            {
                $errorArr[] = 'content_strlen';
            }

            return $errorArr;
        }
    }