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
						Iftar Perdana</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Infaq</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Special Project</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Iftar Perdana</a>
						</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

				<!--begin: Form Wizard Nav -->
				<div class="kt-wizard-v4__nav">

					<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
					<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable clickable_nav_items">
						<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
							<div class="kt-wizard-v4__nav-body">
								<div class="kt-wizard-v4__nav-number">
									1
								</div>
								<div class="kt-wizard-v4__nav-label">
									<div class="kt-wizard-v4__nav-label-title">
										Your Plan
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										Choose Your Plan
									</div>
								</div>
							</div>
						</div>
						<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
							<div class="kt-wizard-v4__nav-body">
								<div class="kt-wizard-v4__nav-number">
									2
								</div>
								<div class="kt-wizard-v4__nav-label">
									<div class="kt-wizard-v4__nav-label-title">
										Your Profile
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										Add Your Personal Info
									</div>
								</div>
							</div>
						</div>
						<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
							<div class="kt-wizard-v4__nav-body">
								<div class="kt-wizard-v4__nav-number">
									3
								</div>
								<div class="kt-wizard-v4__nav-label">
									<div class="kt-wizard-v4__nav-label-title">
										Payment Details
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										Choose Your Payment Options
									</div>
								</div>
							</div>
						</div>
						<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step">
							<div class="kt-wizard-v4__nav-body">
								<div class="kt-wizard-v4__nav-number">
									4
								</div>
								<div class="kt-wizard-v4__nav-label">
									<div class="kt-wizard-v4__nav-label-title">
										Completed
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										Review and Submit
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--end: Form Wizard Nav -->
				<div class="kt-portlet">
					<div class="kt-portlet__body kt-portlet__body--fit">
						<div class="kt-grid">
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

								<!--begin: Form Wizard Form-->
								{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"saveAppSettingForm"]) }}

									<!--begin: Form Wizard Step 1-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">[A] Belian atau Tajaan untuk Kerusi atau Meja</div>
										<div class="kt-heading kt-heading--md">Beli & Hadir Ke Iftar Perdana</div>
										<div class="kt-form__section kt-form__section--first">
										
											<div class="kt-wizard-v4__form">
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Meja Emas (RM 10000.00)<br/>Nota:1 Meja mempunyai 10 Kerusi</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Meja Emas (RM 5000.00)<br/>Nota:1 Meja mempunyai 10 Kerusi</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Meja Emas (RM 3000.00)<br/>Nota:1 Meja mempunyai 10 Kerusi</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Kerusi Emas (RM 1000.00)</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Kerusi Emas (RM 500.00)</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Kerusi Emas (RM 300.00)</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												
												<div class="kt-heading kt-heading--md">Taja Saudara Baru Ke Iftar Perdana</div>
												
												
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Kerusi Emas (RM 300.00)</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												<div class="form-group row">
													<label class="col-form-label col-lg-4 col-sm-12">Meja Emas (RM 2000.00)<br/>Nota:1 Meja mempunyai 10 Kerusi</label>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-bookmark-o"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
													<div class="col-lg-4 col-sm-12">
														<div class="input-group flex-nowrap mb-3">
															<div class="input-group-prepend">
																<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
															</div>
															{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														
													</div>
												</div>
												
												
												<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
												
												
												
												<div class="kt-heading kt-heading--md">Sumbangan Tanpa Belian atau Tajaan</div>
												
												
												
												<div class="form-group"></div>
													
												<div class="form-group">
													<label>Total Contribution:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">RM</span></div>
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'0']) }}
													</div>
													
												</div>
												
											</div>
										</div>
									</div> 

									<!--end: Form Wizard Step 1-->

									<!--begin: Form Wizard Step 2-->
									
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
									
										<div class="kt-heading kt-heading--md">Enter Your Personal Detail</div>
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
															<label>Address (Optional)</label>
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

									<!--end: Form Wizard Step 2-->

									<!--begin: Form Wizard Step 3-->
									
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
										<div class="kt-heading kt-heading--md">Select Payment Details</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
											
												<div class="form-group form-group-marginless">
													<label>Choose Payment Option:</label>
													<div class="row">
														<div class="col-sm-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Online Banking (Recurring)
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														<div class="col-sm-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Bank Transfer
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														<div class="col-sm-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			CDM
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														<div class="col-sm-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Cheque
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														<div class="col-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			QR Pay
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														<div class="col-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('contactus_status','1','1',['class'=>'']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			Credit / Debit Card (Terminal)
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
														
														
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="form-group">
													<label>Refference ID</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
													<span class="form-text text-muted">Please enter your Payment RefferenceID.</span>
												</div>
												
											</div>
										</div>
									</div>

									<!--end: Form Wizard Step 3-->

									<!--begin: Form Wizard Step 4-->
									
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
										<div class="kt-heading kt-heading--md">Review your Details and Infaq</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__review">
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														Your Plan Details
													</div>
													<div class="kt-wizard-v4__review-content">
														Commitment Type: Monthly<br />
														Plan: RM 50<br />
														Period: 24 Months
													</div>
												</div>
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														Your Personal Info
													</div>
													<div class="kt-wizard-v4__review-content">
														Full Name: Mohd Syafiq Affandi<br />
														I.C Number: 0123456789<br />
														Phone Number: 0123456789<br />
														Email: syafiq.affandi@gmail.com<br/>
														Address: Address1<br />
														Pascode: 70400
													</div>
												</div>
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														Your Payment Details
													</div>
													<div class="kt-wizard-v4__review-content">
														Payment Options: Online Banking<br />
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Form Wizard Step 4-->

									<!--begin: Form Actions -->
									<div class="kt-form__actions">
										<button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
											Previous
										</button>
										<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
											Submit
										</button>
										<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
											Next Step
										</button>
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