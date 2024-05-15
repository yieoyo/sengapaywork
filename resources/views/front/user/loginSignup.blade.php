@extends('front.layouts.default')
@section('content')

<?php
	$segment2	=	Request::segment(1);
	$segment3	=	Request::segment(2); 
	$segment4	=	Request::segment(3); 
	if($segment3 == "signup"){
		$signup_class1		=	"active";
		$signup_class2		=	"in active";
		
		$login_class1		=	"";
		$login_class2		=	"";
	}else {
		$signup_class1		=	"";
		$signup_class2		=	"";
		
		$login_class1		=	"active";
		$login_class2		=	"in active";
	}
?> 

<div class="container">
<div class="custom-tab logintabs">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="{{$login_class1}}"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">{{trans("messages.Login")}}</a></li>
    <li role="presentation" class="{{$signup_class1}}"><a href="#signup" aria-controls="signup" role="tab" data-toggle="tab">{{trans("messages.Signup")}}</a></li>
  </ul>

  <!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane fade {{$login_class2}}" id="login">
			{{ Form::open(['role' => 'form','url' => "login",'class' => 'mws-form','id'=>"login_form"]) }}
				<div class="alert alert-danger display_error" style="display:none"></div>
				<div class="form-group">
					{{ Form::hidden("redirect_url",(!empty($segment4) ? $segment4 : ""), ['class' => 'form-control','placeholder'=>trans("messages.Email")]) }}
					{{ Form::text("login_email",'', ['class' => 'form-control','placeholder'=>trans("messages.Email")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="form-group">
					{{ Form::password("login_password", ['class' => 'form-control','placeholder'=>trans("messages.Password")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<div class="checkbox">
							<label>
								<input type="checkbox"> {{trans("messages.remember_me")}}</a>
							</label>
						</div>
					 </div>
					<div class="col-xs-6 text-right f13">
						<a href="javascript:void(0);" onclick="forget_password();">{{trans("messages.forget_password")}}</a>
					</div>
				</div>
				<button type="button" onclick="login();" class="btn btn-danger btn-block">{{trans("messages.Login")}}</button>
				<div class="loginseparator"><span>{{trans("messages.or_login_with")}}</span></div>
				<ul class="social_icon">
					<li><a href="{{URL('login-with-social/weibo')}}"><img src="<?php echo WEBSITE_IMG_URL;?>weibo.png" alt="Weibo" data-toggle="tooltip" data-placement="bottom" title="Weibo"></a></li>
					<li><a href=""><img src="<?php echo WEBSITE_IMG_URL;?>wechat.png" alt="Wechat" data-toggle="tooltip" data-placement="bottom" title="Wechat"></a></li>
					<li><a href="{{URL('login-with-social/facebook')}}"><img src="<?php echo WEBSITE_IMG_URL;?>facebook.png" alt="Facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"></a></li>
					<li><a href="{{URL('login-with-social/google')}}"><img src="<?php echo WEBSITE_IMG_URL;?>google.png" alt="Google" data-toggle="tooltip" data-placement="bottom" title="Google"></a></li>
				</ul>
			{{ Form::close() }} 
		</div>
		<div role="tabpanel" class="tab-pane fade {{$signup_class2}}" id="signup">
			{{ Form::open(['role' => 'form','url' => "signup",'class' => 'mws-form','id'=>"signup_form"]) }}
				<div class="form-group">
					{{ Form::text("first_name",'', ['class' => 'form-control','placeholder'=>trans("messages.first_name")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="form-group">
					{{ Form::text("last_name",'', ['class' => 'form-control','placeholder'=>trans("messages.last_name")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="form-group">
					{{ Form::text("email",'', ['class' => 'form-control','placeholder'=>trans("messages.Email")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="form-group">
					{{ Form::password("password",['class' => 'form-control','placeholder'=>trans("messages.Password")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="form-group">
					{{ Form::password("confirm_password", ['class' => 'form-control','placeholder'=>trans("messages.Confirm_Password")]) }}
					<span class="help-inline"></span>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="terms"> {{trans("messages.read_and_agree")}} <a href="{{URL('terms')}}">{{trans("messages.term_and_conditions")}}</a>.
						<br />
						<span class="help-inline"></span>
					</label>
				</div>
				<button type="button" onclick="signup();" class="btn btn-danger btn-block">{{trans("messages.create_account")}}</button>
				<div class="loginseparator"><span>{{trans("messages.or_signup_with")}}</span></div>
					<ul class="social_icon">
						<li><a href="{{URL('login-with-social/weibo')}}"><img src="<?php echo WEBSITE_IMG_URL;?>weibo.png" alt="Weibo" data-toggle="tooltip" data-placement="bottom" title="Weibo"></a></li>
						<li><a href=""><img src="<?php echo WEBSITE_IMG_URL;?>wechat.png" alt="Wechat" data-toggle="tooltip" data-placement="bottom" title="Wechat"></a></li>
						<li><a href="{{URL('login-with-social/facebook')}}"><img src="<?php echo WEBSITE_IMG_URL;?>facebook.png" alt="Facebook" data-toggle="tooltip" data-placement="bottom" title="Facebook"></a></li>
						<li><a href="{{URL('login-with-social/google')}}"><img src="<?php echo WEBSITE_IMG_URL;?>google.png" alt="Google" data-toggle="tooltip" data-placement="bottom" title="Google"></a></li>
						
					</ul>
			{{ Form::close() }} 
		</div>
	</div>

</div>
</div>

<?php 
	$segment4_url		=	base64_decode($segment4);
?>
<script>
	function login() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$(".display_error").html("");
		$(".display_error").hide();
		$.ajax({
			url: '{{ URL("login") }}',
			type:'POST',
			data: $('#login_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1) {
					if("<?php echo $segment4_url; ?>" == ""){
						window.location.href	 =	"{{ URL('dashboard') }}";
					}else {
						window.location.href	 =	"{{ URL($segment4_url) }}";						
					}
				}else if(datas['success'] == 2) {
					document.getElementById("login_form").reset();
					$(".display_error").html(datas['message']);
					$(".display_error").show();
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
	
	
	function signup() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("signup") }}',
			type:'POST',
			data: $('#signup_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1) {
					window.location.href	 =	"{{ URL('login-signup/login') }}";
				}else {
					$.each(datas['errors'],function(index,html){
						if(index == "terms"){
							$("input[name = "+index+"]").next().next().next().addClass('error');
							$("input[name = "+index+"]").next().next().next().html(html);
						}else {
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

	function submit_forgot_password() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("forgot-password") }}',
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
	
	function forget_password() {
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		document.getElementById("forget_password_form").reset();
		$('#forget_password_popup').modal("show");
	}
</script>


<div class="modal fade login_form" id="forget_password_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("messages.forget_password")}}</h4>
      </div>
		<div class="modal-body">		
			{{ Form::open(['role' => 'form','url' => 'forgot-password','class' => 'mws-form','id'=>"forget_password_form"]) }}
			<div class="login_frm">
				<div class="email_dv">
				<p class="text-center">{{trans("messages.click_here_forget_password_button")}}
					</p>
					<div class="input_dv email_input mt30">
						{{ Form::text("forgot_email",'', ["class"=>"form-control",'placeholder'=>trans("messages.email_address")]) }}
						<span class="help-inline"></span>
					</div>
					<div class="input_dv mt10">
						<input type="button" class="btn btn-danger btn-block"  onclick="submit_forgot_password();" value='{{ trans("messages.Signup.submit") }}'>
					</div>
					<!--<p class="f12 text-center mt30">Remember your password?  <a href="" data-dismiss="modal" aria-label="Close">Log In.</a>
					</p>-->
				</div>
			</div>
			{{ Form::close() }} 
		</div>
		</div>
	</div>
</div>

@stop