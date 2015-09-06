$(function(){
	$.getJSON( "../data/analysisReport.json", function( data  ) {
		var missingDirSamples = data["MissingDirSamples"];
                var missingDirSamples_pg = $("#MissingDirSamples").find(".panel-group");
		// set header for missing dir samples
		$("#numberOfMissingDirSamples").html(missingDirSamples.length);
		if(missingDirSamples.length==0) {
			$("#MissingDirSamples").addClass("hidden")
		}
		// fill missing dir samples
		for (i = 0; i < missingDirSamples.length; i++) { 
			missingDirSamples_pg.append(
                                $("<div />").addClass("panel panel-info").append(
					$("<div />").addClass("panel-heading").html(
						$("<h4 />").addClass("panel-title").html(
							$("<a />").attr({"data-toggle":"collapse", "data-parent":"#accordion", "href":"#collapse"+i}).html(
								missingDirSamples[i]["name"]+" (created on "+missingDirSamples[i]["creation_time"]+" by "+missingDirSamples[i]["author"]+")"
							)
						)
					)
                                ).append(
					$("<div />").addClass("panel-collapse collapse").attr({id: "collapse"+i}).html(
						$("<div />").addClass("panel-body").html(
							$("<div />").addClass("table-responsive").html(
								$("<div />").addClass("table table-hover").html(
									$("<tbody />").html($("<tr />").html("<td>Path</td><td>"+missingDirSamples[i]["path"]+"</td>")).append(
											    $("<tr />").html("<td>Type</td><td>"+missingDirSamples[i]["sampletype"]+"</td>")).append(
											    $("<tr />").html("<td>number of processed events</td><td>"+missingDirSamples[i]["nevents_processed"]+"</td>")).append(
											    $("<tr />").html("<td>number of events</td><td>"+missingDirSamples[i]["nevents"]+"</td>")).append(
											    $("<tr />").html("<td>(Effective) luminosity</td><td>"+missingDirSamples[i]["luminosity"]+"</td>")).append(
											    $("<tr />").html("<td>Normalization</td><td>"+missingDirSamples[i]["normalization"]+"</td>")).append(
											    $("<tr />").html("<td>Code version</td><td>"+missingDirSamples[i]["code_version"]+"</td>")).append(
											    $("<tr />").html("<td>Comment</td><td>"+missingDirSamples[i]["user_comment"]+"</td>")).append(
											    $("<tr />").html("<td>Source dataset</td><td>"+missingDirSamples[i]["source_dataset_id"]+"</td>")).append(
											    $("<tr />").html("<td>Source sample</td><td>"+missingDirSamples[i]["source_sample_id"]+"</td>")
									)
								)
                                	                )
						)
                                	)
				)
			)

		}
		var dbProblems = data["DatabaseInconsistencies"];
		var dbProblems_pg = $("#DbProblems").find(".panel-group");
		// set header for db inconsistencies
		$("#numberOfDbProblems").html(dbProblems.length);
		if(dbProblems.length==0) {
			$("#DbProblems").addClass("hidden");
		}
		// fill db inconsistencies
		for (i = 0; i < dbProblems.length; i++) {
			dbProblems_pg.append(
				// this will depend on what we put in the json
			)
		}
		// plots
		var statistics = data["SampleStatistics"];
		var sampleNevents = statistics["sampleNevents"];
		var sampleNeventsTimeprof = statistics["sampleNeventsTimeprof"];
		var sampleNeventsProcessed = statistics["sampleNeventsProcessed"];
		var sampleNeventsProcessedTimeprof = statistics["sampleNeventsProcessedTimeprof"];
		var sampleTypes = statistics["sampleTypes"];
    		$('#typePlotContainer').highcharts({
    		    chart: {
    		        type: 'pie',
    		        options3d: {
    		            enabled: true,
    		            alpha: 45,
    		            beta: 0
    		        }
    		    },
    		    title: {
    		        text: ''
    		    },
    		    tooltip: {
    		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    		    },
    		    plotOptions: {
    		        pie: {
    		            allowPointSelect: true,
    		            cursor: 'pointer',
    		            depth: 35,
    		            dataLabels: {
    		                enabled: true,
    		                format: '{point.name}'
    		            }
    		        }
    		    },
    		    series: [{
    		        type: 'pie',
    		        name: 'Samples share',
			data: sampleTypes
    		    }]
    		});
		console.log(sampleTypes)
		$("#typePlotContainer").siblings().filter(".panel-heading").html("Samples type")
		var samplesTimeprof = statistics["samplesTimeprof"];
		var sampleAuthors = statistics["sampleAuthors"];
    		$('#authorsPlotContainer').highcharts({
    		    chart: {
    		        type: 'pie',
    		        options3d: {
    		            enabled: true,
    		            alpha: 45,
    		            beta: 0
    		        }
    		    },
    		    title: {
    		        text: ''
    		    },
    		    tooltip: {
    		        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    		    },
    		    plotOptions: {
    		        pie: {
    		            allowPointSelect: true,
    		            cursor: 'pointer',
    		            depth: 35,
    		            dataLabels: {
    		                enabled: true,
    		                format: '{point.name}'
    		            }
    		        }
    		    },
    		    series: [{
    		        type: 'pie',
    		        name: 'Samples share',
			data: sampleAuthors
    		    }]
    		});
		$("#authorsPlotContainer").siblings().filter(".panel-heading").html("Samples author")
	} );

});
