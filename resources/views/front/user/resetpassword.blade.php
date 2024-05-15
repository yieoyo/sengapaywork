@extends('front.layouts.login_layout')
@section('content')


<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
	<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?php echo WEBSITE_IMG_URL; ?>bg/bg-3.jpg);    min-height: 100vh;">
			<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
				<div class="kt-login__container">
					<div class="kt-login__logo">
						<a href="#">
							<img src="<?php echo WEBSITE_IMG_URL; ?>logo.png">
						</a>
					</div>
					<div class="kt-login__signin">
						<div class="kt-login__head">
							<h3 class="kt-login__title">{{ trans('messages.reset_password.reset_password') }}</h3>
						</div>
						{{ Form::open(['role' => 'form','url' => 'reset-password','class' => 'kt-form','id'=>'resetPwdFormId']) }}
						{{ Form::hidden("validate_string", $validateString, []) }}
							<div class="error_popup"></div>
							<div class="input-group">
								{{ Form::password("new_password", ["class"=>"form-control",'placeholder'=>trans('messages.reset_password.new_password')]) }}
							</div>
							<span class="help-inline new_password_error"></span>
							
							<div class="input-group">
								{{ Form::password("confirm_password", ["class"=>"form-control",'placeholder'=>trans("messages.reset_password.confirm_password")]) }}
							</div>
							<span class="help-inline confirm_password_error"></span>
							
							<div class="kt-login__actions">
								<button id="" type="button" onclick="reset_password();" class="btn btn-brand btn-elevate kt-login__btn-primary">
								{{ trans('messages.reset_password.reset_now') }}</button>
							</div>
						{{ Form::close() }}
					</div>
					
					<div class="kt-login__account"> 
						<a href="{{URL('/login')}}" id="kt_login_signup" class="kt-login__account-link">{{ trans('messages.reset_password.login') }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php /* 
<section class="site_content_holder">
    <div class="about_us_wrapper">
        <div class="container">
            <div class="wrapper-heading"><center>{{trans('messages.dashboard.reset_password')}}</center></div>
            <div class="row">
                <div class="col-sm-4">
				</div>
                <div class="col-sm-4 signin-page">
					 <div class="row">
                        <div class="col-sm-12">
                            <div class="card-header">
                                {{trans('messages.signup.existing_users')}} 
                            </div>
                            <div class="card card-container">
								<img id="profile-img" class="profile-img-card" src="{{WEBSITE_IMG_URL}}avatar_2x.png" />
								{{ Form::open(['role' => 'form','url' => 'reset-password','class' => 'mws-form','id'=>'resetPwdFormId']) }}
								{{ Form::hidden("validate_string", $validateString, []) }}
									<div class="form-group">
										{{ Form::password("new_password", ["class"=>"form-control",'placeholder'=>trans("messages.Signup.new_password")]) }}
										<span class="help-inline"></span>
									</div>
									<div class="form-group">
											{{ Form::password("confirm_password", ["class"=>"form-control",'placeholder'=>trans("messages.messages.Signup.confirm_password")]) }}
										<span class="help-inline"></span>
									</div>
									<button type="button" onclick="reset_password();" class="btn btn-danger btn-block">{{trans("messages.messages.reset")}}</button>
								{{ Form::close() }} 
							 </div><!-- /card-container -->
						</div>
					</div>
				</div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
    </div>
</section> */ ?>

<script>
	function reset_password() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("reset-password") }}',
			type:'post',
			data: $('#resetPwdFormId').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				data			=	JSON.parse(error_array);
				
				if(data['success'] == 1) {
					window.location.href	 =	"{{ URL('/login') }}";
				}
				else {
					console.log(data['errors']);
					$.each(data['errors'],function(index,html){
						if(index == "confirm_password"){
							$(".new_password_error").addClass('error');
							$(".new_password_error").html(html);
						}else if(index == "new_password"){
							$(".confirm_password_error").addClass('error');
							$(".confirm_password_error").html(html);
						}else{
							$("input[name = "+index+"]").next().addClass('error');
							$("input[name = "+index+"]").next().html(html);
						}
					});
				}
				$('#loader_img').hide();
			}
		});
	}
	
	 $('#resetPwdFormId').each(function() {
		$(this).find('input').keypress(function(e) {
	          if(e.which == 10 || e.which == 13) {
				profile();
				return false;
	           }
	       });
	});
</script>
@stop