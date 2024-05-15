@extends('front.layouts.default')
@section('content')

<?php /* <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"> */ ?>


<script src="{{ WEBSITE_JS_URL }}pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>


<script>
/* $(function(){
	$('.search_by_date').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD',
		changeMonth: true,
		changeYear : true,
		weekStart : 0,
		time: false,
		nowButton : true,
		switchOnClick : true,
		yearRange: '-100:+100',
		maxDate : new Date()  
		//minDate : new Date()  
	});
	
}); */
</script>


<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader kt-grid__item" id="kt_subheader">
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
							<a href="#" class="kt-subheader__breadcrumbs-link">
								{{$subProjectDetails->project_module_name}} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<span class="kt-subheader__breadcrumbs-link">
								{{$subProjectDetails->sub_project_name}} </span>
						</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<?php $queryString = Request::getQueryString(); ?>
						<a href="{{route('User.exportProjectExcel',array($subProjectDetails->slug,$queryString))}}" class="btn kt-subheader__btn-secondary">
							{{ trans("messages.language_settings.reports") }}
						</a>
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
					
					<div class="kt-portlet__head kt-portlet__head--lg">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon">
								<i class="kt-font-brand flaticon2-line-chart"></i>
							</span>
							<h3 class="kt-portlet__head-title">
								{{$subProjectDetails->sub_project_name}} {{ trans('messages.sub_project_lists.list') }}
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<a href="{{ URL::previous() }}" class="btn btn-clean btn-icon-sm">
									<i class="la la-long-arrow-left"></i>
									{{ trans('messages.sub_project_lists.back') }}
								</a>
								&nbsp;
								&nbsp;
								<div class="dropdown dropdown-inline">
								  @if(($subProjectDetails->project_module == 1 && !empty($addAnsarValGlobal)) || ($subProjectDetails->project_module == 2 && !empty($addSpecialProjectValGlobal)) || ($subProjectDetails->project_module == 3 && !empty($addDanaProjectValGlobal)))
									<a href="{{ route('user.book_plan',$subProjectDetails->slug) }}" class="btn btn-brand btn-icon-sm">
										<i class="flaticon2-plus"></i> {{ trans('messages.sub_project_lists.add_new') }}
									</a>
								  @endif
								</div>
							</div>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="row">
							<div class="col-sm-6">
								<div class="kt-widget12">
									<div class="kt-widget12__content">
										<div class="kt-widget12__item">
											<div class="kt-widget12__info">
												<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.total_contribution_funds")}}</span>
												<span class="kt-widget12__value">{{Currency}} {{!empty($totalApprovedContribution)? number_format($totalApprovedContribution,2):0}}</span>
											</div>
											<div class="kt-widget12__info">
												<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.target_achieve")}}</span>
												<div class="kt-widget12__progress">
													<div class="progress kt-progress--sm">
														<div class="progress-bar kt-bg-brand"
															role="progressbar"
															style="width: {{$targetAchive}}%;"
															aria-valuenow="100"
															aria-valuemin="0"
															aria-valuemax="100"></div>
													</div>
													<span class="kt-widget12__stat">
														{{$targetAchive}}%
													</span>
												</div>
											</div>
										</div>
										<div class="kt-widget12__item">
											<div class="kt-widget12__info">
												<span class="kt-widget12__desc">{{ trans('messages.sub_project_lists.pending_payments') }}</span>
												<span class="kt-widget12__value">{{number_format($totalPendingPayments,2)}}</span>
											</div>
											<div class="kt-widget12__info">
												<span class="kt-widget12__desc">{{ trans('messages.dashboard.waiting_approval') }}</span>
												<span class="kt-widget12__value">{{number_format($totalWaitingApprovalPayments,2)}}</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="kt-widget16">
									<div class="kt-widget16__items">
										<div class="kt-widget16__item">
											<span class="kt-widget16__sceduled">
												{{ trans('messages.dashboard.type') }}
											</span>
											<span class="kt-widget16__amount">
												{{ trans('messages.dashboard.amount') }}
											</span>
										</div> <?php //pr($pieChartData);?>
										@if(!empty($pieChartData))
										  @foreach($pieChartData as $pieChartRecord)
											@if(!empty($pieChartRecord['amount']))
												<div class="kt-widget16__item">
													<span class="kt-widget16__date">
														{{ucfirst($pieChartRecord['name'])}}
													</span>
													<span class="kt-widget16__price  kt-font-{{ !empty($pieChartRecord['color'])?$pieChartRecord['color']:'success' }}">
														{{Currency}} {{ !empty($pieChartRecord['amount'])? number_format($pieChartRecord['amount'],2):0; }}
													</span>
												</div>
											@endif
										  @endforeach
										@endif
										
									</div>
									
									<div class="kt-widget16__stats">
										<div class="kt-widget16__visual">
											<div id="kt_chart_revenue_change"
												style="height: 160px; width: 160px; margin:0 0 0 80px">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<div class="kt-portlet__body">

						<!--begin: Search Form -->
						{{ Form::open(['role' => 'form','url' => "/infaq/".$subProjectDetails->slug,'method'=>'get','files'=>'true', 'class' => 'kt-form','id'=>"saveAppSettingForm"]) }}
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							<div class="row align-items-center">
								<div class="col-xl-12 order-2 order-xl-1">
									<div class="row align-items-center">
									
										<div class="col-md-2 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												{{ Form::text('keyword', !empty($searchVariable['keyword'])?$searchVariable['keyword']:'', ['class'=>'form-control','autocomplete'=>'off','id'=>'generalSearch', 'placeholder'=> trans('messages.sub_project_lists.search')]) }}
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
										
										<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left" id="kt_daterangepicker_61">
												{{ Form::text('filterdate', !empty($searchVariable['filterdate'])?$searchVariable['filterdate']:'', ['class'=>'form-control ','autocomplete'=>'off', 'placeholder'=> trans('messages.sub_project_lists.date')]) }}
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-calendar"></i></span>
												</span>
											</div>
										</div>
										
										<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>{{ trans('messages.dashboard.status') }}:</label>
												</div>
												<div class="kt-form__control">
													{{ Form::select('status',array('1'=>'Waiting Approval','2'=>'Success','3'=>'Pending','5'=>'Expired') , !empty($searchVariable['status'])?$searchVariable['status']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.sub_project_lists.nothing_selected')]) }}
												</div>
											</div>
										</div> 
										
										<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>{{ trans('messages.dashboard.payment_option') }}:</label>
												</div>
												<div class="kt-form__control">
													{{ Form::select('payment_method',$paymentMethods , !empty($searchVariable['payment_method'])?$searchVariable['payment_method']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.sub_project_lists.nothing_selected')]) }}
												</div>
											</div>
										</div> 
										
										@if($subProjectDetails->project_module == 1)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans('messages.dashboard.type') }}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('plan_type',array('daily'=>'Daily','monthly'=>'Monthly','yearly'=>'Yearly') , !empty($searchVariable['plan_type'])?$searchVariable['plan_type']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div> 
											
										@elseif($subProjectDetails->project_module == 2)
										  @if($subProjectDetails->customize_plan_option == 1)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('default_project_plan', $planLists, !empty($searchVariable['default_project_plan'])?$searchVariable['default_project_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div> 
										  @elseif($subProjectDetails->customize_plan_option == 2)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('special_project_seat_plan', $planLists, !empty($searchVariable['special_project_seat_plan'])?$searchVariable['special_project_seat_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div> 
										  @elseif($subProjectDetails->customize_plan_option == 3)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('quantity_project_plan', $planLists, !empty($searchVariable['quantity_project_plan'])?$searchVariable['quantity_project_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div> 
										  @elseif($subProjectDetails->customize_plan_option == 4)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('special_project_section_plan', $planLists, !empty($searchVariable['special_project_section_plan'])?$searchVariable['special_project_section_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div> 
										  @endif
										@elseif($subProjectDetails->project_module == 3)
										  @if($subProjectDetails->customize_plan_option == 5)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('dana_default_project_plan', $planLists, !empty($searchVariable['dana_default_project_plan'])?$searchVariable['dana_default_project_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div>
										  @elseif($subProjectDetails->customize_plan_option == 6)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('dana_property_plan', $planLists, !empty($searchVariable['dana_property_plan'])?$searchVariable['dana_property_plan']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div>
										  @elseif($subProjectDetails->customize_plan_option == 7)
											<div class="col-md-3 kt-margin-b-20 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-form__group kt-form__group--inline">
													<div class="kt-form__label">
														<label>{{ trans("messages.book_plan.plan")}}:</label>
													</div>
													<div class="kt-form__control">
														{{ Form::select('dana_vendor', $vendorLists, !empty($searchVariable['dana_vendor'])?$searchVariable['dana_vendor']:'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans('messages.admin_dashboard.all')]) }}
													</div>
												</div>
											</div>
										  @endif
										@endif
										<button type="submit" class="btn btn-success">{{ trans('messages.sub_project_lists.search') }}</button>&nbsp;
										<a href="{{route('user.sub_project_lists',$subProjectDetails->slug)}}" class="btn btn-danger">{{ trans('messages.sub_project_lists.reset') }}</a>
									</div>
								</div>
								
							</div>
						</div>
						{{ Form::close() }}
						<!--end: Search Form -->
					</div>
					
					<div class="cover_content_table_block">
					  <div class="kt-portlet__body kt-portlet__body--fit">

						<!--begin: Datatable -->
						<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable  kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
						  <table class="kt-datatable__table" style="display: block;height: auto;">
							<thead class="kt-datatable__head">
								<tr class="kt-datatable__row" style="left: 0px;">
									<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 30px;"></span>
									</th>
									<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 40px;">#</span>
									</th>
									<th data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans('messages.personal_information.full_name') }}</span>
									</th>
									@if($subProjectDetails->project_module == 1)
										<th data-field="CommitmentType" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
											<span style="width: 140px;">{{ trans("messages.book_plan.commitment_type")}}</span>
										</th>
										<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
											<span style="width: 200px;">{{ trans('messages.sub_project_lists.plan_total_contribution') }}</span>
										</th>
										<th data-field="Period" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
											<span style="width: 100px;">{{ trans("messages.book_plan.period")}}</span>
										</th>
									@elseif($subProjectDetails->project_module == 2)
										@if($subProjectDetails->customize_plan_option == 1)
											<th data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.sub_project_lists.project_plan') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 200px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@elseif($subProjectDetails->customize_plan_option == 2)
											<th data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.sub_project_lists.project_plan') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 200px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@elseif($subProjectDetails->customize_plan_option == 3)
											<th data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 140px;">{{ trans('messages.sub_project_lists.project_plan') }}</span>
											</th>
											<th data-field="Quantity" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 100px;">{{ trans("messages.sub_project_detail.quantity") }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 200px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@elseif($subProjectDetails->customize_plan_option == 4)
											<th data-field="Participate" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 140px;">{{ trans('messages.sub_project_lists.no_of_participate') }}</span>
											</th>
											<th data-field="Session" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.sub_project_lists.session') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 140px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@endif
									@elseif($subProjectDetails->project_module == 3)
										@if($subProjectDetails->customize_plan_option == 5)
											<th data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.sub_project_lists.project_plan') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 200px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@elseif($subProjectDetails->customize_plan_option == 6)
											<th data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 150px;">{{ trans('messages.sub_project_lists.project_plan') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@elseif($subProjectDetails->customize_plan_option == 7)
											<th data-field="Vendor" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 150px;">{{ trans('messages.sub_project_lists.vendor') }}</span>
											</th>
											<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
												<span style="width: 160px;">{{ trans('messages.dashboard.total_contribution') }}</span>
											</th>
										@endif
									@endif
									<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 100px;">{{ trans('messages.dashboard.date') }}</span>
									</th>
									<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sorted" data-sort="asc">
										<span style="width: 120px;">{{ trans('messages.dashboard.status') }}<i class="flaticon2-arrow-up"></i></span>
									</th>
									<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 120px;">{{ trans("messages.admin_dashboard.actions") }}</span>
									</th>
								</tr>
							</thead>
							<tbody style="height: auto;" class="kt-datatable__body ps--active-y">
							@if(!empty($result))
							  <?php $i = 1; ?>
							  @foreach($result as $key=>$record)
								<tr data-row="0" class="kt-datatable__row" style="left: 0px;">
									<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 30px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details">
													
													<!--begin::Accordion-->
													<div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
														<div class="card">
															<div class="card-header get_donation_invoice_list" data-order-id="{{$record->id}}" id="headingTwo{{$key}}">
																<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo{{$key}}" aria-expanded="false" aria-controls="collapseTwo{{$key}}">
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24"/>
																			<path d="M9.82866499,18.2771971 L16.5693679,12.3976203 C16.7774696,12.2161036 16.7990211,11.9002555 16.6175044,11.6921539 C16.6029128,11.6754252 16.5872233,11.6596867 16.5705402,11.6450431 L9.82983723,5.72838979 C9.62230202,5.54622572 9.30638833,5.56679309 9.12422426,5.7743283 C9.04415337,5.86555116 9,5.98278612 9,6.10416552 L9,17.9003957 C9,18.1765381 9.22385763,18.4003957 9.5,18.4003957 C9.62084305,18.4003957 9.73759731,18.3566309 9.82866499,18.2771971 Z" fill="#000000"/>
																		</g>
																	</svg>
																</div>
															</div>
															
														</div>
													</div>
													<!--end::Accordion-->

												</div>
											</div>
										</span>
									</td>
									<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 40px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$i;}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details">
													<a href="#" class="kt-user-card-v2__name">{{$record->full_name}}</a>
													<span class="kt-user-card-v2__desc">{{$record->phone}}</span><br />	
													<span class="kt-user-card-v2__desc">{{$record->email}}</span>	
												</div>
											</div>
										</span>
									</td>
									@if($subProjectDetails->project_module == 1)
										<td data-field="CommitmentType" data-autohide-disabled="false" class="kt-datatable__cell">
											<span style="width: 140px;">                        
												<div class="kt-user-card-v2">                            
													<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
														{{ ($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->plan_type) }}</a>
													</div>
												</div>
											</span>
										</td>
										<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
											<span style="width: 200px;">                        
												<div class="kt-user-card-v2">                            
													<div class="kt-user-card-v2__details">
														<a href="#" class="kt-user-card-v2__name">
															{{CURRENCY}} {{!empty($record->other_plan_price) ? number_format($record->other_plan_price,2) : number_format($record->plan_price,2); }}
														</a>
													</div>
												</div>
											</span>
										</td>
										<td data-field="Period" data-autohide-disabled="false" class="kt-datatable__cell">
											<span style="width: 100px;">                        
												<div class="kt-user-card-v2">                            
													<div class="kt-user-card-v2__details">
														<a href="#" class="kt-user-card-v2__name">
															{{!empty($record->other_time_period) ? $record->other_time_period : $record->time_period; }}
															@if($record->plan_type == "daily")
																{{ trans('messages.sub_project_lists.days') }}
															@elseif($record->plan_type == "monthly")
																{{ trans('messages.sub_project_lists.months') }}
															@elseif($record->plan_type == "yearly")
																{{ trans('messages.sub_project_lists.years') }}
															@endif
														</a>
													</div>
												</div>
											</span>
										</td>
									@elseif($subProjectDetails->project_module == 2)
										@if($subProjectDetails->customize_plan_option == 1)
											<td data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 140px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
															{{ ($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->default_project_plan_name) }}</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 200px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : 0; }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@elseif($subProjectDetails->customize_plan_option == 2)
											<td data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 160px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
														<?php $totalAmountOfSeat = 0; ?>
														@if($record->is_enquiry == 1)
															{{ trans('messages.edit_book_plan.enquiry') }}
														@else
															@if(!empty($record->ReservationArray) && (count($record->ReservationArray) > 0))
															  @foreach($record->ReservationArray as $reservationSeats)
																<span class="kt-user-card-v2__name">
																	{{$reservationSeats->seat_name}} x {{$reservationSeats->total_seat}}
																</span>
																<?php $totalAmountOfSeat += $reservationSeats->amount; ?>
															  @endforeach
															@else
																<span class="kt-user-card-v2__name">
																	{{ trans("messages.project_template.seat_reservation") }}
																</span>
															@endif
														@endif
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 200px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : number_format($totalAmountOfSeat,2); }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@elseif($subProjectDetails->customize_plan_option == 3)
											<td data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 140px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
															{{ ($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->quantity_project_plan_name) }}</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="Quantity" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 100px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{!empty($record->quantity) ? $record->quantity : ''; }}
															</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 200px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : 0; }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@elseif($subProjectDetails->customize_plan_option == 4)
											<td data-field="Participate" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 140px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																@if($record->is_enquiry == 1)
																	{{ trans('messages.edit_book_plan.enquiry') }}
																@else
																	{{!empty($record->TotalParticipates) ? $record->TotalParticipates : '-'; }}
																@endif
															</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="Session" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 160px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<?php $totalAmountOfParticipate = 0; ?>
															@if(!empty($record->ParticipateArray))
															  @foreach($record->ParticipateArray as $paricipateArray)
																<span class="kt-user-card-v2__name">
																	{{!empty($paricipateArray->section_name) ? $paricipateArray->section_name : ''; }}
																	<?php $totalAmountOfParticipate += $paricipateArray->price; ?>
																</span>
															  @endforeach
															@endif 
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 140px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : number_format($totalAmountOfParticipate,2); }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@endif
									@elseif($subProjectDetails->project_module == 3)
										@if($subProjectDetails->customize_plan_option == 5)
											<td data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 160px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
															{{ ($record->is_enquiry == 1) ? trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_default_project_plan_name) }}</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 200px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : 0; }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@elseif($subProjectDetails->customize_plan_option == 6)
											<td data-field="ProjectPlan" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 150px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
															{{ ($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_property_plan_name) }}</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 160px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : 0; }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@elseif($subProjectDetails->customize_plan_option == 7)
											<td data-field="Vendor" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 150px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">
															{{ ($record->is_enquiry == 1) ?  trans('messages.edit_book_plan.enquiry') : ucfirst($record->dana_vendor_name) }}</a>
														</div>
													</div>
												</span>
											</td>
											<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
												<span style="width: 160px;">                        
													<div class="kt-user-card-v2">                            
														<div class="kt-user-card-v2__details">
															<a href="#" class="kt-user-card-v2__name">
																{{CURRENCY}} {{!empty($record->total_contribution) ? number_format($record->total_contribution,2) : 0; }}
															</a>
														</div>
													</div>
												</span>
											</td>
										@endif
									@endif
									<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
										<span style="width: 100px;">
											<span class="kt-font-bold">{{!empty($record->created_at) ? date("d/m/Y",strtotime($record->created_at)):"";}}</span>
										</span>
									</td>
									<td data-field="Status" class="kt-datatable__cell">
										<span style="width: 120px;">
										@if($record->main_payment_status == 1)
											<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill badge_{{$record->id}}">
											{{ trans('messages.dashboard.waiting_approval') }}</span>
										@elseif($record->main_payment_status == 2)
											<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill badge_{{$record->id}}">
											{{ trans('messages.dashboard.success') }}</span>
										@elseif($record->main_payment_status == 3)
											<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill badge_{{$record->id}}">
											{{ trans('messages.dashboard.pending') }}</span>
										@elseif($record->main_payment_status == 5)
											<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill badge_{{$record->id}}">
											{{ trans('messages.dashboard.expired') }}</span>
										@else
											<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill badge_{{$record->id}}">
											{{ trans('messages.dashboard.not_paid') }}</span>
										@endif
										</span>
									</td>
									<td data-field="Actions" class="kt-datatable__cell">
										
										<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
											<div class="dropdown">
												<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
													<i class="flaticon-more-1"></i>                            
												</a>                            
												<div class="dropdown-menu dropdown-menu-right">                                
													<ul class="kt-nav">                                    
														<?php /* <li class="kt-nav__item">
															<a href="#" class="kt-nav__link"> 
																<i class="kt-nav__link-icon flaticon2-expand"></i>
																<span class="kt-nav__link-text">View</span>
															</a>                                    
														</li>                                
													  @if($editaccountValGlobal != 0)	
														@if($record->is_active == 1)
														<li class="kt-nav__item"> 
															<a href="{{URL('/change-status-sales-person/'.$record->slug.'/0')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-drop"></i>
																<span class="kt-nav__link-text">InActive</span>
															</a>
														</li> 
														@else
														<li class="kt-nav__item"> 
															<a href="{{URL('/change-status-sales-person/'.$record->slug.'/1')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-drop"></i>
																<span class="kt-nav__link-text">Active</span>
															</a>
														</li>
														@endif
													  @endif */ ?> 
														@if($record->is_recurring == 1)
															<li class="kt-nav__item">
																<a href="{{ route('User.cancelRecurringPlan',$record->unique_donation_id) }}" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-cancel-music"></i>
																	<span class="kt-nav__link-text">
																	{{ trans('messages.sub_project_lists.cancel_recurring_plan') }}</span>
																</a> 
															</li>
														@endif
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon-download"></i>
																<span class="kt-nav__link-text">
																{{ trans('messages.sub_project_lists.export_individual_donator_payment_history') }}</span>
															</a> 
														</li>
														@if($record->is_enquiry == 0)
															<li class="kt-nav__item">
																<a href="{{ route('User.sendRemainder',$record->unique_donation_id) }}" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-mail-1"></i>
																	<span class="kt-nav__link-text">{{ trans('messages.sub_project_lists.send_reminder') }}</span>
																</a> 
															</li>
														@endif
													</ul>
												</div>
											</div>  
											@if(($subProjectDetails->project_module == 1 && !empty($editAnsarValGlobal)) || ($subProjectDetails->project_module == 2 && !empty($editSpecialProjectValGlobal)) || ($subProjectDetails->project_module == 3 && !empty($editDanaProjectValGlobal)))
											<a href="{{URL('/edit-donation-plan/'.$subProjectDetails->slug.'/'.$record->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
												<i class="la la-edit"></i>
											</a> 
											@endif
											
											@if(($subProjectDetails->project_module == 1 && !empty($deleteAnsarValGlobal)) || ($subProjectDetails->project_module == 2 && !empty($deleteSpecialProjectValGlobal)) || ($subProjectDetails->project_module == 3 && !empty($deleteDanaProjectValGlobal)))
											<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$subProjectDetails->slug.'/'.$record->unique_donation_id)}}">
												<i class="la la-trash"></i>
											</a> 
											@endif
											
										</span>
										
									</td>
								</tr>
								
								<tr class="kt-datatable__row kt-datatable__row--even dropdown">
								  <td colspan="7">
									<div id="collapseTwo{{$key}}" class="collapse" aria-labelledby="headingTwo{{$key}}" data-parent="#accordionExample7">
										<div class="card-body">
											<div class="kt-section__content dynamic_invoice_list_{{$record->id}}">
												
											</div>
										</div>
									</div>
								  </td>
								</tr>
								
								<?php $i++; ?>
							  @endforeach
							@endif
						
							</tbody>
						  </table>
						<div class="kt-datatable__pager kt-datatable--paging-loaded">
						 @include('pagination.front', ['paginator' => $result])
						
						</div>
						</div>

						<!--end: Datatable -->
						</div>
					</div>
					
					
					
				</div>
				
			</div>


	
		

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>

<script>
$('#kt_daterangepicker_61').daterangepicker({
	buttonClasses: ' btn',
	applyClass: 'btn-primary',
	cancelClass: 'btn-secondary',

	// startDate: start,
	// endDate: end,
	ranges: {
	   'Today': [moment(), moment()],
	   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	   'This Month': [moment().startOf('month'), moment().endOf('month')],
	   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	}
}, function(start, end, label) {
	$('#kt_daterangepicker_61 .form-control').val( start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
});



$(".get_donation_invoice_list").click(function(){
	var guestId = $(this).attr("data-order-id");
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("user.get_donation_invoice_table") }}',
		type:'POST',
		data: {'order_id':$(this).attr("data-order-id")},
		success: function(response){
			$('#loader_img').hide();
			$(".dynamic_invoice_list_"+guestId).html(response);
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
	
})


/* $(".get_guest_list").click(function(){
	var salesPersonId = $(this).attr("data-sales-id");
	
	$('#loader_img').show();
	$.ajax({
		url: '',
		type:'POST',
		data: {'salesPersonId':$(this).attr("data-sales-id")},
		success: function(response){
			$('#loader_img').hide();
			$(".guest_list_"+salesPersonId).html(response);
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
	
}) */

var KTAdminDashboard = function() {
	
	// Support Tickets Chart.
	// Based on Morris plugin - http://morrisjs.github.io/morris.js/
	var revenueChange = function() {
		if ($('#kt_chart_revenue_change').length == 0) {
			return;
		}

		Morris.Donut({
			element: 'kt_chart_revenue_change',
			data: [{{$saleTypeChartData}}
			],
			labelColor: '#a7a7c2',
			colors: [
				KTApp.getStateColor('success'),
				KTApp.getStateColor('brand'),
				KTApp.getStateColor('danger'),
				KTApp.getStateColor('info'),
				KTApp.getStateColor('warning'),
				KTApp.getStateColor('primary'),
				KTApp.getStateColor('brand')
			],
			formatter: function (x) { return x + "%"}
		});
	}

	return {
        // Init demos
        init: function() {
            // init charts
            revenueChange();
			
            // demo loading
            var loading = new KTDialog({'type': 'loader', 'placement': 'top center', 'message': 'Loading ...'});
            loading.show();

            setTimeout(function() {
                loading.hide();
            }, 3000);
        }
    };
	
}();

// Class initialization on page load
jQuery(document).ready(function() {
    KTAdminDashboard.init();
});

</script>





@stop