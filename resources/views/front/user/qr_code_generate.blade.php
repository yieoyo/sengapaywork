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
						{{ trans("messages.header.home") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{route('user.home_template')}}" class="kt-subheader__breadcrumbs-link">
						{{ trans("messages.qr_code_generate.form_application") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link"> {{ trans("messages.qr_code_generate.qr_code") }} </span>
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
					<div class="kt-portlet__body">
						<div class="">
							<div class="row">
								<div class="col-sm-3">
									<div class="qr_code_img_blk" style="background-image:url('http://chart.apis.google.com/chart?cht=qr&chs=200x200&chl={{$billUrl}}&chld=H|0')"></div>
									<div class="qr_code_img_instruction">Scan QR Code to Pay Online <span>OR Click Link Below</span></div>
									<div class="qr_code_link"><a href="{{$billUrl}}" target="_blank">{{$billUrl}}</a></div>
								</div>
								<div class="col-sm-2">
									<div class="qr_payment_description">
										<div class="qr_payment_description_txt">Title:</div>
										<div class="qr_payment_description_txt">Departure-Arrival Date:</div>
										<div class="qr_payment_description_txt">Name:</div>
										<div class="qr_payment_description_txt">Phone:</div>
										<div class="qr_payment_description_txt">Email:</div>
										<div class="qr_payment_description_txt">Deposit (RM)/ Quantity:</div>
										<div class="qr_payment_description_txt">Agent Referral / ID:</div>
									</div>
								</div>
								<div class="col-sm-7">
									<div class="qr_payment_description">
										<div class="qr_payment_description_txt">
											@if($orderDetails->package_category == 1)
												Direct Flight-
											@elseif($orderDetails->package_category == 2)
												Umrah Ziarah-
											@elseif($orderDetails->package_category == 3)
												Umrah Transit-
											@else
												Holidays-
											@endif
											{{$orderDetails->season}} - {{$orderDetails->hotel_category}} - {{$orderDetails->flight}} - {{$orderDetails->hotel}}
										</div>
										<div class="qr_payment_description_txt">{{$orderDetails->date}}</div>
										<div class="qr_payment_description_txt">{{$orderDetails->contact_name}}</div>
										<div class="qr_payment_description_txt">{{$orderDetails->contact_phone}}</div>
										<div class="qr_payment_description_txt">{{$orderDetails->contact_email}}</div>
										<div class="qr_payment_description_txt">{{$depositAmount}} - {{$totalGuests}}</div>
										<div class="qr_payment_description_txt">{{$orderDetails->sales_person_name}} - {{$orderDetails->refrral_id}}</div>
									</div>
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



@stop