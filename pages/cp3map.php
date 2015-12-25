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
    <link rel="stylesheet" type="text/css" href="../bower_components/jquery-svg/jquery.svg.css"> 

</head>

<body>

    <div id="wrapper">

        <?php include "navigation.html"; ?>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                  <!-- Form -->
                  <div class="col-lg-6" id="colform">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                         Search and Selection
                      </div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-lg-12">
                            <form role="form" id="mapform">
                              <div class="form-group">
                                <label for="sel1">Room:</label>
                                <select class="form-control" id="sel1" name="room">
                                </select>
                              </div>
                              <label for="search1">Search Person:</label>
                              <div class="input-group custom-search-form" id="search1">
                                <input type="text" class="form-control" placeholder="Search..." name="search">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </span>
                              </div>
                            </form>
                          </div> <!-- col-lg-12 -->
                        </div> <!-- row -->
                      </div> <!-- panel-body -->
                    </div> <!-- panel -->
                  </div> <!-- col-lg-6 -->
                  <!-- Content -->
                  <div class="col-lg-12" id="cp3level1" data-floor="floor1">
		      <h1 class="page-header">Level 1</h1>
		  </div>
                  <div class="col-lg-12" id="cp3level2" data-floor="floor2">
		      <h1 class="page-header">Level 2</h1>
		  </div>
                  <div class="col-lg-12" id="cp3level3" data-floor="floor3">
		      <h1 class="page-header">Level 3</h1>
		  </div>
                </div>
            </div>  <!-- /.container-fluid -->
        </div>  <!-- /#page-wrapper -->
    </div>  <!-- /#wrapper -->

    <?php include "stdScripts.html"; ?>
    <script type="text/javascript" src="../bower_components/jquery-svg/jquery.svg.js"></script>
    <script src="../js/cp3map.js"></script>


</body>

</html>
