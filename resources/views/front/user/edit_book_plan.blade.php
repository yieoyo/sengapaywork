@extends('front.layouts.default')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<script>
$(function(){
	$('.date_of_birth').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD HH:mm',
		changeMonth: true,
		changeYear : true,
		weekStart : 0,
		time: true,
		nowButton : true,
		switchOnClick : true,
		yearRange: '-100:+100',
		maxDate : new Date()  
		//minDate : new Date()  
	});
});
</script>

<style>
.display_hide_cls {
	display:none;
}
</style>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{$subProjectDetails->sub_project_name}}</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="#" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.edit_book_plan.infaq") }} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="{{ route('user.sub_project_lists',$subProjectDetails->slug) }}" class="kt-subheader__breadcrumbs-link">
								{{$subProjectDetails->sub_project_name}}</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<span class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.edit_book_plan.edit") }} </span>
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
										{{ trans("messages.book_plan.your_plan") }}
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										{{ trans("messages.book_plan.choose_your_plan") }}
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
										{{ trans("messages.book_plan.your_profile") }}
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										{{ trans("messages.book_plan.add_your_personal_info") }}
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
										{{ trans("messages.book_plan.payment_details") }}
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										{{ trans("messages.book_plan.choose_your_payment_options") }}
									</div>
								</div>
							</div>
						</div>
						<div class="kt-wizard-v4__nav-item final_view_step" data-ktwizard-type="step">
							<div class="kt-wizard-v4__nav-body">
								<div class="kt-wizard-v4__nav-number">
									4
								</div>
								<div class="kt-wizard-v4__nav-label">
									<div class="kt-wizard-v4__nav-label-title">
										{{ trans("messages.book_plan.completed") }}
									</div>
									<div class="kt-wizard-v4__nav-label-desc">
										{{ trans("messages.book_plan.review_and_submit") }}
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
								{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"book_plan_form"]) }}
									<input type="hidden" name="sub_project_id" class="get_project_id" value="{{$subProjectDetails->id}}">
									<input type="hidden" name="donation_order_id" class="get_donation_id" value="{{$donationOrderDetails->id}}">
	
									<!--begin: Form Wizard Step 1-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
									 @if($subProjectDetails->project_module	==	1)
										<div class="kt-heading kt-heading--md">Enter your Favourite Plan</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												<div class="form-group form-group-marginless">
													<label>{{ trans("messages.sub_project_detail.choose_commitment_type")}}:</label>
													<div class="row">
													  @if($subProjectDetails->daily_status != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','daily',($donationOrderDetails->plan_type == "daily") ? 1 :'', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.daily")}}
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		{{$subProjectDetails->daily_description}}
																	</span>
																</span>
															</label>
														</div>
													  @endif
													  @if($subProjectDetails->monthly_status != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','monthly',($donationOrderDetails->plan_type == "monthly") ? 1 :'', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.monthly")}}
																		</span>
																	</span>
																	<span class="kt-option__body">
																		{{$subProjectDetails->monthly_description}}
																	</span>
																</span>
															</label>
														</div>
													  @endif
													  @if($subProjectDetails->yearly_status != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','yearly',($donationOrderDetails->plan_type == "yearly") ? 1 :'', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.yearly")}}
																		</span>
																	</span>
																	<span class="kt-option__body">
																		{{$subProjectDetails->yearly_description}}
																	</span>
																</span>
															</label>
														</div>
													  @endif
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="dynamic_plan_option_block">
												<div class="form-group">
													<label>{{ trans("messages.sub_project_detail.choose_plan") }}</label>
													@if(!empty($dailyPlanDetails))
													<div class="kt-portlet__tab_block_options">
													  <?php $activePlanPrice = ""; ?>
													  @foreach($dailyPlanDetails as $key=>$dailyPlanDetail)
														<?php
															if($donationOrderDetails->plan_price == $dailyPlanDetail->id){
																$activePlanPrice = Currency." ".$dailyPlanDetail->price;
																$activeClass	=	"1";
															}else{
																$activeClass	=	"";
															}
														?>
														<div class="kt-portlet__tab_block_options_item">
															{{ Form::radio('plan_price',$dailyPlanDetail->id,$activeClass,['class'=>'plan_price', 'id'=>'tab_'.$key]) }}
															<label for="tab_{{$key}}">{{Currency." ".$dailyPlanDetail->price}}</label>
														</div>
													  @endforeach
													  @if($subProjectDetails->daily_plan_allow_other == 1)
														<div class="kt-portlet__tab_block_options_item">
															<?php
																if(!empty($donationOrderDetails->other_plan_price)){
																	$allowOtherPlanPrice = "1";
																	$display_hide_cls_plan = "";
																}else{
																	$allowOtherPlanPrice = "";
																	$display_hide_cls_plan = "display_hide_cls";
																}
															?>
															{{ Form::radio('plan_price','other',$allowOtherPlanPrice,['class'=>'plan_price', 'id'=>'allow_other']) }}
															<label for="allow_other">{{ trans("messages.sub_project_detail.others")}}</label>
														</div>
													  @endif
													</div>  
													<div class="col-6 form-group customized_plan_cls {{$display_hide_cls_plan}}">
														<label></label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
															{{ Form::text('other_plan_price', $donationOrderDetails->other_plan_price, ['class'=>'form-control customized_plan alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_customized_plan")]) }}
															<span class="help-inline"></span>
														</div>
													</div>
													<span class="form-text text-muted">*{{$activePlanPrice}}{{ trans("messages.edit_book_plan.will_deduct_from_your_account_on_daily_basis") }}</span>
													@else
													  <span class="form-text text-muted">{{ trans("messages.sub_project_detail.no_plan_found_on_daily_basis") }}</span>
													@endif
													
												</div>
												
												<div class="form-group"></div>
												
												<div class="form-group">
													<label>{{ trans("messages.sub_project_detail.choose_period") }}</label>
													@if(!empty($dailyPeriodDetails))
													<div class="kt-radio-inline">
													  @foreach($dailyPeriodDetails as $key=>$dailyPeriodDetail)
														<?php
															if($donationOrderDetails->time_period == $dailyPeriodDetail->id){
																$activePeriod	=	"1";
															}else{
																$activePeriod	=	"";
															}
														?>
														
														<label class="kt-radio" for="time_period_{{$key}}">
															{{ Form::radio('time_period',$dailyPeriodDetail->id,$activePeriod,['class'=>'time_period', 'id'=>'time_period_'.$key]) }} {{trans($dailyPeriodDetail->quantity.' Days')}}
															<span></span>
														</label>
													  @endforeach
													  @if($subProjectDetails->daily_period_allow_other == 1)
														<label class="kt-radio"for="time_period_other">
															<?php
																if(!empty($donationOrderDetails->other_time_period)){
																	$allowOtherPlanPeriod = "1";
																	$display_hide_cls_period = "";
																}else{
																	$allowOtherPlanPeriod = "";
																	$display_hide_cls_period = "display_hide_cls";
																}
															?>
															{{ Form::radio('time_period','other',$allowOtherPlanPeriod,['class'=>'time_period', 'id'=>'time_period_other']) }} {{ trans("messages.sub_project_detail.others")}}
															<span></span>
														</label>
													  @endif
													</div>
													<div class="col-6 form-group customized_period_cls {{$display_hide_cls_period}}">
														<label></label>
														<div class="input-group">
															{{ Form::text('other_time_period', $donationOrderDetails->other_time_period, ['class'=>'form-control customized_time alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.book_plan.enter_customized_period")]) }}
															<span class="help-inline"></span>
														</div>
													</div>
													@else
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.no_period_found_on_daily_basis") }}</span>
													@endif
												</div>
												</div>
											</div>
										</div>
									
									 @elseif($subProjectDetails->project_module	==	2)
										@if($subProjectDetails->customize_plan_option == 1)
											<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
											<div class="kt-wizard-v4__form">
												<div class="form-group">
													<label>{{ trans("messages.sub_project_detail.choose_project") }}:</label>
													<div class="row">
													@if(!empty($projectPlans))
													  @foreach($projectPlans as $key=>$projectPlan)
														@if($donationOrderDetails->default_project_plan == $projectPlan->id)
															<?php $checkedPlan	=	"1"; ?>
														@else
															<?php $checkedPlan	=	""; ?>
														@endif
														<div class="col-lg-4">
															<label class="kt-option" for="project_plans_key_{{$key}}">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('default_project_plan', $projectPlan->id,$checkedPlan ,['class'=>'default_project_plan', 'id'=>'project_plans_key_'.$key]) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title project_plans_key_{{$key}}">
																			{{$projectPlan->title}}
																		</span>

																	</span>
																	<span class="kt-option__body">
																		{{$projectPlan->description}}
																	</span>
																</span>
															</label>
														</div>
													  @endforeach
													@endif
													
													</div>
												</div>
												<div class="form-group">
													<label>{{ trans('messages.dashboard.total_contribution') }} :</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm") }}</span></div>
														{{ Form::number('total_contribution', !empty($donationOrderDetails->total_contribution)?$donationOrderDetails->total_contribution:'', ['class'=>'form-control','autocomplete'=>'off','min'=>'1']) }}
													</div>
												</div>
											</div>
											
										@elseif($subProjectDetails->customize_plan_option == 2)
											@if(!empty($seatReservationPlans))
												<div class="kt-heading kt-heading--md">{{$subProjectDetails->seat_reservation_main_title}}</div>
												 <div class="kt-form__section kt-form__section--first">
												  <div class="kt-wizard-v4_form">
													@foreach($seatReservationPlans as $key=>$seatReservationPlan)
													  <div class="kt-heading kt-heading--md seat_reservation_title_blk" rel="{{$key}}">{{$seatReservationPlan->description}}</div>
													  @if(!empty($seatReservationPlan->ReservationSeats))
													   @foreach($seatReservationPlan->ReservationSeats as $seatDetails)
														{{ Form::hidden('SeatReservation['.$seatDetails->id.'][id]', $seatDetails->booked_seat_id, ['class'=>'']) }}
														{{ Form::hidden('SeatReservation['.$seatDetails->id.'][seat_subtitle_id]', $seatReservationPlan->id, ['class'=>'']) }}
														<div class="form-group row">
															<label class="col-form-label col-lg-4 col-sm-12"><span class="seat_reservation_name_price_{{$key}}" rel="{{$seatDetails->id}}" data-price="{{$seatDetails->seat_price}}">{{$seatDetails->seat_name}} ({{Currency}}{{$seatDetails->seat_price}})</span><br/> {{$seatDetails->seat_description}}</label>
															<div class="col-lg-4 col-sm-12">
																<div class="input-group flex-nowrap mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
																	</div>
																	<select name="SeatReservation[{{$seatDetails->id}}][total_seat]" class="form-control setSelection">
																	  <option value="">Bil Belian {{$seatDetails->seat_name}}</option>
																	  <?php for($seatNumber = 1; $seatNumber < $seatDetails->seat_max_unit; $seatNumber++){ ?>
																		@if(!empty($seatDetails->total_booked_seat) && ($seatDetails->total_booked_seat == $seatNumber))
																			<option selected value="{{$seatNumber}}">{{$seatNumber}}</option>
																		@else
																			<option value="{{$seatNumber}}">{{$seatNumber}}</option>
																		@endif
																	  <?php } ?>
																	</select>
																</div>
															</div>
															<div class="col-lg-4 col-sm-12">
																<div class="input-group flex-nowrap mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
																	</div>
																	<select name="SeatReservation[{{$seatDetails->id}}][total_attendance]" class="form-control totalAttendance">
																	  <option value="">{{ trans("messages.sub_project_detail.bill_present") }}</option>
																	  <?php for($bookedSeatNumber = 1; $bookedSeatNumber <= $seatDetails->total_booked_seat; $bookedSeatNumber++){ ?>
																		@if(!empty($seatDetails->total_attendance) && ($seatDetails->total_attendance == $bookedSeatNumber))
																			<option selected value="{{$bookedSeatNumber}}">{{$bookedSeatNumber}}</option>
																		@else
																			<option value="{{$bookedSeatNumber}}">{{$bookedSeatNumber}}</option>
																		@endif
																	  <?php } ?>
																	</select>
																</div>
															</div>
															
														</div>
													   @endforeach
													  @endif
														<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
													@endforeach
												 
													@if($subProjectDetails->seat_reservation_menual_contribution == 1)
														<div class="kt-heading kt-heading--md">{{$subProjectDetails->seat_reservation_main_title_2}}</div>
														<div class="form-group"></div>
														<div class="form-group">
															<label>{{ trans('messages.dashboard.total_contributions') }}:</label>
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
																{{ Form::text('total_contribution', ($donationOrderDetails->seat_reservation_plan_price_2 > 0)?$donationOrderDetails->seat_reservation_plan_price_2:$donationOrderDetails->total_contribution, ['class'=>'form-control total_contribution_amt','autocomplete'=>'off', 'placeholder'=>'']) }}
																<span class="help-inline"></span>
															</div>
														</div>
													@endif
													
												 </div>
												</div>
											  @endif
											
											<?php /* @if(!empty($seatReservationPlans))
												<div class="kt-heading kt-heading--md">{{$subProjectDetails->seat_reservation_main_title}}</div>
												<div class="kt-form__section kt-form__section--first">
												  <div class="kt-wizard-v4__form">
													@foreach($seatReservationPlans as $seatReservationPlan)
													  <div class="kt-heading kt-heading--md">{{$seatReservationPlan->description}}</div>
													  @if(!empty($seatReservationPlan->ReservationSeats))
													   @foreach($seatReservationPlan->ReservationSeats as $seatDetails)
														{{ Form::hidden('SeatReservation['.$seatDetails->id.'][id]', $seatDetails->booked_seat_id, ['class'=>'']) }}
														{{ Form::hidden('SeatReservation['.$seatDetails->id.'][seat_subtitle_id]', $seatReservationPlan->id, ['class'=>'']) }}
														<div class="form-group row">
															<label class="col-form-label col-lg-4 col-sm-12">{{$seatDetails->seat_name}} ({{Currency}}{{$seatDetails->seat_price}})<br/> {{$seatDetails->seat_description}}</label>
															<div class="col-lg-4 col-sm-12">
																<div class="input-group flex-nowrap mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text" id="basic-addon1"><i class="la la-user"></i></span>
																	</div>
																	<select name="SeatReservation[{{$seatDetails->id}}][total_seat]" class="form-control">
																	  <option value="">{{ trans("messages.sub_project_detail.bill_present") }}</option>
																	  @for($seatNumber = 1; $seatNumber < $seatDetails->seat_max_unit; $seatNumber++)
																		@if($seatDetails->total_booked_seat == $seatNumber)
																			<option selected value="{{$seatNumber}}">{{$seatNumber}}</option>
																		@else
																			<option value="{{$seatNumber}}">{{$seatNumber}}</option>
																		@endif
																	  @endfor
																	</select>
																</div>
															</div>
														</div>
													   @endforeach
													  @endif
														
														<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
														
													@endforeach
												 
													@if($subProjectDetails->seat_reservation_menual_contribution == 1)
														<div class="kt-heading kt-heading--md">{{$subProjectDetails->seat_reservation_main_title_2}}</div>
														<div class="form-group"></div>
														<div class="form-group">
															<label>{{ trans('messages.dashboard.total_contributions') }}:</label>
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
																{{ Form::text('total_contribution', !empty($donationOrderDetails->total_contribution)?$donationOrderDetails->total_contribution:0, ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
																<span class="help-inline"></span>
															</div>
														</div>
													@endif
													
												 </div>
												</div>
											 @endif */ ?>
											 
										@elseif($subProjectDetails->customize_plan_option == 3)
											@if(!empty($quantityPlans))
											 <div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
											 <div class="kt-form__section kt-form__section--first">
												<div class="kt-wizard-v4__form">
													<div class="form-group">
														<div class="row">
															@foreach($quantityPlans as $key=>$quantityPlan)
																@if($donationOrderDetails->quantity_project_plan == $quantityPlan->id)
																	<?php $checkedQuantityPlan = 1; ?>
																@else
																	<?php $checkedQuantityPlan = ""; ?>
																@endif
																<div class="col-lg-6">
																	<label class="kt-option">
																		<span class="kt-option__control">
																			<span class="kt-radio">
																				{{ Form::radio('quantity_project_plan', $quantityPlan->id,$checkedQuantityPlan, ['class'=>'quantity_project_plan', 'id'=>'quantity_plans_key_'.$key, 'data-quantity-plan-price'=>$quantityPlan->price]) }}
																				<span></span>
																			</span>
																		</span>
																		<span class="kt-option__label">
																			<span class="kt-option__head">
																				<span class="kt-option__title quantity_plans_key_{{$key}}">
																					{{$quantityPlan->plan_title}}
																				</span>
																				<span class="kt-option__focus">
																					{{Currency}}{{$quantityPlan->price}}/Unit
																				</span>
																			</span>
																			<span class="kt-option__body">
																				{{$quantityPlan->plan_description}}
																			</span>
																		</span>
																	</label>
																</div>
															@endforeach
																
														</div>
													</div>
													<div class="form-group">
														<label>{{ trans("messages.sub_project_detail.quantity") }}:</label>
														{{ Form::number('quantity', $donationOrderDetails->quantity, ['class'=>'form-control plan_quantity alphabetRestriction','autocomplete'=>'off', 'placeholder'=>'', 'min'=>1]) }}
													</div>
													<div class="form-group">
														<label>{{ trans('messages.dashboard.total_contributions') }} :</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
															{{ Form::text('total_contribution', $donationOrderDetails->total_contribution, ['class'=>'form-control total_contribution', 'autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1','readonly'=>true]) }}
														</div>
													</div>

												</div>
											 </div>
											@endif
											
										@elseif($subProjectDetails->customize_plan_option == 4)
											@if(!empty($sectionPlans))
												<?php $counter = 0; ?>
												<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}  </div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v4__form get_dynamic_participate_block">

													@if(!empty($participateArray))
													  @foreach($participateArray as $participateRecord)
														{{ Form::hidden('Section['.$counter.'][id]', !empty($participateRecord->id)?$participateRecord->id:'', ['class'=>'']) }}
														<section class="form-group row delete_more_section_item_{{$counter}}" rel="{{$counter}}">
															<div data-repeater-list="" class="col-lg-12">
																<div data-repeater-item="" class="form-group row align-items-center">
																	<div class="col-md-5">
																		<div class="kt-form__group--inline">
																			<div class="kt-form__label">
																				<label>{{ trans("messages.sub_project_detail.participant_name") }}:</label>
																			</div>
																			<div class="kt-form__control">
																				{{ Form::text('Section['.$counter.'][name]', !empty($participateRecord->name)?$participateRecord->name:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_participant_name"), 'aria-describedby'=>'emailHelp']) }}
																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	<div class="col-md-5">
																		<div class="kt-form__group--inline">
																			<div class="kt-form__label">
																				<label class="kt-label m-label--single">{{ trans("messages.sub_project_detail.parts_tails") }}:</label>
																			</div>
																			<div class="kt-form__control">
																				<select name="Section[{{$counter}}][section_plan]" class="form-control" id="exampleSelect1">
																					<option>{{ trans("messages.sub_project_detail.select_section") }}  </option>
																				  @foreach($sectionPlans as $sectionPlan)
																					@if(!empty($participateRecord->section_plan))
																						@if($participateRecord->section_plan == $sectionPlan->id)
																							<?php $selectedSectionPlan = "selected"; ?>
																						@else
																							<?php $selectedSectionPlan = ""; ?>
																						@endif
																					@else
																						<?php $selectedSectionPlan = ""; ?>
																					@endif
																					<option value="{{$sectionPlan->id}}" {{$selectedSectionPlan}} >{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
																				  @endforeach
																				</select>

																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	@if($counter != 0)
																		<div class="col-md-2">
																			<button type="button" onclick="deleteMoreSectionItem({{$counter}})" class="btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
																		</div>
																	@endif
																</div>

															</div>
														</section>
													  <?php $counter++; ?>
													  @endforeach
													@else
														<section class="form-group row delete_more_section_item_{{$counter}}" rel="{{$counter}}">
															<div data-repeater-list="" class="col-lg-12">
																<div data-repeater-item="" class="form-group row align-items-center">
																	<div class="col-md-5">
																		<div class="kt-form__group--inline">
																			<div class="kt-form__label">
																				<label>{{ trans("messages.sub_project_detail.participant_name") }}:</label>
																			</div>
																			<div class="kt-form__control">
																				{{ Form::text('Section['.$counter.'][name]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_participant_name"), 'aria-describedby'=>'emailHelp']) }}
																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	<div class="col-md-5">
																		<div class="kt-form__group--inline">
																			<div class="kt-form__label">
																				<label class="kt-label m-label--single">{{ trans("messages.sub_project_detail.parts_tails") }}:</label>
																			</div>
																			<div class="kt-form__control">
																				<select name="Section[{{$counter}}][section_plan]" class="form-control" id="exampleSelect1">
																					<option>{{ trans("messages.sub_project_detail.select_section") }} </option>
																				  @foreach($sectionPlans as $sectionPlan)
																					<option value="{{$sectionPlan->id}}">{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
																				  @endforeach
																				</select>

																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	@if($counter != 0)
																		<div class="col-md-2">
																			<button type="button" onclick="deleteMoreSectionItem({{$counter}})" class="btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
																		</div>
																	@endif
																</div>

															</div>
														</section>
													@endif
													
													</div>
													@if($subProjectDetails->is_multiple_participate == 1)
														<div class="form-group row">
															<div class="col-lg-4">
																<button type="button" onclick="addMoreSectionParticipate()" class="btn btn-bold btn-sm btn-label-brand"><span class="flaticon2-plus">&nbsp;&nbsp;</span> {{ trans('messages.sub_project_detail.add_participant') }}</button>
															</div>
														</div>
													@endif
												</div>
												
											@endif
										@endif
											
									 @elseif($subProjectDetails->project_module	==	3)
										@if($subProjectDetails->customize_plan_option  == 5)
										  @if(!empty($danaDefaultPlans))
											<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}  </div>
											<div class="kt-form__section kt-form__section--first">
												<div class="kt-wizard-v4__form">
													<div class="form-group">
														<div class="row">
														  @foreach($danaDefaultPlans as $key=>$danaDefaultPlan)
															@if($danaDefaultPlan->id == $donationOrderDetails->dana_default_project_plan)
																<?php $checkedPlan	=	"1"; ?>
															@else
																<?php $checkedPlan	=	""; ?>
															@endif
															<div class="col-lg-6">
																<label class="kt-option">
																	<span class="kt-option__control">
																		<span class="kt-radio">
																			{{ Form::radio('dana_default_project_plan', $danaDefaultPlan->id,$checkedPlan, ['class'=>'dana_default_project_plan', 'id'=>'dana_project_plans_key_'.$key]) }}
																			<span></span>
																		</span>
																	</span>
																	<span class="kt-option__label">
																		<span class="kt-option__head">
																			<span class="kt-option__title dana_project_plans_key_{{$key}}">
																				{{$danaDefaultPlan->title}} 
																			</span>
																			<span class="kt-option__focus">
																				{{Currency}}{{$danaDefaultPlan->amount}} 
																			</span>
																		</span>
																		
																	</span>
																</label>
															</div>
														  @endforeach
														</div>
													</div>
												</div>
											</div>
										  @endif 
										  
										@elseif($subProjectDetails->customize_plan_option  == 6)
										  @if(!empty($danaProperyPlans))
											<div class="kt-heading kt-heading--md"> {{ trans("messages.sub_project_detail.select_your_will_detail") }} </div>
											<p> <span class="kt-option__title"> {{ trans("messages.sub_project_detail.property_sale") }} </span> </p>
											<div class="row">
											  @foreach($danaProperyPlans as $key=>$danaProperyPlan)
												@if($danaProperyPlan->id == $donationOrderDetails->dana_property_plan)
													<?php $checkedPlan	=	"1"; ?>
												@else
													<?php $checkedPlan	=	""; ?>
												@endif
												
												<div class="col-lg-4">
													<label class="kt-option">
														<span class="kt-option__control">
															<span class="kt-radio">
																{{ Form::radio('dana_property_plan', $danaProperyPlan->id,$checkedPlan, ['class'=>'dana_property_plan', 'id'=>'dana_property_plans_key_'.$key]) }}
																<span></span>
															</span>
														</span>
														<span class="kt-option__label">
															<span class="kt-option__head">
																<span class="kt-option__title dana_property_plans_key_{{$key}}">
																	{{$danaProperyPlan->title}}
																</span>
															</span>
															<span class="kt-option__body">
																{{$danaProperyPlan->description}}
															</span>
														</span>
													</label>
												</div>
											  @endforeach
											  
											  <?php /* @if(!empty($danaProperyPriceRanges))
												<div class="col-lg-4">
													<p style="padding: 20px 0 0;"> <span class="kt-option__title"> Estimated Price Range </span> </p>
													@foreach($danaProperyPriceRanges as $danaProperyPriceRange)
														<label class="">
															<span class="kt-option__control">
																<span class="kt-radio">
																	<input type="radio" name="m_option_2" value="1" checked="">
																	<span></span>
																</span>
															</span>
															<span class="kt-option__label">
																<span class="kt-option__head">
																	<span class="kt-option__title">
																		{{Currency}}{{$danaProperyPriceRange->min_price}} - {{Currency}}{{$danaProperyPriceRange->max_price}}
																	</span>
																</span>
															</span>
														</label>
													@endforeach
												</div>
											  @endif */ ?>
											  
											</div>

											<div class="form-group">
												<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans("messages.sub_project_detail.estimated_price") }} :</label></p>
												<div class="col-12">
												  <div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
													{{ Form::text('total_contribution', !empty($donationOrderDetails->total_contribution)?$donationOrderDetails->total_contribution:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
												  </div>
												</div>
											</div>

											<div class="form-group ">
												<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans("messages.sub_project_detail.additional_information") }}</label></p>
												<div class="col-12">
													{{ Form::textarea('extra_note', !empty($donationOrderDetails->extra_note)?$donationOrderDetails->extra_note:'', ['class'=>'form-control']) }}
												</div>
											</div>
											
										  @endif
											
										@elseif($subProjectDetails->customize_plan_option  == 7)
										  @if(!empty($vendorLists))
											<div class="kt-heading kt-heading--md"> {{ trans("messages.sub_project_detail.select_your_vendor") }} </div>
											<div class="row">
											  @foreach($vendorLists as $key=>$vendorList)
												@if($vendorList->id == $donationOrderDetails->dana_vendor)
													<?php $checkedPlan	=	"1"; ?>
												@else
													<?php $checkedPlan	=	""; ?>
												@endif
												
												<div class="col-lg-4">
													<label class="kt-option">
														<span class="kt-option__control">
															<span class="kt-radio">
															   {{ Form::radio('dana_vendor', $vendorList->id,$checkedPlan, ['class'=>'dana_vendor', 'id'=>'dana_vendor_key_'.$key]) }}
																<span></span>
															</span>
														</span>
														<span class="kt-option__label">
															<span class="kt-option__head">
																<span class="kt-option__title dana_vendor_key_{{$key}}">
																	{{$vendorList->full_name}}
																</span>
															</span>
															<span class="kt-option__body">
																Lorem ipsum dolor sit amet, consectetur adipisicing elit
															</span>
														</span>
													</label>
												</div>
											  @endforeach
											</div>
											
											<div class="form-group">
												<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans('messages.dashboard.total_contributions') }} :</label></p>
												<div class="col-12">
												  <div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
													{{ Form::text('total_contribution', !empty($donationOrderDetails->total_contribution)?$donationOrderDetails->total_contribution:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
												  </div>
												</div>
											</div>

										  @endif
											
										@endif
											
									 @endif
									</div> 

									<!--end: Form Wizard Step 1-->

									<!--begin: Form Wizard Step 2-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_personal_detail")}}</div>
										@if($subProjectDetails->contributor_type == "personal")
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.full_name")}}*:</label>
														{{ Form::text('full_name', $donationOrderDetails->full_name, ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.ic_number_optional")}}:</label>
														{{ Form::text('ic_number', $donationOrderDetails->ic_number, ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('phone', $donationOrderDetails->phone, ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_phone_number")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans('messages.cms_page_details.email') }}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', $donationOrderDetails->email, ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
												
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.address_optional")}}</label>
															{{ Form::text('address', $donationOrderDetails->address, ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													
													<div class="form-group"></div>
													
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
															{{ Form::text('postcode', $donationOrderDetails->postcode, ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_postcode")}}</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										@else
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.pic_full_name")}}*:</label>
														{{ Form::hidden('profile_type', '1', ['class'=>'form-control','autocomplete'=>'off']) }}
														{{ Form::text('full_name', $donationOrderDetails->full_name, ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.pic_ic_number_optional")}}:</label>
														{{ Form::text('ic_number', $donationOrderDetails->ic_number, ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('phone', $donationOrderDetails->phone, ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_phone_number")}}</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
											</div>
										</div>
										
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_company_detail")}}</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-12 form-group">
														<label>{{ trans("messages.sub_project_detail.company_name")}}*:</label>
														{{ Form::text('company_name', $donationOrderDetails->company_name, ['class'=>'form-control company_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_company_name")}}</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.work_email")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', $donationOrderDetails->email, ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.company_registration_number_optional")}}:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('registration_number', $donationOrderDetails->registration_number, ['class'=>'form-control registration_number', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
												
													<div class="col-xl-12">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.company_address_optional")}}</label>
															{{ Form::text('address', $donationOrderDetails->address, ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													
													<div class="form-group"></div>
													
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
															{{ Form::text('postcode', $donationOrderDetails->postcode, ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_postcode")}}</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										@endif
									</div>

									<!--end: Form Wizard Step 2-->

									<!--begin: Form Wizard Step 3-->
									
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.select_payment_details")}}</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
											
												<div class="form-group form-group-marginless">
												  <label>{{ trans("messages.sub_project_detail.choose_payment_option")}}:</label>
												  <div class="row">
													@if(!empty($paymentMethods))
													  @foreach($paymentMethods as $key=>$paymentMethod)
														@if($paymentMethod->id == $donationOrderDetails->payment_method)
															<?php $selected = "1"; ?>
														@else
															<?php $selected = ""; ?>
														@endif
														<div class="col-sm-6">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('payment_method',$paymentMethod->id,$selected,['class'=>'payment_method_change', 'id'=>'payment_methd_'.$key]) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title" id="payment_methd_name_{{$paymentMethod->id}}">
																			{{ !empty($paymentMethod->name)?$paymentMethod->name:''; }} <!--(Recurring)-->
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		Lorem Ipsum is simply dummy text of the printing and typesetting industry
																	</span>
																</span>
															</label>
														</div>
													  @endforeach
													@endif
													<div class="col-xl-6 refrence_id_block">
														<div class="form-group">
															<label>{{ trans("messages.book_plan.reference_id")}}:</label>
															{{ Form::text('refrence_id', $donationOrderDetails->refrence_id, ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													<div class="col-xl-6 refrence_id_block">
														<div class="form-group">
														  <label>{{ trans("messages.book_plan.upload_receipt")}}: </label>
														  <div class="custom-file">
															{{ Form::file('receipt', ['class'=>'custom-file-input', 'accept'=>'application/pdf,image/*', 'id'=>'customFile']) }}
															<label class="custom-file-label lbl_left_cls" for="customFile">{{ trans("messages.edit_book_plan.upload_receipt_image_pdf") }}</label>
														  </div>
														  <span class="form-text help-inline"></span>
														</div>
													</div>
													
												  </div>
												</div>
												
												<div class="form-group"></div>
												
											</div>
										</div>
									</div>

									<!--end: Form Wizard Step 3-->

									<!--begin: Form Wizard Step 4-->
									
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content">
										<div class="kt-portlet__body">
											<div class="kt-section kt-section--first">
											  <div class="kt-section__body">
												<h3 class="kt-heading kt-heading--md">{{ trans("messages.edit_book_plan.donation_details") }}:</h3>
												<div id="form_errors"></div>
												<div class="">
												 
													<?php 
														$paymentNumber = 1;
														$counter = 0;
														$totalPayment = 0;
														$totalPrice	=	0;
													?>
													
													<div class="add_more_payment">
														<?php 
															$readonlyClass = "";
															$disableClass = "";
															$darkClass = "";
															$autoApprove = "";
														?>
														
														@if(!empty($donationPayments))
														  @foreach($donationPayments as $paymentRecord)
															{{ Form::hidden('Payment['.$counter.'][id]', !empty($paymentRecord->id)?$paymentRecord->id:'', ['readonly'=>true]) }}
															<?php
																if(!empty($paymentRecord->payment_option)){
																	if($paymentRecord->payment_option == 5){
																		$readonlyClass = "readonly";
																		$disableClass = "disabled";
																		$darkClass = "kt_form_input_dark";
																		$autoApprove = "Auto Approved";
																	}
																}
																if($paymentRecord->payment_status == 2 || $paymentRecord->payment_status == 5){
																	$readonlyClass = "readonly";
																	$disableClass = "disabled";
																	$darkClass = "kt_form_input_dark";
																}
															?>
															<section class="form-group row delete_add_more_payment_{{$counter}} payment_section" rel="{{$counter}}">
																<div class="col-sm-3">
																	<div class="form-group cot_form_input_holder">
																		<label class="col-form-label">{{$paymentNumber}} {{ trans("messages.edit_book_plan.payment") }} ({{ trans('messages.edit_book_plan.deposit') }}):</label>
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<span class="input-group-text">{{CURRENCY}}</span>
																			</div>
																			{{ Form::text('Payment['.$counter.'][amount]', !empty($paymentRecord->amount)?$paymentRecord->amount:'', ["class"=>"form-control valid payment_amount paid_amount ".$darkClass, $readonlyClass, 'aria-describedby'=>'basic-addon1']) }}
																		</div>
																	</div>
																</div>
																<div class="col-sm-3">
																	<label class="col-form-label">{{ trans('messages.edit_book_plan.payment_type') }}:</label>
																	{{ Form::select('Payment['.$counter.'][payment_option]', $paymentMethodList, !empty($paymentRecord->payment_option)?$paymentRecord->payment_option:'', ['class'=>'form-control '.$darkClass, 'autocomplete'=>'off', $readonlyClass, 'placeholder'=>trans('messages.edit_book_plan.payment_type')]) }}
																</div>
																<div class="col-sm-2">
																	<div class="form-group cot_form_input_holder">
																		<label class="col-form-label">{{ trans('messages.edit_book_plan.payment_date') }}:</label>
																		{{ Form::text('Payment['.$counter.'][payment_date]', !empty($paymentRecord->created_at)? date("Y-m-d H:i:s",strtotime($paymentRecord->created_at)):'', ["class"=>"form-control valid date_of_birth  ".$darkClass, $readonlyClass]) }}
																	</div>
																</div>
																<div class="col-sm-2">
																	<div class="form-group cot_form_input_holder">
																		<label class="col-form-label">{{ trans('messages.edit_book_plan.refrence_id') }}:</label>
																		{{ Form::text('Payment['.$counter.'][reference_id]', !empty($paymentRecord->reference_id)?$paymentRecord->reference_id:'', ["class"=>"form-control valid  ".$darkClass, $readonlyClass]) }}
																	</div>
																	@if(!empty($paymentRecord->receipt))
																		<div class="ref_image_holder">
																			<?php 
																				$ext = pathinfo(PAYMENT_RECEIPT_ROOT_PATH . $paymentRecord->receipt, PATHINFO_EXTENSION);
																			?>
																			@if($ext == "pdf")
																				<a target="_blank" href="{{ PAYMENT_RECEIPT_URL . $paymentRecord->receipt }}">{{ trans('messages.edit_book_plan.download_pdf') }}<i class="fa fa-download"></i></a>
																			@else
																				<a target="_blank" class="image-popup-vertical-fit" href="{{ PAYMENT_RECEIPT_URL . $paymentRecord->receipt }}" title="Payment receipt image">
																					<img src="{{ PAYMENT_RECEIPT_URL . $paymentRecord->receipt }}" width="75" height="75">
																				</a>
																			@endif
																		</div>
																	@endif
																</div>
																<div class="col-sm-2">
																	<label class="col-form-label">{{ trans('messages.edit_book_plan.confirmation') }}:</label>
																	<div class="btn-group">
																		<?php 
																			if($paymentRecord->payment_status == 1){
																				$statusClass = "btn btn-warning";
																				$statusName = "Waiting Approval";
																				$chngStatusText = "Waiting Approval by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}else if($paymentRecord->payment_status == 2){
																				$statusClass = "btn btn-success";
																				$statusName = "Approved";
																				$chngStatusText = "Approved by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}else if($paymentRecord->payment_status == 3){
																				$statusClass = "btn btn-success";
																				$statusName = "Pending";
																				$chngStatusText = "Pending by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}else if($paymentRecord->payment_status == 4){
																				$statusClass = "btn btn-danger";
																				$statusName = "Cancelled";
																				$chngStatusText = "Cancelled by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}else if($paymentRecord->payment_status == 5){
																				$statusClass = "btn btn-primary";
																				$statusName = "Refund";
																				$chngStatusText = "Refund by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}else if($paymentRecord->payment_status == 6){
																				$statusClass = "btn btn-warning";
																				$statusName = "Enquiry";
																				$chngStatusText = "";
																			}else{
																				$statusClass = "btn btn-danger";
																				$statusName = "Not Paid";
																				$chngStatusText = "Not Paid by ".$paymentRecord->status_change_by." at ".date("h:i A d/m/Y",strtotime($paymentRecord->payment_status_date));
																			}
																			if(empty($paymentRecord->payment_status_date) || ($paymentRecord->payment_status_date == "0000-00-00 00:00:00")){
																				$chngStatusText = "";
																			}
																			if(empty($autoApprove)){
																				$autoApprove = $chngStatusText;
																			}
																			
																		?>
																		{{ Form::hidden('Payment['.$counter.'][payment_status]', !empty($paymentRecord->payment_status)?$paymentRecord->payment_status:0, ['class'=>'payment_status', 'id'=>'paymentStatus_'.$counter, $readonlyClass]) }}
																		<button type="button" class="status_btn_cls_name_{{$counter}} {{$statusClass}}">{{$statusName}}</button>
																		<button type="button" class="status_btn_cls_{{$counter}} {{$statusClass}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" {{$readonlyClass}} >
																			<span class="sr-only">{{ trans('messages.booking_template_edit.toggle_dropdown') }}</span>
																		</button>
																		<div class="dropdown-menu">
																			@if($paymentRecord->payment_status != 2)
																				<a class="dropdown-item chnage_status" data-status-id="6" data-payment-id="{{$counter}}" data-statusClass="btn btn-warning" type="button">
																					{{ trans('messages.edit_book_plan.enquiry') }}</a>
																				<a class="dropdown-item chnage_status" data-status-id="3" data-payment-id="{{$counter}}" data-statusClass="btn btn-danger" type="button">
																					{{ trans('messages.dashboard.pending') }}</a>
																				<a class="dropdown-item chnage_status" data-status-id="1" data-payment-id="{{$counter}}" data-statusClass="btn btn-warning" type="button">
																					{{ trans('messages.dashboard.waiting_approval') }}</a>
																				<a class="dropdown-item chnage_status" data-status-id="2" data-payment-id="{{$counter}}" data-statusClass="btn btn-success" type="button">
																					{{ trans('messages.edit_book_plan.approved') }}</a>
																				<a class="dropdown-item chnage_status" data-status-id="4" data-payment-id="{{$counter}}" data-statusClass="btn btn-danger" type="button">
																					{{ trans('messages.personal_information.cancel') }}</a>
																			@else
																				<a class="dropdown-item chnage_status" data-status-id="5" data-payment-id="{{$counter}}" data-statusClass="btn btn-primary" type="button">
																					{{ trans('messages.edit_book_plan.refund') }}</a>
																			@endif
																			@if($paymentRecord->payment_status == 1)
																				<a class="dropdown-item chnage_status" data-status-id="5" data-payment-id="{{$counter}}" data-statusClass="btn btn-primary" type="button">
																					{{ trans('messages.edit_book_plan.refund') }}</a>
																			@endif
																		</div>
																	</div>
																	
																	<span class="form-text text-muted big_right_text">{{$autoApprove}}</span>
																</div>
																@if($paymentNumber > 1)
																  <div class="col-sm-2">
																	<a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}</a>
																  </div>
																@endif
															</section>
														   <?php 
															$paymentNumber++; 
															$counter++;
														   ?>
														  @endforeach
														@endif
													</div>
													
													<hr class="hr_padding">
													
													<div class="form-group form-group-last row">
														<label class="col-lg-2 col-form-label"></label>
														<div class="cot_form_input_holder col-lg-4">
															<a href="javascript:void();" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand" onclick="addMorePayment()">
																<i class="la la-plus"></i> {{ trans('messages.edit_book_plan.add_payment') }}
															</a>
														</div>
													</div>
													
													<div class="row">
														<div class="col-sm-6">
															<div class="form-group cot_form_input_holder">
																<label class="col-form-label"> {{ trans('messages.edit_book_plan.total_payment') }}</label>
																<div class="input-group">
																	<div class="input-group-prepend">
																		<span class="input-group-text">{{CURRENCY}}</span>
																	</div>
																	{{ Form::text('Payment[total_payment]',
																	!empty($subProjectDetails->total_contribution)?$subProjectDetails->total_contribution:0, ["class"=>"form-control valid kt_form_input_dark", 'aria-describedby'=>'basic-addon1', 'id'=>'totalPaymentAmount','readonly'=>true,'disabled'=>'disabled']) }}
																</div>
																<span class="help-inline form-text text-muted">{{ trans("messages.edit_book_plan.auto_calculate") }}</span>
															</div>
														</div>
													</div>
													
												</div>
												
												</div>
											</div>
										</div>
								
									</div>

									<!--end: Form Wizard Step 4-->

									<!--begin: Form Actions -->
									<div class="kt-form__actions">
										<button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
											{{ trans("messages.book_plan.previous") }}
										</button>
										<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" onclick="updateDonation()">
											{{ trans('messages.cms_page_details.submit') }}
										</button>
										<button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u final_view_step" data-ktwizard-type="action-next">
											{{ trans("messages.book_plan.next_step") }}
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

<script>
//get dynamic plans or periods//
$(document).ready(function(){
	$(".change_plan_type").each(function(){
	  if ($(this).is(':checked')){
		var plan_type = $(this).val();
		var sub_project_id = $(".get_project_id").val();
		var order_id = $(".get_donation_id").val();
		
		$('#loader_img').show();
		$.ajax({
			url: '{{ route("user.get_plan_html") }}',
			type:'POST',
			data: {'plan_type':plan_type, 'sub_project_id':sub_project_id, 'order_id':order_id},
			success: function(r){
				$(".dynamic_plan_option_block").html(r);
				$('#loader_img').hide();
				
				//get plan name value to show
				var radioID = $("input[name='plan_price']:checked").attr('id');
				$("label").each(function(ind, elm){
				  if ($(elm).prop("for") == radioID){
					$(".plan_price").text($(elm).text());
				  }

				});
				
				var time_periodID = $("input[name='time_period']:checked").attr('id');
				$("label").each(function(val, elements){
				  if ($(elements).prop("for") == time_periodID){
					$(".plan_period").text($(elements).text());
				  }

				});
			},
			error: function(r){
				$('#loader_img').hide();
			},
		});
	  }
	})
})

$(".change_plan_type").click(function(){
	var plan_type = $(this).val();
	var sub_project_id = $(".get_project_id").val();
	var order_id = $(".get_donation_id").val();
	
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("user.get_plan_html") }}',
		type:'POST',
		data: {'plan_type':plan_type, 'sub_project_id':sub_project_id, 'order_id':order_id},
		success: function(r){
			$(".dynamic_plan_option_block").html(r);
			$('#loader_img').hide();
			
			//get plan name value to show
			var radioID = $("input[name='plan_price']:checked").attr('id');
			$("label").each(function(ind, elm){
			  if ($(elm).prop("for") == radioID){
				$(".plan_price").text($(elm).text());
			  }

			});
			
			var time_periodID = $("input[name='time_period']:checked").attr('id');
			$("label").each(function(val, elements){
			  if ($(elements).prop("for") == time_periodID){
				$(".plan_period").text($(elements).text());
			  }

			});
			
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});

})

$(document.body).on('change', '.plan_price' ,function(){
	if($(this).val() == "other"){
		$(".active_plan_price_blk").text($(".customized_plan").val());
	}else{
		$(".active_plan_price_blk").text($("#planPrice_" + $(this).val()).text());
	}
})

$(document.body).on('keyup', '.customized_plan' ,function(){
	$(".active_plan_price_blk").text($(".customized_plan").val());
})


$(".setSelection").change(function(){
	totalSeat = $(this).val();
	if(totalSeat != ""){
		var seatOption = "<option value=''>Bil Hadir</option>";
		for(var i = 1; i <= totalSeat; i++){
			seatOption+="<option value=" + i + ">"+ i +"</option>";  
		}
		$(this).closest(".form-group").find(".totalAttendance").html(seatOption);
	}
})

</script>

<script>
function updateDonation(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#book_plan_form')[0];
	
	$.ajax({
		url: '{{ route("User.updateDonation") }}',
		type:'POST',
		data: $('#book_plan_form').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				location.reload();
				/* if(datas['billUrl'] == ""){
					window.location.href	 =	"{{ URL('invoice') }}/"+datas['DonationOrderId'];
				}else{
					window.location.href	 =	datas['billUrl'];
				} */
			}else if(datas['success'] == 2){
				location.reload();
				//window.location.href	 =	"{{ URL('invoice') }}/"+datas['DonationOrderId'];
			}else if(datas['error'] == 1){
				swal.fire({
					"title": "Fill all required fields!",
					"text": datas['message'],
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "page_name"){
						$(".name_error").addClass('error');
						$(".name_error").html(html);
					}else if(index == "footer_body"){
						$(".footer_body_error").addClass('error');
						$(".footer_body_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
					swal.fire({
						"title": "",
						"text": "There are some errors in your submission. Please correct them.",
						"type": "error",
						"confirmButtonClass": "btn btn-secondary"
					});
				});
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}

</script>

<script>
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v4', {
			startStep: 4, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		wizard.on('beforePrev', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		// Change event
		wizard.on('change', function(wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				//= Step 1
				plan_price: {
					required: true
				},
				time_period: {
					required: true
				},
				other_plan_price: {
					required: true
				},
				other_time_period: {
					required: true
				},
				default_project_plan: {
					required: true
				},
				total_contribution: {
					required: true
				},
				quantity_project_plan: {
					required: true
				},
				quantity: {
					required: true
				},
				dana_default_project_plan: {
					required: true
				},
				dana_vendor: {
					required: true
				},
				"Section[0][name]": "required",
				"Section[0][section_plan]": "required",
				

				//= Step 2
				full_name: {
					required: true
				},
				postcode: {
					required: true
				},
				phone: {
					required: true,
					minlength: 8,
					maxlength: 14
				},
				email: {
					required: true,
					email: true
				},
				company_name: {
					required: true
				},

				//= Step 3
				payment_method: {
					required: true
				},
				refrence_id: {
					required: false
				},
				/* ccnumber: {
					required: true,
					creditcard: true
				},
				ccmonth: {
					required: true
				},
				ccyear: {
					required: true
				},
				cccvv: {
					required: true,
					minlength: 2,
					maxlength: 3
				}, */
			},

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {

			}
		});
	} 

	/* var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function() {
						KTApp.unprogress(btn);
						//KTApp.unblock(formEl);

						swal.fire({
							"title": "",
							"text": "The application has been successfully submitted!",
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						});
					}
				});
			}
		});
	} */

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#book_plan_form');

			initWizard();
			initValidation();
			//initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard4.init();
});

jQuery(document).ready(function() {
	
	var radioID = $("input[name='plan_price']:checked").attr('id');
	$("label").each(function(ind, elm){
	  if ($(elm).prop("for") == radioID){
		$(".plan_price").text($(elm).text());
	  }

	});
	
	var time_periodID = $("input[name='time_period']:checked").attr('id');
	$("label").each(function(val, elements){
	  if ($(elements).prop("for") == time_periodID){
		$(".plan_period").text($(elements).text());
	  }

	});
	
	//for refrence id
	if($(".payment_method_change").val() == 2 || $(".payment_method_change").val() == 3 || $(".payment_method_change").val() == 6){
		$(".refrence_id_block").show();
	}else{
		$(".refrence_id_block").hide();
	}

	$(".payment_method_change").each(function(val, elements){
		if ($(this).is(':checked')){
			var PaymentMethodChange = $(this).val();
			if(PaymentMethodChange == 2 || PaymentMethodChange == 3 || PaymentMethodChange == 6){
				$(".refrence_id_block").show();
			}else{
				$(".refrence_id_block").hide();
			}
		}
	});

});

jQuery('.alphabetRestriction').keypress(function (event) { 
   return event.keyCode < 32 || (event.keyCode >= 48 && event.keyCode <= 57);
});

$(document.body).on('click', '.plan_price' ,function(){
//$(".plan_price").click(function(){
	$(".plan_price").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		 var radioID = $(this).attr('id');
        $("label").each(function(ind, elm){
          if ($(elm).prop("for") == radioID){
            $(".plan_price").text($(elm).text());
          }
        });
		//for customized plan 
		$(".customized_plan").val('');
		if($(this).val() == "other"){
			$(".customized_plan_cls").show();
		}else{
			$(".customized_plan_cls").hide();
		}
	}
})

$(document.body).on('click', '.time_period' ,function(){
//$(".time_period").click(function(){
	$(".time_period").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var periodID = $(this).attr('id');
        $("label").each(function(val, elements){
          if ($(elements).prop("for") == periodID){
            $(".plan_period").text($(elements).text());
          }
        });
		//for customized period 
		$(".customized_time").val('');
		if($(this).val() == "other"){
			$(".customized_period_cls").show();
		}else{
			$(".customized_period_cls").hide();
		}
	}
})

$(document.body).on('click', '.payment_method_change' ,function(){
	$(".payment_method_change").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var PMValue = $(this).val();
        var PMName = $("#payment_methd_name_"+PMValue).text();
		$(".paymnet_option").text(PMName);
		
	}
	if($(this).val() == 2 || $(this).val() == 3 || $(this).val() == 6){
		$(".refrence_id_block").show();
	}else{
		$(".refrence_id_block").hide();
	}
})

$(".final_view_step").click(function(){
	var Currency	=	"{{Currency}}";
	var planType = $(".change_plan_type").val();
	if(typeof planType !== "undefined"){
		planType = planType.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			return letter.toUpperCase();
		});
		$(".plan_type").text(planType);
	}
	//$(".plan_price").text($(".plan_price").val());
	//$(".plan_period").text($(".time_period").val());
	$(".full_name").text($(".full_name").val());
	$(".ic_number").text($(".ic_number").val());
	$(".phone").text($(".phone").val());
	$(".email").text($(".email").val());
	$(".address").text($(".address").val());
	$(".postcode").text($(".postcode").val());
	$(".company_name").text($(".company_name").val());
	$(".registration_number").text($(".registration_number").val());
	if($("input[name=total_contribution]").val() != ""){
		$(".total_payment_amount").show();
		$(".total_payment_amount").text(Currency + $("input[name=total_contribution]").val());
	}else{
		$(".total_payment_amount").hide();
	}
	
	$(".payment_method_change").each(function(val, elements){
		if ($(this).is(':checked')){
			var PMValue = $(this).val();
			var PMName = $("#payment_methd_name_"+PMValue).text();
			$(".paymnet_option").text(PMName);
			
		}
	});
	
	$(".default_project_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".project_plan").text($("."+radioID).text());
		}
	});
	
	//quantity-special project
	$(".quantity_project_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".project_plan").text($("."+radioID).text());
		}
	});
	
	//dana-lastari default plan project
	$(".dana_default_project_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".dana_project_plan").text($("."+radioID).text());
		}
	});
		
	//dana property plan selected
	$(".dana_property_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".dana_project_plan").text($("."+radioID).text());
		}
	});
		
	//dana vendor selected
	$(".dana_vendor").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".dana_project_plan").text($("."+radioID).text());
		}
	});
	
})

//
$(document.body).on('click', '.default_project_plan' ,function(){
	$(".default_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".project_plan").text($("."+radioID).text());
      
	}
})

//quantity-special project
$(document.body).on('click', '.quantity_project_plan' ,function(){
	$(".quantity_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".project_plan").text($("."+radioID).text());
      
	}
})

//dana-lastari default plan project
$(document.body).on('click', '.dana_default_project_plan' ,function(){
	$(".dana_default_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".dana_project_plan").text($("."+radioID).text());
      
	}
})

//dana property plan change
$(document.body).on('click', '.dana_property_plan' ,function(){
	$(".dana_property_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".dana_project_plan").text($("."+radioID).text());
      
	}
})

//dana vendor change
$(document.body).on('click', '.dana_vendor' ,function(){
	$(".dana_vendor").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".dana_project_plan").text($("."+radioID).text());
      
	}
})


</script>

<script>
$(document).ready(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(".plan_quantity").val());
})

$(".quantity_project_plan").change(function(){
	SelectedPlanPrice = $(this).attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(".plan_quantity").val());
})

$(".plan_quantity").change(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(this).val());
})

$(".plan_quantity").keyup(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(this).val());
})


$(document).on("click", ".chnage_status", function(){
//$(".chnage_status").click(function(){
	var paymentId = $(this).attr("data-payment-id");
	var paymentStatus = $(this).attr("data-status-id");
	var StatusClass = $(this).attr("data-statusClass");
	//alert(StatusClass);
	$(".status_btn_cls_"+paymentId).removeClass("btn btn-warning");
	$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-warning");
	$(".status_btn_cls_"+paymentId).removeClass("btn btn-danger");
	$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-danger");
	$(".status_btn_cls_"+paymentId).removeClass("btn btn-success");
	$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-success");
	$(".status_btn_cls_"+paymentId).removeClass("btn btn-primary");
	$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-primary");
	
	$(".status_btn_cls_"+paymentId).addClass(StatusClass);
	$(".status_btn_cls_name_"+paymentId).addClass(StatusClass);
	$(".status_btn_cls_name_"+paymentId).text($(this).text());
	
	$("#paymentStatus_"+paymentId).val(paymentStatus);
})

$(document).ready(function(){
	var TotalValue = Number(0);
	$(".paid_amount").each(function() {
		if($(this).val() != ""){
			TotalValue += parseFloat($(this).val());
		}
	});
	$("#totalPaymentAmount").val(TotalValue);
	
})

$(document).on("keyup", ".payment_amount", function(){
	//$(".payment_amount").keyup(function(){
	
	var TotalValue = Number(0);
	$(".paid_amount").each(function() {
		if($(this).val() != ""){
			TotalValue += parseFloat($(this).val());
		}
	});
	$("#totalPaymentAmount").val(TotalValue);
	
})


function addMorePayment(){
	var order_id = $(".order_id").val();
	var get_last_id			=	$('.add_more_payment section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	
	$.ajax({
		url:'{{ route("User.AddMorePayment") }}',
		'type':'post',
		data:{'counter':counter,'order_id':order_id},
		success:function(response){
			$('#loader_img').hide();
			$(".add_more_payment").append(response);
			
			var TotalValue = Number(0);
			$(".paid_amount").each(function() {
				if($(this).val() != ""){
					TotalValue += parseFloat($(this).val());
				}
			});
			$("#totalPaymentAmount").val(TotalValue);
	
		}
	});
}

function deleteMorePayment(id){
	Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
		$(".delete_add_more_payment_"+id).remove();
		var TotalValue = Number(0);
		$(".payment_section .payment_amount").each(function() {
			if($(this).val() != ""){
				TotalValue += parseFloat($(this).val());
			}
		});
		$("#totalPaymentAmount").val(TotalValue);
	  }
	})
} 

// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})


</script>


<script>
$(document).ready(function() {
	$('.image-popup-vertical-fit').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
		
	});
)};

</script>

@stop