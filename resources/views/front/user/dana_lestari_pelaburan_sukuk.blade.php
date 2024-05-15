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
						Pelaburan Sukuk</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Infaq </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Dana Lestari</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Pelaburan Sukuk</a>
						</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

				<!--end: Form Wizard Nav -->
				<div class="kt-portlet">
					<div class="kt-portlet__body kt-portlet__body--fit">
						<div class="kt-grid">
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

								<!--begin: Form Wizard Form-->
								{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"saveAppSettingForm"]) }}

									<!--begin: Form Wizard Step 1-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">Enquiry Form</div>
										<div class="kt-heading kt-heading--md">Enter your Personal Detail</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-6 form-group">
														<label>Full Name*:</label>
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">Please enter your Full Name.</span>
													</div>
													<div class="col-6 form-group">
														<label>I.C. Number (Optional):</label>
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">Please enter I.C. Number.</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>Phone Number*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('field_name', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">Please enter your Phone Number.</span>
													</div>
													<div class="col-6 form-group">
														<label>Email*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('field_name', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">Please enter Your Email.</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
												
													<div class="col-xl-6">
														<div class="form-group">
															<label>Company Address (Optional)</label>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">Please enter your Address.</span>
														</div>
													</div>
													
													<div class="form-group"></div>
													
													<div class="col-xl-6">
														<div class="form-group">
															<label>Postcode</label>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">Please enter your Postcode.</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> 

									<!--end: Form Wizard Step 1-->


									<!--begin: Form Actions -->
									<div class="kt-form__actions">
										<div class="row">
											<div class="col-2">
												<button type="reset" class="btn btn-secondary">Previous</button>
											</div>
											<div class="col-8"></div>
											<div class="col-2">
												<button type="button" onclick="" class="btn btn-success">Submit</button>
											</div>
										</div>
									</div>
									

									<!--end: Form Actions -->
								{{ Form::close() }}

								<!--end: Form Wizard Form-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Content -->
	</div>
</div>


@stop