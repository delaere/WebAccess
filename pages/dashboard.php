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
                <div class="row">
                    <div class="panel panel-primary">
                       <div class="panel-heading">First plot</div>
                       <div class="panel-body" id="plot1"></div>
                    </div>
                    <div class="panel panel-primary">
		       <div class="panel-heading">Plot </div>
		       <div class="panel-body" id="plot2">
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

    <script language="javascript" type="text/javascript">
      function resizeIframe(obj) {
         obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
      }
    </script>
    <script language="javascript" type="text/javascript">
    function ajax_info() {
        encodedfile = encodeURIComponent("/home/delaer/public_html/data/ZbblowMET_smallMll_RewFormformulaPol3NLO_PAS.root")
	encodedcanvas = encodeURIComponent("Combined/jetmetMET")
	console.log(encodedfile,encodedcanvas)
        $.ajax({
        url:       "http://localhost/cgi-bin/getCanvas.py?file="+encodedfile+"&canvas="+encodedcanvas,
        cache:     false,
        dataType:  "text",
        data:      { mode: 'info' },
        success:   function(result) { $("#plot2").html(result); var ratio = $("#plot2 svg").height()/$("#plot2 svg").width(); $("#plot2 svg").width($("#plot2").width()); $("#plot2 svg").height($("#plot2 svg").width()*ratio);  }
    });
    }

    $(function () {
	    ajax_info();
    });
	    </script>
}

</body>

</html>
