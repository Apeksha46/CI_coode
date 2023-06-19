<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
	#map {
		height: 600px;
		width:  100%;
		position: inherit !important;
	}
      /* Optional: Makes the sample page fill the window. */
	html, body {
        height: 50%;
        margin: 0;
        padding: 0;
    }
    #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }
</style>
<div id="page-wrapper">
	<div class="header">
		<ol class="breadcrumb">
		  	<li><a href="<?php echo site_url('seller/Dashboard');?>">Home</a></li>
			<li class="active">Driver Tracking</li>
			<li></li>
		</ol> 			
	</div>
    <!-- /. PAGE INNER  -->
    <div id="page-inner" class="booking">
    	<div class="row">
    		<div class="col-md-12">
		    	<div id="map"></div>
		    	<input type="hidden" id = "start" value="<?php echo $data['pick_up_address']; ?>">
		    	<input type="hidden" id = "start_point" value="<?php echo $data['pick_up_latitude']; ?>">
		    	<input type="hidden" id = "end" value="<?php echo $data['cust_address']; ?>">
		    	<input type="hidden" id = "end_point" value="<?php echo $data['pick_up_longitude']; ?>">
		    	<input type="hidden" id = "driver_mobile" value="<?php if(empty($data['driver_mobile'])){ echo""; }else{ echo $data['driver_mobile']; } ?>">
		    	<input type="hidden" id = "driver_name" value="<?php echo $data['driver_name']; ?>">
		    	<input type="hidden" id = "driver_id" value="<?php echo $data['driver_id']; ?>">
		    	<input type="hidden" id = "driver_latitude" value="<?php echo $data['driver_latitude']; ?>">
		    	<input type="hidden" id = "driver_longitude" value="<?php echo $data['driver_longitude']; ?>">
		    	<input type="hidden" id = "driver_identification_id" value="<?php if(empty($data['driver_identification_id'])){ echo""; }else{ echo $data['driver_identification_id']; } ?>">
    		<!-- </div> -->
    	</div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXFc7HjeYZbFQxnYjJerXZv618R_Ir96o&libraries=places&callback=initMap" async defer></script>
<script>
	// $( document ).ready(function() {
	//     console.log( "ready!" );
	//     initMap();
	// });
  	function initMap() {
  		var center_lat = document.getElementById('start_point').value;
	    var center_long = document.getElementById('end_point').value;
	    // console.log(center_long)
	    // var center_points = new google.maps.LatLng(center_lat,center_long);
	    var center_points = new google.maps.LatLng(-32.0388251, 115.3996796);
	    console.log(center_points)
	    var directionsService = new google.maps.DirectionsService;
	    var directionsDisplay = new google.maps.DirectionsRenderer;
	    var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 8,
	      center: center_points
	    });
	    directionsDisplay.setMap(map);
	    calculateAndDisplayRoute(directionsService, directionsDisplay);

	    var name 				= document.getElementById('driver_name').value;
	    var address 			= document.getElementById('driver_identification_id').value;
	    var mobile  			= document.getElementById('driver_mobile').value;
	    var driver_id  			= document.getElementById('driver_id').value;
	    var driver_latitude  	= document.getElementById('driver_latitude').value;
	    var driver_longitude  	= document.getElementById('driver_longitude').value;
	    //set marker 
	    var infowincontent = document.createElement('div');
		var strong = document.createElement('strong');
		strong.textContent = name
		infowincontent.appendChild(strong);
		infowincontent.appendChild(document.createElement('br'));

		var text = document.createElement('text');
		text.textContent = address
		
		infowincontent.appendChild(text);

		// infowincontent.appendChild(document.createElement('br'));
		// var cellphone = document.createElement('text');
		// cellphone.textContent = mobile
		// infowincontent.appendChild(cellphone);
		// alert(infowincontent)
		setInterval(function(){ update_lat_lon(); }, 10000);

		var point = new google.maps.LatLng(driver_latitude,driver_longitude);
		// var point = {lat: driver_latitude, lng: driver_longitude};
	    var marker = new google.maps.Marker({
            map: map,
            position: point,
            title: 'Driver Identification Id : '+address+'   Driver Name : '+name+'  Driver Name : '+mobile
          });
          
	    // var onChangeHandler = function() {
	    //   calculateAndDisplayRoute(directionsService, directionsDisplay);
	    // };
	    // document.getElementById('start').addEventListener('change', onChangeHandler);
	    // document.getElementById('end').addEventListener('change', onChangeHandler);
    }

    function update_lat_lon()
    {
    	var driver_id = document.getElementById('driver_id').value;
    	// alert(driver_id)
    	$.ajax({
            url: '<?php echo site_url("seller/Booking/driver_update_location"); ?>',
            type: "GET",
            data: {
            	"driver_id" : driver_id
            },
            success: function (response) {
                var obj = JSON.parse(response);
                // console.log(obj.lat);

                if (obj.length > 0) {
                	var point = new google.maps.LatLng(obj['lat'],obj['longi']);
				    var marker = new google.maps.Marker({
			            map: map,
			            position: point,
			            title: 'Driver Identification Id : '+address+'   Name : '+name+'  Mobile : '+mobile
			        });
                }
            }
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    	// console.log(document.getElementById('end').value)
	    directionsService.route({
	      origin: document.getElementById('start').value,
	      destination: document.getElementById('end').value,
	      travelMode: 'DRIVING'
	    }, function(response, status) {
	    	// console.log(response)
	    	// console.log(status)
		    if (status === 'OK') {
		        directionsDisplay.setDirections(response);
		    } else {
		        window.alert('Directions request failed due to ' + status);
		    }
	    });
  	}
</script>
