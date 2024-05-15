<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		@if(empty(Auth::user()) || (!empty(Auth::user()) && (Auth::user()->user_role_id == 2)))
			@if(!empty($subProjectDetails->header_image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $subProjectDetails->header_image))
				<?php $headerImage = "background: url('".TEMPLATE_IMG_URL . $subProjectDetails->header_image."'); background-size: cover;"; ?>
			@else
				<?php $headerImage = "background-color:#2ece2f; height:120px;"; ?>
			@endif
		@else
				<?php $headerImage = ""; ?>
		@endif
		<div class="kt-subheader kt-grid__item" id="kt_subheader" style="{{ $headerImage }}">
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
								 {{ trans("messages.book_plan.add") }}</span>
						</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
		  @if($subProjectDetails->editor_status == 1)
			{{$subProjectDetails->editor}}
		  @else
			
		    @if($subProjectDetails->subject_type == 0 || (!empty(Auth::user()) && Auth::user()->user_role_id == 1))
			  <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">

				<!--begin: Form Wizard Nav -->
				<div class="kt-wizard-v4__nav">

					<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
					<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable clickable_nav_items">
						<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" style="flex:1;">
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
									
									<?php 
										$selectedPlan	=	"";
										$selectedPlanPrice	=	"";
										$selectedOtherPlanPrice	=	"";
										$activePlanPrice	=	"";
										$selectedPlanPeriod	=	"";
										if(!empty(Auth::user()) && Auth::user()->user_role_id == 1){
											if($subProjectDetails->project_module	==	1){
												if($subProjectDetails->daily_status != 0){
													$planShowDailyStatus	=	1;
												}
												if($subProjectDetails->monthly_status != 0){
													$planShowMonthlyStatus	=	1;
												}
												if($subProjectDetails->yearly_status != 0){
													$planShowYearlyStatus	=	1;
												}
											}
										}else if(!empty(Auth::user()) && Auth::user()->user_role_id != 1){
											if($subProjectDetails->project_module	==	1){
												if($subProjectDetails->daily_status == 1){
													$planShowDailyStatus	=	1;
												}else{
													$planShowDailyStatus	=	0;
												}
												if($subProjectDetails->monthly_status == 1){
													$planShowMonthlyStatus	=	1;
												}else{
													$planShowMonthlyStatus	=	0;
												}
												if($subProjectDetails->yearly_status == 1){
													$planShowYearlyStatus	=	1;
												}else{
													$planShowYearlyStatus	=	0;
												}
											}
										}else{
											if($subProjectDetails->project_module	==	1){
												if($subProjectDetails->daily_status == 1){
													$planShowDailyStatus	=	1;
												}else{
													$planShowDailyStatus	=	0;
												}
												if($subProjectDetails->monthly_status == 1){
													$planShowMonthlyStatus	=	1;
												}else{
													$planShowMonthlyStatus	=	0;
												}
												if($subProjectDetails->yearly_status == 1){
													$planShowYearlyStatus	=	1;
												}else{
													$planShowYearlyStatus	=	0;
												}
											}
										}
										
										if(!empty($selectedDonationPlanData)){
										  if(!empty($selectedDonationPlanData['project_module']) && $selectedDonationPlanData['project_module'] == 1){
											if($selectedDonationPlanData['plan_type'] == "daily"){
												$selectedPlan	=	trans("messages.sub_project_detail.daily");
											}else if($selectedDonationPlanData['plan_type'] == "monthly"){
												$selectedPlan	=	trans("messages.sub_project_detail.monthly");
											}else if($selectedDonationPlanData['plan_type'] == "yearly"){
												$selectedPlan	=	trans("messages.sub_project_detail.yearly");
											}else{
												$selectedPlan	=	trans("messages.sub_project_detail.daily");
											}
											
											$selectedOtherPlanPrice	= !empty($selectedDonationPlanData['other_plan_price'])?$selectedDonationPlanData['other_plan_price']:'';
											if(empty($selectedOtherPlanPrice)){
												$selectedPlanPrice = !empty($selectedDonationPlanData['plan_price'])?$selectedDonationPlanData['plan_price']:'';
											}else{
												$selectedPlanPrice = "";
											}
											
											$selectedOtherPlanPeriod = !empty($selectedDonationPlanData['other_time_period'])?$selectedDonationPlanData['other_time_period']:'';
											if(empty($selectedOtherPlanPeriod)){
												$selectedPlanPeriod	= !empty($selectedDonationPlanData['time_period'])?$selectedDonationPlanData['time_period']:'';
											}else{
												$selectedPlanPeriod	=	"";
											}
										  }else if(!empty($selectedDonationPlanData['project_module']) && $selectedDonationPlanData['project_module'] == 2){
											$totalContributons = !empty($selectedDonationPlanData['total_contribution']) ? $selectedDonationPlanData['total_contribution']:0;
											
											if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 1)){
												$selectedProject	=	!empty($selectedDonationPlanData['default_project_plan'])?$selectedDonationPlanData['default_project_plan']:'';
											}else if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 3)){
												$selectedProject	=	!empty($selectedDonationPlanData['quantity_project_plan'])?$selectedDonationPlanData['quantity_project_plan']:'';
												$selectedProjectQuantity	=	!empty($selectedDonationPlanData['quantity'])?$selectedDonationPlanData['quantity']:1;
											}else if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 4)){
												$participateArray = $selectedDonationPlanData['Section'];
											}else{
												$participateArray = "";
												$selectedProject = "";
												$selectedProjectQuantity = 1;
											}
											
										  }else if(!empty($selectedDonationPlanData['project_module']) && $selectedDonationPlanData['project_module'] == 3){
											$totalContributons = !empty($selectedDonationPlanData['total_contribution']) ? $selectedDonationPlanData['total_contribution']:0;
											$extra_note = !empty($selectedDonationPlanData['extra_note']) ? $selectedDonationPlanData['extra_note']:0;
											if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 7)){
												$selectedProject	=	!empty($selectedDonationPlanData['dana_vendor'])?$selectedDonationPlanData['dana_vendor']:'';
											}else if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 6)){
												$selectedProject	=	!empty($selectedDonationPlanData['dana_property_plan'])?$selectedDonationPlanData['dana_property_plan']:'';
											}else if(!empty($selectedDonationPlanData['customize_plan_option']) && ($selectedDonationPlanData['customize_plan_option'] == 5)){
												$selectedProject	=	!empty($selectedDonationPlanData['dana_default_project_plan'])?$selectedDonationPlanData['dana_default_project_plan']:'';
											}
										  }
										  
										}else{
											$selectedPlan				=	"daily";
											$selectedPlanPrice			=	"";
											$selectedOtherPlanPrice		=	"";
											$selectedPlanPeriod			=	"";
											$selectedOtherPlanPeriod	=	"";
											$participateArray			=	"";
											$selectedProject			=	"";
											$totalContributons			=	0;
											$selectedProjectQuantity	=	1;
											$extra_note					=	"";
											
										}
										//pr($selectedDonationPlanData); die;
									?>
									
									<!--begin: Form Wizard Step 1-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
									 @if($subProjectDetails->project_module	==	1)
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												<div class="form-group form-group-marginless">
													<label>{{ trans("messages.sub_project_detail.choose_commitment_type")}}:</label>
													<div class="row">
													  @if($planShowDailyStatus != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','daily',($selectedPlan == "daily") ? 1 : '', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.days");}}
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		{{$subProjectDetails->daily_description}}
																	</span>
																</span>
															</label>
														</div>
													  @endif
													  @if($planShowMonthlyStatus != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','monthly',($selectedPlan == "monthly") ? 1 : '', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.months") }}
																		</span>
																	</span>
																	<span class="kt-option__body">
																		{{$subProjectDetails->monthly_description}}
																	</span>
																</span>
															</label>
														</div>
													  @endif
													  @if($planShowYearlyStatus != 0)
														<div class="col-lg-4">
															<label class="kt-option">
																<span class="kt-option__control">
																	<span class="kt-radio">
																		{{ Form::radio('plan_type','yearly',($selectedPlan == "yearly") ? 1 : '', ['class'=>'change_plan_type']) }}
																		<span></span>
																	</span>
																</span>
																<span class="kt-option__label">
																	<span class="kt-option__head">
																		<span class="kt-option__title">
																			{{ trans("messages.sub_project_detail.years") }}
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
													  @foreach($dailyPlanDetails as $key=>$dailyPlanDetail)
														@if(!empty($selectedDonationPlanData))
															@if($selectedPlanPrice == $dailyPlanDetail->id)
																<?php 
																	$activePlanPrice = Currency." ".$dailyPlanDetail->price;
																	$activeClass = "1";
																?>
															@else
																<?php 
																	$activeClass = ""; 
																?>
															@endif
														@else
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
														@endif
														<div class="kt-portlet__tab_block_options_item">
															{{ Form::radio('plan_price',$dailyPlanDetail->id, $activeClass, ['class'=>'plan_price', 'id'=>'tab_'.$key]) }}
															<label for="tab_{{$key}}">{{Currency." ".$dailyPlanDetail->price}}</label>
														</div>
													  @endforeach
													  @if($subProjectDetails->daily_plan_allow_other == 1)
														<div class="kt-portlet__tab_block_options_item">
															{{ Form::radio('plan_price','other', ($selectedPlanPrice == 'other')?$selectedPlanPrice:'', ['class'=>'plan_price', 'id'=>'allow_other']) }}
															<label for="allow_other">{{ trans("messages.sub_project_detail.others")}}</label>
														</div>
													  @endif
													</div>  
													<div class="col-6 form-group customized_plan_cls" style="display:none;">
														<label></label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
															{{ Form::text('other_plan_price', $selectedOtherPlanPrice, ['class'=>'form-control customized_plan alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_customized_plan")]) }}
															<span class="help-inline"></span>
														</div>
													</div>
													<span class="form-text text-muted">*<span class="selected_plan_price">{{$activePlanPrice}}</span> {{ trans("messages.book_plan.will_deduct_from_your_account_on") }} {{ trans("messages.sub_project_detail.".$selectedPlan)}} {{ trans('messages.sub_project_detail.basis') }}</span>
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
														@if(!empty($selectedDonationPlanData))
															@if($selectedPlanPeriod == $dailyPeriodDetail->id)
																<?php 
																	$activePeriod = "1";
																?>
															@else
																<?php 
																	$activePeriod = ""; 
																?>
															@endif
														@else
															@if($dailyPeriodDetail->is_primary == 1)
																<?php 
																	$activePeriod = "1";
																?>
															@else
																<?php 
																	$activePeriod = ""; 
																?>
															@endif
														@endif
														<label class="kt-radio" for="time_period_{{$key}}">
															{{ Form::radio('time_period',$dailyPeriodDetail->id, $activePeriod, ['class'=>'time_period', 'id'=>'time_period_'.$key]) }} {{trans($dailyPeriodDetail->quantity.' '.ucfirst(trans("messages.sub_project_detail.".$selectedPlan)))}}
															<span></span>
														</label>
													  @endforeach
													  @if($subProjectDetails->daily_period_allow_other == 1)
														<label class="kt-radio"for="time_period_other">
															{{ Form::radio('time_period','other','',['class'=>'time_period', 'id'=>'time_period_other']) }} {{ trans("messages.sub_project_detail.others")}}
															<span></span>
														</label>
													  @endif
													</div>
													<div class="col-6 form-group customized_period_cls" style="display:none;">
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
											</div>
										</div>
												
										@elseif($subProjectDetails->project_module	==	2)
										  @if($subProjectDetails->customize_plan_option == 1)
											<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
											<div class="kt-form__section kt-form__section--first">
												<div class="kt-wizard-v4__form">
													<div class="form-group">
														<label>{{ trans("messages.sub_project_detail.choose_project") }}:</label>
														<div class="row">
														@if(!empty($projectPlans))
														  @foreach($projectPlans as $key=>$projectPlan)
															@if(!empty($selectedProject))
																@if($selectedProject == $projectPlan->id)
																	<?php $checkedPlan	=	"1"; ?>
																@else
																	<?php $checkedPlan	=	""; ?>
																@endif
															@elseif($key == 0)
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
															{{ Form::number('total_contribution', !empty($totalContributons)?$totalContributons:0, ['class'=>'form-control','autocomplete'=>'off','min'=>'1']) }}
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
																	  <?php 
																	  if(!empty($seatDetails->total_booked_seat)){
																	   for($bookedSeatNumber = 1; $bookedSeatNumber <= $seatDetails->total_booked_seat; $bookedSeatNumber++){ ?>
																		@if(!empty($seatDetails->total_attendance) && ($seatDetails->total_attendance == $bookedSeatNumber))
																			<option selected value="{{$bookedSeatNumber}}">{{$bookedSeatNumber}}</option>
																		@else
																			<option value="{{$bookedSeatNumber}}">{{$bookedSeatNumber}}</option>
																		@endif
																	  <?php } } ?>
																	</select>
																</div>
															</div>
															
														</div>
													   @endforeach
													  @endif
														<?php /* <div class="form-group row">
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
														 */ ?>
														
														<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
														
													@endforeach
												 
													@if($subProjectDetails->seat_reservation_menual_contribution == 1)
														<div class="kt-heading kt-heading--md reservation_title_2">{{$subProjectDetails->seat_reservation_main_title_2}}</div>
														<div class="form-group"></div>
														<div class="form-group">
															<label>{{ trans('messages.dashboard.total_contributions') }}:</label>
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
																{{ Form::text('total_contribution', !empty($totalContributons)?$totalContributons:0, ['class'=>'form-control total_contribution_amt','autocomplete'=>'off', 'placeholder'=>'']) }}
																<span class="help-inline"></span>
															</div>
														</div>
													@endif
													
												 </div>
												</div>
											  @endif
										  @elseif($subProjectDetails->customize_plan_option == 3)
											@if(!empty($quantityPlans))
											 <div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }}</div>
											 <div class="kt-form__section kt-form__section--first">
												<div class="kt-wizard-v4__form">
													<div class="form-group">
														<div class="row">
															@foreach($quantityPlans as $key=>$quantityPlan)
																@if(!empty($selectedProject))
																	@if($selectedProject == $quantityPlan->id)
																		<?php $checkedQuantityPlan	=	"1"; ?>
																	@else
																		<?php $checkedQuantityPlan	=	""; ?>
																	@endif
																@elseif($key == 0)
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
																			<span class="kt-option__head quantity_plans_key_{{$key}}">
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
														{{ Form::number('quantity', !empty($selectedProjectQuantity)?$selectedProjectQuantity:1, ['class'=>'form-control plan_quantity','autocomplete'=>'off', 'placeholder'=>'', 'min'=>1]) }}
													</div>
													<div class="form-group">
														<label>{{ trans('messages.dashboard.total_contributions') }} :</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
															{{ Form::text('total_contribution', !empty($totalContributons)?$totalContributons:0, ['class'=>'form-control total_contribution','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1','readonly'=>true]) }}
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

													 @if(!empty($participateArray))
													  @foreach($participateArray as $participateRecord)
														<section class="form-group row delete_more_section_item_{{$counter}}" rel="{{$counter}}">
															<div data-repeater-list="" class="col-lg-12">
																<div data-repeater-item="" class="form-group row align-items-center">
																	<div class="col-md-5">
																		<div class="kt-form__group--inline">
																			<div class="kt-form__label">
																				<label>{{ trans("messages.sub_project_detail.participant_name") }}:</label>
																			</div>
																			<div class="kt-form__control">
																				{{ Form::text('Section['.$counter.'][name]', !empty($participateRecord['name'])?$participateRecord['name']:'', ['class'=>'form-control section_name', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_participant_name"), 'aria-describedby'=>'emailHelp']) }}
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
																					@if(!empty($participateRecord['section_plan']))
																						@if($participateRecord['section_plan'] == $sectionPlan->id)
																							<?php $selectedSectionPlan = "selected"; ?>
																						@else
																							<?php $selectedSectionPlan = ""; ?>
																						@endif
																					@else
																						<?php $selectedSectionPlan = ""; ?>
																					@endif
																					<option value="{{$sectionPlan->id}}" data-plan-price="{{$sectionPlan->price}}" {{$selectedSectionPlan}} >{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
																				  @endforeach
																				</select>

																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	@if($counter != 0)
																		<div class="col-md-2">
																			<div class="kt-form__label">
																				<label class="kt-label m-label--single"> </label>
																			</div>
																			<button type="button" onclick="deleteMoreSectionItem({{$counter}})" class="btn btn-label-danger btn-bold">
																				<i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}
																			</button>
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
																					<option value="">{{ trans("messages.sub_project_detail.select_section") }} </option>
																				  @foreach($sectionPlans as $sectionPlan)
																					<option value="{{$sectionPlan->id}}" data-plan-price="{{$sectionPlan->price}}">{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
																				  @endforeach
																				</select>
																				<span class="help-inline form-text section_plan_error"></span>
																			</div>
																		</div>
																		<div class="d-md-none kt-margin-b-10"> </div>
																	</div>

																	@if($counter != 0)
																		<div class="col-md-2">
																			<div class="kt-form__label">
																				<label class="kt-label m-label--single"> </label>
																			</div>
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
																<button type="button" onclick="addMoreSectionParticipate()" class="btn btn-bold btn-sm btn-label-brand btn_loader"><span class="flaticon2-plus">&nbsp;&nbsp;</span> {{ trans('messages.sub_project_detail.add_participant') }}</button>
															</div>
														</div>
													@endif
												</div>
											@endif
										  @endif
										
										@elseif($subProjectDetails->project_module	==	3)
											@if($subProjectDetails->customize_plan_option  == 5)
											  @if(!empty($danaDefaultPlans))
												<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_favorite_plan") }} </div>
												<div class="kt-form__section kt-form__section--first">
													<div class="kt-wizard-v4__form">
														<div class="form-group">
															<div class="row">
															  @foreach($danaDefaultPlans as $key=>$danaDefaultPlan)
																@if(!empty($selectedProject))
																	@if($selectedProject == $danaDefaultPlan->id)
																		<?php $checkedPlan	=	"1"; ?>
																	@else
																		<?php $checkedPlan	=	""; ?>
																	@endif
																@else
																	@if($danaDefaultPlan->is_primary == 1)
																		<?php $checkedPlan	=	"1"; ?>
																	@else
																		<?php $checkedPlan	=	""; ?>
																	@endif
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
													@if(!empty($selectedProject))
														@if($selectedProject == $danaProperyPlan->id)
															<?php $checkedPlan	=	"1"; ?>
														@else
															<?php $checkedPlan	=	""; ?>
														@endif
													@else
														@if($key == 0)
															<?php $checkedPlan	=	"1"; ?>
														@else
															<?php $checkedPlan	=	""; ?>
														@endif
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
														{{ Form::text('total_contribution', !empty($totalContributons)?$totalContributons:0, ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
													  </div>
													</div>
												</div>

												<div class="form-group ">
													<p style="padding-top: 25px"><label class="col-12 col-form-label">{{ trans("messages.sub_project_detail.additional_information") }}</label></p>
													<div class="col-12">
														{{ Form::textarea('extra_note', !empty($extra_note)?$extra_note:'', ['class'=>'form-control']) }}
													</div>
												</div>
												
											  @endif
												
											@elseif($subProjectDetails->customize_plan_option  == 7)
											  @if(!empty($vendorLists))
												<div class="kt-heading kt-heading--md"> {{ trans("messages.sub_project_detail.select_your_vendor") }} </div>
												<div class="row">
												  @foreach($vendorLists as $key=>$vendorList)
													@if(!empty($selectedProject))
														@if($selectedProject == $vendorList->id)
															<?php $checkedPlan	=	"1"; ?>
														@else
															<?php $checkedPlan	=	""; ?>
														@endif
													@else
														@if($key == 0)
															<?php $checkedPlan	=	"1"; ?>
														@else
															<?php $checkedPlan	=	""; ?>
														@endif
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
													<div class="col-12">
													  <div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
														{{ Form::text('total_contribution', !empty($totalContributons)?$totalContributons:0, ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'aria-describedby'=>'basic-addon1']) }}
													  </div>
													</div>
												</div>

											  @endif
												
											@endif
											
										@endif
											
										
									</div> 

									<!--end: Form Wizard Step 1-->


									<!--begin: Form Wizard Nav -->
									<div class="kt-wizard-v4__nav">

										<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
										<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable clickable_nav_items">
											<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" style="flex:1;">
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
										</div>
									</div>

									<!--begin: Form Wizard Step 2-->
									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.enter_your_personal_detail")}}</div>
										@if($subProjectDetails->contributor_type == "personal")
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.full_name")}}*:</label>
														{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'', 'ng-model'=>'full_name']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.ic_number_optional")}}:</label>
														{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('phone', '', ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_phone_number")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans('messages.cms_page_details.email') }}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<?php /* 
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.address_optional")}}</label>
															{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													<div class="form-group"></div>
													 */ ?>
													
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}*:</label>
															{{ Form::text('postcode', '', ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
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
														{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'', 'ng-model'=>'full_name']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.pic_ic_number_optional")}}:</label>
														{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
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
													<div class="col-12 form-group">
														<label>{{ trans("messages.sub_project_detail.company_name")}}*:</label>
														{{ Form::text('company_name', '', ['class'=>'form-control company_name','autocomplete'=>'off', 'placeholder'=>'']) }}
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_company_name")}}</span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.work_email")}}*:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">@</span></div>
															{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
													</div>
													<div class="col-6 form-group">
														<label>{{ trans("messages.sub_project_detail.company_registration_number_optional")}}:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
															{{ Form::text('registration_number', '', ['class'=>'form-control registration_number', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>'']) }}
														</div>
														<span class="form-text text-muted"></span>
													</div>
												</div>
												
												<div class="form-group"></div>
												
												<div class="row">
												
													<div class="col-xl-12">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.company_address_optional")}}</label>
															{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													
													<div class="form-group"></div>
													
													<div class="col-xl-6">
														<div class="form-group">
															<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
															{{ Form::text('postcode', '', ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
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
									
									<!--begin: Form Wizard Nav -->
									<div class="kt-wizard-v4__nav">
										<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
										<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable clickable_nav_items">
											<div class="kt-wizard-v4__nav-item" data-ktwizard-type="step" data-ktwizard-state="current" style="flex:1;">
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
										</div>
									</div>

									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">{{ trans("messages.sub_project_detail.select_payment_details")}}</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__form">
											
												<div class="form-group form-group-marginless">
												  <label>{{ trans("messages.sub_project_detail.choose_payment_option")}}:</label>
												  <div class="row">
													@if(!empty($paymentMethods))
													  @foreach($paymentMethods as $key=>$paymentMethod)
														<?php $selected = "";?>
														@if($key == 0)
															<?php $selected = "1";?>
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
																			{{$paymentMethod->name}} <!--(Recurring)-->
																		</span>
																		
																	</span>
																	<span class="kt-option__body">
																		{{$paymentMethod->description}}
																	</span>
																</span>
															</label>
														</div>
													  @endforeach
													@endif
													<div class="col-xl-6 refrence_id_block">
														<div class="form-group">
															<label>{{ trans("messages.book_plan.reference_id")}}:</label>
															{{ Form::text('refrence_id', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'', 'ng-model'=>'refrence_id']) }}
															<span class="form-text text-muted"></span>
														</div>
													</div>
													<div class="col-xl-6 refrence_id_block">
														<div class="form-group">
															<label>{{ trans("messages.book_plan.upload_receipt")}}:</label>
															{{ Form::file('receipt', ['class'=>'form-control', 'accept'=>'application/pdf,image/*']) }}
															<span class="form-text text-muted"></span>
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
									
									<!--begin: Form Wizard Nav -->
									<div class="kt-wizard-v4__nav">
										<!--doc: Remove "kt-wizard-v4__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
										<div class="kt-wizard-v4__nav-items kt-wizard-v4__nav-items--clickable clickable_nav_items">
											<div class="kt-wizard-v4__nav-item final_view_step" data-ktwizard-type="step" data-ktwizard-state="current" style="flex:1;">
												<div class="kt-wizard-v4__nav-body">
													<div class="kt-wizard-v4__nav-number">
														4
													</div>
													<div class="kt-wizard-v4__nav-label">
														<div class="kt-wizard-v4__nav-label-title">
															{{ trans("messages.book_plan.confirmation") }}
														</div>
														<div class="kt-wizard-v4__nav-label-desc">
															{{ trans("messages.book_plan.review_and_submit") }}
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">{{ trans("messages.book_plan.review_your_details_and_infaq")}}</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v4__review">
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														{{ trans("messages.book_plan.your_plan_details")}}
													</div>
													<div class="kt-wizard-v4__review-content">
													  @if($subProjectDetails->project_module == 1)
														{{ trans("messages.book_plan.commitment_type")}}: <span class="plan_type"></span><br />
														{{ trans("messages.book_plan.plan")}}: <span class="plan_price"></span><br />
														{{ trans("messages.book_plan.period")}}: <span class="plan_period"></span>
													  @elseif($subProjectDetails->project_module == 2)
														 @if($subProjectDetails->customize_plan_option == 1 || $subProjectDetails->customize_plan_option == 3)
															 {{ trans("messages.book_plan.plan")}}: <span class="project_plan_single"></span>
														 @else
															{{ trans("messages.book_plan.plan")}}: <span class="project_plan"></span>
														@endif
													  @elseif($subProjectDetails->project_module == 3)
														{{ trans("messages.book_plan.plan")}}: <span class="dana_project_plan"></span>
													  @endif
													</div>
												</div>
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														{{ trans("messages.book_plan.your_personal_info")}}
													</div>
													@if($subProjectDetails->contributor_type == "personal")
														<div class="kt-wizard-v4__review-content">
															{{ trans("messages.sub_project_detail.full_name")}}: <span class="full_name"></span><br />
															{{ trans("messages.book_plan.ic_number")}}: <span class="ic_number"></span><br />
															{{ trans("messages.sub_project_detail.phone_number")}}: <span class="phone"></span><br />
															{{ trans('messages.cms_page_details.email') }}: <span class="email"></span><br/>
															{{ trans("messages.book_plan.address")}}: <span class="address"></span><br />
															{{ trans("messages.sub_project_detail.postcode")}}: <span class="postcode"></span>
														</div>
													@else
														<div class="kt-wizard-v4__review-content">
															{{ trans("messages.sub_project_detail.pic_full_name")}}: <span class="full_name"></span><br />
															{{ trans("messages.sub_project_detail.pic_ic_number")}}: <span class="ic_number"></span><br />
															{{ trans("messages.book_plan.pic_phone_number")}}: <span class="phone"></span><br />
														</div>
														<div class="kt-wizard-v4__review-title">
															{{ trans("messages.book_plan.your_company") }}
														</div>
														<div class="kt-wizard-v4__review-content">
															{{ trans("messages.book_plan.company_name") }}: <span class="company_name"></span><br />
															{{ trans("messages.book_plan.company_registration_number") }}: <span class="registration_number"></span><br />
															{{ trans('messages.cms_page_details.email') }}: <span class="email"></span><br/>
															{{ trans("messages.book_plan.address")}}: <span class="address"></span><br />
															{{ trans("messages.sub_project_detail.postcode")}}: <span class="postcode"></span>
														</div>
													@endif
												</div>
												<div class="kt-wizard-v4__review-item">
													<div class="kt-wizard-v4__review-title">
														{{ trans("messages.book_plan.your_payment_details") }}
													</div>
													<div class="kt-wizard-v4__review-content">
														{{ trans("messages.book_plan.payment_options") }}: <span class="paymnet_option"></span><br />
													</div>
													<div class="kt-wizard-v4__review-content payment_amount_blk">
														{{ trans("messages.book_plan.total_amount") }}: <span class="total_payment_amount"></span><br />
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Form Wizard Step 4-->

									<!--begin: Form Actions -->
									<div class="kt-form__actions">
										
										<div class="terms_check_box">
											<input type="checkbox" name="terms" value="1" id="terms">&nbsp;&nbsp; <label for="terms">{{ trans('messages.cms_page_details.i_have_read_and_agree_to_the') }}</label>&nbsp;<a href="{{WEBSITE_URL}}projects/terms-and-conditions" class="agree" target="_blank"> <b>{{ trans("messages.book_plan.privacy_policy") }}</b></a>
										</div>
										
										<button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u final_submit_btn" onclick="createDonation()" disabled="disabled">
											{{ trans('messages.cms_page_details.submit') }}
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
			  
		    @else
			  <div class="kt-portlet">
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
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.full_name")}}*:</label>
											{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
										</div>
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.ic_number_optional")}}:</label>
											{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted"></span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.phone_number")}}*:</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">+6</span></div>
												{{ Form::text('phone', '', ['class'=>'form-control phone','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
											</div>
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_phone_number")}}</span>
										</div>
										<div class="col-6 form-group">
											<label>{{ trans('messages.cms_page_details.email') }}*:</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">@</span></div>
												{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
											</div>
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
										</div>
									</div>
									
									<div class="row">
									
										<div class="col-sm-8">
											<div class="form-group">
												<label>{{ trans("messages.sub_project_detail.address_optional")}}</label>
												{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
												<span class="form-text text-muted"></span>
											</div>
										</div>
										
										<div class="col-sm-4">
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
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.pic_full_name")}}*:</label>
											{{ Form::hidden('profile_type', '1', ['class'=>'form-control','autocomplete'=>'off']) }}
											{{ Form::text('full_name', '', ['class'=>'form-control full_name','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_full_name")}}</span>
										</div>
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.pic_ic_number_optional")}}:</label>
											{{ Form::text('ic_number', '', ['class'=>'form-control ic_number','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted"></span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-6 form-group">
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
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.company_name")}}*:</label>
											{{ Form::text('company_name', '', ['class'=>'form-control company_name','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_company_name")}}</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.work_email")}}*:</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">@</span></div>
												{{ Form::text('email', '', ['class'=>'form-control email','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'']) }}
											</div>
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_email")}}</span>
										</div>
										<div class="col-6 form-group">
											<label>{{ trans("messages.sub_project_detail.company_registration_number_optional")}}:</label>
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text">#</span></div>
												{{ Form::text('registration_number', '', ['class'=>'form-control registration_number', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>'']) }}
											</div>
											<span class="form-text text-muted"></span>
										</div>
									</div>
									
									<div class="row">
									
										<div class="col-sm-8 form-group">
											<label>{{ trans("messages.sub_project_detail.company_address_optional")}}</label>
											{{ Form::text('address', '', ['class'=>'form-control address','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted"></span>
										</div>
										
										<div class="col-sm-4 form-group">
											<label>{{ trans("messages.sub_project_detail.postcode")}}</label>
											{{ Form::text('postcode', '', ['class'=>'form-control postcode','autocomplete'=>'off', 'placeholder'=>'']) }}
											<span class="form-text text-muted">{{ trans("messages.sub_project_detail.please_enter_your_postcode")}}</span>
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
							@endif
						</div>
					</div>
				</div>
			   {{ Form::close() }}
			  </div>
			
		   @endif
		  @endif
		</div>
		<!-- end:: Content -->
	</div>
</div>

<style>
.btn-success:disabled {
    cursor: not-allowed;
}
</style>

<script>
//get dynamic plans or periods//
$(".change_plan_type").click(function(){
	var plan_type = $(this).val();
	var sub_project_id = $(".get_project_id").val();
	
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

$("#terms").change(function(){
	if($(this).is(':checked')){
		$(".final_submit_btn").attr("disabled",false);
	}else{
		$(".final_submit_btn").attr("disabled","disabled");
	}
})
</script>

<script>
function createDonation(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#book_plan_form')[0];
	
	$.ajax({
		url: '{{ route("User.saveDonation") }}',
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
				//location.reload();
				if(datas['billUrl'] == ""){
					window.location.href	 =	"{{ URL('invoice') }}/"+datas['invoiceId'];
				}else{
					window.location.href	 =	datas['billUrl'];
				}
			}else if(datas['success'] == 2){
				window.location.href	 =	"{{ URL('invoice') }}/"+datas['invoiceId'];
				
			}else {
				$('#loader_img').hide();
				$.each(datas['errors'],function(index,html){
					if(index == "page_name"){
						$(".name_error").addClass('error');
						$(".name_error").html(html);
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
			
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}

function createDonationEnquiry(){
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
				window.location.href	 =	"{{ URL('/dashboard') }}";
			}else if(datas['success'] == 2) {
				$('#sign_up_popup').modal({backdrop: 'static', keyboard: false}) 
				window.localStorage.setItem('isDashboard', '1');
			}else {
				$.each(datas['errors'],function(index,html){
					$("input[name = "+index+"]").next().addClass('error');
					$("input[name = "+index+"]").next().html(html);
					
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
			startStep: '<?php echo !empty($selectedDonationPlanData)? 2:1; ?>', // initial active step number
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
					required: true,
					number: true
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
				dana_propery_plan: {
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

			//initWizard();
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
	if($(".payment_method_change").val() == 1 || $(".payment_method_change").val() == 2 || $(".payment_method_change").val() == 3 || $(".payment_method_change").val() == 4 || $(".payment_method_change").val() == 6){
		$(".refrence_id_block").show();
	}else{
		$(".refrence_id_block").hide();
	}

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
            $(".selected_plan_price").text($(elm).text());
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
	if($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3 || $(this).val() == 4 || $(this).val() == 6){
		$(".refrence_id_block").show();
	}else{
		$(".refrence_id_block").hide();
	}
})

$(".payment_amount_blk").hide();
$(".form-control").on('blur', function(){
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
	if($("input[name=total_contribution]").val() != "" && typeof($("input[name=total_contribution]").val()) != "undefined"){
		$(".payment_amount_blk").show();
		$(".total_payment_amount").text(Currency + $("input[name=total_contribution]").val());
	}else{
		$(".payment_amount_blk").hide();
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
			$(".project_plan_single").text($("."+radioID).text());
		}
	});
	
	//quantity-special project
	$(".quantity_project_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			$(".project_plan_single").html($("."+radioID).html());
			$(".payment_amount_blk").show();
			//$(".total_payment_amount").text($("."+radioID).find(".kt-option__focus").text());  
		}
	});
	
	//dana-lastari default plan project
	$(".dana_default_project_plan").each(function(val, elements){
		if ($(this).is(':checked')){
			var radioID = $(this).attr('id');
			var radioAmount = $("."+radioID).next(".kt-option__focus").text();
			$(".dana_project_plan").text($("."+radioID).text()+" - "+radioAmount);
			
			$(".payment_amount_blk").show();
			$(".total_payment_amount").text(radioAmount);
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
		
	//participate selected
	$(".project_plan").text("");
	PlanPrice	=	0;
	$(".get_dynamic_participate_block section").each(function(val, elements){
		counter = $(this).attr('rel');
		if(counter == 0){
			Numbers = 1;
		}else{
			Numbers = Number(counter) + 1;
		}
		Name = $('input:text[name="Section['+counter+'][name]"]').val();
		Plan = $('select[name="Section['+counter+'][section_plan]"]').find(':selected').text();
		SecPrice = $('select[name="Section['+counter+'][section_plan]"]').find(':selected').attr("data-plan-price");
		if(SecPrice != '' && SecPrice != "undefined"){
			PlanPrice += Number(SecPrice);
		}
		$(".project_plan").append("<br >"+Numbers+". "+Name+" - "+Plan);
	});
	if(PlanPrice != ''){
		$(".payment_amount_blk").show();
		$(".total_payment_amount").text(Currency + PlanPrice);
	}
	
	//seat reservation
	ReservAmount = 0;
	$(".seat_reservation_title_blk").each(function(val, elements){
		seatReservationTitle = $(this).text();
		$(".project_plan").append(seatReservationTitle+"<br>");
		KeyID = $(this).attr('rel');
		$(".seat_reservation_name_price_"+KeyID).each(function(val, elements){
			seatReservationName = $(this).text();
			ReservID = $(this).attr('rel');
			totalSeat = $('select[name="SeatReservation['+ReservID+'][total_seat]"]').val();
			if(totalSeat != ''){
				ReservAmount += parseInt(($(this).attr('data-price')*totalSeat), 10);
				$(".project_plan").append(seatReservationName+"x"+totalSeat+"<br>");
			}
		})
		$(".project_plan").append("<br>"); 
	});
	
	if(ReservAmount != '' && typeof(ReservAmount) != "undefined"){
		ReservAmount = parseInt((Number(ReservAmount)+Number($("input[name=total_contribution]").val())), 10);
		$(".payment_amount_blk").show();
		$(".total_payment_amount").text(Currency + ReservAmount);
		$(".project_plan").append($(".reservation_title_2").text()+": "+$("input[name=total_contribution]").val());
	}
	
	/* var paymentMethod = $(".payment_method_change").val();
	if(paymentMethod == 1){
		var selectedPAymentMethod = "QR Pay";
	}else if(paymentMethod == 2){
		var selectedPAymentMethod = "Cheque";
	}else if(paymentMethod == 3){
		var selectedPAymentMethod = "CDM";
	}else if(paymentMethod == 4){
		var selectedPAymentMethod = "Bank Transfer";
	}else if(paymentMethod == 5){
		var selectedPAymentMethod = "Online Banking";
	}else if(paymentMethod == 6){
		var selectedPAymentMethod = "Credit/Debit Card";
	}else{
		var selectedPAymentMethod = "";
	}
	$(".paymnet_option").text(selectedPAymentMethod); */
	
	
})

//

$(document.body).on('click', '.default_project_plan' ,function(){
	$(".default_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".project_plan_single").text($("."+radioID).text());
	}
})

//quantity-special project
$(document.body).on('click', '.quantity_project_plan' ,function(){
	$(".quantity_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		$(".project_plan_single").html($("."+radioID).html());
		$(".payment_amount_blk").show();
		
	}
})

//dana-lastari default plan project
$(document.body).on('click', '.dana_default_project_plan' ,function(){
	$(".dana_default_project_plan").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		var radioID = $(this).attr('id');
		var radioAmount = $("."+radioID).next(".kt-option__focus").text();
		$(".dana_project_plan").text($("."+radioID).text()+" - "+radioAmount);
	}
    $(".payment_amount_blk").show();
	$(".total_payment_amount").text(radioAmount); 
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
			
			/* var TotalValue = Number(0);
			$(".guest_section .package_price").each(function() {
				if($(this).val() != ""){
					TotalValue += parseFloat($(this).val());
				}
			});
			$("#totalPriceId").val(TotalValue);
			var totalGuest = Number(counter) + 1;
			var DefaultDeposite = '';
			var TotalDepositeAmount = Number(DefaultDeposite) * Number(totalGuest);
			$("#totalDepositeId").val(TotalDepositeAmount); */
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

</script>

<script>
$(document).ready(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(".plan_quantity").val());
	$(".total_payment_amount").text(SelectedPlanPrice * $(".plan_quantity").val());  
})

$(".quantity_project_plan").change(function(){
	SelectedPlanPrice = $(this).attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(".plan_quantity").val());
	$(".total_payment_amount").text(SelectedPlanPrice * $(".plan_quantity").val());  
})

$(".plan_quantity").change(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(this).val());
	$(".total_payment_amount").text(SelectedPlanPrice * $(this).val());  
})

$(".plan_quantity").keyup(function(){
	SelectedPlanPrice = $('input[name="quantity_project_plan"]:checked').attr("data-quantity-plan-price");
	$(".total_contribution").val(SelectedPlanPrice * $(this).val());
	$(".total_payment_amount").text(SelectedPlanPrice * $(this).val());  
})

</script>


<script>
var KTWizard5 = function () {
	// Base elements
	var formE2;
	var validator;

	var initValidation = function() {
		validator = formE2.validate({
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
				createDonationEnquiry();
			}
		});
	} 

	return {
		// public functions
		init: function() {
			formE2 = $('#inquiryForm');

			initValidation();
			//initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard5.init();
});

</script>

