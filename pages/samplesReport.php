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
			<h1 class="page-header">SAMADhi samples - Database analysis report</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
		<div class="row">

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
<!-- TODO: this will be generated automatically by php. Requires to count. Skip if count is zero??? -->
                            Samples with missing path <span class="badge">12</span>
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-info">
<!-- TODO: this will be generated automatically by php. Implement also a proper formatting for the samples. -->
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">TTFullyLept (created on 2013-11-22 17:20:14 by acaudron)</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tbody>
                                                        <tr>
                                                            <td>Path</td>
                                                            <td>/nfs/user/llbb/Pat_8TeV_537/Summer12_TTbarFullLept_S10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Type</td>
                                                            <td>PAT</td>
                                                        </tr>
                                                        <tr>
                                                            <td>number of processed events</td>
                                                            <td>12119013</td>
                                                        </tr>
                                                        <tr>
                                                            <td>number of events</td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Normalization</td>
                                                            <td>1.0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>(Effective) luminosity</td>
                                                            <td>443920.0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Code version</td>
                                                            <td>b2f1b0cb3cfd97319aed59b7bc31357a1a82e9c3</td>
                                                        </tr>
                                                        <tr>
                                                            <td>comment</td>
                                                            <td>Hbb analysis</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Source dataset</td>
                                                            <td>21</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Source sample</td>
                                                            <td>4</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">TTSemiLept</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
{"name": "TTSemiLept", "user_comment": "Hbb analysis", "luminosity": 67097.9, "code_version": "b2f1b0cb3cfd97319aed59b7bc31357a1a82e9c3", "author": "acaudron", "sampletype": "PAT", "nevents_processed": 10997349, "sample_id": 5,
 "creation_time": "2013-11-22 17:21:41", "source_dataset_id": 22, "source_sample_id": null, "nevents": null, "path": "/nfs/user/llbb/Pat_8TeV_537/Summer12_TTbarSemiLept_S10", "normalization": 1.0}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">ZH125</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
{"name": "ZH125", "user_comment": "Hbb analysis", "luminosity": 40139000.0, "code_version": "b2f1b0cb3cfd97319aed59b7bc31357a1a82e9c3", "author": "acaudron", "sampletype": "PAT", "nevents_proces
sed": 999462, "sample_id": 7, "creation_time": "2013-11-22 17:49:21", "source_dataset_id": 7, "source_sample_id": null, "nevents": null, "path": "/nfs/user/llbb/Pat_8TeV_537/Summer12_ZH125_S10", "normalization": 1.0}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
		    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Database Inconsistencies
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNeventsTimeprof
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNevents
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNeventsTimeprof
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                sampleNevents
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Sample Types
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
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
                    <div class="col-lg-6 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Authors
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
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
    <script type="text/javascript">$(function(){$('#collapseOne').collapse("hide");});</script>
<!-- TODO create plots from JSON and put them on the page. This script should be moved to its own file -->
    <script type="text/javascript">$(function(){
$.getJSON( "../data/analysisReport.json", function( data ) {
  console.log(data);
});
});</script>

</body>

</html>
