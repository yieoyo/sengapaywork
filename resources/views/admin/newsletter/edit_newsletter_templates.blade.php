@extends('admin.layouts.default')

@section('content')

<!-- ckeditor js start  here-->
{{ HTML::script('js/admin/ckeditor/ckeditor.js') }}
<!-- ckeditor js end  here-->
<section class="content-header">
	<h1>
		Edit Template
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/news-letter/newsletter-templates')}}">Newsletter Templates</a></li>
		<li class="active">Edit Template</li>
	</ol>
</section>

<section class="content">
	<div class="row pad">
		{{ Form::open(['role' => 'form','url' => 'admin/news-letter/edit-newsletter-templates/'.$result->id,'class' => 'mws-form']) }}
		<div class="col-md-6">
			<div class="mws-form-inline">
				<div class="form-group <?php echo ($errors->first('subject')) ? 'has-error' : ''; ?>">
					{{  Form::label('subject', 'Subject', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						{{ Form::text('subject', $result->subject, ['class' => 'form-control small']) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('subject'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="mws-form-inline">
				<div class="form-group <?php echo ($errors->first('constant')) ? 'has-error' : ''; ?>">
					
					{{  Form::label('constant', 'Constants', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						<div class="col-md-6">
							<?php $constantArray = Config::get('newsletter_template_constant'); ?>
							{{ Form::select('constant', $constantArray,'', ['id' => 'constants','empty' => 'Select one','class' => 'form-control small']) }}
							<div class="error-message help-inline">
								<?php echo $errors->first('constant'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<span>
								<a onclick = "return InsertHTML()" href="javascript:void(0)" class="btn  btn-success no-ajax"><i class="icon-white "></i>{{ trans("messages.system_management.insert_variable") }} </a>
							</span>
						</div>
					</div>
				</div>
			</div>
			<br /><br />	
			<div class="mws-form-inline">
				<div class="form-group">
					{{  Form::label('body', 'Email Body', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						{{ Form::textarea("body", $result->body , ['class' => 'small','id' => 'body']) }}
						
						<span class="error-message help-inline">
							<?php echo $errors->first('body'); ?>
						</span>
						<script type="text/javascript">
					/* For CKeditor */
						// <![CDATA[
						CKEDITOR.replace( 'body',
						{
							height: 350,
							width: 600,
							filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
							filebrowserImageWindowWidth : '640',
							filebrowserImageWindowHeight : '480',
							enterMode : CKEDITOR.ENTER_BR
						});
						//]]>		
					</script>
					</div>
				</div>
			</div>
			<div class="mws-button-row">
				<div class="input" >
					<input type="submit" value="{{ trans('messages.system_management.save') }}" class="btn btn-primary">
					
					<a href="{{URL::to('admin/news-letter/edit-newsletter-templates/'.$result->id)}}" class="btn  btn-danger"><i class=\"icon-refresh\"></i> {{ trans('messages.system_management.reset') }}</a>
					
					<a href="{{URL::to('admin/news-letter/newsletter-templates')}}" class="btn  btn-info"><i class=\"icon-refresh\"></i> {{ trans('messages.cancel.cancel') }}</a>
				</div>
			</div>
		{{ Form::close() }}
		</div>
	</div>
</section>

<script type='text/javascript'>
	/* this function insert define constant on ckeditor*/
	function InsertHTML() {
		var strUser = document.getElementById("constants").value;
		if(strUser != ''){
			var newStr = '{'+strUser+'}';
			var oEditor = CKEDITOR.instances["body"] ;
			oEditor.insertHtml(newStr) ;	
		}
    }
</script>

@stop
