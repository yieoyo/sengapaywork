@extends('admin.layouts.login_layout')

@section('content')

<div class="form-box" id="login-box">
	<div class="header">
		<a href="{{WEBSITE_ADMIN_URL}}">
			@if($logo_image != "")
				<img src ="{{SYSTEM_IMAGE_URL . $logo_image}}">
			@else
				<img src ="{{WEBSITE_IMG_URL}}logo.png">
			@endif
		</a>
	</div>
	<div class="form_info_text">Administrator Login.</div>
	
	{{ Form::open(['role' => 'form','url' => 'admin/login']) }}    
	<div class="body">
		<div class="form-group">
			{{ Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
			<div class="error-message help-inline">
				<?php echo $errors->first('email'); ?>
			</div>
		</div>
		<div class="form-group">
		   {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control','autocomplete'=>false]) }}
		   <div class="error-message help-inline">
				<?php echo $errors->first('password'); ?>
			</div>
		</div>
		@if(Session::get('failed_attampt_login') >= 11)
			<div class="form-group">
				{{ Form::text('captcha', null, ['placeholder' => 'Captcha Code', 'class' => 'form-control']) }}
				<div class="error-message help-inline">
					<?php echo $errors->first('captcha'); ?>
				</div>
				{{captcha_img('flat'); }}
			</div>
		@endif
		
	</div>
	<div class="footer">                                                               
		<button type="submit" class="btn bg-olive btn-block btn-login">Login</button> 
		<a class="forgot_link" href="{{ URL::to('admin/forget_password')}}">Forgot your password?</a>
	</div>
	{{ Form::close() }}
</div>
