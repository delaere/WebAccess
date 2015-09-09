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
			<h1 class="page-header">SAMADhi samples - Database analysis report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Samples Author
                            </div>
                            <div class="panel-body" id="authorsPlotContainer">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Sample Types
                            </div>
                            <div class="panel-body" id="typePlotContainer">
                            </div>
                        </div>
                    </div>
            </div><div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary" id="MissingDirSamples">
                        <div class="panel-heading">
                            Samples with missing path <span class="badge" id="numberOfMissingDirSamples"></span>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
				<p>The following samples are pointing to non-existant locations on the server.</p>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
		    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-primary" id="DbProblems">
                            <div class="panel-heading">
				Database Inconsistencies <span class="badge" id="numberOfDbProblems">0</span>
                            </div>
                            <div class="panel-body">
				<p>The following samples have inconsitencies in their relation to other entries.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNeventsTimeprof
                            </div>
                            <div class="panel-body" id="sampleNeventsTimeprof">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNevents
                            </div>
                            <div class="panel-body" id="sampleNevents">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNeventsProcessedTimeprof
                            </div>
                            <div class="panel-body" id="sampleNeventsProcessedTimeprof">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNeventsProcessed
                            </div>
                            <div class="panel-body" id="sampleNeventsProcessed">
                            </div>
                        </div>
                    </div>
<!--
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Time profile
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
		    </div>
-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "stdScripts.html"; ?>
    <script src="../js/sampleReport.js"></script>

</body>

</html>
