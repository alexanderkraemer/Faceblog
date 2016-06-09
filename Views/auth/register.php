<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        <div class="form-group">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control"
                                       name="username" value="<?php echo Input::old('username'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control"
                                       name="first_name" value="<?php echo Input::old('first_name'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control"
                                       name="last_name" value="<?php echo Input::old('last_name'); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"
                                       name="email" value="<?php echo Input::old('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control"
                                       name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-offset-4 col-md-6">
                            <?php
                                // show errors below form
                                if(in_array('username_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">Username must have at least 3 characters</p>';
                                }

                                if(in_array('username_exists', $errorArr))
                                {
                                    echo '<p class="text-danger">Username already exists</p>';
                                }

                                if(in_array('first_name_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">First Name must have at least 3 characters</p>';
                                }

                                if(in_array('last_name_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">Last Name must have at least 3 characters</p>';
                                }

                                if(in_array('email_exists', $errorArr))
                                {
                                    echo '<p class="text-danger">E-Mail already exists</p>';
                                }

                                if(in_array('password_strlen', $errorArr))
                                {
                                    echo '<p class="text-danger">Password must have at least 6 characters</p>';
                                }

                                if(in_array('password_match', $errorArr))
                                {
                                    echo '<p class="text-danger">Passwords must match</p>';
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>