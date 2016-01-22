//TODO investigate the use of a single call to the backend (should be faster but less flexible)

// callback function called to populate the page from the ROOT file
// called when ROOT is ready
function createmyGUI() {
    window.drawings = new Array();
    window.filename = QueryString.result;
    $.getJSON( "../data/ResultsAnalysisReport.json?salt="+makeid(), createGUI);
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

// actually build the GUI after reading json 
function createGUI(data) {
    window.data = data;
    // fill in the combo box
    loadAvailableResults(data);
    // set the filename: 1. from URL (above); 2. from the combo
    if(window.filename === undefined) {
        window.filename = data.SelectedResults[$('#inputFile')[0].selectedIndex][1]
    }
    if(window.filename === "") return;
    // set data-id of the button to the result id
    $('#SAMADhi').attr("data-id", data.SelectedResults[$('#inputFile')[0].selectedIndex][0]["result_id"]);
    // open the ROOT file
    new JSROOT.TFile(window.filename, onFileOpen);
}

// called when the file is open
function onFileOpen(file) {
    window.fileStructure = parseDirectory(file,file,"",buildFileStructure);
    var activeDir = QueryString.dir;
    var histoGrid = $("#histoGrid");
    var renderLocally = [ "TH1F"  ];
    if($("#renderLocal").is(':checked')) {
	    renderLocally.push("TCanvas");
    }
    window.activeDownloads = 1000; // keep track of the callbacks - start with big number, subtract it at the end of the loop
    if(activeDir != undefined) {
        file.ReadDirectory(activeDir,function(dir) {
	    $("#pleasewait").modal(); 
            dirkeys = dir.fKeys;
            for(var i=0;i<dirkeys.length;i++) {
	        if($.inArray( dirkeys[i].fClassName, renderLocally)!== -1) {
		    window.activeDownloads++;
                    // prepare the html container
		    $('<div/>', {class:"col-lg-3 col-sm-4 col-xs-12"})
			.append($('<div/>',{class:"thumbnail well drawing", id:"drawing_"+dirkeys[i].fName}))
				.appendTo(histoGrid);
		    var element = $("#drawing_"+dirkeys[i].fName);
		    element.height(element.width()*0.75);
                    // draw in it
                    file.ReadObject(activeDir+"/"+dirkeys[i].fName, function(obj) {
			try {
                        	JSROOT.draw("drawing_"+obj.fName, obj, "");
			} catch(err) { } // ignore
			window.drawings["drawing_"+obj.fName] = obj;
			var svgElement = $("#drawing_"+obj.fName+" svg");
			var ratio = svgElement.height()/svgElement.width(); 
			var padding_tot = Number(svgElement.parent().css("padding-left").replace("px",""))+Number(svgElement.parent().css("padding-right").replace("px",""));
			svgElement.width(svgElement.parent().width()-padding_tot);
			svgElement.height(svgElement.width()*ratio);
			window.activeDownloads--;
	    		if(window.activeDownloads==0) $("#pleasewait").modal("hide"); // if last callback, remove the modal
                    });
		} else if($.inArray( dirkeys[i].fClassName, [ "TCanvas" ]  )!== -1) { // this can be used to all objects not handled by JSROOT
		        window.activeDownloads++;
			encodedfile = encodeURIComponent("/var/www/html/WebAccess/pages/"+window.filename)
			encodedcanvas = encodeURIComponent(activeDir+"/"+dirkeys[i].fName)
			$.ajax({
				url:       "/cgi-bin/getCanvas.py?file="+encodedfile+"&canvas="+encodedcanvas,
				cache:     false,
				dataType:  "text",
				success:   function(result) { 
					var element = $('<div/>', {class:"col-lg-3 col-sm-4 col-xs-12"})
						.append($('<div/>',{class:"thumbnail well drawing"})
							.append(result));
					var name = element.find(".drawing").comments().html()
					element.find(".drawing").attr("id","drawing_"+name);
					element.appendTo(histoGrid);
					var svgElement = element.find("svg");
					var ratio = svgElement.height()/svgElement.width(); 
					var padding_tot = Number(svgElement.parent().css("padding-left").replace("px",""))+Number(svgElement.parent().css("padding-right").replace("px",""));
					svgElement.width(svgElement.parent().width()-padding_tot);
					svgElement.height(svgElement.width()*ratio);
				window.activeDownloads--;
	    			if(window.activeDownloads==0) $("#pleasewait").modal("hide"); // if last callback, remove the modal
				}
			});
	       	}
            }
	    window.activeDownloads -= 1000; // done with the loop. From now on, this contains the #active callbacks.
	    if(window.activeDownloads==0) $("#pleasewait").modal("hide"); // if no more callback, remove the modal
        });
    }
}

// recursively parse the file to build the directory structure
var parseDirectoryCount = 0;
function parseDirectory(dir,file,path, callback) {
	var keys = dir.fKeys;
	var structure = [];
	var lastItem = false;
	for (i = 0; i < keys.length; i++) {
		lastItem = (i===keys.length-1);
		if(keys[i].fClassName=="TDirectory") {
	                parseDirectoryCount++;
			file.ReadObject(path+"/"+keys[i].fName, function(obj) {
				structure.push({ name:obj.dir_name, title:obj.fTitle, content:parseDirectory(obj,file,"/"+obj.dir_name,callback) });
				parseDirectoryCount--;
				if(parseDirectoryCount===0 && lastItem && callback) callback();
			});
		}
	}
	return structure;
}

// once the file has been parsed, build the HTML
function buildFileStructure() {
	window.fileStructure.sort(function(a,b){ return a.name>b.name; });
	$("#fileTree").html($("<li/>").html($("<a/>").attr('href','#').html("ROOT file")));
	generateHtmlTree($("#fileTree").find("li"),window.fileStructure);
	$('#fileTree').treed();
}

// recursive function to convert the structure into HTML
function generateHtmlTree(rootElement,tree){
	// create a <ul> and move in there
	rootElement.append($("<ul/>"));
	rootElement = rootElement.find("ul");
	// for each element, create a <li>.
	for (var i = 0; i < tree.length; i++) {
		// if there are subdirs, call recursively
		if(tree[i].content.length>0) {
			rootElement.append($("<li/>").html(tree[i].title));
			generateHtmlTree(rootElement.find("li").last(),tree[i].content);
		} else { 
			rootElement.append($("<li/>").html($("<a/>").attr('href','?result='+encodeURIComponent(window.filename)+"&render="+$("#renderLocal").is(':checked')+'&dir='+tree[i].name).html(tree[i].title)));
		}
	}
}

// load the json with available results
function loadAvailableResults(data) {
	var results = data.SelectedResults;
	var inputs = $("#inputFile");
	for(var i=0;i<results.length;i++){
		inputs.append($("<option/>").html(results[i][0]['path']));
		if(results[i][1]===window.filename) {
			$('#inputFile')[0].selectedIndex = i;
		}
	}
}

$(window).resize(resizeAll);
function resizeAll() {
	if($(".drawing").is(":visible")) {
		var refwidth = $(".drawing").width();
		var refheight = $(".drawing").height();
		var elements = $(".drawing svg");
		for (var i=0;i<elements.size();i++) {
			var ratio = elements.eq(i).width()/elements.eq(i).height();
			elements.eq(i).width(elements.eq(i).parent().width()-10);
			elements.eq(i).height(elements.eq(i).width()/ratio);
			elements.eq(i).parent().height(elements.eq(i).parent().width()/ratio);
		}
	}
	var modal = $("#modal_plot");
	if(modal.is(":visible")){
		var svgElement = $("#modal_plot >svg");
		var ratio = svgElement.height()/svgElement.width(); 
		var padding_tot = Number(svgElement.parent().css("padding-left").replace("px",""))+Number(svgElement.parent().css("padding-right").replace("px",""));
		svgElement.width(svgElement.parent().width()-padding_tot);
		svgElement.height(svgElement.width()*ratio);
	}
}

// register event handlers
$(function(){
     // sets the toggle to the appropriate value
     $("<input/>").attr("type","checkbox").attr("data-toggle","toggle")
                  .attr("data-width","100%")
                  .attr("data-on","Render canvases using JSROOT")
                  .attr("data-off","Render canvases on the server")
                  .attr("id","renderLocal").prop("checked",QueryString.render==="true").appendTo($("#renderLocalContainer"));
     $("#renderLocal").bootstrapToggle();
     $('#histoGrid').on('dblclick',function(e) {
	 // check that we actually clicked on a plot and get its name
	 var hit = e.target.closest(".drawing");
	 if(hit==null) return;
	 var id = e.target.closest(".drawing").id;
	 var name = id.substring(8,id.length);
	 // prepare the modal window
	 // title
	 $('#myModalLabel').html(name);
	 $('#myModalLabel').attr("drawing",id);
	 // display
	 $("#histoZoom").toggle(400);
	 $("#histoGrid").toggle(400);
	 // wait for the modal to appear before drawing
	 window.setTimeout(drawModal,500);
     });
     $('#histoZoom').on('dblclick',function(e) {
	 // display
	 $("#histoZoom").toggle(400);
	 $("#histoGrid").toggle(400);
	 window.setTimeout(resizeAll,500);
     });
     $('#inputFile').on('change',function(e){
	 var newfilename = window.data.SelectedResults[$('#inputFile')[0].selectedIndex][1];
	 window.location=window.location.origin+window.location.pathname+"?result="+encodeURIComponent(newfilename)+"&render="+$("#renderLocal").is(':checked');
     });
     $('#SAMADhi').click(function(){
        var id = $('#SAMADhi').attr("data-id");
	window.open("http://cp3.irmp.ucl.ac.be/~delaere/level2/SAMADhi/index.php?-table=result&-action=browse&-cursor=0&-skip=0&-limit=30&-mode=list&-recordid=result%3Fresult_id%3D"+id);
     });
     $("#SAMADhi").mouseup(function(){
	$(this).blur();
     });
     $("#renderLocal").change(function(){
       var value = $("#renderLocal").is(':checked');
       $("#fileTree a").each(function(){
        if(value) {
	  this.setAttribute("href",this.getAttribute("href").replace("render=false","render=true"));
	} else {
	  this.setAttribute("href",this.getAttribute("href").replace("render=true","render=false"));
        }
       });
       $("#histoGrid").html("");
       new JSROOT.TFile(window.filename, onFileOpen);
     });
});

// draw the modal window
function drawModal() {
	var id = $('#myModalLabel').attr("drawing");
	$("#modal_plot").html("");
        if(!$("#renderLocal").is(':checked')) {
		// drawback of this method: we cannot interact with the zoomed plot
		$("#"+id+" >svg").clone().appendTo($("#modal_plot"));
		var svgElement = $("#modal_plot >svg");
		var ratio = svgElement.height()/svgElement.width(); 
		var padding_tot = Number(svgElement.parent().css("padding-left").replace("px",""))+Number(svgElement.parent().css("padding-right").replace("px",""));
		svgElement.width(svgElement.parent().width()-padding_tot);
		svgElement.height(svgElement.width()*ratio);
	} else {
		// slower and uses object stored in memory, but the plot is interactive
		var objModal = window.drawings[id];
		JSROOT.redraw("modal_plot", objModal, "");
        }
}

// decode the URL
var QueryString = function () {
  // This function is anonymous, is executed immediately and 
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]],decodeURIComponent(pair[1]) ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  } 
    return query_string;
}();
