var info = []; // Needed to access data from outside the JSON processing function

// Global empty check
function isEmpty(value) {
	if (value == null || value == "" || value === undefined) {
		return true;
	} else {
		return false;
	}
}

/* Store information in a JS cookie */
function setCookie(c_name, value, expireDays, domain) {
	var exdate = new Date();
	if (expireDays == null) {
		expireDays = 365;
	}
	exdate.setDate(exdate.getDate() + expireDays);
	var cookie = c_name + "=" + escape(value) + ";expires=" + exdate.toGMTString() + "; path=" + domain;
	document.cookie = cookie;
}

/* Get information in a JS cookie */
function getCookie(c_name) {
	if (document.cookie.length > 0){
		var c_start = document.cookie.indexOf(c_name + "=");
		if (c_start!=-1) { 
			c_start = c_start + c_name.length + 1; 
			c_end = document.cookie.indexOf(";", c_start);
			if (c_end == -1) {
				c_end = document.cookie.length;
			}
			return unescape(document.cookie.substring(c_start, c_end));
		}
	}
	return "";
}


// Read a page's GET URL variables and return them as an associative array.
function getUrlVars()
{
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

// HTML5 geolocation
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(storeLngLatCookie,errorFindingLocation);
	}
	else {
		alert("Geolocation is not supported by this browser.");
	}
}

function errorFindingLocation() {
	alert('There has been an error trying to find your location.');
}

function storeLngLatCookie(position) {
	setCookie('loclng', position.coords.longitude, 1, '/');
	setCookie('loclat', position.coords.latitude, 1, '/');
}

// Geocoding
var map;
var markers = [];
var infoWindow;
var locationSelect;

function load() {
	map = new google.maps.Map(document.getElementById("map"), {
		center: new google.maps.LatLng(53.252069, -1.845703),
		zoom: 4,
		mapTypeId: 'roadmap',
		mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
	});
	infoWindow = new google.maps.InfoWindow();

	locationSelect = document.getElementById("locationSelect");

	locationSelect.onchange = function() {
		var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
	    if (markerNum != "none") {
	    	google.maps.event.trigger(markers[markerNum], 'click');
	    }
	};
}

function searchLocations(val) {
	if (!isEmpty(val)) {
		var address = val;
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({address: address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				searchLocationsNear(results[0].geometry.location);
			} else {
				alert(address + ' not found');
			}
		});
	}
}

function clearLocations() {
	infoWindow.close();
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	}
	markers.length = 0;

	locationSelect.innerHTML = "";
	var option = document.createElement("option");
	option.value = "none";
	option.innerHTML = "See all results:";
	locationSelect.appendChild(option);
}

function searchLocationsNear(center) {
	clearLocations();
	var radius = document.getElementById('radiusSelect').value;
	var searchUrl = '/teacher-town/index.php/ajax_results?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius;
 
	downloadUrl(searchUrl, function(data) {
		var xml = parseXml(data);
		var markerNodes = xml.documentElement.getElementsByTagName("marker");
		var bounds = new google.maps.LatLngBounds();
		clearTeacherListings();
		for (var i = 0; i < markerNodes.length; i++) {
			var name = markerNodes[i].getAttribute("name");
			var userId = markerNodes[i].getAttribute("userId");
			var locationName = markerNodes[i].getAttribute("locationName");
			var address = markerNodes[i].getAttribute("address");
			var distance = parseFloat(markerNodes[i].getAttribute("distance"));
			var latlng = new google.maps.LatLng(parseFloat(markerNodes[i].getAttribute("lat")),parseFloat(markerNodes[i].getAttribute("lng")));
			createOption(name, distance, i);
			createMarker(latlng, name, address);
			createTeacherListings(name,userId,locationName); 
			bounds.extend(latlng);
		}
		var listener = google.maps.event.addListener(map, "idle", function() { 
			if (map.getZoom() > 16) map.setZoom(16); 
			google.maps.event.removeListener(listener); 
		});
		map.fitBounds(bounds);
		locationSelect.style.visibility = "visible";
		locationSelect.onchange = function() {
			var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
			google.maps.event.trigger(markers[markerNum], 'click');
		};
	});
}

function createMarker(latlng, name, address) {
	var html = "<b>" + name + "</b> <br/>" + address;
	var marker = new google.maps.Marker({
		map: map,
		position: latlng
	});
	google.maps.event.addListener(marker, 'click', function() {
		infoWindow.setContent(html);
		infoWindow.open(map, marker);
	});
	markers.push(marker);
}

function createOption(name, distance, num) {
	var option = document.createElement("option");
	option.value = num;
	option.innerHTML = name + "(" + distance.toFixed(1) + ")";
	locationSelect.appendChild(option);
}

function downloadUrl(url, callback) {
	var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;

	request.onreadystatechange = function() {
	    if (request.readyState == 4) {
	    	request.onreadystatechange = doNothing;
	    	callback(request.responseText, request.status);
	    }
	};

	request.open('GET', url, true);
	request.send(null);
}

function parseXml(str) {
	if (window.ActiveXObject) {
		var doc = new ActiveXObject('Microsoft.XMLDOM');
		doc.loadXML(str);
		return doc;
	} else if (window.DOMParser) {
		return (new DOMParser).parseFromString(str, 'text/xml');
	}
}

function doNothing() {}

function grabLongAndLat() {
	var addressLine1 = $('#addressLine1').val();
	var addressLine2 = $('#addressLine2').val();
	var city = $('#addressCity').val();
	var postCode = $('#postCode').val();
	
	if (!isEmpty(addressLine1) && !isEmpty(addressCity) && !isEmpty(postCode)) {
		var address = addressLine1 + ',' + addressCity + ',' + postCode;
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({address: address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latNgString = String(results[0].geometry.location);
        		var stringLength = latNgString.length;
        		latNgString = latNgString.slice(1,stringLength-1);
        		var latNgArr = latNgString.split(",");
        		$("#lat").val($.trim(latNgArr[0]));
        		$("#lng").val($.trim(latNgArr[1]));
				
			} else {
				alert(address + ' not found');
			}
		});
	}
}

function clearTeacherListings() {
	// clears current listings
	$('.listings .teacherItem').fadeOut('slow').remove();
}

function createTeacherListings(name,id,locationName) {
	
	// forAjax div still there even after clearing all results so we append to div which retains sort
	$('.listings div:last').after('<div class="teacherItem"><h2><a href="http://localhost/teacher-town/index.php/teacher/' + name + '/' + id +'">' + name + '</a> [' + locationName + ']</h2></div>');
}

$(document).ready(function(){
	
	// Datepicker
	var d = new Date();
	var startY=d.getFullYear() - 90;
	var endY=d.getFullYear() - 18;
	$("#dobPicker").datepicker({"dateFormat":"dd/mm/yy","changeYear":true,yearRange: startY+':'+endY});

	// Timepicker
	$('.timePicker').timepicker();
	
	// Get long / lat on register
	$('#postCode').focusout(function() {
		grabLongAndLat();
	});
	
	// HTML5: use my location
	$('form input.useLocation').click(function(e){
		e.preventDefault();
		// Set to disabled as we don't want post code to be populated
		$('#addressInput').attr('disabled','disabled');
		getLocation();
		$(this).parent('form').submit();
	});
	
	// If search locations button is pressed
	$('.searchLocations[type=button]').click(function() {
		searchLocations($("#addressInput").val());
	});
	
});

$(window).load(function() {
	
	// Geocoding setup
	if ($('#map').length > 0) {
		load();
	}
	
	// If postcode GET URL param exists and has a value, load results. 
	// Else, check if lnglat cookie is stored.
	urlAddress = getUrlVars()["pc"];
	if (!isEmpty(urlAddress)) {
		searchLocations(urlAddress);
	} else {
		var lngLatCookie = new google.maps.LatLng(getCookie('loclat'),getCookie('loclng'));
		if (!isEmpty(lngLatCookie.Ya) || !isEmpty(lngLatCookie.Za)) {
			searchLocationsNear(lngLatCookie);
		}
	}
	
});