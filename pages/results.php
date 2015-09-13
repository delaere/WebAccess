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
                    <!-- /.col-lg-12 -->
                    <div class="col-md-4 well ">
                        <ul id="fileTree"></ul>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4 well" id="drawing" ></div>
                </div>
                <!-- /.row -->
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
