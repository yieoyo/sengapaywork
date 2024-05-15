@extends('front.layouts.default')
@section('content')


<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{ trans('messages.account_vendors.edit_vendor')}}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.admin_account.account") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{route('user.account_vendors')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans('messages.header.vendors')}} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans('messages.account_vendors.edit_vendor')}} </span>
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
							<h3 class="kt-portlet__head-title">{{ trans('messages.account_vendors.edit_vendor_form')}}</h3>
						</div>
					</div>
					{{ Form::open(['role' => 'form','url'=>"vendor-save", 'class'=>'kt-form kt-form--label-left', 'id'=>"editSalesPersonForm"]) }}
					{{ Form::hidden('id',$userDetails->id,['class'=>'']) }}
					<div class="cover_content_edit_admin_block">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans('messages.personal_information.full_name') }}:</label>
									{{ Form::text('vendor_name',$userDetails->full_name,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.personal_information.enter_full_name')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.contact_number") }}:</label>
									{{ Form::text('phone',$userDetails->phone,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.enter_contact_number')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans('messages.cms_page_details.email') }}:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="flaticon-email"></i></span>
										</div>
										{{ Form::text('vendor_email',$userDetails->email,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans(''), 'aria-describedby'=>'basic-addon1']) }}
									</div>
									<span class="form-text text-muted email_error"></span>
								</div>
							</div><?php /* <div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.password") }}:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="flaticon-safe-shield-protection"></i></span>
										</div>
										{{ Form::password('password',['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans(''), 'aria-describedby'=>'basic-addon1']) }}
									</div>
									<span class="form-text text-muted password_error"></span>
								</div>
							</div> */ ?>
							
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans('messages.dashboard.status') }}:</label>
									{{ Form::select('is_active',array('1'=>trans('messages.navigation.active'),'0'=>trans('messages.language_settings.in_active')),$userDetails->is_active, ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.select_status')]) }}
									<span class="form-text text-muted status_error"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.short_description") }}:</label>
									{{ Form::textarea('short_description',$userDetails->short_description,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.short_description')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							
							<?php /* <div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">Payment Method:</label>
									<div class="kt-checkbox-inline">
										<label class="kt-checkbox">
											{{ Form::checkbox('payment_method[]',1,(in_array(1,$selectedPaymentMethod))?1:'', ['class'=>'']) }} QR Code
											<span></span>
										</label>
										<label class="kt-checkbox">
											{{ Form::checkbox('payment_method[]',2,(in_array(2,$selectedPaymentMethod))?2:'', ['class'=>'']) }} Cash
											<span></span>
										</label>
										<label class="kt-checkbox">
											{{ Form::checkbox('payment_method[]',3,(in_array(3,$selectedPaymentMethod))?1:'', ['class'=>'']) }} CDM
											<span></span>
										</label>
										<label class="kt-checkbox">
											{{ Form::checkbox('payment_method[]',4,(in_array(4,$selectedPaymentMethod))?1:'', ['class'=>'']) }} Bank Transfer
											<span></span>
										</label>
									</div>
									<span class="form-text text-muted payment_error"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">Deposit (RM):</label>
									{{ Form::text('deposit',$userDetails->deposit,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('Enter allowed deposit per guest')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">Commission (RM):</label>
									{{ Form::text('commission',$userDetails->commission,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('Enter commission per package')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">Sales Person Refrral ID:</label>
									{{ Form::text('refrral_id',$userDetails->refrral_id,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('Enter Sales Person Refrral ID')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div> */ ?>
							
							
						</div>
					</div>
					<div class="kt-portlet__foot">
					  <div class="kt-form__actions">
						<div class="row">
						  <div class="col-lg-9 col-xl-9">
							<input type="button" onclick="saveSalesPerson(1)" value="{{ trans('messages.account_vendors.update') }}" class="btn btn-success btn_1">&nbsp;
							<input type="button" onclick="saveSalesPerson(2)" class="btn btn-brand btn_2" value="{{ trans('messages.account_vendors.update_create_new') }}" >&nbsp;
							<a href="{{ route('user.account_vendors') }}" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</a>
						  </div>
						</div>
					  </div>
					</div>
				
				</div>

			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>


<script>
function saveSalesPerson(KeyVal){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.AccountVendorUpdate") }}',
		type:'POST',
		data: $('#editSalesPersonForm').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				if(KeyVal == 2){
					//location.reload();
					window.location.href	 =	"{{ route('user.account_vendor_add') }}";
				}else{
					window.location.href	 =	"{{ route('user.account_vendors') }}";
				}
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email"){
						$(".email_error").addClass('error');
						$(".email_error").html(html);
					}else if(index == "password"){
						$(".password_error").addClass('error');
						$(".password_error").html(html);
					}else if(index == "payment_method"){
						$(".payment_error").addClass('error');
						$(".payment_error").html(html);
					}else if(index == "is_active"){
						$(".status_error").addClass('error');
						$(".status_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
				});
			}
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
		error: function(r){
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
	});
}

</script>



@stop