<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo DIR; ?>/">Faceblog</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
                if(Auth::isAuthenticated())
                {
                    ?>
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo DIR; ?>/myblog">MyBlog</a></li>
                        <li><a href="<?php echo DIR; ?>/people">People</a></li>
                    </ul>
                    <?php
                }
            ?>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(Auth::isAuthenticated())
                    {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo Auth::user()->name; ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo DIR; ?>/logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="<?php echo DIR; ?>/login">Login</a></li>

                        <li><a href="<?php echo DIR; ?>/register">Register</a></li>
                        <?php
                    }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>