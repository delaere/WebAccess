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

</head>

<body>

    <div id="wrapper">

        <?php include "navigation.html"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<!-- TODO things we can display:
colored wells with #datasets #samples #results
big red/green light with db status (online/offline)
some grid stats (#running jobs, etc.) -> see with JdF
-->
                <div class="row">
                    <div class="col-lg-6">
			<canvas id="clock" class="CoolClock:fancy:150"></canvas>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                           <div class="panel-heading">First plot</div>
                           <div class="panel-body" id="plot1"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
		           <div class="panel-heading">Second Plot</div>
		           <div class="panel-body" id="plot2">
		            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
		           <div class="panel-heading">Third Plot</div>
		           <div class="panel-body" id="plot3">
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
