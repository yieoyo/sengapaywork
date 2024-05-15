@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
		 {{ trans("Update User Level") }} 
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}">{{ trans("Users Management") }}</a></li>
		<li class="active"> {{ trans("Update User Level") }}  </li>
	</ol>
</section>
<section class="content"> 
	<div class="row pad">
		<div class="col-md-6">	
			@if(!empty($user_rate_links))
				<label>Shared Link By {{$userDetails->full_name}}</label>
				<iframe width="660" height="415" src="{{$user_rate_links->rate_link}}" frameborder="0" allowfullscreen></iframe>
			@else 
				<label><h4 style="color:red;">There are not any link to submit for review/rates for user level.</h4></label>
			@endif
		</div>
	</div>
	{{ Form::open(['role' => 'form','url' => 'admin/users/rates-user/'.$user_id,'class' => 'mws-form','files'=>'true']) }}
	<div class="row pad">
		<div class="col-md-6">	
			<div class="form-group <?php echo ($errors->first('level_id')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('level_id',trans("User Level").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::select(
						 'level_id',
						 [null => 'Please Select User Level'] + $user_teaching_levels,
						 $userDetails->user_level,
						 ['class' => 'form-control']
						) 
					}}
					<div class="error-message help-inline">
						<?php echo $errors->first('level_id'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mws-button-row">
		<div class="input" >
			<input type="submit" value="{{ trans('Update User Level') }}" class="btn btn-danger">
			<a href="{{URL::to('admin/users/rates-user/'.$user_id)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("messages.user_management.reset") }}</a>
			<a href="{{URL::to('admin/users')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans("Cancel") }}</a>
		</div>
	</div>
	{{ Form::close() }}
</section>
@stop
