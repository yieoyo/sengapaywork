@extends('admin.layouts.default')

@section('content') 
<!-- CKeditor js and custom li js  end here--->
<section class="content-header">
	<h1>
		{{ trans("Add Currency") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{route('currency.listCurrency')}}">{{ trans("Currency") }}</a></li>
		<li class="active">{{ trans("Add Currency") }}</li>
	</ol>
</section>
<section class="content"> 
			{{ Form::open(['role' => 'form','route' => 'currency.saveCurrency','class' => 'mws-form']) }}
	<div class="row pad">
		<div class="col-md-6">	 
			<div class="form-group <?php echo ($errors->first('name')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('name',trans("Name").'<span class="requireRed">*</span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('name','',['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('name'); ?>
					</div>
				</div>
			</div>	 
			<div class="form-group <?php echo ($errors->first('symbol')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('symbol',trans("Symbol").'<span class="requireRed">*</span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('symbol','',['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('symbol'); ?>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-danger">
				
				<a href="{{route('currency.addCurrency')}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans('messages.system_management.reset')  }}</a>
				
				<a href="{{route('currency.listCurrency')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel')  }}</a>
			</div>
		</div>
	</div> 
			{{ Form::close() }} 
</section>
@stop