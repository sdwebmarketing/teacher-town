var info = []; // Needed to access data from outside the JSON processing function

$(document).ready(function(){
	
	// Datepicker
	var d = new Date();
	var startY=d.getFullYear() - 90;
	var endY=d.getFullYear() - 18;
	$("#dobPicker").datepicker({"dateFormat":"dd/mm/yy","changeYear":true,yearRange: startY+':'+endY});

	// Timepicker
	$('.timePicker').timepicker();
	
	// Find Postcode
	
	$(".postCodeFindSubmit").click(function(event) {
		$("#addressResult").html("Loading..."); // Loading
		$.ajax({
			dataType: 'jsonp',
			data: 'postcode='+$(".postCode").val()+'&number='+$("#houseNumber").val(),
			jsonp: 'jsonp_callback',
			url: '//www.tabcat.co.uk/postcode_lookup_json_v2.php',
			success: function (data) {
				var options;
				//This bit populates the <select> with addresses and an onclick event to populate HTML entities on the page
				$("#addressResult").html("<select onclick='if($.browser.msie && $.browser.version==\"6.0\") alert(\"Thanks. Your address selection will now be populated into the order form.\"); $(\"#address\").val(info[this.value].address); $(\"#city\").val(info[this.value].town); $(\"#county\").val(info[this.value].county); $(\"#postcode\").val(info[this.value].postcode);' style='display: none' multiple='multiple' id='addressResults'></select>");
				for(var i in data) {
					info[i] = data[i];
					options=data[i].address+", "+data[i].town+", "+data[i].county+", "+data[i].postcode;
					$("#addressResults").append("<option value='"+i+"'>"+options+"</option>");
				}
				
				function addressSelected(address) {
					$("#addressResults").hide();
					$("#resultSelected").val(address).show();
					$("#useAddress").hide();
				}
				
				function geocodePostCode() {
					var postcode = $("#postCode").val();
					var address = $("#address").val();
					
					var loc = postcode + "," + address;
					var geocoder = new google.maps.Geocoder();
			        geocoder.geocode( {'address': loc }, function(data, status) { 
		        		var latNgString = String(data[0].geometry.location);
		        		var stringLength = latNgString.length;
		        		latNgString = latNgString.slice(1,stringLength-1);
		        		var latNgArr = latNgString.split(",");
		        		console.log(latNgString);
		        		$("#lat").val($.trim(latNgArr[0]));
		        		$("#lng").val($.trim(latNgArr[1]));
			        });
			        
			        addressSelected(address);
				}
				
				$("#addressResults").show("slow").dblclick(function(){
					geocodePostCode();
				});
				$("#useAddress").click(function(e){
					e.preventDefault();
					geocodePostCode();
				});
				
				$("#useAddress").show();
			},
		});
	});
})