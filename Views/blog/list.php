<div class="container">
    <h4><a href="<?php echo DIR; ?>/myblog/create"><span class="glyphicon glyphicon-plus"></span></a></h4>
    <?php
        if(empty($blogposts))
        {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Keine Blogposts verfügbar!</h3>
                </div>
            </div>
            <?php
        }
        foreach($blogposts as $post)
        {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?php
                            if(BlogPost::findOrFailWhere('id = ? AND user_id = ?', [$post->id, Auth::user()->id]))
                            {
                                ?>
                                <a href="<?php echo DIR . '/myblog/' . $post->id . '/edit' ?>">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="<?php echo DIR . '/myblog/' . $post->id . '/delete'?>">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                                <?php
                            }
                        ?>
                        <?php echo $post->title; ?>
                        <small class="pull-right">
                            <?php echo Tools::dateTime($post->created_at); ?>
                        </small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="block form-horizontal">
                                <?php echo $post->content; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php echo (empty($post->likestring) ? '' : 'Liked by: ' . $post->likestring); ?>
                </div>
                <div class="panel-heading">
                    <?php
                        if(Like::exists($post->id))
                        {
                            ?>
                            <a href="<?php echo DIR . '/myblog/' . $post->id . '/like'; ?>">Unlike</a>
                            <?php
                        }
                        else
                        {
                            ?>
                            <a href="<?php echo DIR . '/myblog/' . $post->id . '/like'; ?>">Like</a>
                            <?php
                        }
                    ?>
                </div>
            </div>
    <?php
        }
    ?>
</div>