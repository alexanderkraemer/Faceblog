<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="">
                        <div class="col-lg-offset-4 col-md-6">
                            <?php
                                if ( isset($message) && !empty($message) )
                                {
                                    echo '<p class="text-danger">' . $message
                                         . '</p>';
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">
                                Username
                            </label>
                            <div class="col-md-6">
                                <input id="username" type="text"
                                       class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">
                                Password
                            </label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>