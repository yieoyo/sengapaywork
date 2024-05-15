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
						{{ trans("messages.header.setting") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} </span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.setting") }} </span>
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
					  <div class="kt-portlet__head-toolbar" id="general_setting_tabs">
							<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab" aria-selected="true">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"/>
											<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
											<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
										</g>
									</svg>{{ trans("messages.general_setting.application_setting") }}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab" aria-selected="false">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" fill="#000000" opacity="0.3"/>
												<path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" fill="#000000"/>
											</g>
										</svg>{{ trans("messages.general_setting.email_setting") }}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M14.486222,18 L12.7974954,21.0565532 C12.530414,21.5399639 11.9220198,21.7153335 11.4386091,21.4482521 C11.2977127,21.3704077 11.1776907,21.2597005 11.0887419,21.1255379 L9.01653358,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,16.6568542 20.6568542,18 19,18 L14.486222,18 Z" fill="#000000" opacity="0.3"/>
												<path d="M6,7 L15,7 C15.5522847,7 16,7.44771525 16,8 C16,8.55228475 15.5522847,9 15,9 L6,9 C5.44771525,9 5,8.55228475 5,8 C5,7.44771525 5.44771525,7 6,7 Z M6,11 L11,11 C11.5522847,11 12,11.4477153 12,12 C12,12.5522847 11.5522847,13 11,13 L6,13 C5.44771525,13 5,12.5522847 5,12 C5,11.4477153 5.44771525,11 6,11 Z" fill="#000000" opacity="0.3"/>
											</g>
										</svg>{{ trans("messages.general_setting.sms_setting") }}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab4_content" role="tab">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24"/>
												<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
												<path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
											</g>
										</svg>{{ trans("messages.general_setting.payment_gateway") }}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab5_content" role="tab">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<polygon points="0 0 24 0 24 24 0 24"/>
												<rect fill="#000000" opacity="0.3" transform="translate(11.646447, 12.853553) rotate(-315.000000) translate(-11.646447, -12.853553) " x="10.6464466" y="5.85355339" width="2" height="14" rx="1"/>
												<path d="M8.1109127,8.90380592 C7.55862795,8.90380592 7.1109127,8.45609067 7.1109127,7.90380592 C7.1109127,7.35152117 7.55862795,6.90380592 8.1109127,6.90380592 L16.5961941,6.90380592 C17.1315855,6.90380592 17.5719943,7.32548256 17.5952502,7.8603687 L17.9488036,15.9920967 C17.9727933,16.5438602 17.5449482,17.0106003 16.9931847,17.0345901 C16.4414212,17.0585798 15.974681,16.6307346 15.9506913,16.0789711 L15.6387276,8.90380592 L8.1109127,8.90380592 Z" fill="#000000" fill-rule="nonzero"/>
											</g>
										</svg>{{ trans("messages.general_setting.integration") }}
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="kt-portlet__body">
					   <div class="tab-content">
							<div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
							{{ Form::open(['role' => 'form','url' => "save-general-setting",'files'=>'true', 'class' => 'kt-form','id'=>"saveAppSettingForm"]) }}
								<div class="kt-portlet__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="row">
												<div class="col-sm-3"></div>
												
												<div class="col-sm-6">
													<h3 class="kt-section__title kt-section__title-sm">{{ trans("messages.header.general") }}:</h3>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.business_name") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('business_name', !empty($settingResult->business_name)?$settingResult->business_name:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.address") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('business_address', !empty($settingResult->business_address)?$settingResult->business_address:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.business_email") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('business_email', !empty($settingResult->business_email)?$settingResult->business_email:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.business_contact") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('business_contact', !empty($settingResult->business_contact)?$settingResult->business_contact:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.business_url") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('business_url', !empty($settingResult->business_url)?$settingResult->business_url:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.pending_payment_auto_cancellation") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('pending_payment_auto_cancel', !empty($settingResult->pending_payment_auto_cancel)?$settingResult->pending_payment_auto_cancel:'', ['class'=>'form-control','autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.1st_pending_Payment_reminder") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('first_payment_reminder', !empty($settingResult->first_payment_reminder)?$settingResult->first_payment_reminder:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.2st_pending_Payment_reminder") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('second_payment_reminder', !empty($settingResult->second_payment_reminder)?$settingResult->second_payment_reminder:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.3st_pending_Payment_reminder") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('third_payment_reminder', !empty($settingResult->third_payment_reminder)?$settingResult->third_payment_reminder:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.home_title") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('meta_title', !empty($settingResult->meta_title)?$settingResult->meta_title:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<?php /* <div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Default Keyword</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('meta_keyword', !empty($settingResult->meta_keyword)?$settingResult->meta_keyword:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">Default Description</label>
												<div class="col-lg-6 col-xl-6">
													<div class="email_temp_format_blk">
														{{ Form::textarea('meta_description', !empty($settingResult->meta_description)?$settingResult->meta_description:'', ['class'=>'form-control', 'rows'=>'4', 'cols'=>'50', 'autocomplete'=>'off']) }}
													</div>
													<span class="form-text text-muted"></span>
												</div>
											</div> */ ?>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.logo_frontend") }}</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_avatar">
														@if(!empty($settingResult->logo) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . $settingResult->logo))
															<?php $logo = SYSTEM_IMAGE_URL . $settingResult->logo; ?>
														@else
															<?php $logo = ""; ?>
														@endif
														<div class="kt-avatar__holder" style="background-image: url('{{$logo;}}');"></div>
														<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Logo">
															<i class="fa fa-pen"></i>
															{{ Form::file('logo',['class'=>'', 'accept'=>'image/png']) }}
														</label>
														<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Logo">
															<i class="fa fa-times"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.logo_backend") }}</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_backend_avatar">
														@if(!empty($settingResult->logo_backend) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . $settingResult->logo_backend))
															<?php $logo_backend = SYSTEM_IMAGE_URL . $settingResult->logo_backend; ?>
														@else
															<?php $logo_backend = ""; ?>
														@endif
														<div class="kt-avatar__holder" style="background-image: url('{{$logo_backend;}}');"></div>
														<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Backend Logo">
															<i class="fa fa-pen"></i>
															{{ Form::file('logo_backend',['class'=>'', 'accept'=>'image/png']) }}
														</label>
														<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Backend Logo">
															<i class="fa fa-times"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.logo_invoice") }}</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_invoice_avatar">
														@if(!empty($settingResult->logo_invoice) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . $settingResult->logo_invoice))
															<?php $logo_invoice = SYSTEM_IMAGE_URL . $settingResult->logo_invoice; ?>
														@else
															<?php $logo_invoice = ""; ?>
														@endif
														<div class="kt-avatar__holder" style="background-image: url('{{$logo_invoice;}}');"></div>
														<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Invoice Logo">
															<i class="fa fa-pen"></i>
															{{ Form::file('logo_invoice',['class'=>'', 'accept'=>'image/png']) }}
														</label>
														<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Invoice Logo">
															<i class="fa fa-times"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.favicon") }}</label>
												<div class="col-lg-9 col-xl-6">
													<div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_user_edit_favicon">
														@if(!empty($settingResult->favicon) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . $settingResult->favicon))
															<?php $favicon = SYSTEM_IMAGE_URL . $settingResult->favicon; ?>
														@else
															<?php $favicon = ""; ?>
														@endif
														<div class="kt-avatar__holder" style="background-image: url('{{$favicon}}');"></div>
														<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change Favicon">
															<i class="fa fa-pen"></i>
															{{ Form::file('favicon',['class'=>'', 'accept'=>'image/png']) }}
														</label>
														<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel Favicon">
															<i class="fa fa-times"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.tracking_analytics") }}</label>
												<div class="col-lg-6 col-xl-6">
													<div class="email_temp_format_blk">
														{{ Form::textarea('analytics', !empty($settingResult->analytics)?$settingResult->analytics:'', ['class'=>'', 'autocomplete'=>'off','rows'=>'6','cols'=>'50']) }}
														<span class="form-text text-muted analytics_error"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-10 col-xl-10">
											</div>
											<div class="col-lg-2 col-xl-2">
											  @if($editgeneralValGlobal != 0)
												<input type="button" onclick="saveAppSetting()" value='{{ trans("messages.general_setting.save") }}' class="btn btn-success">&nbsp;
												<!--<button type="reset" class="btn btn-secondary">Cancel</button>-->
											  @endif
											</div>
										</div>
									</div>
								</div>
							{{ Form::close() }}
						  </div>
						 
							<div class="tab-pane" id="kt_widget5_tab2_content">
								{{ Form::open(['role' => 'form','url' => "save-email-setting",'files'=>'true', 'class' => 'kt-form','id'=>"saveEmailSettingForm"]) }}
								<div class="kt-portlet__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.mailer") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mail_type', !empty($settingResult->mail_type)?$settingResult->mail_type:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.cms_page_details.email') }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('sender_mail', !empty($settingResult->sender_mail)?$settingResult->sender_mail:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<hr class="hr_padding">
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.smtp_secure") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::select('smtp_security',array('tls'=>'TLS','ssl'=>'SSL','no tls'=>'No TLS') , !empty($settingResult->smtp_security)?$settingResult->smtp_security:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.smtp_host") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mail_host', !empty($settingResult->mail_host)?$settingResult->mail_host:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.smtp_port") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mail_port', !empty($settingResult->mail_port)?$settingResult->mail_port:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.smtp_username") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mail_user_name', !empty($settingResult->mail_user_name)?$settingResult->mail_user_name:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.smtp_password") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mail_user_password', !empty($settingResult->mail_user_password)?$settingResult->mail_user_password:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.mailer") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('mailer_name', !empty($settingResult->mailer_name)?$settingResult->mailer_name:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="kt-form__actions">
												<div class="row">
													<div class="col-lg-3 col-xl-3">
													</div>
													<div class="col-lg-6 col-xl-6">
														<button type="button" onclick="sendTestEmail()" class="btn btn-brand btn-bold btn_1">
														{{ trans("messages.general_setting.test_individual_email") }}</button>
													</div>
												</div>
											</div>
											
											<hr class="hr_padding">
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.global_email_header") }}</label>
												<div class="col-lg-6 col-xl-6">
													<div class="email_temp_format_blk">
														{{ Form::textarea('email_header', !empty($settingResult->email_header)?$settingResult->email_header:'', ['class'=>'', 'autocomplete'=>'off','rows'=>'4','cols'=>'50']) }}
														<span class="form-text text-muted email_header_error"></span>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												{{ trans("messages.general_setting.global_email_footer") }}</label>
												<div class="col-lg-6 col-xl-6">
													<div class="email_temp_format_blk">
														{{ Form::textarea('email_footer', !empty($settingResult->email_footer)?$settingResult->email_footer:'', ['class'=>'', 'autocomplete'=>'off','rows'=>'4','cols'=>'50']) }}
														<span class="form-text text-muted email_footer_error"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-10 col-xl-10">
											</div>
											<div class="col-lg-2 col-xl-2">
											  @if($editgeneralValGlobal != 0)
												<input type="button" onclick="saveEmailSetting()" value="Save" class="btn btn-success">&nbsp;
											  @endif
											</div>
										</div>
									</div>
								</div>
								{{ Form::close() }}
							</div>
						  
							<div class="tab-pane" id="kt_widget5_tab3_content">
								{{ Form::open(['role' => 'form','url' => "save-sms-setting",'files'=>'true', 'class' => 'kt-form','id'=>"saveSMSSettingForm"]) }}
								<div class="kt-portlet__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.api_endpoint") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('api_endpoint', !empty($settingResult->api_endpoint)?$settingResult->api_endpoint:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.api_username") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('api_username', !empty($settingResult->api_username)?$settingResult->api_username:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.api_password") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('api_password', !empty($settingResult->api_password)?$settingResult->api_password:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<hr class="hr_padding">
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.receiver_number") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('receiver_number', !empty($settingResult->receiver_number)?$settingResult->receiver_number:'', ['class'=>'form-control receiver_number', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted">
													{{ trans("messages.general_setting.user_number_without_+6_sample_0123456789") }}</span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.cms_page_details.message') }}</label>
												<div class="col-lg-6 col-xl-6">
													<div class="email_temp_format_blk">
														{{ Form::textarea('message', !empty($settingResult->message)?$settingResult->message:'Hello Testing SMS. 
Hidayah Centre Foundation', ['class'=>'message', 'autocomplete'=>'off','rows'=>'4','cols'=>'50']) }}
													</div>
													<span class="form-text text-muted">
													{{ trans("messages.general_setting.enter_message_less_than_164_character") }}</span>
												</div>
											</div>
											<div class="kt-form__actions">
												<div class="row">
													<div class="col-lg-3 col-xl-3">
													</div>
													<div class="col-lg-6 col-xl-6">
														<?php /* <a href="https://www.smshubs.net/api/sendsms.php?email=admin@apextreasuresoftware.com&key=307b23e8940d302e61041000dae98fdd&sender=GLOBALSMS&recipient=+917792054447&message=Hello Hidayah Centre Foundation&referenceID=4au23sd1ppe4d5as" class="btn btn-brand btn-bold">INDIVIDUAL SMS TEST</a> */ ?>
														<button type="button" onclick="sendTestSms()" class="btn btn-brand btn-bold">
														{{ trans("messages.general_setting.individual_sms_test") }}</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-10 col-xl-10">
											</div>
											<div class="col-lg-2 col-xl-2">
											  @if($editgeneralValGlobal != 0)
												<input type="button" onclick="saveSmsSetting()" value="Save" class="btn btn-success">&nbsp;
											  @endif
											</div>
										</div>
									</div>
								</div>
								{{ Form::close() }}
							</div>
						  
							<div class="tab-pane" id="kt_widget5_tab4_content">
								{{ Form::open(['role' => 'form','url' => "save-payment-setting",'files'=>'true', 'class' => 'kt-form','id'=>"savePaymentSettingForm"]) }}
								<div class="kt-portlet__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="row">
												<div class="col-sm-3"></div>
												<div class="col-sm-6">
													<h3 class="kt-section__title kt-section__title-sm">{{ trans("messages.general_setting.online_payment") }}:</h3>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.billplz_api_secret_key") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('payment_secret_key', !empty($settingResult->payment_secret_key)?$settingResult->payment_secret_key:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label"> {{ trans("messages.general_setting.billplz_collection_id") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('payment_collection_id', !empty($settingResult->payment_collection_id)?$settingResult->payment_collection_id:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label"> {{ trans("messages.general_setting.description") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::text('payment_description', !empty($settingResult->payment_description)?$settingResult->payment_description:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											
											<div class="row">
												<div class="col-sm-3"></div>
												<div class="col-sm-6">
													<h3 class="kt-section__title kt-section__title-sm">
													{{ trans("messages.general_setting.ofline_payment") }}:</h3>
												</div>
											</div>
											<div class="offline_payment_option_blk">
											 @if(!empty($offlinePaymentOptions))
											  @foreach($offlinePaymentOptions as $key=>$offlinePaymentOption)
											   @if(!empty($offlinePaymentOption))
												{{ Form::hidden("Offline[".$key."][id]", $offlinePaymentOption->id, ['class'=>'', 'autocomplete'=>'off']) }}
												<section class="form-group" rel="{{$key}}">
												  <div class="row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.option") }} {{$key + 1}}</label>
													<div class="col-lg-6 col-xl-6">
														{{ Form::text("Offline[".$key."][name]", $offlinePaymentOption->name, ['class'=>'form-control', 'autocomplete'=>'off']) }}
														<span class="form-text text-muted"></span>
													</div>
												  </div>
												  <div class="row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.description") }} {{$key + 1}}</label>
													<div class="col-lg-6 col-xl-6">
														{{ Form::text("Offline[".$key."][description]", $offlinePaymentOption->description, ['class'=>'form-control', 'autocomplete'=>'off']) }}
														<span class="form-text text-muted"></span>
													</div>
												  </div>
												</section>
											   @endif
											  @endforeach
											 @endif
											</div>
											
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">&nbsp;</label>
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="addMoreOfflinePaymentOption()" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.general_setting.add_more_offline_payment_option") }}</button>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-10 col-xl-10">
											</div>
											<div class="col-lg-2 col-xl-2">
											  @if($editgeneralValGlobal != 0)
												<input type="button" onclick="savePaymentSetting()" value="Save" class="btn btn-success">&nbsp;
											  @endif
											</div>
										</div>
									</div>
								</div>
								{{ Form::close() }}
							</div>
						  
							<div class="tab-pane" id="kt_widget5_tab5_content">
								{{ Form::open(['role' => 'form','url' => "save-integration-setting",'files'=>'true', 'class' => 'kt-form','id'=>"saveIntegrationSettingForm"]) }}
								<div class="kt-portlet__body">
									<div class="kt-section kt-section--first">
										<div class="kt-section__body">
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label">{{ trans("messages.general_setting.google_analytics") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::textarea('google_analytics', !empty($settingResult->google_analytics)?$settingResult->google_analytics:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label"> {{ trans("messages.general_setting.google_adsense") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::textarea('google_adsense', !empty($settingResult->google_adsense)?$settingResult->google_adsense:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-xl-3 col-lg-3 col-form-label"> {{ trans("messages.general_setting.facebook_pixel") }}</label>
												<div class="col-lg-6 col-xl-6">
													{{ Form::textarea('facebook_pixel', !empty($settingResult->facebook_pixel)?$settingResult->facebook_pixel:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
													<span class="form-text text-muted"></span>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="kt-portlet__foot">
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-lg-10 col-xl-10">
											</div>
											<div class="col-lg-2 col-xl-2">
											  @if($editgeneralValGlobal != 0)
												<input type="button" onclick="saveIntegrationSetting()" value="Save" class="btn btn-success">&nbsp;
											  @endif
											</div>
										</div>
									</div>
								</div>
								{{ Form::close() }}
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
function saveAppSetting(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#saveAppSettingForm')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SaveGeneralSetting") }}',
		type:'POST',
		data: $('#saveAppSettingForm').serialize(),
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
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
				//window.location.href	 =	"";
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email"){
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

function saveEmailSetting(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#saveEmailSettingForm')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SaveGeneralEmailSetting") }}',
		type:'POST',
		data: $('#saveEmailSettingForm').serialize(),
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
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email_header"){
						$(".email_header_error").addClass('error');
						$(".email_header_error").html(html);
					}else if(index == "email_footer"){
						$(".email_footer_error").addClass('error');
						$(".email_footer_error").html(html);
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

function saveSmsSetting(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#saveSMSSettingForm')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SaveGeneralSmsSetting") }}',
		type:'POST',
		data: $('#saveSMSSettingForm').serialize(),
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
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email_header"){
						$(".email_header_error").addClass('error');
						$(".email_header_error").html(html);
					}else if(index == "email_footer"){
						$(".email_footer_error").addClass('error');
						$(".email_footer_error").html(html);
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

function savePaymentSetting(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#savePaymentSettingForm')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SavePaymentSetting") }}',
		type:'POST',
		data: $('#savePaymentSettingForm').serialize(),
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
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				location.reload();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email_header"){
						$(".email_header_error").addClass('error');
						$(".email_header_error").html(html);
					}else if(index == "email_footer"){
						$(".email_footer_error").addClass('error');
						$(".email_footer_error").html(html);
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

function saveIntegrationSetting(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var KeyVal = 1;
	var formData  = $('#saveIntegrationSettingForm')[0];
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SaveIntegrationSetting") }}',
		type:'POST',
		data: $('#saveIntegrationSettingForm').serialize(),
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
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				location.reload();
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email_header"){
						$(".email_header_error").addClass('error');
						$(".email_header_error").html(html);
					}else if(index == "email_footer"){
						$(".email_footer_error").addClass('error');
						$(".email_footer_error").html(html);
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



function sendTestEmail(){
	$('#loader_img').show();
	var KeyVal = 1;
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ URL("/send-test-email") }}',
		type:'POST',
		data: {},
		// dataType: 'json',
		// contentType: false,       // The content type used when sending data to the server.
		// cache: false,             // To unable request pages to be cached
		// processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
			}else {
				Swal.fire({
				  position: 'top-end',
				  icon: 'error',
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
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


function sendTestSms(){
	$('#loader_img').show();
	var phoneNumber = $(".receiver_number").val();
	var message = $(".message").val();
	var KeyVal = 1;
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ URL("/send-test-sms") }}',
		type:'POST',
		data: {'phoneNumber':phoneNumber, 'message':message},
		// dataType: 'json',
		// contentType: false,       // The content type used when sending data to the server.
		// cache: false,             // To unable request pages to be cached
		// processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				Swal.fire({
				  position: 'top-end',
				  icon: 'success',
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
				//location.reload();
			}else {
				Swal.fire({
				  position: 'top-end',
				  icon: 'error',
				  title: datas['message'],
				  showConfirmButton: false,
				  timer: 2000
				})
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



function addMoreOfflinePaymentOption(){
	$('#loader_img').show();
	var get_last_id			=	$('.offline_payment_option_blk section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-offline-payment-option") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".offline_payment_option_blk").append(response);
		}
	});
}





// Class definition
var KTUserEdit = function () {
	// Base elements
	var logo;
	var backend_logo;
	var invoice_logo;
	var favicon;
	
	var initUserForm = function() {
		logo = new KTAvatar('kt_user_edit_avatar');
		backend_logo = new KTAvatar('kt_user_edit_backend_avatar');
		invoice_logo = new KTAvatar('kt_user_edit_invoice_avatar');
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