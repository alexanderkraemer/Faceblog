<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Faceblog Details</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="block form-horizontal">
                        <div class="form-group">
                            <label class="col-md-5 control-label">Anzahl der registrierten Benutzer:</label>
                            <div class="col-md-5">
                                <p class="form-control-static"><?php echo User::count(); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label"> Gesamtzahl aller erstellten Blogeinträge:</label>
                            <div class="col-md-5">
                                <p class="form-control-static"><?php echo BlogPost::count(); ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Anzahl der neuen Blogeinträge in den letzten 24 Stunden:</label>
                            <div class="col-md-5">
                                <p class="form-control-static"><?php echo $postsLastHours; ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-5 control-label">Datum des letzten Beitrags:</label>
                            <div class="col-md-5">
                                <p class="form-control-static"><?php echo Tools::date($lastPost[0]->created_at); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>