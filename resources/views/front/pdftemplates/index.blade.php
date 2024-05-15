@extends('front.layouts.default')
@section('content')

{{HTML::script('js/admin/vendors/match-height/jquery.equalheights.js') }}

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						PDF Template </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							General </span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							PDF Template </span>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
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
					<div class="kt-portlet kt-portlet--mobile">
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="kt-font-brand flaticon-calendar"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								Template List
							</h3>
						</div>
					</div>
					
					<div class="template_list_table">
					   <table id="template_list">
						  <tbody>
							 
							 <?php
							   if(!$result->isEmpty()){
								$counter = "1";
								 $tag = "1";
								foreach($result as $record){ 
								 if($record->template_for == "direct_flight"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									
									if($tag == 1){
										$tag = "2";
									?>
									<tr>
										<th style="width: 10%;">{{$templateFor}}</th>
										<th>TEMPLATE NAME</th>
										<th style="width: 18%%;text-align: center;">ACTION</th>
									 </tr> 
							 <?php 
									}
								 }else if($record->template_for == "umrah_ziarah"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									if($tag == 2){
										$tag = "3";
									?>
									<tr>
										<th style="width: 10%;">{{$templateFor}}</th>
										<th>TEMPLATE NAME</th>
										<th style="width: 18%%;text-align: center;">ACTION</th>
									 </tr> 
							 <?php 
									}
								 }else if($record->template_for == "umrah_transit"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									if($tag == 3){
										$tag = "4";
									?>
									<tr>
										<th style="width: 10%;">{{$templateFor}}</th>
										<th>TEMPLATE NAME</th>
										<th style="width: 18%%;text-align: center;">ACTION</th>
									 </tr> 
							 <?php 
									}
								 }else if($record->template_for == "holidays"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									if($tag == 4){
										$tag = "0";
									?>
									<tr>
										<th style="width: 10%;">{{$templateFor}}</th>
										<th>TEMPLATE NAME</th>
										<th style="width: 18%%;text-align: center;">ACTION</th>
									 </tr> 
							 <?php 
									}
								 }
								?>
								 
								 <tr>
									<td>{{$counter}} <span class="booking_order"></span></td>
									<td>{{ $record->name }}</td>
									<td width="18%" style="">
									   <span class="edit_temp_btn">
									   <a href="{{URL('/pdf-manager/edit-template/'.$record->id)}}"><i class="flaticon-edit-1"></i>Edit</a>
									   </span>
									   <span class="test_temp_btn">
									   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test PDF</a>
									   </span>
									</td>
								 </tr>
							 <?php
								//$tag = "0";
								$counter++;
								}
							   } ?>
							   
							<?php  /* <tr>
								<td>2 <span class="booking_paid"></span></td>
								<td>Booking Paid- Admin</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 
							 <tr>
								<td>3 <span class="booking_registration"></span></td>
								<td>Email Admin foe Sales Person Registration</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 <tr>
								<th style="width: 10%;">SALES PERSON</th>
								<th>TEMPLATE NAME</th>
								<th style="width: 18%;text-align: center;">ACTION</th>
							 </tr>
							 <tr>
								<td>1 <span class="booking_order"></span></td>
								<td>Booking Order- Sales Person</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 
							 <tr>
								<td>2 <span class="booking_paid"></span></td>
								<td>Booking Paid- Sales Person</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 
							 <tr>
								<td>3 <span class="booking_order"></span></td>
								<td>Sales Person Registration</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 <tr>
								<th style="width: 10%;">GUEST</th>
								<th>TEMPLATE NAME</th>
								<th style="width: 18%;text-align: center;">ACTION</th>
							 </tr>
							 <tr>
								<td>1 <span class="booking_order"></span></td>
								<td>Booking Order</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							 
							 <tr>
								<td>2 <span class="booking_order"></span></td>
								<td>Booking Paid</td>
								<td style="">
								   <span class="edit_temp_btn">
								   <a href="{{URL('/email-template-edit')}}"><i class="flaticon-edit-1"></i>Edit</a>
								   </span>
								   <span class="test_temp_btn">
								   <a href="javascript:void(0);" class=""><i class="flaticon-email"></i>Test Email</a>
								   </span>
								</td>
							 </tr>
							  */ ?>
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

