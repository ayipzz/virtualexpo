/*
* @Author: ayipzz
* @Date:   2016-10-18 19:50:17
* @Last Modified by:   ayipzz
* @Last Modified time: 2016-10-22 13:50:32
*/

var app = angular.module('virtualExpo', ['ngMap']);
app.controller('mapController', function($scope,$http,NgMap) {
	var vm = this;
  	NgMap.getMap().then(function(map) {
  	  vm.map = map;
  	});
	vm.getEvent = function() {
		var start_date = $("#startdate").val();
		var end_date = $("#enddate").val();
		var eventcategory = $("#eventcategory").val();
		var allvalues = {
			startdate : start_date,
		  	enddate : end_date,
		  	eventcategory : eventcategory
		};
		$http({
			url: 'get_event', 
		    method: "GET",
		    params: allvalues
		}).success(function(hasil){
			vm.shops = hasil;
			$("#startdate").val(start_date);
			$("#enddate").val(end_date);
		});
	};

  	vm.getEvent();
  	vm.getEventCategory = function() {
		$http({
			url: 'get_eventcategory', 
		    method: "GET"
		}).success(function(hasil){
			vm.ev_category = hasil;
		});
	};

  	vm.getEventCategory();
	vm.showDetail = function(e, shop) {
  		$scope.shop = shop;
  		$(".event-header").removeClass("hidden").addClass("visible");
  		$(".event-found").html(shop.event_list.length);
  		$(".event-list").css({'background-color' : '#57767c'});
  	};
  	vm.bookPlace = function(eventselected) {
  		$scope.eventname = eventselected.event_name;
  		$scope.keyword = "Select the stand to book";

  		var allvalues = {
  			events_id : eventselected.event_id
  		};
		$("#myMaps").removeClass("visible").addClass("hidden");
  		$http({
			url: 'get_stands', 
		    method: "GET",
		    params: allvalues
		}).success(function(hasil){
			if(hasil.length > 0) {
				$("#myMaps").removeClass("hidden").addClass("visible");
				$scope.stands = hasil[0].event_stands;
				$('#myMaps').wayfinding({
					'maps': [
						{'path': hasil[0].event_stands, 'id': 'stand1'}
					],
					'defaultMap': 'stand1',
					'showLocation': true
				}, function(){
					console.log('callback reached');
					var doc;
					for(var i = 0; i < hasil[0].event_resv.length; i++) {
						$('#'+hasil[0].event_resv[i].stand_resv).css({
							'fill': 'rgb(180, 180, 180)',
							'stroke': "#000000"
						});
 						var svgimg = document.createElementNS('http://www.w3.org/2000/svg','image');
						svgimg.setAttributeNS(null,'height',document.getElementById(hasil[0].event_resv[i].stand_resv).getAttribute("height"));
						svgimg.setAttributeNS(null,'width',document.getElementById(hasil[0].event_resv[i].stand_resv).getAttribute("width"));
						svgimg.setAttributeNS('http://www.w3.org/1999/xlink','href', hasil[0].event_resv[i].company_logo);
						svgimg.setAttributeNS(null,'x',document.getElementById(hasil[0].event_resv[i].stand_resv).getAttribute("x"));
						svgimg.setAttributeNS(null,'y',document.getElementById(hasil[0].event_resv[i].stand_resv).getAttribute("y"));
						svgimg.setAttributeNS(null, 'visibility', 'visible');
						$('svg').append(svgimg);
						doc =hasil[0].event_resv[i].company_doc;
						$('#'+hasil[0].event_resv[i].stand_resv).on("click", {value: doc}, function(e) {
							console.log(e.data.value);
							if(confirm("Are you sure to download marketing document this company ?")) {
								//location.href = doc;
								window.open(e.data.value,'_blank');
							}
						});
						
					}
				});

				
				$('#myMaps').on('wayfinding:roomClicked', function(e, r) {

					//console.log(r.roomId);
					//console.log($('#'+r.roomId+' *').attr('id'));
					if($('#'+r.roomId+' *').css("fill") == 'rgb(180, 180, 180)') {

					} else {
						if($('#'+r.roomId+' *').css("fill") == 'rgb(120, 242, 48)') {
							$('#'+r.roomId+' *').css({
								'fill': 'rgb(252, 252, 252)',
								'stroke': "#000000"
							});
						} else {
							var stands_id = $('#'+r.roomId+' *').attr('id');
							$('#'+r.roomId+' *').css({
								'fill': 'rgb(120, 242, 48)',
								'stroke': "#000000"
							});

							$('#reservationModal').modal('show').one('shown.bs.modal', function (event) {
								vm.standDetail(eventselected.event_id, stands_id);
							}).on('hide.bs.modal', function (event) {
	  							$('#'+r.roomId+' *').css({
								'fill': 'rgb(252, 252, 252)',
								'stroke': "#000000"
								});
	  						});

						}
					}
				});
			} else {
				$('#myMaps').html("");
				$scope.mymaps = '';
			}
		});
  	};
  	vm.standDetail = function(event_id, stand_id, source = 'modal') {
		var std_id = stand_id.split('_');
  		var allvalues4 = {
			event_id : event_id,
			stands_id : stand_id
		};
		$("#event_id").val(event_id);
		$("#stand_id").val(stand_id);
		$http({
			url: 'get_stands_detail', 
			method: "GET",
			params: allvalues4
		}).success(function(hasil4){
			if(source == 'modal') {
				$("#reservationModalLabel").html("Stands "+hasil4[0].event_name);
			}
			var stand_image = '';
			if(hasil4[0].event_standimage = '' || hasil4[0].event_standimage == null) {
				stand_image = 'assets/front/images/stand_empty.jpg';
			} else {
				stand_image = hasil4[0].event_standimage;
			}
			var html_stand = '';
			html_stand += '<div class="media">';
  			html_stand += '<div class="media-left">';
    		html_stand += '<a href="#">';
      		html_stand += '<img class="media-object" src="'+stand_image+'" width="200" alt="'+hasil4[0].event_name+'">';
    		html_stand += '</a>';
  			html_stand += '</div>';
  			html_stand += '<div class="media-body">';
    		html_stand += '<p><b>Stand ID :</b> '+std_id[1]+'</p><p><b>Price :</b> '+money(hasil4[0].event_price,"")+'</p><p><b>Date :</b> '+dateformat(hasil4[0].event_startdate)+' -  '+dateformat(hasil4[0].event_enddate)+'</p><p><b>Location :</b> '+hasil4[0].event_location+'</p><p><b>Description :</b> '+hasil4[0].event_description+'</p>';
    		html_stand += '</div>';
			html_stand += '</div>';
			if(source == 'modal') {
				$(".modal-body").html(html_stand);
			} else {
				$scope.standdetail = html_stand;
			}
		});
  	};
});

app.directive("eventHeader", function() {
    return {
    	restrict : "A",
        template : "<h3>Event List</h3><p> <span class='event-found'></span> event found, please select the event to book your place</p>"
    };
});
app.directive("tplEventList", function() {
    return {
    	restrict : "E",
        templateUrl : 'template_event_list'
    };
});
app.directive("tplBookEvent", function() {
    return {
    	restrict : "E",
        templateUrl : 'template_book_event'
    };
});

function money (source, type) {
	var id;
	if(type == 'form') id = source.val();
	else id = source;
	id = id.replace(/[\D\s\._\-]+/g, "");
    id = id ? parseInt( id, 10 ) : 0;
		
	if(type == 'form') {
		source.val( function() {
	    	return ( id === 0 ) ? 0 : id.toLocaleString( "id-ID" );
	    });
	} else return id.toLocaleString( "id-ID" );
};

function dateformat(date) {
	var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep", "Oct", "Nov", "Dec"];
	var d = new Date(date);
	var year = d.getFullYear();
	var month = months[d.getMonth()];
	var day = d.getDate();

	return month+' '+day+', '+year;
}

function getStandDetail(event_id, stand_id)
{
	
}