@extends('admin.layouts.default')

@section('content')

<!-- CKeditor js and custom li js  strat here-->
{{ HTML::style('css/admin/custom_li_bootstrap.css') }}	
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/admin/ckeditor/ckeditor.js') }}
<!-- CKeditor js and custom li js  end here--->
<section class="content-header">
	<h1>
		{{ trans("messages.system_management.add_new_faq") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/faqs-manager')}}">{{ trans("messages.system_management.manage_faq") }}</a></li>
		<li class="active">{{ trans("messages.system_management.add_new_faq") }}</li>
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
			{{ Form::open(['role' => 'form','url' => 'admin/faqs-manager/add-faqs','class' => 'mws-form']) }}
			<?php /* <div class="form-group <?php echo ($errors->first('category_id')) ? 'has-error' : ''; ?>">
				<div class="mws-form-row">
					{{ HTML::decode( Form::label('topic',trans("Topic").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
					<div class="mws-form-item">
						{{ Form::select(
							'category_id',
							array(''=>'Select topic')+$listDownloadCategory,
							'null',
							['class' => 'form-control']
						) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('category_id'); ?>
						</div>
					</div>
				</div>
			</div>	 */ ?>
			@if(count($languages) > 1)
				<div class="text-right mws-form-item" style="margin-right:20px; padding-top:10px; font-size: 12px;">
					<hr class ="hrLine"/>
					<b>{{ trans("messages.system_management.language_field") }}</b>
				</div>
			@endif
			<div class="mws-panel-body no-padding tab-content"> 
				@foreach($languages as $value)
					<?php
						$i = $value->id ;
					?>
					<div id="{{ $i }}div" class="tab-pane {{ ($i ==  $language_code )?'active':'' }} ">
						<div class="mws-form-inline">
							<div class="form-group <?php if($value -> id == 1) { echo ($errors->first('answer')) ? 'has-error' : '';} ?>">
								@if($value -> id == 1)
									{{ HTML::decode( Form::label($i.'.question',trans("messages.system_management.question").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
									{{ HTML::decode( Form::label($i.'.question',trans("messages.system_management.question").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i]['question']",'', ['class' => 'form-control','id' => 'question_'.$i]) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('question') : ''; ?>
									</div>
								</div>
							</div>
							<div class="form-group <?php if($value -> id == 1) { echo ($errors->first('answer')) ? 'has-error' : ''; } ?>">
								@if($value -> id == 1)
									{{ HTML::decode( Form::label($i.'._answer',trans("messages.system_management.answer").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
								@else
									{{ HTML::decode( Form::label($i.'._answer',trans("messages.system_management.answer").'<span class="requireRed"></span>', ['class' => 'mws-form-label'])) }}
								@endif
								<div class="mws-form-item">
									{{ Form::textarea("data[$i]['answer']",'', ['class' => 'form-control','id' => 'answer_'.$i]) }}
									<div class="error-message help-inline">
										<?php echo ($i ==  $language_code ) ? $errors->first('answer') : ''; ?>
									</div>
								</div>
								<script type="text/javascript">
								/*  CKEDITOR for question */
									
									CKEDITOR.replace( <?php echo 'question_'.$i; ?>,
									{
										height: 200,
										width: 507,
										filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
										filebrowserImageWindowWidth : '640',
										filebrowserImageWindowHeight : '480',
										enterMode : CKEDITOR.ENTER_BR
									});
									
									/*  CKEDITOR for answer */
									
									CKEDITOR.replace( <?php echo 'answer_'.$i; ?>,
									{
										height: 200,
										width: 507,
										filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
										filebrowserImageWindowWidth : '640',
										filebrowserImageWindowHeight : '480',
										enterMode : CKEDITOR.ENTER_BR
									});
										
								</script>
							</div>
						</div>
					</div>
				<?php // $i++ ; ?>
				@endforeach
				<div class="mws-button-row">
					<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-danger">
					
					<a href="{{URL::to('admin/faqs-manager/add-faqs')}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans('messages.system_management.reset')  }}</a>
					
					<a href="{{URL::to('admin/faqs-manager')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel')  }}</a>
				</div>
			</div>
			{{ Form::close() }} 
		</div>
	</div>
</section>
@stop