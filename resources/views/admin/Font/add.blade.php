@extends('admin.layouts.default')
@section('content')

<!-- CKeditor start here-->
{{ HTML::script('js/admin/plugins/ckeditor/ckeditor.js') }}
<!-- CKeditor ends-->

<section class="content-header">
	<h1>
		{{ trans("Add New Font") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
		<li><a href="{{URL::to('admin/font-manager')}}">Font Manager</a></li>
		<li class="active">Add New Font</li>
	</ol>
</section>
<section class="content"> 
	<div class="row pad">
		<div class="">	
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
			{{ Form::open(['role' => 'form','route' => "$modelName.save",'class' => 'mws-form', 'files' => true]) }}
			
			<div class="col-md-6">
				<div class="form-group <?php echo ($errors->first('font_name')?'has-error':''); ?>">
					<div class="mws-form-row">
					{{ HTML::decode( Form::label('font_name', trans("messages.$modelName.font_name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::text('font_name','', ['class' => 'form-control small']) }}
							<div class="error-message help-inline">
								<?php echo $errors->first('font_name'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<?php /* <div class="col-md-6">	
				<div class="form-group <?php echo ($errors->first('font_family_css_text')?'has-error':''); ?>">
					<div class="mws-form-row ">
						{{ HTML::decode( Form::label('font_family_css_text', trans("messages.$modelName.font_family_css_text").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::text("font_family_css_text",'', ['class' => 'form-control small']) }}
							<div class="error-message help-inline">
								<?php echo $errors->first('font_family_css_text'); ?>
							</div>
						</div>
					</div>
				</div>
			</div> */ ?>
			<div class="clearfix"></div>
			
			<div class="col-md-6">
				<div class="form-group <?php echo ($errors->first('payment_link')?'has-error':''); ?>">
					<div class="mws-form-row">
					{{ HTML::decode( Form::label('payment_link', trans("Payment Link").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::text('payment_link','', ['class' => 'form-control small']) }}
							<div class="error-message help-inline">
								<?php echo $errors->first('payment_link'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
			
			<div class="mws-panel-body no-padding tab-content"> 
				<?php $i = 1 ; ?>
				@foreach($languages as $value)
				<div id="{{ $i }}div" class="tab-pane {{ ($i ==  $language_code )?'active':'' }} ">
				  <div class="col-md-6">
					<div class="form-group <?php if($i == 1) {echo ($errors->first('font_description')?'has-error':'');} ?>">
						<div class="mws-form-row ">
							{{ HTML::decode( Form::label($i.'_body', trans("messages.$modelName.font_description").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
							<div class="mws-form-item">
								{{ Form::textarea("data[$i][font_description]",'', ['class' => 'form-control small','id' => 'font_description'.$i]) }}
								<span class="error-message help-inline">
								<?php echo ($i ==  $language_code ) ? $errors->first('font_description') : ''; ?>
								</span>
							</div>
							<?php /* <script type="text/javascript">
								// CKEDITOR fro description //
								CKEDITOR.replace( <?php echo 'font_description'.$i; ?>,
								{
									height: 350,
									width: 507,
									filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
									filebrowserImageWindowWidth : '640',
									filebrowserImageWindowHeight : '480',
									enterMode : CKEDITOR.ENTER_BR
								});
							</script> */ ?>
						</div>
					</div>
				  </div>
				
				</div>
				<?php $i++ ; ?>
				@endforeach
			</div>
			
			<?php /* <div class="col-md-6">
				<div class="form-group <?php echo ($errors->first('web_font_css')?'has-error':''); ?>">
					<div class="mws-form-row ">
						{{ HTML::decode( Form::label('web_font_css', trans("messages.$modelName.web_font_css_description").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::textarea("web_font_css",'', ['class' => 'form-control small']) }}
							<span class="error-message help-inline">
							<?php echo $errors->first('web_font_css'); ?>
							</span>
						</div>
					</div>
				</div>
			</div> */ ?>
			<div class="clearfix"></div>
			<div class="col-md-6">
				<div class="form-group <?php echo ($errors->first('font_file')?'has-error':''); ?>">
					<div class="mws-form-row ">
						{{ HTML::decode( Form::label('font_file', trans("Font File").'<span class="requireRed">  </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							{{ Form::file('font_file[]', array('multiple'=>true,'accept'=>'.woff2,.woff,.ttf,.svg,.otf,.eot'));  }}
							<div class="error-message help-inline">
								<?php echo $errors->first('font_file'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<br />
			<div class="col-md-12">
				<div class="mws-button-row">
					<input type="submit" value="{{ trans('messages.global.save') }}" class="btn btn-danger">
					
					<a href="{{ route($modelName.'.add')}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans('messages.global.reset') }}</a>
					
					<a href="{{URL::to('admin/font-manager')}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel')  }}</a>
				</div>
			</div>
			{{ Form::close() }} 
		</div>
	</div>
</section>
@stop