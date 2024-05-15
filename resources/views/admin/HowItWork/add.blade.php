@extends('admin.layouts.default')

@section('content')

<!-- CKeditor start here-->
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::style('css/admin/custom_li_bootstrap.css') }}
<!-- CKeditor ends

{{ IMAGE_INFO }}-->

<section class="content-header">
	<h1>
		Add How It Works
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/how-it-work-manager')}}">{{ trans("How It Works") }}</a></li>
		<li class="active">Add How It Works</li>
	</ol>
</section>


<section class="content">
	<div class="row pad">
		<div class="col-md-6">
			@if(count($languages) > 1)
				<div  class="default_language_color">
					{{ Config::get('default_language.message') }}
				</div>
				<div class="wizard-nav wizard-nav-horizontal">
					<ul class="nav nav-tabs">
						@foreach($languages as $value)
							<?php $i = $value->id; ?>
							<li class=" {{ ($i ==  $language_code )?'active':'' }}">
								<a data-toggle="tab" href="#{{ $i }}div">
									{{ $value -> title }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
			{{ Form::open(['role' => 'form','route' => "$modelName.add",'class' => 'mws-form', 'files' => true]) }}
			
			<div class="form-group <?php echo ($errors->first('image')) ? 'has-error' : ''; ?>">
				<div class="mws-form-row">
					{{ HTML::decode( Form::label('image', trans("Image").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
					
					<a class='tooltipHelp' title="" data-html="true" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo "The attachment must be a file of type:".IMAGE_EXTENSION; ?>" style="cursor:pointer;">
						<i class="fa fa-question-circle fa-2x"> </i>
					</a>
					<div class="mws-form-item">
						{{ Form::file('image') }}
						<div class="error-message help-inline">
							<?php echo $errors->first('image'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('order')?'has-error':''); ?>">
				<div class="mws-form-row ">
					{{ HTML::decode( Form::label('order', trans("Order").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
					<div class="mws-form-item">
						{{ Form::text("order",'', ['class' => 'form-control small']) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('order'); ?>
						</div>
					</div>
				</div>
			</div>
			@if(count($languages) > 1)
				<div class="text-right mws-form-item" style="margin-right:20px; padding-top:10px; font-size: 12px;">
					<hr class ="hrLine"/>
					<b>{{ trans("messages.system_management.language_field") }}</b>
				</div>
			@endif
			<div class="mws-panel-body no-padding tab-content">
				@foreach($languages as $value)
				<?php $i = $value -> id ; ?>
				<div id="{{ $i }}div" class="tab-pane {{ ($i ==  $language_code )?'active':'' }} ">
					<div class="mws-form-inline">
						<div class="form-group <?php  if($value -> id == 1) {  echo ($errors->first('name')) ? 'has-error' : '';} ?>">
							@if($i == 1)
							{{ HTML::decode( Form::label('name', trans("Title").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
							@else
							{{ HTML::decode( Form::label('name', trans("Title").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
							@endif
							<div class="mws-form-item">
								{{ Form::text("data[$i][name]",'', ['class' => 'form-control small']) }}
								<div class="error-message help-inline">
									<?php echo ($i ==  $language_code ) ? $errors->first('name') : ''; ?>
								</div>
							</div>
						</div>
					</div>
				</div> 
				@endforeach
				<div class="mws-button-row">
					<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-danger">
					
					<a href='{{ route("$modelName.add")}}' class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans('messages.system_management.reset')  }}</a>
					
					<a href="{{URL::to('admin/how-it-work-manager')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel')  }}</a>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</section>
@stop
