// callback function called to populate the page from the ROOT file

// called when ROOT is ready
function createmyGUI() {
    // absolute file path can be used as well
    var filename = "../data/controlPlots_ttbar.root";
    new JSROOT.TFile(filename, onFileOpen);
}

// called when the file is open
function onFileOpen(file) {
      window.fileObj = file; // for debugging
      window.fileStructure = parseDirectory(file,file,"",buildFileStructure);

    var activeDir = QueryString.dir;
    // display the first plot (test)
    if(activeDir != undefined) {
      //TODO: get the first TH1F in the dir. (just an example)

    file.ReadDirectory(activeDir,function(dir) {
        var dirkeys = dir.fKeys;
        for(var i=0;i<dirkeys.length;i++) {
            if(dirkeys[i].fClassName==="TH1F") {
                file.ReadObject(activeDir+"/"+dirkeys[i].fName, function(obj) {
                    JSROOT.draw("drawing", obj, "");
                    window.objPlot = obj; // for debugging
                });
		break;
            }
        }
    });

    } else {
    // default
        //new JSROOT.TFile(filename, function(file) {
        //   file.ReadObject("stage_5/top/bestHmass", function(obj) {
        //      JSROOT.draw("drawing", obj, "");
        //      window.objPlot = obj;
        //   });
        //});
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
			rootElement.append($("<li/>").html($("<a/>").attr('href','?dir='+tree[i].name).html(tree[i].title)));
		}
	}
}

// redraw on resize
$(window).resize(function() {
  $("#drawing").html("");
  JSROOT.draw("drawing", window.objPlot, "");
});

$(function(){
});

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
