@extends('admin.layouts.login_layout')

@section('content')

<div class="form-box" id="login-box">
	<div class="header"><a href="{{WEBSITE_ADMIN_URL}}"><img src ="{{WEBSITE_IMG_URL}}logo.png"></a></div>
	<div class="form_info_text">Please enter your email here to reset password.</div>
	
	
	
	{{ Form::open(['role' => 'form','url' => 'admin/send_password']) }}
	<div class="body">
		<div class="form-group">
			{{ Form::text('email', null, ['placeholder' => 'Email','class'=>'form-control']) }}
			<div class="error-message help-inline">
				<?php echo $errors->first('email'); ?>
			</div>
		</div>
	</div>
	<div class="footer">                                                               
		<button type="submit" class="btn bg-olive btn-block">Submit</button> 
		<a class="btn bg-olive btn-block"  href="{{ URL::to('/admin')}}">Cancel</a>
	</div>
	{{ Form::close() }}
</div>