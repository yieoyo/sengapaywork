@extends('admin.layouts.default')

@section('content')
<!-- CKeditor start here-->
{{ HTML::script('js/admin/plugins/ckeditor/ckeditor.js') }}

<!-- CKeditor ends-->
<section class="content-header">
	<h1>
		{{ trans("messages.system_management.add_new_cms") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/cms-manager')}}">Cms Pages</a></li>
		<li class="active">Add New Cms</li>
	</ol>
</section>

<section class="content"> 
	<div class="row pad">
		<div class="col-md-12">	
			@if(count($languages) > 1)
				<div  class="default_language_color">
					{{ Config::get('default_language.message') }}
				</div>
				<div class="wizard-nav wizard-nav-horizontal">
					<ul class="nav nav-tabs">
						<?php $i = 1 ; ?>
						@foreach($languages as $value)
							<li class=" {{ ($i ==  $language_code )?'active':'' }}">
								<a data-toggle="tab" href="#{{ $i }}div">
									{{ $value -> title }}
								</a>
							</li>
							<?php $i++; ?>
						@endforeach
					</ul>
				</div>
			@endif
			{{ Form::open(['role' => 'form','url' => 'admin/cms-manager/add-cms','class' => 'mws-form']) }}
				
				<div class="form-group <?php echo ($errors->first('name')?'has-error':''); ?>">
					<div class="mws-form-row">
						{{ HTML::decode( Form::label('name',trans("messages.system_management.page_name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::text('name','', ['class' => 'form-control']) }}
							<div class="error-message help-inline">
								<?php echo $errors->first('name'); ?>
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
				<?php $i = 1 ; ?>
				@foreach($languages as $value)
					<div id="{{ $i }}div" class="tab-pane {{ ($i ==  $language_code )?'active':'' }} ">
						<div class="mws-form-inline">
							<div class="form-group <?php if($i == 1){ echo ($errors->first('title')?'has-error':'');} ?>">
								@if($i == 1)
									{{ HTML::decode( Form::label($i.'.title',trans("Page Title").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
									{{ HTML::decode( Form::label($i.'.title',trans("Page Title").'<span class="requireRed">  </span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::text("data[$i][title]",'', ['class' => 'form-control']) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('title') : ''; ?>
									</div>
								</div>
							</div>
							<div class="form-group <?php if($i == 1){ echo ($errors->first('body')?'has-error':'');} ?>">
								@if($i == 1)
								{{ HTML::decode( Form::label($i.'._body',trans("messages.system_management.description").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
								{{ HTML::decode( Form::label($i.'._body',trans("messages.system_management.description").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i][body]",'', ['class' => 'form-control textarea_resize','id' => 'body_'.$i ,"rows"=>3,"cols"=>3]) }}
									<span class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('body') : ''; ?>
									</span>
								</div>
								<script type="text/javascript">
									/* For CKEDITOR */
									CKEDITOR.replace( <?php echo 'body_'.$i; ?>,
									{
										height: 400,
										width: 1080,
										filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
										filebrowserImageWindowWidth : '640',
										filebrowserImageWindowHeight : '480',
										enterMode : CKEDITOR.ENTER_BR
									});
									CKEDITOR.config.allowedContent = true;		
								</script>
							</div>
							<div class="form-group <?php if($i == 1){ echo ($errors->first('meta_title')?'has-error':'');} ?>">
								@if($i == 1)
								{{ HTML::decode( Form::label('meta_title',trans("messages.system_management.meta_title").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
								{{ HTML::decode( Form::label('meta_title',trans("messages.system_management.meta_title").'<span class="requireRed"> </span>', ['class' => 'mws-form-label'])) }}
							    @endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i][meta_title]",'', ['class' => 'form-control textarea_resize' ,"rows"=>3,"cols"=>3]) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('meta_title') : ''; ?>
									</div>
								</div>
							</div>
							<div class="form-group <?php if($i == 1){ echo ($errors->first('meta_description')?'has-error':'');} ?>">
								@if($i == 1)
								{{ HTML::decode( Form::label('meta_description',trans("messages.system_management.meta_description").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
								{{ HTML::decode( Form::label('meta_description',trans("messages.system_management.meta_description").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i][meta_description]",'', ['class' => 'form-control textarea_resize' ,"rows"=>3,"cols"=>3]) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('meta_description') : ''; ?>
									</div>
								</div>
							</div>
							<div class="form-group <?php if($i == 1){ echo ($errors->first('meta_keywords')?'has-error':'');} ?>">
								@if($i == 1)
								{{ HTML::decode( Form::label('meta_keywords',trans("messages.system_management.meta_keyword").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
								{{ HTML::decode( Form::label('meta_keywords',trans("messages.system_management.meta_keyword").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i][meta_keywords]",'', ['class' => 'form-control textarea_resize' ,"rows"=>3,"cols"=>3]) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('meta_keywords') : ''; ?>
									</div>
								</div>
							</div>
						</div>
					</div> 
				<?php $i++ ; ?>
				@endforeach
				<div class="mws-button-row">
					<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-danger">
					
					<a href="{{URL::to('admin/cms-manager/add-cms')}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans('messages.system_management.reset')  }}</a>
					
					<a href="{{URL::to('admin/cms-manager')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel')  }}</a>
				</div>
			</div>
			{{ Form::close() }} 
		</div>
	</div>
</section>
<style>
	.textarea_resize {
		resize: vertical;
	}
</style>
@stop
