@extends('front.layouts.default')
@section('content')

<?php $imageTumbUrl = WEBSITE_URL.'image.php?height=600&width=600&cropratio=1:1&image='; ?>

<script src="<?php echo WEBSITE_JS_URL;?>jquery.plugin.js"></script>
<script src="<?php echo WEBSITE_JS_URL;?>jquery.countdown.js"></script>
<!--<link href="<?php echo WEBSITE_JS_URL;?>jquery.countdown.css" rel="stylesheet" type="text/css" />-->

<style>
.donate_btn_blk {
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.donate_btn_blk-empty {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}
</style>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	@if(!empty($subProjectDetails->header_image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $subProjectDetails->header_image))
		<img class="project_detail_header_img" src='{{TEMPLATE_IMG_URL . $subProjectDetails->header_image}}' />
	@else
		<div class="header_bg_clr_blk" style=""></div>
	@endif
	<div class="project_detail_header_contnt" style="">
		<span class="project_detail_header_contnt_hd" style="">{{$subProjectDetails->sub_project_name}}</span><br>
		<span class="project_detail_header_contnt_txt" style="">{{$subProjectDetails->title}}</span>
	</div>
	
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="margin-top:100px;">
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			
			<div class="kt-portlet" style="-webkit-box-shadow:none; box-shadow:none;">
				<div class="kt-portlet__body kt-portlet__body--fit">
				  @if($subProjectDetails->slider_position == "center")	
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
							<div id="campaign" class="owl-carousel owl-theme">
							 @if(!empty($sliderImages))
							  @foreach($sliderImages as $sliderImage)
								@if(!empty($sliderImage->image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $sliderImage->image))
								  <div class="item"> 
									<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.TEMPLATE_IMG_URL . $sliderImage->image}}');"></div>
								  </div>
								@endif
							  @endforeach
							 @else
								<div class="item"> 
									<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.WEBSITE_IMG_URL}}admin/no_image.jpg');"></div>
								</div>
							 @endif
							</div>
							
						</div>
						<div class="col-sm-3"></div>
					</div>
					
				  @endif
				  
					<div class="row">
					  @if($subProjectDetails->slider_position == "left")	
						<div class="col-sm-6">
							<!--<div class="row" style="background: url('{{WEBSITE_IMG_URL}}users/user1.jpg'); background-size: 100%; width: 100%; height: 80%; margin: 0;"></div>-->
							
						  <div class="" style="">
							<div class="row">
								<div id="campaign" class="owl-carousel owl-theme">
									 @if(!empty($sliderImages))
									  @foreach($sliderImages as $sliderImage)
										@if(!empty($sliderImage->image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $sliderImage->image))
										  <div class="item"> 
											<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.TEMPLATE_IMG_URL . $sliderImage->image}}');"></div>
										  </div>
										@endif
									  @endforeach
									 @else
										<div class="item"> 
											<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.WEBSITE_IMG_URL}}admin/no_image.jpg');"></div>
										</div>
									 @endif
								</div>
								<?php /* @if($subProjectDetails->share_btn_status == 1)
									<div style="margin: 0; margin-top: 20px; width: 100%;">
										<div class="sharethis-inline-share-buttons"></div>
										<a href="#" class="btn btn-facebook col"><i class="socicon-facebook"></i> Facebook</a>&nbsp;
										<a href="#" class="btn btn-twitter col"><i class="socicon-twitter"></i> Twitter</a>&nbsp;
										<a href="#" class="btn btn-google col"><i class="socicon-google"></i> Google</a>&nbsp;
										<a href="#" class="btn btn-instagram col"><i class="socicon-instagram"></i> Instagram</a>&nbsp;
										<a href="#" class="btn btn-linkedin col"><i class="socicon-linkedin"></i> Linkedin</a>&nbsp;
									</div>
								@endif */ ?>
								
							 </div>
						  </div>
							
						</div>
					  @endif
					  
					  @if($subProjectDetails->slider_position == "center")
						  <div class="col-sm-3"></div>
					  @endif
					  
					 @if($subProjectDetails->editor_status == 1)
						<div class="col-sm-6">
							{{$subProjectDetails->editor}}
						</div>
					 @else
					  @if($subProjectDetails->plan_show_status == 1 && $subProjectDetails->subject_type == 0)
						<div class="col-sm-6">
						 <div style="margin:10px;">
						  @if($subProjectDetails->client_view == 1)
							<div class="row" style="font-size: 20px; font-weight:bold; margin: 0; margin-top: 20px;">
								Campaign will end at:&nbsp; <span style="color: red;" class="countdown hasCountdown" id="countdown_{{$subProjectDetails->id}}" data-ends-at="2019-01-11T22:59:59Z"> {{ trans("messages.sub_project_detail.30_days_10_hours_20_minutes_32_seconds")}}</span>
							</div><br>
							<script type="text/javascript"> 
								jQuery(document).ready(function(){
									austDay = "<?php echo strtotime($subProjectDetails->campaign_end_date)-(time()); ?>";  
									jQuery('#countdown_<?php echo $subProjectDetails->id; ?>').countdown({ 
										until: austDay									
									});
								});  
							</script>
							
							<div class="row" style="text-align: center; font-size: 13px; margin-left:0px;">
								<span style="color: #63cb34; font-size: 35px; font-weight: bold;"> {{Currency}}{{ !empty($totalApprovedContribution) ? $totalApprovedContribution:0; }} &nbsp; </span>       
								<span style="margin-top: 20px; font-size: 16px;"> {{ trans("messages.sub_project_detail.out_of")}} {{Currency . round($subProjectDetails->target_amount,2)}} {{ trans("messages.sub_project_detail.rasied")}} </span>
							</div><br>
							<div class="kt-widget__container">
								<?php $avgReaisedAmount = round((($totalApprovedContribution / $subProjectDetails->target_amount) * 100),2); ?>
								<span class="kt-widget__subtitel">{{ trans('messages.cms_page_details.goal') }}</span>
								<div class="kt-widget__progress d-flex align-items-center flex-fill">
									<div class="progress" style="height: 5px;width: 90%;">
										<div class="progress-bar kt-bg-success" role="progressbar" style="width: {{$avgReaisedAmount}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="kt-widget__stat">
										{{$avgReaisedAmount}}%
									</span>
								</div>
							</div>
						  @endif
						  
						  {{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"select_plan_form"]) }}
						  <input type="hidden" name="sub_project_id" class="get_project_id" value="{{$subProjectDetails->id}}">
						   @if($subProjectDetails->project_module ==	1)
							
							<div class="form-group">
							  <br>
								<label style="font-size: 16px;">{{ trans("messages.sub_project_detail.choose_commitment_type")}} : </label>
								<div class="row">
								  @if($subProjectDetails->daily_status == 1)
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio" checked="">
													{{ Form::radio('plan_type','daily','1',['class'=>'change_plan_type']) }}
													<span></span>
												</span>
											</span>
											<span class="kt-option__label" >
												<span class="kt-option__head">
													<span class="kt-option__title"  style="font-size: 16px;">
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
								  @if($subProjectDetails->monthly_status == 1)
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio" checked="">
													{{ Form::radio('plan_type','monthly','',['class'=>'change_plan_type']) }}
													<span></span>
												</span>
											</span>
											<span class="kt-option__label">
												<span class="kt-option__head">
													<span class="kt-option__title" style="font-size: 16px;">
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
								  @if($subProjectDetails->yearly_status == 1)
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio">
													{{ Form::radio('plan_type','yearly','',['class'=>'change_plan_type']) }}
													<span></span>
												</span>
											</span>
											<span class="kt-option__label">
												<span class="kt-option__head">
													<span class="kt-option__title" style="font-size: 16px;">
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
								  <div class="help-inline plan_error"></div>
								</div>
							</div>
							<div class="form-group"></div>
							<div class="dynamic_plan_option_block">
							  <div class="form-group">
								<label>{{ trans("messages.sub_project_detail.choose_plan") }}</label>
								@if(!empty($dailyPlanDetails))
									<div class="kt-portlet__tab_block_options">
									  @foreach($dailyPlanDetails as $key=>$dailyPlanDetail)
										@if($dailyPlanDetail->is_primary == 1)
											<?php 
												$activePlanPrice = Currency." ".$dailyPlanDetail->price;
												$activeClass = "1";
											?>
										@else
											<?php 
												$activeClass = ""; 
											?>
										@endif
										<div class="kt-portlet__tab_block_options_item">
											{{ Form::radio('plan_price',$dailyPlanDetail->id,$activeClass,['class'=>'plan_price', 'id'=>'tab_'.$key]) }}
											<label for="tab_{{$key}}">{{Currency." ".$dailyPlanDetail->price}}</label>
										</div>
									  @endforeach
									  @if($subProjectDetails->daily_plan_allow_other == 1)
										<div class="kt-portlet__tab_block_options_item">
											{{ Form::radio('plan_price','other','',['class'=>'plan_price', 'id'=>'allow_other']) }}
											<label for="allow_other">{{ trans("messages.sub_project_detail.others")}}</label>
										</div>
									  @endif
									</div>  
									<div class="col-sm-6 form-group customized_plan_cls" style="display:none;">
										<label></label>
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
											{{ Form::text('other_plan_price', '', ['class'=>'form-control customized_plan alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_customized_plan")]) }}
											<span class="help-inline"></span>
										</div>
									</div>
									<span class="form-text text-muted">*  {{ trans("messages.sub_project_detail.it_will_deduct_from_your_account_on_daily_basis") }}</span>
								@else
								  <span class="form-text text-muted"> {{ trans("messages.sub_project_detail.no_plan_found_on_daily_basis") }}</span>
								@endif
							  </div>
							
							  <div class="form-group"></div>
							
							  <div class="form-group">
								<label> {{ trans("messages.sub_project_detail.choose_period") }}</label>
								@if(!empty($dailyPeriodDetails))
									<div class="kt-radio-inline">
									  @foreach($dailyPeriodDetails as $key=>$dailyPeriodDetail)
										@if($dailyPeriodDetail->is_primary == 1)
											<?php 
												$activePeriod = "1";
											?>
										@else
											<?php 
												$activePeriod = ""; 
											?>
										@endif
										<label class="kt-radio" for="time_period_{{$key}}">
											{{ Form::radio('time_period',$dailyPeriodDetail->id,$activePeriod,['class'=>'time_period', 'id'=>'time_period_'.$key]) }} {{trans($dailyPeriodDetail->quantity.' Days')}}
											<span></span>
										</label>
									  @endforeach
									  @if($subProjectDetails->daily_period_allow_other == 1)
										<label class="kt-radio"for="time_period_other">
											{{ Form::radio('time_period','other','',['class'=>'time_period', 'id'=>'time_period_other']) }} {{trans('Others')}}
											<span></span>
										</label>
									  @endif
									</div>
									<div class="col-sm-6 form-group customized_period_cls" style="display:none;">
										<label></label>
										<div class="input-group">
											{{ Form::text('other_time_period', '', ['class'=>'form-control customized_time alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.book_plan.enter_customized_period")]) }}
											<span class="help-inline"></span>
										</div>
									</div>
								@else
									<span class="form-text text-muted">{{ trans("messages.sub_project_detail.no_period_found_on_daily_basis") }}</span>
								@endif
							  </div>
							</div>
							
						   @elseif($subProjectDetails->project_module ==	2)
							 @if($subProjectDetails->customize_plan_option == 1)
								<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
								<div class="kt-form__section kt-form__section--first">
									<div class="kt-wizard-v4__form">
										<div class="form-group">
											<label>{{ trans("messages.sub_project_detail.choose_project") }}:</label>
											<div class="row">
											@if(!empty($projectPlans))
											  @foreach($projectPlans as $key=>$projectPlan)
												@if($key == 0)
													<?php $checkedPlan	=	"1"; ?>
												@else
													<?php $checkedPlan	=	""; ?>
												@endif
												<div class="col-lg-4">
													<label class="kt-option" for="project_plans_key_{{$key}}">
														<span class="kt-option__control">
															<span class="kt-radio">
																{{ Form::radio('default_project_plan', $projectPlan->id,$checkedPlan, ['class'=>'default_project_plan', 'id'=>'project_plans_key_'.$key]) }}
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
												{{ Form::number('total_contribution', '', ['class'=>'form-control','autocomplete'=>'off','min'=>'1']) }}
											</div>
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
											{{ Form::hidden('SeatReservation['.$seatDetails->id.'][seat_subtitle_id]', $seatReservationPlan->id, ['class'=>'']) }}
											<div class="form-group row">
												<label class="col-form-label col-lg-4 col-sm-12"><span class="seat_reservation_name_price_{{$key}}" rel="{{$seatDetails->id}}">{{$seatDetails->seat_name}} ({{Currency}}{{$seatDetails->seat_price}})</span><br/> {{$seatDetails->seat_description}}</label>
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
													{{ Form::text('total_contribution', 0, ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
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
									  <div class="kt-wizard-v4_form">
										@foreach($seatReservationPlans as $seatReservationPlan)
										  <div class="kt-heading kt-heading--md">{{$seatReservationPlan->description}}</div>
										  @if(!empty($seatReservationPlan->ReservationSeats))
										   @foreach($seatReservationPlan->ReservationSeats as $seatDetails)
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
														  <?php for($seatNumber = 1; $seatNumber < $seatDetails->seat_max_unit; $seatNumber++){ ?>
															<option value="{{$seatNumber}}">{{$seatNumber}}</option>
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
													{{ Form::text('total_contribution', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
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
													@if($key == 0)
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
																	<span class="kt-option__title">
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
											{{ Form::number('quantity', '1', ['class'=>'form-control plan_quantity','autocomplete'=>'off', 'placeholder'=>'', 'min'=>1]) }}
										</div>
										<div class="form-group">
											<label>{{ trans('messages.dashboard.total_contributions') }} :</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
												{{ Form::text('total_contribution', '', ['class'=>'form-control total_contribution','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1','readonly'=>true]) }}
											</div>
										</div>

									</div>
								 </div>
								@endif
								
							 @elseif($subProjectDetails->customize_plan_option == 4)
								@if(!empty($sectionPlans))
									<?php $counter = 0; ?>
									<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }} </div>
									<div class="kt-form__section kt-form__section--first">
										<div class="kt-wizard-v4__form get_dynamic_participate_block">

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
																	<span class="help-inline form-text section_name_error"></span>
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
																		<option value="">{{ trans("messages.sub_project_detail.select_section") }}</option>
																	  @foreach($sectionPlans as $sectionPlan)
																		<option value="{{$sectionPlan->id}}">{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
																	  @endforeach
																	</select>
																	<span class="help-inline form-text section_plan_error"></span>
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
										</div>
										@if($subProjectDetails->is_multiple_participate == 1)
											<div class="form-group row">
												<div class="col-lg-4">
													<button type="button" onclick="addMoreSectionParticipate()" class="btn btn-bold btn-sm btn-label-brand btn_loader"><span class="flaticon2-plus">&nbsp;&nbsp;</span> {{ trans('messages.sub_project_detail.add_participant') }}</button>
												</div>
											</div>
										@endif
									</div>
									
								@endif
							 @endif
							
						   @elseif($subProjectDetails->project_module ==	3)
							 @if($subProjectDetails->customize_plan_option  == 5)
								@if(!empty($danaDefaultPlans))
									<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }} </div>
									<div class="kt-form__section kt-form__section--first">
										<div class="kt-wizard-v4__form">
											<div class="form-group">
												<div class="row">
												  @foreach($danaDefaultPlans as $key=>$danaDefaultPlan)
													@if($danaDefaultPlan->is_primary == 1)
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
									<div class="kt-heading kt-heading--md">  {{ trans("messages.sub_project_detail.select_your_will_detail") }}</div>
									<p> <span class="kt-option__title">  {{ trans("messages.sub_project_detail.property_sale") }}</span> </p>
									<div class="row">
									  @foreach($danaProperyPlans as $key=>$danaProperyPlan)
										@if($key == 0)
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
									  
									</div>

									<div class="form-group">
										<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans("messages.sub_project_detail.estimated_price") }} :</label></p>
										<div class="col-sm-12">
										  <div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
											{{ Form::text('total_contribution', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
										  </div>
										</div>
									</div>

									<div class="form-group ">
										<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans("messages.sub_project_detail.additional_information") }}</label></p>
										<div class="col-sm-12">
											{{ Form::textarea('extra_note', '', ['class'=>'form-control']) }}
										</div>
									</div>
									
								@endif
								
							 @elseif($subProjectDetails->customize_plan_option  == 7)
								@if(!empty($vendorLists))
									<div class="kt-heading kt-heading--md">  {{ trans("messages.sub_project_detail.select_your_vendor") }}</div>
									<div class="row">
									  @foreach($vendorLists as $key=>$vendorList)
										@if($key == 0)
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
													@if(!empty($vendorList->short_description))
													<span class="kt-option__body">
														{{$vendorList->short_description}}
													</span>
													@endif
												</span>
											</label>
										</div>
									  @endforeach
									</div>
									
									<div class="form-group">
										<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans('messages.dashboard.total_contributions') }} :</label></p>
										<div class="col-sm-12">
										  <div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
											{{ Form::text('total_contribution', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
											<span class="help-inline "></span>
										  </div>
										</div>
									</div>

								@endif
								
							 @endif
							
						   @endif
							
							<a href="javascript:void();" onclick="donateNow()" class="kt-nav__link">
								<button type="button" class="btn btn-label-success" style="float: right; font-size: 16px;">{{ trans('messages.cms_page_details.donate_now') }} </button>
							</a>
						  
						 {{ Form::close() }}
						 </div>
						</div>
					  @elseif($subProjectDetails->plan_show_status == 1 && $subProjectDetails->subject_type == 1)
						<div class="col-sm-6">
						  <div class="kt-portlet" style="-webkit-box-shadow:none; box-shadow:none;">
						   {{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"inquiryForm"]) }}
						   <input type="hidden" name="sub_project_id" class="get_project_id" value="{{$subProjectDetails->id}}">
							<div class="kt-portlet__body">
								<div class="kt-pricing-1 kt-pricing-1--fixed">
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" style="padding: 0 6%">
										<div class="kt-heading kt-heading--md"><h2>{{ trans("messages.sub_project_detail.enquire_form")}}</h2></div>
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_personal_detail")}}</div>
										@if($subProjectDetails->contributor_type == "personal")
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.full_name")}}*:</label>
														{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-12 form-group">
														<label>{{ trans("messages.sub_project_detail.ic_number_optional")}}:</label>
														{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('phone', '', ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_phone_number")}}</span>
													</div>
													<div class="col-sm-12 form-group">
														<label>{{ trans('messages.cms_page_details.email') }}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div>
												</div>
												
												<div class="row">
												
													<div class="col-xl-12">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.address_optional")}}</label>
															{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													
													<div class="col-xl-12">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
															{{ Form::text('postcode', '', ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_postcode")}}</span>
														</div>
													</div>
												</div>
												
												<div class="row">
												  <div class="col-xl-12">
													<div class="form-group">
														<button class="btn btn-success float-right">{{ trans("messages.sub_project_detail.auto_generate_form_application")}}</button>
													</div>
												  </div>
												</div>
												
											</div>
										</div>
										@else
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-sm-6 form-group">
														<label>{{ trans("messages.sub_project_detail.pic_full_name")}}*:</label>
														{{ Form::hidden('profile_type', '1', ['class'=>'form-control','autocomplete'=>'off']) }}
														{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-sm-6 form-group">
														<label>{{ trans("messages.sub_project_detail.pic_ic_number_optional")}}:</label>
														{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('phone', '', ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
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
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.company_name")}}*:</label>
														{{ Form::text('company_name', '', ['class'=>'form-control company_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_company_name")}}</span>
													</div>
												</div>
												
												<div class="row">
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.work_email")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div> 
													<div class="col-sm-12 form-group">
														<label>{{ trans("messages.sub_project_detail.company_registration_number_optional")}}:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">#</span></div>
															{{ Form::text('registration_number', '', ['class'=>'form-control registration_number', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="row">
												
													<div class="col-sm-9">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.company_address_optional")}}</label>
															{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													
													<div class="col-sm-3">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
															{{ Form::text('postcode', '', ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_postcode")}}</span>
														</div>
													</div>
												</div>
												
												<div class="row">
												  <div class="col-xl-sm-12">
													<div class="form-group">
														<button class="btn btn-success float-right">{{ trans("messages.sub_project_detail.auto_generate_form_application")}}
														</button>
													</div>
												  </div>
												</div>
												
											</div>
										</div>
										@endif
									</div>
								</div>
							</div>
						   {{ Form::close() }}
						  </div>
						</div>
					  @else
						<div class="col-sm-6" style="">
							<div class="donate_btn_blk-empty">
								<?php /* {{ route('user.book_plan',$subProjectDetails->slug) }} */ ?>
								@if($subProjectDetails->donation_btn_type != 'default' && !empty($subProjectDetails->donation_btn_url))
									<a href="{{$subProjectDetails->donation_btn_url}}" class="kt-nav__link">  
										<button type="button" class="btn btn-label-success" style="float: right; font-size: 16px; padding: 14px 60px;">{{ trans('messages.cms_page_details.donate_now') }} </button>
									</a>
								@else
									<a href="javascript:;" onclick="openBookingModal('{{$subProjectDetails->slug}}')" class="kt-nav__link">  
										<button type="button" class="btn btn-label-success" style="float: right; font-size: 16px; padding: 14px 60px;">{{ trans('messages.cms_page_details.donate_now') }} </button>
									</a>
								@endif
							</div>
						</div>
					  @endif
					  
					  @if($subProjectDetails->slider_position == "right")	
						<div class="col-sm-6">
						  <div class="" style="margin-right: 20px;">
							<!--<div class="row" style="background: url('{{WEBSITE_IMG_URL}}users/user1.jpg'); background-size: 100%; width: 100%; height: 80%; margin: 0;"></div>-->
							
							<div class="row">
								<div id="campaign" class="owl-carousel owl-theme">
									@if(!empty($sliderImages))
									  @foreach($sliderImages as $sliderImage)
										@if(!empty($sliderImage->image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $sliderImage->image))
										  <div class="item"> 
											<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.TEMPLATE_IMG_URL . $sliderImage->image}}');"></div>
										  </div>
										@endif
									  @endforeach
									@else
										<div class="item"> 
											<div class="campaign_project_img" style="background: url('{{$imageTumbUrl.WEBSITE_IMG_URL}}admin/no_image.jpg');"></div>
										</div>
									@endif
								</div>
							
								@if($subProjectDetails->share_btn_status == 1)
									<div style="margin: 0; margin-top: 20px; width: 100%;">
										<div class="sharethis-inline-share-buttons"></div>
									</div>
								@endif
							</div>
							
						  </div>
					    </div>
					  @endif
					 @endif
					 
					<div class="col-12">	
					  <div class="" style="padding: 100px 15px 0px;">
						{{ $subProjectDetails->project_description }}
					  </div>
					</div>
					 
					</div>
					
					<!-- <br><br><br> -->
					<?php /* <div class="kt-widget kt-widget--project-1" style="padding: 100px 0;">
						<div class="kt-widget__body" style="margin: auto; text-align: center;">
							<span style="color: #b3df99; font-size: 26px;">Cara Sumbangan</span> <span style="font-size: 26px;">Alternatif</span><br><br>
							<span style="font-size: 20px;">salurkan terus ke akaun bank:</span><br><br>
							<span style="font-size: 26px; color: #97f161; font-weight: bold;">The trustees of <br/>Hidayah Centre Foundation Registered</span><br>
							<br>
							<div>
								<ul style="list-style: none; font-size: 20px;">
									<li><span><strong>Maybank islamic</strong></span> : 5622 0962 4421</li>
									<li><span><strong>Bank islam</strong></span> : 1211 3010 3494 33</li>
									<li><span><strong>Bank Rakyat</strong></span> : 1104 6100 0356</li>
								</ul>
							</div>
							<br>
						</div>
					</div> */ ?>

					<?php /* <div class="kt-widget kt-widget--project-1" style="">
					  {{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"contactusForm"]) }}
						<div class="kt-widget__body" style="">
							<span style="color: #b3df99;font-size: 26px;text-align: center;display: block;">{{ trans('messages.cms_page_details.contact_us') }}</span><br><br>
							<div class="row">
								<div class="col-lg-7">
									<div class="form-group row">
										<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;"  >{{ trans('messages.cms_page_details.name') }}</label>
										<div class="col-sm-9">
											{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_name')]) }}
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;">{{ trans('messages.cms_page_details.email') }}</label>
										<div class="col-sm-9">
											{{ Form::text('email', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_email')]) }}
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;">{{ trans('messages.cms_page_details.message') }}</label>
										<div class="col-sm-9">
											{{ Form::textarea('message', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_message'), 'rows'=>'3']) }}
											<span class="help-inline message_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9">
											<button type="button" onclick="saveContactUsForm()" class="btn btn-success btn-block">{{ trans('messages.cms_page_details.submit') }}</button>
										</div>
									</div>
								</div>
								<div class="col-lg-5" style="font-size: 16px;text-align: center;" align="left">
									{{Config::get("Settings.business_name")}}<br>{{Config::get("Settings.business_address")}}<br>P : {{Config::get("Settings.business_contact")}}<br><br>{{ trans('messages.cms_page_details.email') }} : {{Config::get("Settings.business_email")}}<br><br>{{ trans('messages.cms_page_details.website') }} : {{Config::get("Settings.business_url")}}
								</div>
							</div>
						</div>
					  {{ Form::close() }}
					</div> */ ?>
				
					
					@if($subProjectDetails->share_btn_status == 1)
						<div style="margin: 0; margin-top: 20px; width: 100%;">
							<div class="sharethis-inline-share-buttons"></div>
						</div>
					@endif
					
					
				</div>
			</div>
		</div>
		

		<!-- end:: Content -->
	</div>
</div>















<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5c76766d8f16b70011540129&product=inline-share-buttons"></script>

<script>
function donateNow(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#select_plan_form')[0];
	
	$.ajax({
		url: '{{ route("Globaluser.selectDonationPlan") }}',
		type:'POST',
		data: $('#select_plan_form').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				//window.location.href	 =	"{{ route('user.book_plan',array($subProjectDetails->slug)) }}";
				openBookingModal('{{$subProjectDetails->slug}}');
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "plan_type"){
						$(".plan_error").addClass('error');
						$(".plan_error").html(html);
					}else if(index == "footer_body"){
						$(".footer_body_error").addClass('error');
						$(".footer_body_error").html(html);
					}else if(index == "section_name"){
						$(".section_name_error").addClass('error');
						$(".section_name_error").html(html);
					}else if(index == "section_plan"){
						$(".section_plan_error").addClass('error');
						$(".section_plan_error").html(html);
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
//get dynamic plans or periods//
$(".change_plan_type").click(function(){
	var plan_type = $(this).val();
	var sub_project_id = $(".get_project_id").val();
	
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("user.get_plan_html") }}',
		type:'POST',
		data: {'plan_type':plan_type, 'sub_project_id':sub_project_id},
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

function addMoreSectionParticipate(){
	$(".btn_loader").addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	var subProjectId		=	$(".get_project_id").val();
	var get_last_id			=	$('.get_dynamic_participate_block section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	
	$.ajax({
		url:'{{ route("user.add_more_section_participate") }}',
		'type':'post',
		data:{'counter':counter, 'subProjectId':subProjectId},
		success:function(response){
			$('#loader_img').hide();
			$(".get_dynamic_participate_block").append(response);
			
			$(".btn_loader").removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		}
	});
}

function deleteMoreSectionParticipateItem(id){
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
		$(".delete_more_section_item_"+id).remove();
	  }
	})
} 

$(".setSelection").click(function(){
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

</script>

<script>
function saveContactUsForm(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#contactusForm')[0];
	
	$.ajax({
		url: '{{ URL("/contact") }}',
		type:'POST',
		data: $('#contactusForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				$("#contactusForm")[0].reset()
				swal.fire({
					"title": "Thank You",
					"text": "We got your contactus query. Our exicutive answer you soon.",
					"type": "success",
					"confirmButtonClass": "btn btn-secondary"
				});
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "message"){
						$(".message_error").addClass('error');
						$(".message_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
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

<script type="text/javascript"> 
$(document).ready(function() {	
	$("#campaign").owlCarousel({
		
		items:1,

		itemsDesktop:[1000,1],

		itemsDesktopSmall:[979,1],

		itemsTablet:[768,1],

		pagination:false,

		navigation:false,

		navigationText:["",""],

		slideSpeed:1000,

		autoPlay:true,
		stopOnHover:true,
	}); 
});	

</script>

<script>
var KTWizard4 = function () {
	// Base elements
	var formEl;
	var validator;

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				full_name: {
					required: true
				},
				postcode: {
					required: true
				},
				phone: {
					required: true,
					digits: true,
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

			},

			// Display error
			invalidHandler: function(event, validator) {
				//KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {
				saveEnquiry();
			}
		});
	} 

	return {
		// public functions
		init: function() {
			formEl = $('#inquiryForm');

			initValidation();
			//initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard4.init();
});

</script>

<script>
function saveEnquiry(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#inquiryForm')[0];
	
	$.ajax({
		url: '{{ route("User.saveEnquiry") }}',
		type:'POST',
		data: $('#inquiryForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				window.location.href	 =	"{{ URL('/dashboard') }}";
			}else if(datas['success'] == 2) {
				$('#sign_up_popup').modal({backdrop: 'static', keyboard: false}) 
				window.localStorage.setItem('isDashboard', '1');
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "plan_type"){
						$(".plan_error").addClass('error');
						$(".plan_error").html(html);
					}else if(index == "footer_body"){
						$(".footer_body_error").addClass('error');
						$(".footer_body_error").html(html);
					}else if(index == "section_name"){
						$(".section_name_error").addClass('error');
						$(".section_name_error").html(html);
					}else if(index == "section_plan"){
						$(".section_plan_error").addClass('error');
						$(".section_plan_error").html(html);
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

@stop