@extends('front.layouts.default')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<?php $userDetails	=	CustomHelper::getSideMenuDetails(); ?>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{ trans('messages.personal_information.personal_information') }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{route('User.dashboard')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans('messages.navigation.dashboard') }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							 {{ trans('messages.personal_information.personal_information') }}</span>
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

				<!--Begin:: App Aside-->
				<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

					@include('front.elements.navigation');
					
				</div>
				<!--End:: App Aside-->

				<!--Begin:: App Content-->
				<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
					<div class="row">
						<div class="col-xl-12">
							<div class="kt-portlet">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">{{ trans('messages.personal_information.personal_information') }} <small>{{ trans('messages.personal_information.update_your_personal_information') }}</small></h3>
									</div>
									<?php /* <div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="dropdown dropdown-inline">
												<button type="button" class="btn btn-label-brand btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="flaticon2-gear"></i>
												</button>
												<div class="dropdown-menu dropdown-menu-right">
													<ul class="kt-nav">
														<li class="kt-nav__section kt-nav__section--first">
															<span class="kt-nav__section-text">Export Tools</span>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-print"></i>
																<span class="kt-nav__link-text">Print</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-copy"></i>
																<span class="kt-nav__link-text">Copy</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-file-excel-o"></i>
																<span class="kt-nav__link-text">Excel</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-file-text-o"></i>
																<span class="kt-nav__link-text">CSV</span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																<span class="kt-nav__link-text">PDF</span>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div> */ ?>
								</div>
								{{ Form::open(['role' => 'form','url' => "saveprofile",'id'=>"update_profile_form","class"=>"kt-form kt-form--label-right"]) }}
									<div class="kt-portlet__body">
										<div class="kt-section kt-section--first">
											<div class="kt-section__body">
												<div class="row">
													<label class="col-xl-3"></label>
													<div class="col-lg-9 col-xl-6">
														<h3 class="kt-section__title kt-section__title-sm">{{ trans('messages.personal_information.customer_info') }}:</h3>
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.personal_information.avatar') }}</label>
													<div class="col-lg-9 col-xl-6">
														<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
															@if(!empty($userDetails->image) && File::exists(USER_PROFILE_IMAGE_ROOT_PATH . $userDetails->image))
																<?php $profile = USER_PROFILE_IMAGE_URL . $userDetails->image; ?>
															@else
																<?php $profile = USER_PROFILE_IMAGE_URL."no_image.png"; ?>
															@endif
															<div class="kt-avatar__holder" style="background-image: url('{{$profile;}}');"></div>
															<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Avtar">
																<i class="fa fa-pen"></i>
																{{ Form::file('image',['class'=>'', 'accept'=>'image/*']) }}
															</label>
															<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Avtar">
																<i class="fa fa-times"></i>
															</span>
														</div>
													</div>
												</div>
												
												<?php /* <div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
													<div class="col-lg-9 col-xl-6">
														<input class="form-control" type="text" value="Nick">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
													<div class="col-lg-9 col-xl-6">
														<input class="form-control" type="text" value="Bold">
													</div>
												</div> */ ?>
												
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.personal_information.full_name') }}</label>
													<div class="col-lg-9 col-xl-6">
														{{Form::text("full_name",$userDetails->full_name,['class'=>'form-control', 'placeholder'=>trans('messages.personal_information.enter_full_name') ]) }}
														<span class="form-text help-inline"></span>
													</div>
												</div>
												
												<?php /* <div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
													<div class="col-lg-9 col-xl-6">
														<input class="form-control" type="text" value="Loop Inc.">
														<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
													</div>
												</div> */ ?>
												
												<div class="row">
													<label class="col-xl-3"></label>
													<div class="col-lg-9 col-xl-6">
														<h3 class="kt-section__title kt-section__title-sm">{{ trans('messages.personal_information.contact_info') }}:</h3>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.personal_information.contact_phone') }}</label>
													<div class="col-lg-9 col-xl-6">
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
															{{Form::text("phone",!empty($userDetails->phone)?$userDetails->phone:'', ['class'=>'form-control', 'aria-describedby'=>'basic-addon1', 'placeholder'=>trans('messages.personal_information.enter_contact_phone')]) }}
														</div>
														<span class="form-text help-inline phone_error">{{ trans('messages.personal_information.we_ll_never_share_your_phone_with_anyone_else')}}
														</span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.personal_information.email_address') }}</label>
													<div class="col-lg-9 col-xl-6">
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
															{{Form::text("email",!empty($userDetails->email)?$userDetails->email:'', ['class'=>'form-control', 'aria-describedby'=>'basic-addon1', 'placeholder'=>trans('messages.personal_information.enter_email_address')]) }}
														</div>
														<span class="form-text help-inline email_error">
														{{ trans('messages.personal_information.we_ll_never_share_your_email_with_anyone_else') }}</span>
													</div>
												</div>
												<?php /* <div class="form-group form-group-last row">
													<label class="col-xl-3 col-lg-3 col-form-label">Company Site</label>
													<div class="col-lg-9 col-xl-6">
														<div class="input-group">
															<input type="text" class="form-control" placeholder="Username" value="loop">
															<div class="input-group-append"><span class="input-group-text">.com</span></div>
														</div>
													</div>
												</div> */ ?>
												
											</div>
										</div>
									</div>
									<div class="kt-portlet__foot">
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-3 col-xl-3">
												</div>
												<div class="col-lg-9 col-xl-9">
													<button type="button" onclick="saveInformation();" class="btn btn-success">{{ trans('messages.cms_page_details.submit') }}</button>&nbsp;
													<button type="reset" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</button>
												</div>
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>

				<!--End:: App Content-->
			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>

<script>
function saveInformation(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#update_profile_form')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ url("saveprofile") }}',
		type:'POST',
		data: $('#update_profile_form').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: 'Personal Information Saved Successfully.',
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "phone"){
						$(".phone_error").addClass('error');
						$(".phone_error").html(html);
					}else if(index == "email"){
						$(".email_error").addClass('error');
						$(".email_error").html(html);
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

// Class definition
var KTUserEdit = function () {
	// Base elements
	var logo;
	var favicon;
	
	var initUserForm = function() {
		logo = new KTAvatar('kt_user_edit_avatar');
		favicon = new KTAvatar('kt_user_edit_favicon');
	}	
	
	return {
		// public functions
		init: function() {
			initUserForm(); 
		}
	};
}();

jQuery(document).ready(function() {	
	KTUserEdit.init();
});
</script>

@stop