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
                                    <div class="huge" id="nDatasets">#</div>
                                    <div>Datasets</div>
                                </div>
                            </div>
                        </div>
                        <a href="datasets.php">
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
                                    <div class="huge" id="nSamples">#</div>
                                    <div>Samples</div>
                                </div>
                            </div>
                        </div>
                        <a href="samplesReport.php">
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
                                    <div class="huge" id="nResults">#</div>
                                    <div>Results</div>
                                </div>
                            </div>
                        </div>
                        <a href="resultsReport.php">
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
                                    <div class="huge" id="nAnalyses">#</div>
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
			   <div class="panel-heading">Servers status
				<span class="pull-right"><button type="button" class="btn btn-outline btn-primary btn-xs" id="ping"><i class="fa fa-refresh"></i>
                            </button></span>
			</div>
                           <div class="panel-body" id="servers">
				<div id="ui1" class="alert alert-info"><h3>ingrid-ui1<span class="pull-right"><i class="fa fa-2x fa-exclamation-circle"></i></span></h3></div>
				<div id="ui2" class="alert alert-info"><h3>ingrid-ui2<span class="pull-right"><i class="fa fa-2x fa-exclamation-circle"></i></span></h3></div>
				<div id="gh"  class="alert alert-info"><h3>GitHub<span class="pull-right"><i class="fa fa-2x fa-exclamation-circle"></i></span></h3></div>
				<div id="db"  class="alert alert-info"><h3>SAMADhi<span class="pull-right"><i class="fa fa-2x fa-exclamation-circle"></i></span></h3></div>
				<div id="das" class="alert alert-info"> <h3>DAS server<span class="pull-right"><i class="fa fa-2x fa-exclamation-circle"></i></span></h3></div>
			   </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
		           <div class="panel-heading">Cluster status</div>
		           <div class="panel-body" id="ingridStatus">
				To be discussed with JdF.
				<iframe style="min-height:400px;" src='http://cp3.irmp.ucl.ac.be' id="ingridStatusFrame" class="iframe" name='info' width="100%" height="100%" seamless="seamless" align="left"></iframe>
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
    <script src="../dist/pingjs/ping.js"></script>
    <script src="../js/dashboard.js"></script>
}

</body>

</html>
