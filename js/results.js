// callback function called to populate the page from the ROOT file

// called when ROOT is ready
function createmyGUI() {
    window.drawings = [];
    window.filename = QueryString.result;
    $.getJSON( "../data/ResultsAnalysisReport.json", createGUI);
}

// actually build the GUI after reading json 
function createGUI(data) {
    // fill in the combo box
    loadAvailableResults(data);
    // set the filename: 1. from URL (above); 2. from the combo
    if(window.filename === undefined) {
        window.filename = $('#inputFile option:selected').text();
    }
    if(window.filename === "") return;
    new JSROOT.TFile(window.filename, onFileOpen);
}

// called when the file is open
function onFileOpen(file) {
    window.fileStructure = parseDirectory(file,file,"",buildFileStructure);
    var activeDir = QueryString.dir;
    var histoGrid = $("#histoGrid");
    if(activeDir != undefined) {
        file.ReadDirectory(activeDir,function(dir) {
            var dirkeys = dir.fKeys;
            for(var i=0;i<dirkeys.length;i++) {
		//TODO: need another solution for TCanvas: it doesn't reproduce the full canvas, just the data part.
		//dashboard demonstrates one solution with ajax + cgi to get a svg produced on the server
	        if($.inArray( dirkeys[i].fClassName, [ "TH1F", "TCanvas" ]  )!== -1) { //TODO: extend the list to others. Try first.
                    // prepare the html container
                      $('<div/>', {class:"col-lg-3 col-sm-4 col-xs-12"})
                         .append($('<div/>',{class:"panel panel-primary drawingpanel"})
                                   .append($('<div/>', {class:"panel-body drawing", id:"drawing_"+dirkeys[i].fName}))
                                )
                         .appendTo(histoGrid);
                    // draw in it
                    file.ReadObject(activeDir+"/"+dirkeys[i].fName, function(obj) {
                        JSROOT.draw("drawing_"+obj.fName, obj, "");
                        window.drawings.push(obj);
                    });
                }
            }
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
				structure.push({ name:obj.dir_name, title:obj.fTitle, content:parseDirectory(obj,file,path+"/"+obj.dir_name,callback) });
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
	$("#fileTree").html($("<li/>").html($("<a/>").attr('href','#').html(window.filename)));
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
			rootElement.append($("<li/>").html($("<a/>").attr('href','?result='+encodeURIComponent(window.filename)+'&dir='+tree[i].name).html(tree[i].title)));
		}
	}
}

// load the json with available results
function loadAvailableResults(data) {
	var results = data.SelectedResults;
	var inputs = $("#inputFile");
	for(var i=0;i<results.length;i++){
		inputs.append($("<option/>").html(results[i][1]));
		if(results[i]===window.filename) {
			$('#inputFile')[0].selectedIndex = i;
		}
	}
}

//TODO: might not need to redraw: can directly act on svg dimensions
// redraw on resize
$(window).resize(redrawAll);
function redrawAll() {
  for(var i=0;i<window.drawings.length;i++) {
      var objtoDraw = window.drawings[i];
      console.log(objtoDraw.fName);
      $("#drawing_"+objtoDraw.fName).html("");
      JSROOT.redraw("drawing_"+objtoDraw.fName, objtoDraw, "");
  }
  drawModal();
}

// register event handlers
$(function(){
     $('#histoGrid').on('dblclick',function(e) {
	 // check that we actually clicked on a plot and get its name
	 var hit = e.target.closest(".drawing");
	 if(hit==null) return;
	 var id = e.target.closest(".drawing").id;
	 var name = id.substring(8,id.length);
	 // find the object
	 var obj=null;
	 for(var i=0;i<window.drawings.length;i++) {
		 if(window.drawings[i].fName==name) {
			 obj = window.drawings[i];
			 break;
		 }
	 }
	 if(obj==null) return;
	 // prepare the modal window
	 // title
	 $('#myModalLabel').html(obj.fTitle);
	 $('#myModalLabel').attr("drawing",i);
	 // display
	 $("#histoZoom").toggle(400);
	 $("#histoGrid").toggle(400);
         //JSROOT.redraw("modal_plot", obj, "");
	 // wait for the modal to appear before drawing
	 window.setTimeout(drawModal,500);
     });
     $('#histoZoom').on('dblclick',function(e) {
	 // display
	 $("#histoZoom").toggle(400);
	 $("#histoGrid").toggle(400);
	 window.setTimeout(redrawAll,500);
     });
     $('#inputFile').on('change',function(e){
	 var newfilename = $("#inputFile option:selected").text();
	 window.location=window.location.origin+window.location.pathname+"?result="+encodeURIComponent(newfilename);
     });
});

// draw the modal window
function drawModal() {
	// get obj
	var objModal = window.drawings[($('#myModalLabel').attr("drawing"))];
	// plot
	$("#modal_plot").html("");
	JSROOT.redraw("modal_plot", objModal, "");
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
