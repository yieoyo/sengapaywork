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
						{{ trans("messages.header.email_template") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} </span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.email_template") }} </span>
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
								{{ trans("messages.email_template.template_list") }}
							</h3>
						</div>
					</div>
					
					<div class="template_list_table">
					   <table id="template_list">
						  <tbody>
							<?php $counter = "1"; ?>
							@if(!empty($adminResult))
								<tr>
									<th style="width: 10%;">{{ trans("messages.email_template.admin") }}</th>
									<th>{{ trans("messages.email_template.template_name") }}</th>
									<th style="text-align: center;">{{ trans("messages.email_template.action") }}</th>
								 </tr> 
								@foreach($adminResult as $adminRecord)
									<tr>
										<td>{{$counter}} <span class="booking_order"></span></td>
										<td>{{ $adminRecord->name }}</td>
										<td style="text-align: right;">
										   <span class="edit_temp_btn">
										   <a href="{{URL('/email-manager/edit-template/'.$adminRecord->id)}}"><i class="flaticon-edit-1"></i>
										   {{ trans("messages.edit_book_plan.edit") }}</a>
										   </span>
										   <span class="test_temp_btn">
										   <a href="javascript:void(0);" onclick="sendTestEmail({{$adminRecord->id}})" class=""><i class="flaticon-email"></i>{{ trans("messages.email_template.test_email") }}</a>
										   </span>
										</td>
									</tr>
									<?php $counter++; ?>
								@endforeach
							@endif
							@if(!empty($salesResult))
								<tr>
									<th style="width: 10%;">{{ trans('messages.sub_project_lists.vendor') }}</th>
									<th>TEMPLATE NAME</th>
									<th style="text-align: center;">{{ trans("messages.email_template.action") }}	</th>
								 </tr> 
								@foreach($salesResult as $salesRecord)
									<tr>
										<td>{{$counter}} <span class="booking_order"></span></td>
										<td>{{ $salesRecord->name }}</td>
										<td style="text-align: right;">
										   <span class="edit_temp_btn">
										   <a href="{{URL('/email-manager/edit-template/'.$salesRecord->id)}}"><i class="flaticon-edit-1"></i>
										   {{ trans("messages.edit_book_plan.edit") }}</a>
										   </span>
										   <span class="test_temp_btn">
										   <a href="javascript:void(0);" onclick="sendTestEmail({{$salesRecord->id}})" class=""><i class="flaticon-email"></i>{{ trans("messages.email_template.test_email") }}</a>
										   </span>
										</td>
									</tr>
									<?php $counter++; ?>
								@endforeach
							@endif
							@if(!empty($guestResult))
								<tr>
									<th style="width: 10%;">{{ trans("messages.email_template.donor") }}</th>
									<th>{{ trans("messages.email_template.template_name") }}</th>
									<th style="text-align: center;">{{ trans("messages.email_template.action") }}</th>
								 </tr> 
								@foreach($guestResult as $guestRecord)
									<tr>
										<td>{{$counter}} <span class="booking_order"></span></td>
										<td>{{ $guestRecord->name }}</td>
										<td style="text-align: right;">
										   <span class="edit_temp_btn">
										   <a href="{{URL('/email-manager/edit-template/'.$guestRecord->id)}}"><i class="flaticon-edit-1"></i>
										   {{ trans("messages.edit_book_plan.edit") }}</a>
										   </span>
										   <span class="test_temp_btn">
										   <a href="javascript:void(0);" onclick="sendTestEmail({{$guestRecord->id}})" class=""><i class="flaticon-email"></i>{{ trans("messages.email_template.test_email") }}</a>
										   </span>
										</td>
									</tr>
									<?php $counter++; ?>
								@endforeach
							@endif
							@if(!empty($result))
								<tr>
									<th style="width: 10%;">{{ trans("messages.email_template.other") }}</th>
									<th>{{ trans("messages.email_template.template_name") }}</th>
									<th style="text-align: center;">{{ trans("messages.email_template.action") }}</th>
								 </tr> 
								@foreach($result as $Record)
									<tr>
										<td>{{$counter}} <span class="booking_order"></span></td>
										<td>{{ $Record->name }}</td>
										<td style="text-align: right;">
										   <span class="edit_temp_btn">
										   <a href="{{URL('/email-manager/edit-template/'.$Record->id)}}"><i class="flaticon-edit-1"></i>
										   {{ trans("messages.edit_book_plan.edit") }}</a>
										   </span>
										   <span class="test_temp_btn">
										   <a href="javascript:void(0);" onclick="sendTestEmail({{$Record->id}})" class=""><i class="flaticon-email"></i>
										   {{ trans("messages.email_template.test_email") }}</a>
										   </span>
										</td>
									</tr>
									<?php $counter++; ?>
								@endforeach
							@endif
							
							 <?php
							   /* if(!$result->isEmpty()){
								$counter = "1";
								 $tag = "1";
								foreach($result as $record){ 
								 if($record->template_for == "admin"){
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
								 }else if($record->template_for == "sales_person"){
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
								 }else if($record->template_for == "guest"){
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
								 }else if($record->template_for == "branch"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									if($tag == 4){
										$tag = "5";
									?>
									<tr>
										<th style="width: 10%;">{{$templateFor}}</th>
										<th>TEMPLATE NAME</th>
										<th style="width: 18%%;text-align: center;">ACTION</th>
									 </tr> 
							 <?php 
									}
								 }else if($record->template_for == "other"){
									 $templateFor = ucwords(str_replace("_"," ",$record->template_for));
									if($tag == 5){
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
									   <a href="{{URL('/email-manager/edit-template/'.$record->id)}}"><i class="flaticon-edit-1"></i>Edit</a>
									   </span>
									   <span class="test_temp_btn">
									   <a href="javascript:void(0);" onclick="sendTestEmail({{$record->id}})" class=""><i class="flaticon-email"></i>Test Email</a>
									   </span>
									</td>
								 </tr>
							 <?php
								//$tag = "0";
								$counter++;
								}
							   } */ ?>
							   
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

<script>
function sendTestEmail(TemplateId){
	$('#loader_img').show();
	var KeyVal = 1;
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ URL("/send-test-email-template") }}',
		type:'POST',
		data: {'TemplateId':TemplateId},
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

</script>


@stop
