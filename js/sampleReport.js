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
	} );

});
