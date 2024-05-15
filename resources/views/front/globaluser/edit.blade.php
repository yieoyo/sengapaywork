@extends('front.layouts.default')
@section('content')
<?php $login_user = Auth::user(); ?>
<?php $login_user_id = !empty(Auth::user()) ? Auth::user()->id : ""; ?>
<?php $image =	WEBSITE_URL.'image.php?width=100px&height=100px&image='.WEBSITE_IMG_URL."loader32222.gif"; ?>
{{ HTML::script('js/cropper.js') }}
{{ HTML::style('css/cropper.css') }}
<div class="userprofile-top text-center">
	<p class="username">{{ trans('messages.about_you') }}, <span>{{ Auth::user()->full_name }}</span>
	<small>{{ trans('messages.you_can_upload_your_photo') }} &amp; {{ trans("messages.information_here") }}.</small></p>
	<figure class="user">
		@if(Auth::user()->image != '' && File::exists(USER_PROFILE_IMAGE_ROOT_PATH.Auth::user()->image))
			<img alt="image" src="<?php echo WEBSITE_URL.'image.php?width=200px&height=200px&image='.USER_PROFILE_IMAGE_URL.Auth::user()->image ?>" class="photo user_profile_image" id="profile_image_src">
		@else
			<img src="{{WEBSITE_IMG_URL}}user-image.png" alt="image" class="photo user_profile_image" id="profile_image_src">
		@endif
		<div class="update-btn">
			<div>
				{{ Form::open(['role' => 'form','url' => "saveprofileimage",'id'=>"save_profile_image"]) }}
				<input type="file" class="form-control" name="profile_image" id="photoimg">
				<a href="#"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> {{ trans("messages.upload_photo") }}</a>
				{{ Form::close() }}
			</div>
		</div>
	</figure>
	<b>{{ trans("messages.upload_transparent_png_only") }} </b>
	<div class="container">
		{{ Form::open(['role' => 'form','url' => "saveprofile",'class' => 'text-left profile-form global-form','id'=>"save_profile"]) }}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
				<label for="">{{ trans('messages.first_name') }}</label>	
				{{ Form::text('first_name',isset($login_user->first_name) ? $login_user->first_name : '',['class' => "form-control" ,'placeholder' =>  trans('messages.first_name') ]) }}
				<span class="help-inline"></span>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				<label for="">{{ trans('messages.last_name') }}</label>
				{{ Form::text('last_name',isset($login_user->last_name) ? $login_user->last_name : '',['class' => "form-control" ,'placeholder' =>  trans('messages.last_name') ]) }}
				<span class="help-inline"></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">	
					<label for="">{{ trans('messages.phone_number') }}</label>
					{{ Form::text('phone_number',$login_user->phone_number, ['id' => 'country','class'=>'form-control ','placeholder' =>  trans('messages.phone_number')]) }}
					<span class="help-inline"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">{{ trans('messages.address') }}</label>
					{{ Form::text('address',isset($login_user->address) ? $login_user->address :'',['class' => "form-control txtra" ,'placeholder' =>  trans('messages.address') ]) }}
					<span class="help-inline" ></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">{{ trans('messages.country') }}</label>
					{{ Form::text('country',$login_user->country, ['class'=>'form-control ','placeholder' =>  trans('messages.country')]) }}
					<span class="help-inline"></span>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">{{ trans('messages.city') }}</label>
					{{ Form::text('city',isset($login_user->city) ? $login_user->city : '',['class' => "form-control" ,'placeholder' =>  trans('messages.city') ]) }}
					<span class="help-inline"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label for="">{{ trans('messages.timezone') }}</label>
					<?php $tzlist = Config::get('timezone');?>	
					{{ Form::select('timezone',array(null=>trans("messages.select_timezone"))+$tzlist, isset($login_user->timezone) ? $login_user->timezone :'',['class' => "form-control" ]) }}
					<span class="help-inline" id="timezone_error"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center"> 
				<div class="form-group">
					<input type="button" onclick="save_Profile();" class="btn btn-primary mt20" value="{{{ trans('messages.submit')}}}">
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

<div class="modal fade docs-cropped" id="getCroppedCanvasModal1" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title" id="getCroppedCanvasTitle">{{{ trans("messages.profile.crop_image") }}}</h4>
	  </div>
	  <div class="modal-body">
		 <div class="model_container">
				
					<div class="img_crop_box">
						<div class="img-container">
							<img src="{{$image}}" alt="<?php echo trans('messages.profile.loading'); ?>" id="crop_image" >
						</div>
					</div>
				<div class="clearfix"></div>
				<div class="doc_btn_grp" id="actions">
				  <div class="docs-buttons">
					
					<div class="btn-group">
					  <button id="zoomin" type="button" class="btns btn_theming" data-method="zoom" data-option="0.1" title="Zoom In">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
						  <span class="fa fa-search-plus"></span>
						</span>
					  </button>
					  <button id="zoomout" type="button" class="btns btn_theming" data-method="zoom" data-option="-0.1" title="Zoom Out">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
						  <span class="fa fa-search-minus"></span>
						</span>
					  </button>
					</div>

					<div class="btn-group">
					  <button type="button" id="move_left" class="btns btn_theming" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
						  <span class="fa fa-arrow-left"></span>
						</span>
					  </button>
					  <button type="button" id="move_right" class="btns btn_theming" data-method="move" data-option="10" data-second-option="0" title="Move Right">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
						  <span class="fa fa-arrow-right"></span>
						</span>
					  </button>
					  <button type="button" id="move_up" class="btns btn_theming" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
						  <span class="fa fa-arrow-up"></span>
						</span>
					  </button>
					  <button type="button" id="move_down" class="btns btn_theming" data-method="move" data-option="0" data-second-option="10" title="Move Down">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
						  <span class="fa fa-arrow-down"></span>
						</span>
					  </button>
					</div>

					<div class="btn-group">
					  <button type="button" id="rotateplus" class="btns btn_theming" data-method="rotate" data-option="-45" title="Rotate Left">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
						  <span class="fa fa-rotate-left"></span>
						</span>
					  </button>
					  <button type="button" id="rotateminus" class="btns btn_theming" data-method="rotate" data-option="45" title="Rotate Right">
						<span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
						  <span class="fa fa-rotate-right"></span>
						</span>
					  </button>
					</div>

				  </div>
				</div>
			  </div>
	  </div>
	  <div class="modal-footer">
	    <button type="button" id="button" class="btns_upld">{{{ trans("messages.profile.upload") }}}</button>
		<button type="button" class="btns_close" data-dismiss="modal">{{{ trans("messages.profile.close") }}}</button>
		
	  </div>
	</div>
  </div>
</div><!-- /.modal -->

<script>
	$(document).on('click','#move_left',function(e){
		$('#crop_image').cropper('move', -10,0);
	});
	
	$(document).on('click','#move_right',function(e){
		$('#crop_image').cropper('move', 10,0);
	});
	
	
	$(document).on('click','#move_up',function(e){
		$('#crop_image').cropper('move', 0,-10);
	});
	
	$(document).on('click','#move_down',function(e){
		$('#crop_image').cropper('move', 0,10);
	});
	
	
	$(document).on('click','#rotateplus',function(e){
		$('#crop_image').cropper('rotate', 45);
	});
	
	$(document).on('click','#flip_hor',function(e){
		$('#crop_image').cropper('scaleX', -1);
	});
	
	$(document).on('click','#flip_ver',function(e){
		$('#crop_image').cropper('scaleY', -1);
	});
	
	$(document).on('click','#rotateminus',function(e){
		$('#crop_image').cropper('rotate', -45);
	});
		
	$(document).on('click','#zoomin',function(e){
		$('#crop_image').cropper('zoom', 0.1);
	});
	$(document).on('click','#zoomout',function(e){
		$('#crop_image').cropper('zoom', -0.1);
	});

	function getRoundedCanvas(sourceCanvas) {
		var canvas = document.createElement('canvas');
		var context = canvas.getContext('2d');
		var width = sourceCanvas.width;
		var height = sourceCanvas.height;
		  
		canvas.width = width;
		canvas.height = height;
		context.beginPath();
		context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI);
		context.strokeStyle = 'rgba(0,0,0,0)';
		context.stroke();
		context.drawImage(sourceCanvas, 0, 0, width, height);
		return canvas;
	}

	$(function(){
		$(document).on('click','#button',function(){
			var croppedCanvas;
			var roundedCanvas;
			if (!croppable) {
			  return;
			}
			// Crop
			croppedCanvas = $('#crop_image').cropper('getCroppedCanvas');
			// Round
			roundedCanvas = getRoundedCanvas(croppedCanvas);
			// Show
			var img_cropped_src = roundedCanvas.toDataURL("image/png");
			$("#profile_image_src").attr("src",img_cropped_src);
			$('#getCroppedCanvasModal1').modal('hide');
			
			$.ajax({
				type : "post",
				url: '{{ URL("saveprofileimage") }}',
				data : {base64_image: img_cropped_src},
				success: function(r) {
					
				}
			});
			
      });
	  
	  
		$('#photoimg').change(function(){
			//$("#loader_img").show();
			$("#crop_image").cropper("destroy");
			var image_path			=		"";
			var oFReader = new FileReader();
			oFReader.readAsDataURL( $( this )[0].files[0] );
			oFReader.onload = function (oFREvent) {
				$('#photoimg').animate({opacity: 0}, 'slow', function(){
					image_path	=	oFREvent.target.result;
				});
			}; 
			   
			setTimeout(function(){
				$('#crop_image').attr('src',image_path);
				var obimage = $('#crop_image');  
				var obbutton = $('#button');
				var obresult = $('#result');
				obimage.cropper({
					viewMode: 1, 
					aspectRatio: 16/9, 
					autoCropArea: 0,
					strict: true,
					guides: false,
					cropBoxResizable: true,
					rotatable: true,
					responsive: true,
					background: false,
					dragCrop: false, 
					doubleClickToggle: false,
					built: function () {
					  croppable = true;
					},
					data: {
						height: 190, // Maybe need computation
						width: 190
					}
				});
			},2000); 
			$('#getCroppedCanvasModal1').modal('show');
			//$("#loader_img").hide();
		});
	});
	
	/* $(".profile_changebox").click(function(){
		$("#photoimg").trigger("click");
	}); */
</script>
<script>
	/* $('#photoimg').change(function(){
		var formData  = $('#save_profile_image')[0];
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("saveprofileimage") }}',
			type:'post',
			data: new FormData(formData), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				data			=	JSON.parse(error_array);
				if(data['success'] == 1) {
					$(".user_profile_image").attr("src",data['image']);
					//window.location.href	 =	"{{ URL('dashboard') }}";
				}else {
					$.each(data['errors'],function(index,html){
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
						$("textarea[name = "+index+"]").next().addClass('error');
						$("textarea[name = "+index+"]").next().html(html);
					});
				}
				$('#loader_img').hide();
			}
		});
	}); */

	function save_Profile(){
		var formData  = $('#save_profile')[0];
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("saveprofile") }}',
			type:'post',
			data: new FormData(formData), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				data			=	JSON.parse(error_array);
				if(data['success'] == 1) {
					window.location.href	 =	"{{ URL('dashboard') }}";
				}else {
					$.each(data['errors'],function(index,html){
						if(index == "timezone"){
							$("#timezone_error").addClass("error");
							$("#timezone_error").html(html);
						}else{
							$("input[name = "+index+"]").next().addClass('error');
							$("input[name = "+index+"]").next().html(html);
							$("textarea[name = "+index+"]").next().addClass('error');
							$("textarea[name = "+index+"]").next().html(html);
						}
					});
				}
			$('#loader_img').hide();
			}
		});
	}
	 $('#save_profile').each(function() {
		$(this).find('input').keypress(function(e) {
           if(e.which == 10 || e.which == 13) {
				save_Profile();
				return false;
            }
        });
	});
</script>
@stop