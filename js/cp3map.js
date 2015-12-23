$(function () { 
    // load building layouts
    var size = window.innerHeight < $('#cp3level1').width() ? window.innerHeight : $('#cp3level1').width();
    $('#cp3level1').css("min-height",size);
    $('#cp3level1').svg({loadURL: 'CP3level1.svg', onLoad: mapCallback});
    $('#cp3level1').css("min-height",20);
    var svg1 = $('#cp3level1').svg('get');
    size = window.innerHeight < $('#cp3level2').width() ? window.innerHeight : $('#cp3level2').width();
    $('#cp3level2').css("min-height",size)
    $('#cp3level2').svg({loadURL: 'CP3level2.svg', onLoad: mapCallback});
    $('#cp3level2').css("min-height",20);
    var svg2 = $('#cp3level2').svg('get');
    size = window.innerHeight < $('#cp3level3').width() ? window.innerHeight : $('#cp3level3').width();
    $('#cp3level3').css("min-height",size)
    $('#cp3level3').svg({loadURL: 'CP3level3.svg', onLoad: mapCallback});
    $('#cp3level3').css("min-height",20);
    var svg3 = $('#cp3level3').svg('get');
    //populate the form (combo box and list for search
    $.getJSON( "../data/towerE.json","salt="+makeid(), prepareForm );
    //register handlers for the form
    $('#sel1').on('change',function(){
           // handler for the event
           console.log($("#sel1").val());
           highlightRoom($("#sel1").val());
    });
    $('#search1 .btn').click(function(){
           // handler for search click
           console.log($('#search1 .form-control').val());
           var room = findRoom($('#search1 .form-control').val());
           highlightRoom(room);
    });
    $("#search1 .btn").mouseup(function(){
       $(this).blur();
    });
    // disable the submit when pressing enter in the input field
    $('#mapform').on('keyup keypress', function(e) {
      var code = e.keyCode || e.which;
      if (code == 13) { 
        e.preventDefault();
        return false;
      }
    });

});

function findRoom(name) {
    for (var idx=0; idx<allnames.length; idx++) {
       var n = allnames[idx].toLowerCase().search(name.toLowerCase());
       if (n!=-1) {
          return associatedRooms[idx];
       }
    }
}

function highlightRoom(room) {

    if (typeof lastHighlight != 'undefined')
      lastHighlight.css("fill","white");
    var re = /(\w)\.(\d{3})/;
    var area = '#$1$2_area';
    var purpose = '#$1$2_purpose';
    var purpose2 = '#$1$2_purpose2';
    var user1 = '#$1$2_user1';
    var user2 = '#$1$2_user2';
    var user3 = '#$1$2_user3';
    lastHighlight = $(room.replace(re, area));
    lastHighlight.css("fill","yellow");

    // scroll there
    $('html, body').animate({
        scrollTop: lastHighlight.parents("svg").offset().top
    }, 2000);

    // modal popup with some text from one room
    $("#myModal .modal-title").html(room);
    var body = $("#myModal .modal-body p");
    body.html("");
    body.append($("<p/>").html($(room.replace(re, purpose)).html()),
                $("<p/>").html($(room.replace(re, purpose2)).html()),
                $("<p/>").html($(room.replace(re, user1)).html()),
                $("<p/>").html($(room.replace(re, user2)).html()),
                $("<p/>").html($(room.replace(re, user3)).html())
    );
    $('#myModal').modal('show');

}

function prepareForm(data) {
    // Fill Combobox
    for (var floor in data.floors) {
    	if(data.floors.hasOwnProperty(floor)) {
    		for(var room in data.floors[floor]) {
    			$("#sel1").append($("<option/>").html(data.floors[floor][room]));
    		}
    	}
    }
    // Build a list of names that we can search for
    allnames = [];
    associatedRooms = []
    var excludedNames=["","NA","None","XX","AN"];
    for (var room in data.rooms) {
    	if(data.rooms.hasOwnProperty(room)) {
		if(!isInArray(data.rooms[room].user1,excludedNames)) {
			allnames.push(data.rooms[room].user1);
			associatedRooms.push(room);
		}
		if(!isInArray(data.rooms[room].user2,excludedNames)) {
			allnames.push(data.rooms[room].user2);
			associatedRooms.push(room);
		}
		if(!isInArray(data.rooms[room].user3,excludedNames)) {
			allnames.push(data.rooms[room].user3);
			associatedRooms.push(room);
		}
    	}
    }
}

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function mapCallback() {
    // auto-resize
    var svg = $(this).children("svg")
    svg.width("100%");
    svg.height("100%");

    // load the SVG
    var floor = $(this).attr("data-floor");
    $.getJSON( "../data/towerE.json","salt="+makeid(), (function(thisfloor, thissvg) { return function(data) { fillmap(data,thisfloor,thissvg); };  }(floor,svg)) );

}

function fillmap(data, floor, svg) {
    var floor = data.floors[floor];
    var rooms = data.rooms;
    var re = /(\w)\.(\d{3})/; 
    var entity = '#$1$2_entity'; 
    var purpose = '#$1$2_purpose';
    var purpose2 = '#$1$2_purpose2';
    var user1 = '#$1$2_user1'; 
    var user2 = '#$1$2_user2'; 
    var user3 = '#$1$2_user3'; 
    //console.log(floor);
    
    for(var roomid=0;roomid<floor.length;roomid++) {
      var roomName = floor[roomid];
      var room = rooms[floor[roomid]];

      // user NA means not available
      // user None means empty
      // in both cases, display nothing
      if (room.user1=="NA") { room.user1="" }
      if (room.user2=="NA") { room.user2="" }
      if (room.user3=="NA") { room.user3="" }
      if (room.user1=="None") { room.user1="" }
      if (room.user2=="None") { room.user2="" }
      if (room.user3=="None") { room.user3="" }
      $(svg).find(roomName.replace(re, entity)).html(room.owner);
      var purposes = room.purpose.split("\n");
      if(purposes.length==1) { purposes.push(""); }

      // check if there is a purpose in the svg and in the json
      // depending on the case, do the best we can to render properly
      // purposes and users.
      var hasPurpose = $(svg).find(roomName.replace(re, purpose)).length;
      var hasPurpose2 = $(svg).find(roomName.replace(re, purpose2)).length;
      if(hasPurpose && hasPurpose2) {
          $(svg).find(roomName.replace(re, purpose)).html(purposes[0]);
          $(svg).find(roomName.replace(re, purpose2)).html(purposes[1]);
          $(svg).find(roomName.replace(re, user1)).html(room.user1);
          $(svg).find(roomName.replace(re, user2)).html(room.user2);
          $(svg).find(roomName.replace(re, user3)).html(room.user3);
	      
      } else if (hasPurpose) {
          $(svg).find(roomName.replace(re, purpose)).html(room.purpose);
          $(svg).find(roomName.replace(re, user1)).html(room.user1);
          $(svg).find(roomName.replace(re, user2)).html(room.user2);
          $(svg).find(roomName.replace(re, user3)).html(room.user3);
      } else {
	      if(purposes[1]!="") {
		      room.user3=room.user1;
		      room.user1=purposes[0];
		      room.user2=purposes[1];
	      } else if(purposes[0]!="") {
		      room.user3=room.user2;
		      room.user2=room.user1;
		      room.user1=purposes[0];
	      }
              $(svg).find(roomName.replace(re, user1)).html(room.user1);
              $(svg).find(roomName.replace(re, user2)).html(room.user2);
              $(svg).find(roomName.replace(re, user3)).html(room.user3);
      }
    }
}


// another issue is how to handle the form/the parameters on the address line. 
// for the demo, write another page with the room or user as argument. 
