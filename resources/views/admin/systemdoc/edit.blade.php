@extends('admin.layouts.default')
@section('content')
<!--set width of  Select box on date picker -->
<section class="content-header">
	<h1>
		{{ trans("Edit System Image") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/system-doc-manager')}}">{{ trans("System Images") }}</a></li>
		<li class="active">{{ trans("Edit System Image") }} </li>
	</ol>
</section>
<section class="content"> 
	{{ Form::open(['role' => 'form','url' => 'admin/system-doc-manager/edit-doc/'.$doc->id,'class' => 'mws-form','enctype'=> 'multipart/form-data']) }}
	<div class="row pad">
		<div class="col-md-6">
			<div class="form-group <?php echo ($errors->first('title')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('title',trans("messages.system_management.title").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('title',isset($doc->title)?$doc->title:'',['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('title'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('file')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('file',trans("Image").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }} <a class='tooltipHelp' title="" data-html="true" data-toggle="tooltip" data-placement="right"  data-original-title="<?php echo "The attachment must be a file of type:".IMAGE_EXTENSION; ?>" style="cursor:pointer;">
						<i class="fa fa-question-circle fa-2x"> </i>
					</a>
				<div class="mws-form-item">
					{{ Form::file('file') }}
					<br />
					@if($doc->name != '' && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH.$doc->name))
						<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo SYSTEM_IMAGE_URL.$doc->name; ?>">
							<div class="usermgmt_image">
								<img  src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&image='.SYSTEM_IMAGE_URL.'/'.$doc->name ?>">
							</div>
						</a>
					@else
						<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
							<div class="usermgmt_image">
								<img class="img-circle" src="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
							</div>
						</a>
					@endif
					<div class="error-message help-inline">
						<?php echo $errors->first('file'); ?>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="mws-button-row">
		<div class="input" >
			<input type="submit" value="{{ trans('messages.user_management.save') }}" class="btn btn-danger">
			<a href="{{URL::to('admin/system-doc-manager/edit-doc/'.$doc->id)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("messages.user_management.reset") }}</a>
			<a href="{{URL::to('admin/system-doc-manager')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans("Cancel") }}</a>
		</div>
	</div>
	{{ Form::close() }}
</section>
@stop
