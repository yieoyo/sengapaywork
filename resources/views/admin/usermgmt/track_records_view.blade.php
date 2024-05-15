@extends('admin.layouts.default')
@section('content')

<script src="https://apis.google.com/js/platform.js" async defer></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMgMY6mK9HrydKgaWcVezBsI5PfChv4bY&libraries=places"></script>
<script src="<?php echo WEBSITE_JS_URL;?>jquery.geocomplete.js"></script>

<section class="content-header">
	
	<?php 
	//echo TRACK_IMG_URL;
	//echo TRACK_IMG_ROOT_PATH;
	//pr($trackData); die; ?>
	
	
	<h1>
		 {{ trans("User Detail") }} 
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}">{{ trans("Users Management") }}</a></li>
		<li><a href="{{URL::to('admin/users/track-records/'.$trackData->user_id)}}">{{ trans("Track Records") }}</a></li>
		<li class="active"> {{ trans("User Detail") }}  </li>
	</ol>
</section>
<div class="box box-warning"> 
	<div class="tracking_map_iframe">
		<div class="row pad">
			<div class="col-sm-12">
				<div class="tracking_map_blk">
					<div class="map_dv_to" id="to_google_map" style="height:200px;width:100%; margin-top:10px;"></div>
				</div>
			</div>
			<div class="">
				<div class="tracking_map_li_blk">
					@if(!empty($trackData->TrackDetail))
						@foreach($trackData->TrackDetail as $key => $record) 
							<div class="tracking_map_li_content_blk">
								<div class="tracking_map_id_info_blk">
									<div class="tracking_map_id_title">{{ $record->name }}</div>
									<div class="tracking_map_id_date">{{ ($record->track_date > "0000-00-00 00:00:00") ? date(Config::get("Reading.date_format") , strtotime($record->track_date)):'-' }}</span></div>
									<div class="clearfix"></div>
								</div>
								
								<div class="tracking_map_id_desc_blk">
									<div class="tracking_map_id_desc">
										<div class="tracking_map_id_description">{{ $record->img_description }}</div>
										<div class="tracking_map_id_address">S-3/5-4, Sector-4, Kiran Path, Madhyam Marg, Mansarovar, Mansarovar</div>
									</div>
									
										@if($record->image != '' && File::exists(TRACK_IMG_ROOT_PATH.$record->image))
											
											<?php $trackimage	=	WEBSITE_URL.'image.php?height=75px&image='.TRACK_IMG_URL.'/'.$record->image; ?>
										@else	
											<?php $trackimage	=	WEBSITE_IMG_URL . "admin/no_image.jpg"; ?>
										@endif
									<div class="tracking_map_id_img" style="background-image:url('{{$trackimage}}')"></div>
									<div class="clearfix"></div>
								</div>
							</div>
					@endforeach
					@else
						<div class="tracking_map_li_content_blk">	
							{{ trans("No Record Found") }}
						</div>
					@endif
					
				</div>
			</div>
			
			<!--<div class="col-md-6 col-sm-6">	
				<table class="table table-bordered table-responsive">
					<tbody>
						<?php /* <tr>
							<th  width="30%">Profile Image</th>
							<td data-th='First Name'>
								<?php 
									$image		=	isset($userDetails->image) ? $userDetails->image : '';
								?>
								@if($image != '' && File::exists(USER_PROFILE_IMAGE_ROOT_PATH.$image))
									<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo USER_PROFILE_IMAGE_URL.$userDetails->image; ?>">
										<div class="usermgmt_image">
											<img  src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&image='.USER_PROFILE_IMAGE_URL.'/'.$userDetails->image ?>">
										</div>
									</a>
								@endif
							</td>
						</tr> */ ?>
						<tr>
							<th  width="30%">Track ID</th>
							<td data-th='Track ID'>{{ isset($trackData->track_id) ? $trackData->track_id:'' }}</td>
						</tr>
						<tr>
							<th  width="30%">User Name</th>
							<td data-th='User Name'>{{ isset($trackData->user_name) ? $trackData->user_name :'' }}</td>
						</tr>
						<tr>
							<th  width="30%">Strat Time</th>
							<td data-th='Strat Time'>{{ isset($trackData->start_time) ? $trackData->start_time :'' }}</td>
						</tr>
						<tr>
							<th  width="30%">End Time</th>
							<td data-th='End Time'>{{ isset($trackData->end_time) ? $trackData->end_time :'' }}</td>
						</tr>
					</tbody>
				</table>
			</div>-->
			
			
			<?php /* <div class="col-md-6 col-sm-6">	
				<table class="table table-bordered table-responsive">
					<tr>
						<th  width="30%">Email</th>
						<td data-th='Email'><a href="mailTo:{{ $userDetails->email }}">{{ $userDetails->email }}</a></td>
					</tr>
					
				
					<tr>
						<th  width="30%">Phone Number</th>
						<td data-th='Phone'>{{ isset($userDetails->phone) ? $userDetails->phone :''  }}</td>
					</tr>
					
					<tr>
						<th  width="30%">Address</th>
						<td data-th='Address'>{{ str_replace("\n","<br />",$userDetails->address) }}</td>
					</tr>
					<tr>
						<th width="20%" >City</th>
						<td data-th='Country'>{{ $userDetails->city }}</td>
					</tr>
					<tr>
						<th width="20%" >State</th>
						<td data-th='Country'>{{ $userDetails->state }}</td>
					</tr>
					<tr>
						<th width="20%" >Country</th>
						<td data-th='Country'>{{ $userDetails->country_name }}</td>
					</tr>
					<tr>
						<th  width="30%">Created On</th>
						<td data-th='Created On'>{{ date(Config::get("Reading.date_format") , strtotime($userDetails->created_at)) }}</td>
					</tr>
				</table>
			</div> */ ?>
		
		<!--<div class="location_input">
			<div class="row">
				<div class="col-sm-12">
				<div class="map_dv_to" id="to_google_map" style="height:200px;width:100%; margin-top:10px;">
				 </div></div>
			
			</div>
		</div>-->
		
		
		
		</div>
	</div>
</div>

<script>

// map code start here //
$(function(){
	var from_lat				=	"<?php echo !empty($trackData->latitude) ? $trackData->latitude:'0.00'; ?>";
	var from_lon				=	"<?php echo !empty($trackData->longitude) ? $trackData->longitude:'0.00'; ?>";
	var to_lat					=	"<?php echo !empty($trackData->end_latitude) ? $trackData->track_id:'0.00'; ?>";
	var to_lon					=	"<?php echo !empty($trackData->end_longitude) ? $trackData->track_id:'0.00'; ?>";
	
	var map = new google.maps.Map(document.getElementById('to_google_map'));
	var start = new google.maps.LatLng(from_lat, from_lon);
	var end = new google.maps.LatLng(to_lat, to_lon);
//	alert(end);
	
	var directionsDisplay = new google.maps.DirectionsRenderer();// also, constructor can get "DirectionsRendererOptions" object
	directionsDisplay.setMap(map); // map should be already initialized.

	var request = {
		origin : start,
		destination : end,
		travelMode : google.maps.TravelMode.DRIVING
	};
	var directionsService = new google.maps.DirectionsService(); 
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
	
})
// map code end here //


// old code //
	function show_both_map(){
		var from_location			=	$('#ProjectFromLocation').val();
		var to_location				=	$('#ProjectToLocation').val();
		var from_lat				=	0.00;
		var from_lon				=	0.00;
		var to_lat					=	0.00;
		var to_lon					=	0.00;
		if(from_location != "" && to_location != "") {
				var geocoder =  new google.maps.Geocoder();
				geocoder.geocode( { 'address': from_location}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						from_lat	=	results[0].geometry.location.lat();
						from_lon 	=	results[0].geometry.location.lng();
					}
				});
				
				var geocoder =  new google.maps.Geocoder();
				geocoder.geocode( { 'address': to_location}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						to_lat	=	results[0].geometry.location.lat();
						to_lon 	=	results[0].geometry.location.lng();
					}
				});
			$("#loader_img").show();
			setTimeout(function(){
				var map = new google.maps.Map(document.getElementById('to_google_map'));
				var start = new google.maps.LatLng(from_lat, from_lon);
				var end = new google.maps.LatLng(to_lat, to_lon);
				
				var directionsDisplay = new google.maps.DirectionsRenderer();// also, constructor can get "DirectionsRendererOptions" object
				directionsDisplay.setMap(map); // map should be already initialized.

				var request = {
					origin : start,
					destination : end,
					travelMode : google.maps.TravelMode.DRIVING
				};
				var directionsService = new google.maps.DirectionsService(); 
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});
				$("#loader_img").hide();
			}, 4000);
		}else if(from_location != "") {
			show_from_map();
		}else if(to_location != "") {
			show_to_map();
		}
	}
	function show_from_map() {
		$(".to_map_hidden").slideDown();
		$(this).html("Change map");
		var form_location			=	$('#ProjectFromLocation').val();
		if($.trim(form_location) != "") {
			var geocoder =  new google.maps.Geocoder();
			geocoder.geocode( { 'address': $('#ProjectFromLocation').val()}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var myLatLng = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
					var map = new google.maps.Map(document.getElementById('to_google_map'), {
					  zoom: 17,
					  center: myLatLng
					});
					var marker = new google.maps.Marker({
					  position: myLatLng,
					  map: map,
					  title: 'Job Location'
					});
				}
			});
		}
	}
	
	function show_to_map() {
		
		$(".to_map_hidden").slideDown(); 
		
		var to_location			=	$('#ProjectToLocation').val();
		if($.trim(to_location) != "") {
			var geocoder =  new google.maps.Geocoder();
			geocoder.geocode( { 'address': $('#ProjectToLocation').val()}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var myLatLng = {lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng()};
					var map = new google.maps.Map(document.getElementById('to_google_map'), {
					  zoom: 17,
					  center: myLatLng
					});
					var marker = new google.maps.Marker({
					  position: myLatLng,
					  map: map,
					  title: 'Job To Location'
					});
				}
			});
		}
	}
	
	$(function(){
		 $(".map_location").geocomplete();
  	});
</script>

@stop
