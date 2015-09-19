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

    <!-- Custom CSS specialization-->
    <link href="../dist/css/webAccess.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">


</head>

<body>

    <div id="wrapper">

        <?php include "navigation.html"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
			<h1 class="page-header">SAMADhi results - Browse</h1>
                    </div>
                    <div class="col-md-4 well ">
                        <ul id="fileTree"></ul>
                    </div>
                    <form role="form">
                      <div class="col-md-8">
                        <div class="form-group">
                          <select class="form-control" id="inputFile">
                          </select>
                        </div>
                      </div>
                    </form>
                    <form role="form">
		      <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8 clearfix">
			<input type="checkbox" data-toggle="toggle" data-width="100%" data-on="Render canvases using JSROOT" data-off="Render canvases on the server">
		      </div>
		      <div class="col-lg-4 col-xs-4 clearfix">
			<button type="button" class="btn btn-primary btn-block" id="SAMADhi">Open in SAMADhi</button>
		      </div>
                    </form>
		      <div class="col-lg-12 col-xs-12" style="visibility: hidden;">-</div>
                </div>
                <div class="row" id="histoZoom" style="display: none;">
                   <div class="col-lg-12">
                        <div class="panel panel-primary">
			    <div class="panel-heading" id="myModalLabel">
                            </div>
                            <div class="panel-body" id="modal_plot">
			    </div>
			    <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="histoGrid">
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "stdScripts.html"; ?>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
    <script src="../dist/root/scripts/JSRootCore.js?io&2d&onload=createmyGUI" type="text/javascript"></script>  
    <script src="../js/treeNavigation.js"></script>
    <script src="../js/results.js"></script>

</body>

</html>
