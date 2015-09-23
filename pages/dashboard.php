<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: login.php");
        die("Redirecting to login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christophe Delaere">

    <title>Nemrod's Dashboard</title>

    <?php include "stdHeaders.html"; ?>
    <link href="../dist/css/webAccess.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <?php include "navigation.html"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
			<h1 class="page-header">Dashboard</h1>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
			<canvas id="clock" class="CoolClock:fancy:50"></canvas>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<!-- TODO things we can display:
some grid stats (#running jobs, etc.) -> see with JdF
-->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">26</div>
                                    <div>Datasets</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">12</div>
                                    <div>Samples</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>Results</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-puzzle-piece fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Analyses</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
			   <div class="panel-heading">Servers status<span class="pull-right"><button type="button" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-refresh"></i>
                            </button></span>
			</div>
                           <div class="panel-body" id="">
				<div class="alert alert-success"><h3>ingrid-ui1<span class="pull-right"><i class="fa fa-2x fa-check-circle text-success"></i></span></h3></div>
				<div class="alert alert-success"><h3>ingrid-ui2<span class="pull-right"><i class="fa fa-2x fa-check-circle text-success"></i></span></h3></div>
				<div class="alert alert-success"><h3>GitHub<span class="pull-right"><i class="fa fa-2x fa-check-circle text-success"></i></span></h3></div>
				<div class="alert alert-warning"><h3>SAMADhi<span class="pull-right"><i class="fa fa-2x fa-refresh fa-spin text-warning"></i></span></h3></div>
				<div class="alert alert-danger"> <h3>DAS server<span class="pull-right"><i class="fa fa-2x fa-times-circle text-danger"></i></span></h3></div>
			   </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
		           <div class="panel-heading">Cluster status</div>
		           <div class="panel-body" id="ingridStatus">
				To be discussed with JdF.
		            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "stdScripts.html"; ?>
    <!--[if IE]><script type="text/javascript" src="../js/excanvas.js"></script><![endif]-->
    <script src="../js/coolclock.js"></script>
    <script src="../js/moreskins.js"></script>
}

</body>

</html>
