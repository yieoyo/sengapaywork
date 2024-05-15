@extends('admin.layouts.default')

@section('content')
<section class="content-header">
	<h1>
		Add Subscriber
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/news-letter/subscriber-list')}}">Newsletter Subscribers</a></li>
		<li class="active">Add Subscriber</li>
	</ol>
</section>

<section class="content">
	<div class="row pad">
		{{ Form::open(['role' => 'form','url' => 'admin/news-letter/add-subscriber/','class' => 'mws-form']) }}
		<div class="col-md-6">
			<div class="form-group <?php echo ($errors->first('name')) ? 'has-error' : ''; ?>">
				<div class="mws-form-row">
					{{ HTML::decode( Form::label('name', trans("Name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
					<div class="mws-form-item">
						{{ Form::text('name', '', ['class' => 'form-control']) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('name'); ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group <?php echo ($errors->first('email')) ? 'has-error' : ''; ?>">
				<div class="mws-form-row">
					{{ HTML::decode( Form::label('email', trans("Email").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
					<div class="mws-form-item">
						{{ Form::text('email', '', ['class' => 'form-control']) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('email'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<div class="input" >
					<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-primary">
					
					<a href="{{URL::to('admin/news-letter/add-subscriber')}}" class="btn btn-danger">{{ trans('messages.system_management.reset') }}</a>
					
					<a href="{{URL::to('admin/news-letter/subscriber-list')}}" class="btn btn-info">{{ trans('Cancel') }}</a>
				</div>
			</div>
		{{ Form::close() }}
			
		</div>
	</div>
</section>
@stop
