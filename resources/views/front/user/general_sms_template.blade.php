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
						SMS Template </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							General </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							SMS Template </a>
						<!--<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Profile 1 </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Email Settings </a>-->
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<!--<a href="#" class="btn kt-subheader__btn-secondary">
							Reports
						</a>
						<!--<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
							<a href="#" class="btn btn-danger kt-subheader__btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Products
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>
								<a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>
								<a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
							</div>
						</div>-->
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
							<h3 class="kt-portlet__head-title"><span class="flaticon-calendar"></span>SMS Template List</h3>
						</div>
					</div>
					<div class="template_list_table">
					   <table id="template_list">
						  <tbody>
							 <tr>
								<th style="width: 8%;">GUEST</th>
								<th>TEMPLATE NAME</th>
								<th style="width: 18%;text-align: center;">ACTION</th>
							 </tr>
							 <tr>
								<td>1 <span class="booking_order"></span></td>
								<td>Booking Order</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/sms-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon2-sms"></i>Test SMS</a>
								   </span>
								</td>
							 </tr>
							 <tr>
								<td>2 <span class="booking_order"></span></td>
								<td>Booking Paid</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/sms-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon2-sms"></i>Test SMS</a>
								   </span>
								</td>
							 </tr>
							 
							 
						  </tbody>
					   </table>
					</div>
					
					
					
				</div>
				
				
				
				
				
				
				
				
				
				

			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



@stop