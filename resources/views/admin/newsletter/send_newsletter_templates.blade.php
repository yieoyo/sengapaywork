@extends('admin.layouts.default')

@section('content')

<!-- chosen select box css and js start here-->
{{ HTML::style('css/admin/chosen.css') }}
{{ HTML::script('js/admin/chosen.jquery.js') }}
<!-- chosen select box css and js end here-->

<!-- ckeditor js start here-->
{{ HTML::script('js/admin/ckeditor/ckeditor.js') }}
<!-- ckeditor js end here-->

<!-- datetime picker js and css start here-->
{{ HTML::script('js/admin/jui/js/jquery-ui-1.9.2.min.js') }}
{{ HTML::script('js/admin/jui/js/timepicker/jquery-ui-timepicker.min.js') }}
<!--{{ HTML::script('js/admin/prettyCheckable.js') }}-->
{{ HTML::style('css/admin/jui/css/jquery.ui.all.css') }}
<!--{{ HTML::style('css/admin/prettyCheckable.css') }}
{{ HTML::style('css/admin/timepicker.css') }}-->
<!-- date time picker js and css and here-->

<section class="content-header">
	<h1>
		Send Newsletter
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/news-letter/newsletter-templates')}}">Newsletter Templates</a></li>
		<li class="active">Send Newsletter</li>
	</ol>
</section>

<section class="content">
	<div class="row pad">
		{{ Form::open(['role' => 'form','url' => 'admin/news-letter/send-newsletter-templates/'.$result->id,'class' => 'mws-form']) }}
		<div class="col-md-6">
			<div class="mws-form-inline">
				<div class="form-group <?php echo ($errors->first('scheduled_time')) ? 'has-error' : ''; ?>">
					{{  Form::label('scheduled_time', 'Scheduled Date', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						{{ Form::text('scheduled_time','', ['class' => 'form-control small']) }}
						<div class="error-message help-inline">
							<?php echo $errors->first('scheduled_time'); ?>
						</div>
					</div>
				</div>
			</div>
			
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
				<div class="form-group <?php echo ($errors->first('newsletter_subscriber_id')) ? 'has-error' : ''; ?>">
					{{  Form::label('newsletter_subscriber_id', 'Subscribers', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						{{ Form::select('newsletter_subscriber_id[]' ,$subscriberArray , null , ['class' => 'chzn-select' , 'style' => 'width:55%','data-placeholder'=>'Select Subscribers','multiple'=>'multiple']) }}
						(Leave blank for select all)
						<div class="error-message help-inline">
							<?php echo $errors->first('newsletter_subscriber_id'); ?>
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
								<?php echo $errors->first('newsletter_subscriber_id'); ?>
							</div>
						</div>
						<div class="col-md-6">
							<span style = "padding-left:20px;padding-top:0px; valign:top">
							<a onclick = "return InsertHTML()" href="javascript:void(0)" class="btn  btn-success no-ajax"><i class="icon-white "></i>{{ trans("messages.system_management.insert_variable") }}</a>
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
						{{ Form::textarea("body",$result->body, ['class' => 'small','id' => 'body']) }}
						
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
				
				<a href="{{URL::to('admin/myaccount')}}" class="btn btn-danger"><i class=\"icon-refresh\"></i> {{ trans("messages.system_management.reset") }}</a>
				
				<a href="{{URL::to('admin/news-letter/newsletter-templates')}}" class="btn  btn-info"><i class=\"icon-refresh\"></i> {{ trans('Cancel') }}</a>
				
			</div>
		</div>
		</div>
		
		{{ Form::close() }}
	</div>
</section>

<script type="text/javascript">
	$(function(){
		$(".chzn-select").chosen();
		$('#scheduled_time').datetimepicker({ 
			timeFormat: "hh:mm:ss tt",
			dateFormat: 'yy-mm-dd',
			ampm: true,
			minDate: new Date(<?php echo date('Y,m-1,d,H,i');  ?>)
		});	
	});
</script>

<script type='text/javascript'>
	/* this function insert defined onstant on button click */
	function InsertHTML() {
		var strUser = document.getElementById("constants").value;
		
		if(strUser != ''){
			var newStr = '{'+strUser+'}';
			var oEditor = CKEDITOR.instances["body"] ;
			oEditor.insertHtml(newStr) ;	
		}
    }
	
</script>
<style>
	.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
		padding:1px;
	}
	.chosen-choices{
		height: 38px;
	}
</style>
@stop
