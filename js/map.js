$(function() {

	var marker = [], infowindow = [], map;

	function addMarker(location,name,contentstr,markimg){
    marker[name] = new google.maps.Marker({
        position: location,
        map: map,
				icon: markimg
    });
    marker[name].setMap(map);
		
		infowindow[name] = new google.maps.InfoWindow({
			content:contentstr
		});
		
		google.maps.event.addListener(marker[name], 'click', function(){
			infowindow[name].open(map,marker[name]);
		});
   }
	
	function initialize() {
		var lat = $('#map').attr("data-lat");
		var lng = $('#map').attr("data-lng");
		var myLatlng = new google.maps.LatLng(lat,lng);
		var setZoom = parseInt($('#map').attr("data-zoom"));
		var styles = [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]
		var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
		var mapOptions = {
			zoom: setZoom,
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM
			},
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE,
				position: google.maps.ControlPosition.LEFT_BOTTOM
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_BOTTOM
			},
			scrollwheel: false,
			center: myLatlng,
			mapTypeControlOptions:{
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			},
			fullscreenControl: false,
			mapTypeControl: false
		};

		map = new google.maps.Map(document.getElementById("map"), mapOptions);
		map.mapTypes.set('map_style', styledMap);
  		map.setMapTypeId('map_style');
		

		$('.addresses-block a').each(function(){
			var mark_lat = $(this).attr('data-lat');
			var mark_lng = $(this).attr('data-lng');
			var this_index = $('.addresses-block a').index(this);
			var mark_name = 'template_marker_'+this_index;
			var mark_locat = new google.maps.LatLng(mark_lat, mark_lng);
			var mark_str = $(this).attr('data-string');
			var mark_img = $(this).attr('data-marker');
			addMarker(mark_locat,mark_name,mark_str,mark_img);	
		});
		
	}

	if ($('#map').length) {
    setTimeout(function(){initialize();}, 500);
  }

});