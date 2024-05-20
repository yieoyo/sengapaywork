<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
	
	<!-- For senangpay testing-->
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<?php
		if(!empty(Config::get("Settings.favicon")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.favicon"))){
			$favicon = SYSTEM_IMAGE_URL . Config::get("Settings.favicon");
		}else{
			$favicon = WEBSITE_IMG_URL . "favicon.png";
		}
	?>
	<link rel="shortcut icon" href="{{$favicon}}" type="image/x-icon">
	<title><?php echo Config::get("Settings.meta_title"); ?></title>
	<meta name="keywords" content="<?php echo Config::get("Settings.meta_keyword"); ?>" />
	<meta name="title" content="<?php echo Config::get("Settings.meta_title"); ?>" />
	<meta name="description" content="<?php echo Config::get("Settings.meta_description"); ?>" />
	<link rel="canonical" href="{{WEBSITE_URL}}" />
	<meta property="og:title" content="<?php echo Config::get("Settings.meta_description"); ?>" />
	<meta property="og:description" content="<?php echo Config::get("Settings.meta_description"); ?>" />
	<meta property="og:image" content="{{$favicon}}" />


	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

	<!--end::Fonts -->

	<!--begin::Page Vendors Styles(used by this page) -->
	<link href="<?php echo WEBSITE_JS_URL;?>plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

	<!--end::Page Vendors Styles -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="<?php echo WEBSITE_JS_URL;?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>owl.carousel.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>style.css" rel="stylesheet" type="text/css" />
	
	<!--begin::Page Custom Styles(used by this page) -->
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles -->
	
	<!--begin::Page Custom Styles(used by this page) -->
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/login/login-1.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/login/login-6.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/invoices/invoice-2.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo WEBSITE_JS_URL;?>pages/custom/login/login-general.js" type="text/javascript"></script>
	
	<script src="<?php echo WEBSITE_JS_URL;?>pages/crud/metronic-datatable/base/html-table.js" type="text/javascript"></script>
	<!--begin::Layout Skins(used by all pages) -->

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
	
	<!--<link rel="stylesheet" type="text/css" href="<?php echo WEBSITE_CSS_URL;?>chosen.min.css" /> -->
	
	{{ !empty(Config::get("Settings.analytics")) ? Config::get("Settings.analytics"):'' }}
	{{ !empty(Config::get("Settings.google_analytics")) ? Config::get("Settings.google_analytics"):'' }}
	{{ !empty(Config::get("Settings.google_adsense")) ? Config::get("Settings.google_adsense"):'' }}
	{{ !empty(Config::get("Settings.facebook_pixel")) ? Config::get("Settings.facebook_pixel"):'' }}
</head>
<?php 
$bodyClass="";
if(!empty(Auth::user())){
	$bodyClass= 'style="background-image: url('.WEBSITE_IMG_URL.'demos/demo4/header.jpg); background-position: center top; background-size: 100% 350px;"';
}
?>


<body {{$bodyClass}} class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading" style="background: none;">


<!--begin::Global Theme Bundle(used by all pages) -->

<script src="<?php echo WEBSITE_JS_URL;?>plugins/global/plugins.bundle.js" type="text/javascript"></script>

<script src="<?php echo WEBSITE_JS_URL;?>owl.carousel.js" type="text/javascript"></script>
<script src="<?php echo WEBSITE_JS_URL;?>scripts.bundle.js" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo WEBSITE_JS_URL;?>plugins/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>-->
<script src="<?php echo WEBSITE_JS_URL;?>plugins/custom/gmaps/gmaps.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo WEBSITE_JS_URL;?>pages/dashboard.js" type="text/javascript"></script>

<?php /* <script src="<?php echo WEBSITE_JS_URL;?>pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script>
<script src="<?php echo WEBSITE_JS_URL;?>pages/custom/wizard/wizard-4.js" type="text/javascript"></script> */ ?>


<!--end::Page Scripts -->
	
<!--<script src="<?php echo WEBSITE_JS_URL;?>jquery.min.js"></script> -->

<!---- date time picker js ---->
<link href="{{ WEBSITE_CSS_URL}}datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/material.min.js" type="text/javascript"></script>
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/moment-with-locales.min.js" type="text/javascript"></script>
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/bootstrap-material-datetimepicker.js" type="text/javascript"></script>
<link href="<?php echo WEBSITE_CSS_URL;?>pages/wizard/wizard-4.css" rel="stylesheet" type="text/css" />

<div class="main_dv">
 <div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
   <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
	<script>
		function show_message(message,message_type) {
			$().toastmessage('showToast', {	
				text: message,
				sticky: false,
				position: 'top-right',
				type: message_type,
			});
		}
		
	</script>
<?php //if(!empty(Auth::user())){ ?>
	@include('front.elements.header')
<?php //} ?>
	@if(Session::has('error'))
		<script type="text/javascript">
			show_message("{{ Session::get('error')}}",'error');
		</script>
	@endif
		
	@if(Session::has('success'))
		<script type="text/javascript">
			show_message("{{ Session::get('success')}}",'success');
		</script>
	@endif
	@if(Session::has('flash_notice'))
		<script type="text/javascript">
			show_message("{{ Session::get('flash_notice')}}",'success');
		</script>
	@endif
	
	<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#366cf3",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->
	
	@yield('content')
	@include('front.elements.footer')
	
	<?php /* <div id="loader_img" style="display:none;"><center><img src="{{WEBSITE_IMG_URL}}loader32222.gif"></center></div>*/ ?>
	<div id="loader_img" style="display: none;">&nbsp;</div>
   </div>
  </div>
 </div>
<?php /* @include('front.elements.deep_footer')*/ ?>
</div>

<style>
#booking_modal_popup .kt-form {
    padding: 50px 30px;
    width: 100%;
}
#booking_modal_popup #kt_body {
    padding-top: 0 !important;
}
</style>
<!--begin::Modal-->
<div class="modal fade" id="booking_modal_popup" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Donate</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div id="getBookNowHtml"></div>
			</div>
			<?php /* <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Send message</button>
			</div> */ ?>
		</div>
	</div>
</div>

<!--end::Modal-->


<script>
function openBookingModal(projectSlug){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ URL("get-book-plan-html") }}/'+projectSlug,
		type:'POST',
		// data: $('#select_plan_form').serialize(),
		// dataType: 'json',
		// contentType: false,       // The content type used when sending data to the server.
		// cache: false,             // To unable request pages to be cached
		// processData:false,
		success: function(r){
			$("#getBookNowHtml").html(r);
			//$("#kt_modal_4").modal("show");
			$('#booking_modal_popup').modal({backdrop: 'static', keyboard: false})
			$('#loader_img').hide();
		},
		error: function(r){
			alert("error");
			$('#loader_img').hide();
		},
	});
}
</script>


<!---- sign up model start ----->
<div class="modal fade" id="sign_up_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-modal="true" style="padding-right: 17px;">
	<?php
		$RegisterDataPending = !empty(Session::get('RegisterDataPending'))?Session::get('RegisterDataPending'):'';
		if(!empty($RegisterDataPending)){
			$userEmail		=	!empty($RegisterDataPending['email']) ? $RegisterDataPending['email']:'';
			$userFullName	=	!empty($RegisterDataPending['full_name']) ? $RegisterDataPending['full_name']:'';
			$userPhone		=	!empty($RegisterDataPending['phone']) ? $RegisterDataPending['phone']:'';
		}else{
			$userEmail		=	"";
			$userFullName	=	"";
			$userPhone		=	"";
		}
	?>
	<div class="modal-dialog"> 
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<div class="sign_up_popup_block" style="background-image: url(img/bg/bg-3.jpg);">
					<div class="kt-login__signup">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.login.sign_up') }}</h3>
							<div class="kt-login__desc">{{ trans('messages.login.enter_your_details_to_create_your_account') }}:</div>
						</div>
						<div class="kt-login__form">
							{{ Form::open(['role' => 'form','url' => "/signup",'files'=>'true', 'class' => 'kt-form','id'=>"SignUpForm"]) }}
								<input type="hidden" name="order_email" value="{{$userFullName}}">
								<input type="hidden" name="phone" value="{{$userPhone}}">
								<div class="form-group">
									{{ Form::text('full_name', $userFullName, ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.login.enter_full_name')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="form-group">
									{{ Form::text('email', $userEmail, ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.personal_information.enter_email_address')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="form-group">
									{{ Form::password('password', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.login.enter_password')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="form-group">
									{{ Form::password('confirm_password', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.login.confirm_password')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="row kt-login__extra">
									<div class="col kt-align-left">
										<label class="kt-checkbox">
											<input name="terms" type="checkbox" value="1" name="agree">{{ trans('messages.login.i_agree_the') }} <a href="#" class="kt-link kt-login__link kt-font-bold">{{ trans('messages.login.terms_and_conditions') }}</a>.
											<span></span>
										</label>
										<span class="form-text help-inline terms_error"></span>
									</div>
								</div>
								<div class="kt-login__actions">
									<button type="button" id="kt_signup_submit" onclick="UserRegister()" class="btn btn-brand btn-pill btn-elevate">
									{{ trans('messages.login.sign_up') }}</button>&nbsp;&nbsp;
									<button type="button" id="kt_signup_cancel" data-dismiss="modal" class="btn btn-outline-brand btn-pill">
									{{ trans('messages.personal_information.cancel') }}</button>
								</div>
								
								<div class="kt-login__account mt-4">
									<span class="kt-login__account-msg">{{ trans('messages.login.already_have_an_account') }}</span>&nbsp;&nbsp;
									<a href="javascript:;" data-dismiss="modal" data-toggle="modal" data-target="#sign_in_popup" href="javascript:void(0);">{{ trans('messages.login.sign_in') }}!</a>
								</div>
								
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!---- sign up model end ----->



<!---- sign In model start ----->
<div class="modal fade" id="sign_in_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-modal="true" style="padding-right: 17px;">
	<div class="modal-dialog"> 
	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				<div class="sign_up_popup_block" style="background-image: url(img/bg/bg-3.jpg);">
					<div class="kt-login__signup">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.login.sign_in') }}</h3>
							<!--<div class="kt-login__desc">Enter your details to create your account:</div>-->
						</div>
						<div class="kt-login__form">
							{{ Form::open(['role' => 'form','url' => "/signup",'files'=>'true', 'class' => 'kt-form','id'=>"SignInForm"]) }}
								<div class="error_popup"></div>
								<div class="form-group">
									{{ Form::text('login_email', $userEmail, ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.personal_information.enter_email_address')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="form-group">
									{{ Form::password('login_password', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.login.enter_password')]) }}
									<span class="help-inline"></span>
								</div>
								<div class="row kt-login__extra">
									<div class="col">
										<label class="kt-checkbox">
											<input type="checkbox" name="remember"> {{ trans('messages.login.remember_me') }}
											<span></span>
										</label>
									</div>
									<div class="col kt-align-right">
										<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">{{ trans('messages.login.forge_password') }} ?</a>
									</div>
								</div>
								
								<div class="kt-login__actions">
									<button type="button" id="kt_login_submit" onclick="loginUser()" class="btn btn-brand btn-pill btn-elevate btn_loader"> {{ trans('messages.login.sign_in') }}</button>&nbsp;&nbsp;
									<button type="button" id="kt_login_cancel" data-dismiss="modal" class="btn btn-outline-brand btn-pill">
									{{ trans('messages.personal_information.cancel') }}</button>
								</div>
								
								<div class="kt-login__account mt-4">
									<span class="kt-login__account-msg">Don't have an account yet ?</span>&nbsp;&nbsp;
									<a href="javascript:;" data-dismiss="modal" data-toggle="modal" data-target="#sign_up_popup" href="javascript:void(0)";>{{ trans('messages.login.sign_up') }}!</a>
								</div>
								
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>

<!---- sign in model end ----->










<script>
$(".openSignupModel").click(function(){
	//$("#sign_up_popup").modal("show");
	
	$('#sign_up_popup').modal({backdrop: 'static', keyboard: false})  

})

var showErrorMsg = function(form, type, msg) {
	var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
		<div class="alert-text">'+msg+'</div>\
		<div class="alert-close">\
			<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
		</div>\
	</div>');

	form.find('.alert').remove();
	alert.prependTo(form);
	//alert.animateClass('fadeIn animated');
	KTUtil.animateClass(alert[0], 'fadeIn animated');
	alert.find('span').html(msg);
}

function UserRegister(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#SignUpForm')[0];
	
	$.ajax({
		url: '{{ URL("/signup") }}',
		type:'POST',
		data: $('#SignUpForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				window.location.href	 =	"{{ URL('/dashboard') }}";
				
				$('#sign_up_popup').remove();
				$('#sign_in_popup').remove();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "page_name"){
						$(".name_error").addClass('error');
						$(".name_error").html(html);
					}else if(index == "footer_body"){
						$(".footer_body_error").addClass('error');
						$(".footer_body_error").html(html);
					}else if(index == "section_name"){
						$(".section_name_error").addClass('error');
						$(".section_name_error").html(html);
					}else if(index == "terms"){
						$(".terms_error").addClass('error');
						$(".terms_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
				});
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}


function loginUser(){
	var form = $(".btn_loader").closest('form');
	var btn = $(".btn_loader");
	btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	//$('#loader_img').show();
	$('.alert').remove();
	$('.error_popup').html('');
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ URL("login") }}',
		type:'POST',
		data: $('#SignInForm').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			const isDashboard = window.localStorage.getItem('isDashboard');
			if(datas['success'] == 1){
				if(isDashboard == 1){
					window.location.href	 =	"{{ URL('/dashboard') }}";
				}else{
					window.location.href	 =	"{{ URL::previous() }}";
				}
				window.localStorage.removeItem('isDashboard');
			}else if(datas['success'] == 3){
				//show_message(datas['message'],'success');
				if(isDashboard == 1){
					window.location.href	 =	"{{ URL('/dashboard') }}";
				}else{
					window.location.href	 =	"{{ URL::previous() }}";
				}
				window.localStorage.removeItem('isDashboard');
			}else if(datas['success'] == 2){
				//document.getElementById("login_form").reset();
				setTimeout(function() {
					btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
					showErrorMsg(form, 'danger', datas["message"]);
				}, 1000);
			}else {
				/* setTimeout(function() {
					btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
					showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
				}, 1000); */
				$.each(datas['message'],function(index,html){
					$("input[name = "+index+"]").next().addClass('error');
					$("input[name = "+index+"]").next().html(html);
				});
			}
			btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
			//$('#loader_img').hide();
		}
	});
}

</script>






<script src="<?php echo WEBSITE_JS_URL;?>pages/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>

<script src="<?php echo WEBSITE_JS_URL;?>pages/crud/forms/widgets/bootstrap-switch.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
{{ HTML::script('js/custom-design.js') }} --> 

</body>

@include('front.elements.include_scripts')
<script>
$(document).on('click', '.delete_any_item', function(e){
 	e.stopImmediatePropagation();
	url = $(this).attr('href');
	bootbox.confirm("Are you sure want to delete this ?",
		function(result){
			if(result){
				window.location.replace(url);
			}	
		});
	e.preventDefault();
});

</script>
</html>