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
                    <div class="col-md-8">
                      <form role="form">
                        <div class="form-group">
                          <label for="sel1">Select result:</label>
                          <select class="form-control" id="inputFile">
                          </select>
                        </div>
                      </form>
                    </div>
                </div>
<!-- TODO: add a toggle to active/disable CGI rendering, and add a link to the SAMADhi website -->
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
    <script src="../dist/root/scripts/JSRootCore.js?io&2d&onload=createmyGUI" type="text/javascript"></script>  
    <script src="../js/treeNavigation.js"></script>
    <script src="../js/results.js"></script>

</body>

</html>
