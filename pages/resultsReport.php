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
			<h1 class="page-header">SAMADhi results - Database analysis report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Time profile
                            </div>
                            <div class="panel-body" id="timeProfileContainer">
                            </div>
                        </div>
		    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Results Author
                            </div>
                            <div class="panel-body" id="authorsPlotContainer">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Number of sample(s) used
                            </div>
                            <div class="panel-body" id="samplesPlotContainer">
                            </div>
                        </div>
                    </div>
		</div>
            	<div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary" id="MissingDirSamples">
                            <div class="panel-heading">
                                Results with missing path <span class="badge" id="numberOfMissingDirSamples"></span>
                            </div>
                            <!-- .panel-heading -->
                            <div class="panel-body">
                                <div class="panel-group" id="accordionA">
		    		<p>The following results are pointing to non-existant locations on the server.</p>
                                </div>
                            </div>
                            <!-- .panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div> <!-- /.col-lg-12 -->
		    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-primary" id="DbProblems">
                            <div class="panel-heading">
				Database Inconsistencies <span class="badge" id="numberOfDbProblems"></span>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordionB">
			            <p>The following results have inconsitencies in their relation to other entries.</p>
                                </div>
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

    <script src="../js/resultReport.js"></script>

</body>

</html>
