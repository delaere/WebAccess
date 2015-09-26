$(function() {
	check_all();
	$("#ping").on("click",check_all);
	$("#ping").mouseup(function(){
		$(this).blur();		     
	});
	$.getJSON( "../data/stats.json", function( data ) {
		$("#nDatasets").html(data.nDatasets);
		$("#nSamples").html(data.nSamples);
		$("#nResults").html(data.nResults);
		$("#nAnalyses").html(data.nAnalyses);
	});
});

function do_ping() {
        ping("http://ingrid-ui1.cism.ucl.ac.be").then(function(delta) {
            alert(delta);
        }).catch(function(error) {
            alert(String(error));
        });
};

function check_all() {
	check_github();
	check_das();
	check_samadhi();
	check_ingridui1();
	check_ingridui2();
}

function check_github() {
	// set the widget in update mode
	$("#gh").attr("class","alert alert-warning");
	$("#gh i").attr("class","fa fa-2x fa-refresh fa-spin text-warning");
	// launch the test
	$.ajax({
		url: "https://status.github.com/api/last-message.json",
    		jsonp: "callback",
    		dataType: "jsonp",
    		success: function( response ) {
			if(response.status==="good") {
				// set the widget in success mode
				$("#gh").attr("class","alert alert-success");
				$("#gh i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in failure mode
				$("#gh").attr("class","alert alert-danger");
				$("#gh i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
			// add the message as a popover
			$("#gh").attr("data-toggle","popover");
			$("#gh").attr("data-trigger","click");
			$("#gh").attr("title",response.created_on);
			$("#gh").attr("data-content",response.body);
			$("#gh").popover({container: 'body'}); 
    		}
	});
}

function check_das() {
	// set the widget in update mode
	$("#das").attr("class","alert alert-warning");
	$("#das i").attr("class","fa fa-2x fa-refresh fa-spin text-warning");
	// launch the test
	$.ajax({
        	url:       "/cgi-bin/das_test.py",
        	cache:     false,
        	dataType:  "text",
        	success:   function(response) {
			response = JSON.parse(response);
			if(response.result==="good") {
				// set the widget in success mode
				$("#das").attr("class","alert alert-success");
				$("#das i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in failure mode
				$("#das").attr("class","alert alert-danger");
				$("#das i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
    		}
	});
}

function check_samadhi() {
	// set the widget in update mode
	$("#db").attr("class","alert alert-warning");
	$("#db i").attr("class","fa fa-2x fa-refresh fa-spin text-warning");
	// launch the test
	$.ajax({
		url:       "/cgi-bin/samadhi_test.py",
		cache:     false,
		dataType:  "text",
		success:   function(response) {
			response = JSON.parse(response);
			if(response.result==="good") {
				// set the widget in success mode
				$("#db").attr("class","alert alert-success");
				$("#db i").attr("class","fa fa-2x fa-check-circle text-success");
				// add the message as a popover
				$("#db").attr("data-toggle","popover");
				$("#db").attr("data-trigger","click");
				$("#db").attr("title","No error detected");
				$("#db").attr("data-content","SAMADhi database up and running");
				$("#db").popover({container: 'body'});
			} else {
				// set the widget in failure mode
				$("#db").attr("class","alert alert-danger");
				$("#db i").attr("class","fa fa-2x fa-times-circle text-danger");
				// add the message as a popover
				$("#db").attr("data-toggle","popover");
				$("#db").attr("data-trigger","click");
				$("#db").attr("title","Error "+response.error[0]);
				$("#db").attr("data-content",response.error[1]);
				$("#db").popover({container: 'body'});
			}
		}
	});
}

//TODO: why does nmap return filtered for the servers when running as cgi 
//while it returns open when I run in the shell???
function check_ingridui1() {
	// set the widget in update mode
	$("#ui1").attr("class","alert alert-warning");
	$("#ui1 i").attr("class","fa fa-2x fa-refresh fa-spin text-warning");
	// launch the test
	$.ajax({
		url:       "/cgi-bin/ssh_test.py",
		cache:     false,
		dataType:  "text",
    		data: { server: "ingrid-ui1.cism.ucl.ac.be" },
		success:   function(response) {
			response = JSON.parse(response);
			if(response.result==="open" || response.result==="filtered") {
				// set the widget in success mode
				$("#ui1").attr("class","alert alert-success");
				$("#ui1 i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in failure mode
				$("#ui1").attr("class","alert alert-danger");
				$("#ui1 i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
			// add the message as a popover
			$("#ui1").attr("data-toggle","popover");
			$("#ui1").attr("data-trigger","click");
			$("#ui1").attr("title",response.result);
			$("#ui1").attr("data-content","Responded in "+response.responseTime);
			$("#ui1").popover({container: 'body'});
		}
	});
}

function check_ingridui2() {
	// set the widget in update mode
	$("#ui2").attr("class","alert alert-warning");
	$("#ui2 i").attr("class","fa fa-2x fa-refresh fa-spin text-warning");
	// launch the test
	$.ajax({
		url:       "/cgi-bin/ssh_test.py",
		cache:     false,
		dataType:  "text",
    		data: { server: "ingrid-ui2.cism.ucl.ac.be" },
		success:   function(response) {
			response = JSON.parse(response);
			if(response.result==="open" || response.result==="filtered") {
				// set the widget in success mode
				$("#ui2").attr("class","alert alert-success");
				$("#ui2 i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in failure mode
				$("#ui2").attr("class","alert alert-danger");
				$("#ui2 i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
			// add the message as a popover
			$("#ui2").attr("data-toggle","popover");
			$("#ui2").attr("data-trigger","click");
			$("#ui2").attr("title",response.result);
			$("#ui2").attr("data-content","Responded in "+response.responseTime);
			$("#ui2").popover({container: 'body'});
		}
	});
}
