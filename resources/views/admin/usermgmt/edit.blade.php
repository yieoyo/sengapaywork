@extends('admin.layouts.default')
@section('content')
<link href="<?php echo WEBSITE_CSS_URL;?>developer.css" rel="stylesheet">
{{HTML::script('js/combodate.js') }}

<link href="{{ WEBSITE_CSS_URL}}datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/material.min.js" type="text/javascript"></script>
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/moment-with-locales.min.js" type="text/javascript"></script>
<script src="{{ WEBSITE_CSS_URL}}datetimepicker/bootstrap-material-datetimepicker.js" type="text/javascript"></script>

<script>
	$(function(){
		Date.prototype.addDays = function(days) {
			var date = new Date(this.valueOf());
			date.setDate(date.getDate() + days);
			return date;
		}

		var date = new Date();

		$('.dob').bootstrapMaterialDatePicker({
			format: 'YYYY/MM/DD',
			changeMonth: true,
			changeYear : true,
			weekStart : 0,
			time: false,
			yearRange: '-100:+100',
			//minDate : date.addDays(2),
			//maxDate : date.addDays(32) 
			maxDate : new Date()  
		});
	});
</script>

<script>
	var  jan_text_string		=	"<?php echo  trans("Jan");?>";
	var  feb_text_string		=	"<?php echo  trans("Feb");?>";
	var  march_text_string		=	"<?php echo  trans("March");?>";
	var  april_text_string		=	"<?php echo  trans("April");?>";
	var  may_text_string		=	"<?php echo  trans("May");?>";
	var  june_text_string		=	"<?php echo  trans("June");?>";
	var  july_text_string		=	"<?php echo  trans("July");?>";
	var  august_text_string		=	"<?php echo  trans("Aug");?>";
	var  september_text_string	=	"<?php echo  trans("Sept");?>";
	var  october_text_string	=	"<?php echo  trans("Oct");?>";
	var  november_text_string	=	"<?php echo  trans("Nov");?>";
	var  december_text_string	=	"<?php echo  trans("Dec");?>";
</script>
{{ HTML::script('js/moment.js') }}
<!--set width of  Select box on date picker -->
<section class="content-header">
	<h1>
		{{ trans("Edit User") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}">{{ trans("Users Management") }}</a></li>
		<li class="active">{{ trans("Edit User") }} </li>
	</ol>
</section>
<section class="content"> 
	{{ Form::open(['role' => 'form','url' => 'admin/users/edit-user/'.$userDetails->id,'class' => 'mws-form','files'=>'true']) }}
	<div class="row pad">
		<div class="col-md-6">	
			<div class="form-group <?php echo ($errors->first('first_name')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('first_name',trans("messages.user_management.first_name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('first_name',(isset($userDetails->first_name) ? $userDetails->first_name :''),['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('first_name'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('last_name')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('last_name', trans("messages.user_management.last_name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('last_name',(isset($userDetails->last_name) ? $userDetails->last_name :''),['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('last_name'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('gender')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('gender', trans("Gender").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::select('gender',array('male'=>'Male','female'=>'Female','other'=>'Other'),(isset($userDetails->gender) ? $userDetails->gender :''),['class' => 'form-control','placeholder'=>'Select Gender']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('gender'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('email')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('email', trans("Email").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('email',(isset($userDetails->email) ? $userDetails->email :''),['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('email'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('password')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('password', trans("messages.user_management.password").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::password('password',['class'=>'userPassword form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('password'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('confirm_password')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('confirm_password', trans("messages.user_management.repassword").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::password('confirm_password',['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('confirm_password'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('date_of_birth')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('date_of_birth', trans("Date of Birth").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text("date_of_birth",(isset($userDetails->date_of_birth) ? $userDetails->date_of_birth :''), ['class'=>'form-control dob','readonly'=>'readonly','data-format'=>"YYYY-MM-DD",'data-template'=>"D MMM YYYY"]) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('date_of_birth'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo ($errors->first('phone')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('phone', trans("Phone"), ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('phone',(isset($userDetails->phone) ? $userDetails->phone :''),['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('phone'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('country')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('country', trans("messages.user_management.country").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::select('country',[''=>'Select Country']+$country_list,(isset($userDetails->country) ? $userDetails->country :''),['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('country'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('state')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('country', trans("State").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('state',(isset($userDetails->state) ? $userDetails->state :''),['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('state'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('city')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('country', trans("City").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('city',(isset($userDetails->city) ? $userDetails->city :''),['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('city'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('zip_code')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('country', trans("Zip Code").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('zip_code',(isset($userDetails->zip_code) ? $userDetails->zip_code :''),['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('zip_code'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('address')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('address', trans("Full Address").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::textarea('address',(isset($userDetails->address) ? $userDetails->address :''),['class'=>'form-control','rows'=>false,'cols'=>false]) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('address'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mws-button-row">
		<div class="input" >
			<input type="submit" value="{{ trans('messages.user_management.save') }}" class="btn btn-danger">
			<a href="{{URL::to('admin/users/edit-user/'.$userDetails->id)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("messages.user_management.reset") }}</a>
			<a href="{{URL::to('admin/users')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans("Cancel") }}</a>
		</div>
	</div>
	{{ Form::close() }}
</section>
<script>
$(function(){
	$('#datepicker').combodate({
		minYear: 1960,
		maxYear: new Date().getFullYear() - 18,
	});
}); 
</script>
@stop
