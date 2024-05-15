@extends('front.layouts.login_layout')
@section('content')


<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
	<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
		<?php
			if(!empty(Config::get("Settings.logo")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.logo"))){
				$logo = SYSTEM_IMAGE_URL . Config::get("Settings.logo");
			}else{
				$logo = WEBSITE_IMG_URL . "logo.png";
			}
		?>
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?php echo WEBSITE_IMG_URL; ?>bg/bg-3.jpg);    min-height: 100vh;">
			<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
				<div class="kt-login__container">
					<div class="kt-login__logo">
						<a href="#">
							<img src="<?php echo $logo; ?>" height="100px">
						</a>
					</div>
					<div class="kt-login__signin">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.login.sign_in_admin') }}</h3>
						</div>
						{{ Form::open(['role' => 'form','url' => "login",'class' => 'kt-form','id'=>"login_form"]) }}
							<div class="error_popup"></div>
							<div class="input-group">
								{{ Form::text('login_email','',['id'=>'inputEmail','class'=>'form-control','autocomplete'=>'off','placeholder'=>trans('messages.cms_page_details.email')]) }}
							</div>
							<div class="input-group">
								{{ Form::password('login_password',['id'=>'inputPassword','class'=>'form-control','placeholder'=>trans('messages.admin_account.password')]) }}
							</div>
							<div class="row kt-login__extra">
								<div class="col">
									<label class="kt-checkbox">
										<input type="checkbox" name="remember"> {{ trans('messages.login.remember_me') }}
										<span></span>
									</label>
								</div>
								<div class="col kt-align-right">
									<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">{{ trans('messages.login.forge_password') }}</a>
								</div>
							</div>
							<div class="kt-login__actions">
								<button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">
								{{ trans('messages.login.sign_in') }}</button>
							</div>
						{{ Form::close() }}
					</div>
					<div class="kt-login__signup">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.login.sign_up') }}</h3>
							<div class="kt-login__desc">{{ trans('messages.login.enter_your_details_to_create_your_account') }}:</div>
						</div>
						<form class="kt-form" action="">
							<div class="input-group">
								{{ Form::text('fullname','',['class'=>'form-control','autocomplete'=>'off','placeholder'=>trans('messages.login.enter_full_name')]) }}
							</div>
							<div class="input-group">
								{{ Form::text('email','',['class'=>'form-control','autocomplete'=>'off','placeholder'=>trans('messages.cms_page_details.email')]) }}
							</div>
							<div class="input-group">
								{{ Form::text('password','',['class'=>'form-control','autocomplete'=>'off','placeholder'=>trans('messages.login.enter_password')]) }}
							</div>
							<div class="input-group">
								{{ Form::text('rpassword','',['class'=>'form-control','autocomplete'=>'off','placeholder'=>trans('messages.login.confirm_password')]) }}
								<input class="form-control" type="password" placeholder="Confirm Password" name="rpassword">
							</div>
							<div class="row kt-login__extra">
								<div class="col kt-align-left">
									<label class="kt-checkbox">
										<input type="checkbox" name="agree">{{ trans('messages.login.i_agree_the') }} <a href="#" class="kt-link kt-login__link kt-font-bold">{{ trans('messages.login.terms_and_conditions') }}</a>.
										<span></span>
									</label>
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="kt-login__actions">
								<button id="kt_login_signup_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">
								{{ trans('messages.login.sign_up') }}</button>&nbsp;&nbsp;
								<button id="kt_login_signup_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">
								{{ trans('messages.personal_information.cancel') }}</button>
							</div>
						</form>
					</div>
					<div class="kt-login__forgot">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.login.forgotten_password') }}</h3>
							<div class="kt-login__desc">{{ trans('messages.login.enter_your_email_to_reset_your_password') }}</div>
						</div>
						{{ Form::open(['role' => 'form','route' => "home.forgetPassword",'class' => 'kt-form','id'=>"forget_password_form"]) }}
							<div class="alert alert-danger display_error" style="display:none"></div>
							<div class="input-group">
							{{ Form::text('forgot_email','',['id'=>'inputEmail kt_email','class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.email')]) }}
							</div> 
							<span class="help-inline"></span>
							<div class="kt-login__actions">
								<button id="kt_login_forgot_submit" <?php /*onclick="submit_forgot_password()"*/ ?> class="btn btn-brand btn-elevate kt-login__btn-primary">{{ trans('messages.login.request') }}</button>&nbsp;&nbsp;
								<button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary">
								{{ trans('messages.personal_information.cancel') }}</button>
							</div>
						{{ Form::close() }}
					</div>
					<?php /* <div class="kt-login__account">  //kt_login_forgot_submit
						<span class="kt-login__account-msg">
							Don't have an account yet ?
						</span>
						&nbsp;&nbsp;
						<a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
					</div> */ ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
/* var handleSignInFormSubmit = function() {
	$('#kt_login_signin_submit').click(function(e) {
		e.preventDefault();
		var btn = $(this);
		var form = $(this).closest('form');
		form.validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				password: {
					required: true
				}
			}
		});

		if (!form.valid()) {
			return;
		}

		btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);

		form.ajaxSubmit({
			url: '{{ URL("login") }}',
			success: function(response, status, xhr, $form) {
				alert(response);
				error_array 	= 	JSON.stringify(response);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1){
					show_message(datas['message'],'success');
					window.location.href	 =	"{{ URL('/') }}";
				}else if(datas['success'] == 3){
					show_message(datas['message'],'success');
					window.location.href	 =	"{{ URL('/') }}";
				}else if(datas['success'] == 2){
					document.getElementById("login_form").reset();
					// similate 2s delay
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', datas['message']);
					}, 2000);
				}else {
					// similate 2s delay
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
					}, 2000);
				}
				
			}
		});
	});
} */

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

var handleSignInFormSubmit = function() {
	$("#kt_login_signin_submit").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var form = $(this).closest('form');
		btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
		//$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("login") }}',
			type:'POST',
			data: $('#login_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1){
					window.location.href	 =	"{{ URL('/dashboard') }}";
					//window.location.href	 =	"{{ URL::previous() }}";
				}else if(datas['success'] == 3){
					//show_message(datas['message'],'success');
					window.location.href	 =	"{{ URL::previous() }}";
				}else if(datas['success'] == 2){
					//document.getElementById("login_form").reset();
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', datas["message"]);
					}, 1000);
				}else {
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', 'Incorrect username or password. Please try again.');
					}, 1000);
					/* $.each(datas['message'],function(index,html){
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}); */
				}
				btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
				//$('#loader_img').hide();
			}
		});
	});
	
	$("#kt_login_forgot_submit").click(function(e){
		e.preventDefault();
		var btn = $(this);
		var form = $(this).closest('form');
		btn.addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
		//$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ route("home.forgetPassword") }}',
			type:'POST',
			data: $('#forget_password_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1) {
					
					$("#kt_login_signin_submit").clearForm();

					$("#kt_login_signin_submit").validate().resetForm();

					$("#kt_login_forgot_cancel").trigger("click");

					var loginform = $("#kt_login_signin_submit").closest('form');
					showErrorMsg(loginform, 'success', 'Cool! Password recovery instruction has been sent to your email.');
					
				}else if(datas['success'] == 2) {
					//document.getElementById("login_form").reset();
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', datas["message"]);
					}, 1000);
				}else {
					setTimeout(function() {
						btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
						showErrorMsg(form, 'danger', 'Enter Valid Email Address.');
					}, 1000);
				}
				btn.removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
				//$('#loader_img').hide();
			}
		});
	});
}


/* 
function submit_forgot_password() {
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ route("home.forgetPassword") }}',
		type:'post',
		data: $('#forget_password_form').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				window.location.href	 =	"{{ URL('/') }}";
			}else if(datas['success'] == 2) {
				document.getElementById("forget_password_form").reset();
				show_message(datas['message'],"error");
			}else {
				$.each(datas['message'],function(index,html){
					$("input[name = "+index+"]").next().addClass('error');
					$("input[name = "+index+"]").next().html(html);
				});
			}
			$('#loader_img').hide();
		}
	});
}
 */

function signup(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ URL("signup-email") }}',
		type:'POST',
		data: $('#signup_form').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				window.location.href	 =	"{{ URL('signup') }}"+'/'+datas['email'];
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "terms"){
						$(".terms_error").addClass('error');
						$(".terms_error").html(html);
					}{
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

$('#signup_form').each(function() {		
	$(this).find('input').keypress(function(e) {           
		if(e.which == 10 || e.which == 13) {				
			signup();				
			return false;            
		}        
	});	
});
</script>
@stop
