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
    		data: {
		        q: "select title,abstract,url from search.news where query=\"cat\"",
		        format: "json"
		},
    		success: function( response ) {
			if(response.status==="good") {
				// set the widget in success mode
				$("#gh").attr("class","alert alert-success");
				$("#gh i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in success mode
				$("#gh").attr("class","alert alert-danger");
				$("#gh i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
			// add the message as a popover
			$("#gh").attr("data-toggle","popover");
			$("#gh").attr("data-trigger","click");
			$("#gh").attr("title",response.created_on);
			$("#gh").attr("data-content",response.body);
			$("#gh").popover(); 
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
			if(response.result==="good") {
				// set the widget in success mode
				$("#das").attr("class","alert alert-success");
				$("#das i").attr("class","fa fa-2x fa-check-circle text-success");
			} else {
				// set the widget in success mode
				$("#das").attr("class","alert alert-danger");
				$("#das i").attr("class","fa fa-2x fa-times-circle text-danger");
			}
    		}
	});
}

//TODO
//SAMADhi: use php to connect to the db using mysql_ping (doing it with javascript would show credentials)
// NO: in order to allow to rerun at will, use another cgi.

// ingrid-ui* : cgi to run nmap on port 22
//

function check_samadhi() {
	
}

function check_ingridui1() {

}

function check_ingridui2() {
	
}
