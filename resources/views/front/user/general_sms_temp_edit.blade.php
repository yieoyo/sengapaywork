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
						Edit SMS Template </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							General </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							SMS Template </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Edit SMS Template </a>
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
							<h3 class="kt-portlet__head-title">Edit SMS Template Form</h3>
						</div>
					</div>
					<form class="kt-form kt-form--label-left">
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Template Name:</label>
										<div class="col-sm-4">
											<div class="input-group">
												<input type="text" class="form-control" value="Enter template name" placeholder="" aria-describedby="basic-addon1">
											</div>
											<!--<span class="form-text text-muted">Please enter branch name</span>-->
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Subject:</label>
										<div class="col-sm-4">
											<div class="input-group">
												<input type="text" class="form-control" value="Enter subject name" placeholder="" aria-describedby="basic-addon1">
											</div>
											<span class="form-text text-muted">This text will appear on email subject</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Shotcodes Variable</label>
										<div class="col-sm-10">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
												<textarea type="text" class="form-control" value="" placeholder="{invoice_id} {invoice_code} {deposit_amount} {total_amount} {customer_email} {customer_id} {country} {phone} {currency_code} {currency_sign} {invoice_link} {site_title} {fullname}" aria-describedby="basic-addon1" autocomplete="off"></textarea>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Messages</label>
										<div class="col-sm-10">
											<div class="form-group">
												<div class="email_temp_format_blk">
													<textarea id="" rows="4" cols="50"></textarea>
												</div>
												<span class="form-text text-muted">Please limit your sentences to 160 character only</span>
											</div>
										</div>
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
										<button type="reset" class="btn btn-success">Save</button>&nbsp;
										<button type="reset" class="btn btn-secondary">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>


			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



@stop