<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Blogpost</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo DIR . '/myblog/' . $blogpost->id . '/edit'; ?>">
                        <div class="form-group">
                            <label for="title" class="col-md-2 control-label">Title</label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control"
                                       name="title" value="<?php echo $blogpost->title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="col-md-2 control-label">Content</label>

                            <div class="col-md-8">
                                <textarea id="content" cols="10" rows="15" class="form-control"
                                       name="content"><?php echo $blogpost->content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Save
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-offset-2 col-md-8">
                            <?php
                                // show errors below form
                                if(in_array('title_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">Title must have at least 3 characters</p>';
                                }

                                if(in_array('content_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">Content must have at least 3 characters</p>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>