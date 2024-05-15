@extends('front.layouts.default')
@section('content')

<!--- ckeditor js start  here -->
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/ckeditor/ckeditor.js') }}

<!--begin::Page Vendors(used by this page) -->
<script src="{{WEBSITE_JS_URL}}plugins/custom/ckeditor/ckeditor-classic.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{WEBSITE_JS_URL}}pages/crud/forms/editors/ckeditor-classic.js" type="text/javascript"></script>

<!--- ckeditor js end  here -->

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{ trans("messages.email_template.edit_email_template") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} </span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{URL('/email-manager')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.email_template") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.email_template.edit_email_template") }} </span>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->


				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">{{ trans("messages.email_template.edit_email_template_form") }}</h3>
						</div>
					</div>
					{{ Form::open(['role' => 'form','url' => 'email-manager/edit-template/'.$emailTemplate->id,'class' => 'kt-form kt-form--label-left']) }}
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										{{ HTML::decode( Form::label('name',trans("messages.email_template.template_name"), ['class' => 'col-sm-2 col-form-label'])) }}
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('name', $emailTemplate->name, ['class' => 'form-control', 'readonly'=>true, 'aria-describedby'=>'basic-addon1']) }}
											</div>
											<span class="form-text text-muted help-inline">
												<?php echo $errors->first('name'); ?>
											</span>
										</div>
									</div>
									<div class="form-group row">
										{{ HTML::decode( Form::label('subject',trans("messages.email_template.subject"), ['class' => 'col-sm-2 col-form-label'])) }}
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('subject', $emailTemplate->subject, ['class' => 'form-control', 'aria-describedby'=>'basic-addon1']) }}
											</div>
											<span class="form-text text-muted help-inline">
												<?php echo $errors->first('subject'); ?>
												{{ trans("messages.email_template.this_text_will_appear_on_email_subject") }}
											</span>
										</div>
									</div>
									<?php /* <div class="form-group row">
										{{ HTML::decode( Form::label('constants',trans("Shotcodes Variable:"), ['class' => 'col-sm-2 col-form-label'])) }}
										<div class="col-sm-10">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
												<textarea type="text" class="form-control" value="" placeholder="{invoice_id} {invoice_code} {deposit_amount} {total_amount} {customer_email} {customer_id} {country} {phone} {currency_code} {currency_sign} {invoice_link} {site_title} {fullname}" aria-describedby="basic-addon1" autocomplete="off"></textarea>
											</div>
											<span class="form-text text-muted help-inline">
												<?php echo $errors->first('constants'); ?>
											</span>
										</div>
									</div> */ ?>
									<div class="form-group" style="display:none;">
										{{  Form::label('action', trans("messages.system_management.action"), ['class' => 'mws-form-label']) }}
										<div class="mws-form-item">
											{{ Form::select('action',$Action_options,$emailTemplate->action, ['class' => 'form-control','onchange'=>'constant()']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('action'); ?>
											</div>
										</div>
									</div>
									<div class="form-group row">
										{{ HTML::decode( Form::label('constants',trans("messages.email_template.shotcodes_variable"), ['class' => 'col-sm-2 col-form-label'])) }}
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::select('constants', array(),'', ['empty' => 'Select one','class' => 'form-control','id'=>'constants']) }}
											</div>
											<span class="form-text text-muted help-inline">
												<?php echo $errors->first('constants'); ?>
											</span>
										</div>
										<div class="col-sm-2">
											<button type="button" onclick = "return InsertHTML()" class="btn btn-primary btn-sm">
											{{ trans("messages.email_template.insert_variable") }}</button>
										</div>
									</div>
									
									<div class="form-group email_temp_format">
										<div class="kt-portlet__head-label">
											{{ HTML::decode( Form::label('body',trans("messages.header.email_template"), ['class' => 'kt-portlet__head-title'])) }}
										</div>
										<div class="email_temp_format_blk">
											{{ Form::textarea("body",$emailTemplate->body, ['class' => '','id' => 'body']) }}
										</div>
										<script type="text/javascript">
											// For CKEDITOR //
											CKEDITOR.replace( 'body',
											{
												height: 350,
												//width: 507,
												filebrowserUploadUrl : '<?php echo URL::to('admin/base/uploder'); ?>',
												filebrowserImageWindowWidth : '640',
												filebrowserImageWindowHeight : '480',
												enterMode : CKEDITOR.ENTER_BR
											});
											CKEDITOR.config.allowedContent = true;	
										</script>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-3 col-xl-3">
									</div>
									<div class="col-lg-9 col-xl-9">
										<button type="submit" class="btn btn-success">{{ trans("messages.general_setting.save") }}</button>&nbsp;
										<a href="{{URL::to('email-manager')}}" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</a>
									</div>
								</div>
							</div>
						</div>
					{{ Form::close() }} 
				</div>


			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



<?php  $constant = ''; ?>
<script type='text/javascript'>
var myText = '<?php  echo $constant; ?>';
	$(function(){
		constant();
	});
	/* this function used for  insert contant, when we click on  insert variable button */
    function InsertHTML() {
		
		var strUser = document.getElementById("constants").value;
		
		if(strUser != ''){
			var newStr = '{'+strUser+'}';
			var oEditor = CKEDITOR.instances["body"] ;
			oEditor.insertHtml(newStr) ;	
		}
    }
	/* this function used for get constant,define in email template*/
	function constant() {
		var constant = document.getElementById("action").value;
			$.ajax({
				url: "<?php echo URL::to('email-manager/get-constant')?>",
				type: "POST",
				data: { constant: constant},
				dataType: 'json',
				success: function(r){
					$('#constants').empty();
					$('#constants').append( '<option value="">-- Select One --</option>' );
					$.each(r, function(val, text) {
						var sel ='';
						if(myText == text)
						 {
						   sel ='selected="selected"';
						 }
						 
						$('#constants').append( '<option value="'+text+'" '+sel+'>'+text+'</option>');
					});	
			   }
			});
		return false; 
	}	
</script>
<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		font-size: 14px !important;
		padding: 0px !important;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		vertical-align: top !important;
	}
	.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
		border: 0px !important;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
		border-top: 0px !important;
		padding: 0px !important;
	}
	.table-bordered {
		border: 0px !important;
	}
</style>
@stop
