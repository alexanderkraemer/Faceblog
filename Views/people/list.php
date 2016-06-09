<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row form-group">
        <form method="post" action="<?php echo DIR; ?>/people/search/">
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?php echo (empty($searchstring) ? '' : $searchstring) ; ?>"
                           name="searchinput" placeholder="Search for people ...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Suchen!</button>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <?php
        if ( empty($users) )
        {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Keine User verfügbar!</h3>
                </div>
            </div>
            <?php
        }
        foreach ( $users as $user )
        {
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="<?php echo DIR . '/myblog/' . $user->id; ?>">
                        <h3 class="panel-title"><?php echo $user->first_name . ' ' . $user->last_name; ?></h3>
                    </a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="block form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Username:</label>
                                    <div class="col-md-5">
                                        <p class="form-control-static"><?php echo $user->name; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">E-Mail:</label>
                                    <div class="col-md-5">
                                        <p class="form-control-static"><?php echo $user->email; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Mitglied seit:</label>
                                    <div class="col-md-5">
                                        <p class="form-control-static"><?php echo Tools::date($user->created_at); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
</div>