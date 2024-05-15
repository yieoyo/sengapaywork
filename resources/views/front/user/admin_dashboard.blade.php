@extends('front.layouts.default')
@section('content')

<script src="{{ WEBSITE_JS_URL }}pages/crud/forms/widgets/bootstrap-daterangepicker.js" type="text/javascript"></script>

<style>
.tab-content>.tab-pane {
    display: block;
    height: 0;
    overflow: hidden;
}
.tab-content>.tab-pane.active {
    height: auto;
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
							{{ trans("messages.admin_dashboard.admin_dashboard")}}</h3>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::Dashboard 3-->

			<!--Begin::Row-->
			<div class="row">
				
				<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
				
					<div class="kt-portlet kt-portlet--height-fluid">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">
									{{ trans("messages.admin_dashboard.infaq_contributors")}}
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
									<li class="nav-item">
										<a class="nav-link {{ !empty(Session::get('SparklineGraphDaily'))? '':'active' }}" data-toggle="tab" href="#kt_widget4_tab11_content" role="tab">
											{{ trans("messages.admin_dashboard.last_30_days")}}
										</a>
									</li>
									<?php /* <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab12_content" role="tab">
											Today
										</a>
									</li> */ ?>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab13_content" role="tab">
											{{ trans("messages.admin_dashboard.last_12_months")}}
										</a>
									</li>
									<li class="nav-item {{ !empty(Session::get('SparklineGraphDaily'))? 'active':'' }}">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab14_content" role="tab">
											{{ trans("messages.admin_dashboard.custom")}}
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="tab-content">
								<div class="tab-pane {{ !empty(Session::get('SparklineGraphDaily'))? '':'active' }}" id="kt_widget4_tab11_content">
									<div class="kt-list-timeline">
										<div class="kt-widget21">
											<div class="kt-widget21__content kt-portlet__space-x">
												<?php /* <div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-brand">
														<i class="flaticon2-bell-alarm-symbol"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.contributors")}}
														</span>
													</div>
												</div> */ ?>
												<div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-success">
														<i class="flaticon2-pie-chart-4"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.funds")}}
														</span>
													</div>
												</div>
											</div>
											<div class="kt-widget21__chart">
												<canvas id="kt_infaq_daily_contribution_chart" style="height:310px;"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="kt_widget4_tab13_content">
									<div class="kt-list-timeline">
										<div class="kt-widget21">
											<div class="kt-widget21__content kt-portlet__space-x">
												<?php /* <div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-brand">
														<i class="flaticon2-bell-alarm-symbol"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.contributors")}}
														</span>
													</div>
												</div> */ ?>
												<div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-success">
														<i class="flaticon2-pie-chart-4"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.funds")}}
														</span>
													</div>
												</div>
											</div>
											<div class="kt-widget21__chart">
												<canvas id="kt_infaq_contribution_chart" style="height:310px;"></canvas>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane {{ !empty(Session::get('SparklineGraphDaily'))? 'active':'' }}" id="kt_widget4_tab14_content">
									<div class="kt-list-timeline">
										<div class="kt-widget21">
											<div class="kt-widget21__content kt-portlet__space-x" style="padding:0px;">
												<div class="form-group row" style="width:100%">
													<label class="col-form-label col-lg-4 col-sm-12">{{ trans("messages.admin_dashboard.select_date_range")}}:</label>
													<div class="col-lg-7 col-md-7 col-sm-11">
														<div class='input-group' id='kt_daterangepicker_12'>
															<?php if(!empty($customDateArray)){
																$startDate = $customDateArray['startDate'];
																$endDate = $customDateArray['endDate'];
																$dateTime = $startDate." - ".$endDate;
															}else{
																$dateTime	=	"";
															} ?>
															<input type="text" name="filter_date" value="{{$dateTime}}" class="form-control filter_date" readonly placeholder="Select date range" />
															<div class="input-group-append">
																<span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
															</div>
														</div>
													</div>
													<div class="col-lg-1 col-md-1 col-sm-1">
														<span class="kt-media kt-media--sm kt-media--success kt-media--circle kt-margin-r-5 kt-margin-t-5">
															<a title="Reload Record" href="javascript:void();" onclick="removeCustomSelected();">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"/>
																		<path d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z" fill="#000000" fill-rule="nonzero"/>
																	</g>
																</svg>
															</a>
														</span>
													</div>
												</div>
											</div>
											<div class="kt-widget21__content kt-portlet__space-x">
												<?php /* <div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-brand">
														<i class="flaticon2-bell-alarm-symbol"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.contributors")}}
														</span>
													</div>
												</div> */ ?>
												<div class="kt-widget21__item">
													<div href="#" class="kt-widget21__icon kt-bg-fill-success">
														<i class="flaticon2-pie-chart-4"></i>
													</div>
													<div class="kt-widget21__info">
														<span class="kt-widget21__title">
															{{ trans("messages.admin_dashboard.funds")}}
														</span>
													</div>
												</div>
											</div>
											<div class="kt-widget21__chart">
												<canvas id="kt_infaq_contribution_chart_custom" style="height:310px;"></canvas>
											</div>
										</div>
									</div>
								</div>
							
							</div>
						</div>
					</div>
				
				</div>
				
				<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
					<!--begin:: Widgets/Quick Stats-->
					<div class="row row-full-height">
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
								<div class="kt-portlet__body kt-portlet__body--fluid">
									<div class="kt-widget26">
										<div class="kt-widget26__content">
											<span class="kt-widget26__number">{{ Currency }} {{ number_format($totalApprovedContribution,2) }}</span>
											<span class="kt-widget26__desc">{{ trans("messages.admin_dashboard.contribution_funds")}}</span>
										</div>
										<div class="kt-widget26__chart" style="height:100px; width: 230px;">
											<canvas id="kt_chart_quick_stats_1"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-space-20"></div>
							<div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger">
								<div class="kt-portlet__body kt-portlet__body--fluid">
									<div class="kt-widget26">
										<div class="kt-widget26__content">
											<span class="kt-widget26__number">{{ $totalContributors }}</span>
											<span class="kt-widget26__desc">{{ trans("messages.admin_dashboard.no_of_contributions")}}</span>
										</div>
										<div class="kt-widget26__chart" style="height:100px; width: 230px;">
											<canvas id="kt_chart_quick_stats_2"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-6">
							<div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-success">
								<div class="kt-portlet__body kt-portlet__body--fluid">
									<div class="kt-widget26">
										<div class="kt-widget26__content">
											<span class="kt-widget26__number">{{ $totalApprovedTransaction }}+</span>
											<span class="kt-widget26__desc">{{ trans("messages.admin_dashboard.complete_transactions")}}</span>
										</div>
										<div class="kt-widget26__chart" style="height:100px; width: 230px;">
											<canvas id="kt_chart_quick_stats_3"></canvas>
										</div>
									</div>
								</div>
							</div>
							<div class="kt-space-20"></div>
							<div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-warning">
								<div class="kt-portlet__body kt-portlet__body--fluid">
									<div class="kt-widget26">
										<div class="kt-widget26__content">
											<span class="kt-widget26__number">{{ $totalTransactions }}+</span>
											<span class="kt-widget26__desc">{{ trans("messages.admin_dashboard.total_transactions")}}</span>
										</div>
										<div class="kt-widget26__chart" style="height:100px; width: 230px;">
											<canvas id="kt_chart_quick_stats_4"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!--end:: Widgets/Quick Stats-->
				</div>


				<div class="col-xl-12 col-lg-12 order-lg-3 order-xl-1">
					<!--begin:: Widgets/New Users-->
					<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">
									{{ trans("messages.admin_dashboard.contribution_proportion")}}
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<?php /* <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content_sp" role="tab">
											All Project
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab2_content_sp" role="tab">
											Ansar
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab3_content_sp" role="tab">
											Special Project
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab4_content_sp" role="tab">
											Dana Lestari
										</a>
									</li>
								</ul> */ ?>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="tab-content">
								<div class="tab-pane active" id="kt_widget4_tab1_content_sp">
									<div class="row">
										<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
											<div class="kt-widget12">
												<div class="kt-widget12__content kt-portlet__space-x kt-portlet__space-y">
													<div class="kt-widget12__item">
														<div class="kt-widget12__info">
															<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.total_contribution_funds")}}</span>
															<span class="kt-widget12__value">{{Currency}} {{ number_format($totalApprovedContribution,2) }}</span>
														</div>
														<div class="kt-widget12__info">
															<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.target_achieve")}}</span>
															<div class="kt-widget12__progress">
																<?php $avgArchive = round((($totalApprovedContribution/$totalTargetAmount)*100),2); ?>
																<div class="progress kt-progress--sm">
																	<div class="progress-bar bg-brand" role="progressbar" style="width: {{$avgArchive}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<span class="kt-widget12__stat">
																	{{$avgArchive}}%
																</span>
															</div>
														</div>
													</div>
													<div class="kt-widget12__item">
														<div class="kt-widget12__info">
															<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.total_contributor")}}</span>
															<span class="kt-widget12__value">{{ $totalContributors }}</span> <?php /* $totalPaidContributors */ ?>
														</div>
														<div class="kt-widget12__info">
															<span class="kt-widget12__desc">{{ trans("messages.admin_dashboard.total_waiting_approval")}}</span>
															<div class="kt-widget12__progress">
																<?php $avgWaitingApproval = round((($totalWaitingApprovalContribution/$totalTargetAmount)*100),2); ?>
																<div class="progress kt-progress--sm">
																	<div class="progress-bar bg-brand" role="progressbar" style="width: {{$avgWaitingApproval}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
																</div>
																<span class="kt-widget12__stat">
																	{{ $avgWaitingApproval }}%
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
											<div class="kt-widget16">
												<div class="kt-widget16__items">
													<div class="kt-widget16__item">
														<span class="kt-widget16__sceduled">
															{{ trans('messages.dashboard.type') }}
														</span>
														<span class="kt-widget16__amount">
															{{ trans('messages.dashboard.amount') }}
														</span>
													</div>
													@if(!empty($projectContributions))
													  @foreach($projectContributions as $projectContribution)
														<div class="kt-widget16__item">
															<span class="kt-widget16__date">
																{{ !empty($projectContribution) ? $projectContribution['key']:'' }}
															</span>
															<span class="kt-widget16__price  kt-font-{{ !empty($projectContribution) ? $projectContribution['color']:'' }}">
																{{ Currency}} {{ !empty($projectContribution) ? number_format($projectContribution['price'],2):0 }}
															</span>
														</div>
													  @endforeach
													@endif
												</div>
												<div class="kt-widget20__stats">
													<div class="kt-widget16__visual">
														<div id="kt_chart_revenue_change" style="height: 200px;width: 250px;text-align: center;"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>

					<!--end:: Widgets/New Users-->
				</div>


				<div class="col-xl-4 col-lg-4 order-lg-3 order-xl-1">
					<!--begin:: Widgets/Sales States-->
					<div class="kt-portlet kt-portlet--height-fluid">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">
									{{ trans("messages.admin_dashboard.location_stats")}}
								</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-widget6">
								<div class="kt-widget6__head">
									<div class="kt-widget6__item">
										<span>{{ trans("messages.sub_project_detail.postcode")}}</span>
										<span>{{ trans("messages.admin_dashboard.count")}}</span>
										<span>{{ trans('messages.dashboard.amount') }}</span>
									</div>
								</div>
								<div class="kt-widget6__body">
									@if(!empty($locationStates))
									  @foreach($locationStates as $locationState)
										@if(!empty($locationState['total_donation']) && ($locationState['total_donation'] > 0))
										<div class="kt-widget6__item">
											<span>{{ $locationState['postcode'] }}</span>
											<span>{{ $locationState['total_orders'] }}</span>
											<?php 
												$colorArray = array('success','brand','warning','danger','info');
												$randColor = array_rand($colorArray, 1); 
											?>
											<span class="kt-font-{{!empty($colorArray)?$colorArray[$randColor]:'brand' }} kt-font-bold">{{ Currency . number_format($locationState['total_donation'],2) }}</span>
										</div>
										@endif
									  @endforeach
									@endif
								</div>
								<?php /* <div class="kt-widget6__foot">
									<div class="kt-widget6__action kt-align-right">
										<a href="#" class="btn btn-label-brand btn-sm btn-bold">Export...</a>
									</div>
								</div> */ ?>
							</div>
						</div>
					</div>

					<!--end:: Widgets/Sales States-->
				</div>


				<div class="col-xl-8 col-lg-8 order-lg-3 order-xl-1">
					<!--begin:: Widgets/New Users-->
					<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">
									{{ trans("messages.admin_dashboard.recent_infaq")}}
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#kt_widget4_tab1_content" role="tab">
											{{ trans("messages.admin_dashboard.all")}}
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab2_content" role="tab">
											{{ trans('messages.dashboard.success') }}
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab3_content" role="tab">
											{{ trans('messages.dashboard.pending') }}
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_widget4_tab4_content" role="tab">
											{{ trans('messages.dashboard.waiting_approval') }}
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="tab-content">
								<div class="tab-pane active" id="kt_widget4_tab1_content">
								  <!--begin: Datatable -->
								  <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
									<table class="kt-datatable__table" style="display: block;height: auto;">
										<thead class="kt-datatable__head">
											<tr class="kt-datatable__row" style="left: 0px;">
												<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 30px;"></span>
												</th>
												<th data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 200px;">{{ trans("messages.sub_project_detail.full_name")}}</span>
												</th>
												<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans('messages.dashboard.date') }}</span>
												</th>
												<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans("messages.book_plan.payment_status") }}</span>
												</th>
												<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 120px;">{{ trans("messages.admin_dashboard.actions") }}</span>
												</th>
											</tr>
										</thead>
										<tbody style="height: auto;" class="kt-datatable__body ps--active-y">
										 @if(!empty($recentAllOrders))
										   @foreach($recentAllOrders as $key=>$recentAllOrder)
											<tr data-row="{{$key}}" class="kt-datatable__row" style="left: 0px;">
												<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 30px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																
																<!--begin::Accordion-->
																<div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
																	<div class="card">
																		<div class="card-header get_donation_invoice_list" data-order-id="{{$recentAllOrder->id}}" id="headingTwo{{$key}}">
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
												<td data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 200px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																<a href="#" class="kt-user-card-v2__name">
																	@if(!empty($recentAllOrder->company_name))
																		{{ $recentAllOrder->company_name }}
																	@else
																		{{ $recentAllOrder->full_name }}
																	@endif
																</a>
																<span class="kt-user-card-v2__desc">
																	@if($recentAllOrder->project_module == 1)
																		Ansar
																	@elseif($recentAllOrder->project_module == 2)
																		{{ trans("messages.dashboard.special_project") }}
																	@else
																		Dana Lestari
																	@endif
																</span><br />	
																<span class="kt-user-card-v2__desc">{{ $recentAllOrder->sub_project_name }}</span>	
															</div>
														</div>
													</span>
												</td>
												<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
													<span style="width: 130px;">
														<span class="kt-font-bold">{{ date("d/m/Y",strtotime($recentAllOrder->created_at)) }}</span>
													</span>
												</td>
												<td data-field="Status" class="kt-datatable__cell">
													<span style="width: 120px;">
													@if($recentAllOrder->main_payment_status == 1)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.waiting_approval') }}</span>
													@elseif($recentAllOrder->main_payment_status == 2)
														<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.success') }}</span>
													@elseif($recentAllOrder->main_payment_status == 3)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
													@elseif($recentAllOrder->main_payment_status == 5)
														<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.expired') }}</span>
													@else
														<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.not_paid') }}</span>
													@endif
													</span>
												</td>
												<td data-field="Actions" class="kt-datatable__cell">
													<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
														
														  <a href="{{URL('/infaq/'.$recentAllOrder->sub_project_slug)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-eye"></i>
														  </a> 
														
														  <a href="{{URL('/edit-donation-plan/'.$recentAllOrder->sub_project_slug.'/'.$recentAllOrder->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-edit"></i>
														  </a> 
														
														  <a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$recentAllOrder->sub_project_slug.'/'.$recentAllOrder->unique_donation_id)}}">
															<i class="la la-trash"></i>
														  </a> 
														
													</span>
												</td>
											</tr>
											<tr class="kt-datatable__row kt-datatable__row--even dropdown">
											  <td colspan="7">
												<div id="collapseTwo{{$key}}" class="collapse" aria-labelledby="headingTwo{{$key}}" data-parent="#accordionExample7">
													<div class="card-body">
														<div class="kt-section__content dynamic_invoice_list_{{$recentAllOrder->id}}">
															
														</div>
													</div>
												</div>
											  </td>
											</tr>
										  @endforeach
										 @endif
										</tbody>
									</table>
								  </div>
								  <!--end: Datatable -->
								</div>

								<div class="tab-pane" id="kt_widget4_tab2_content">
								  <!--begin: Datatable -->
								  <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
									<table class="kt-datatable__table" style="display: block;height: auto;">
										<thead class="kt-datatable__head">
											<tr class="kt-datatable__row" style="left: 0px;">
												<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 30px;"></span>
												</th>
												<th data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 200px;">{{ trans('messages.personal_information.full_name') }}</span>
												</th>
												<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans('messages.dashboard.date') }}</span>
												</th>
												<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans("messages.book_plan.payment_status") }}</span>
												</th>
												<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 120px;">{{ trans("messages.admin_dashboard.actions") }}</span>
												</th>
											</tr>
										</thead>
										<tbody style="height: auto;" class="kt-datatable__body ps ps--active-y">
										 @if(!empty($recentSuccessOrders))
										   @foreach($recentSuccessOrders as $key=>$record)
											<tr data-row="{{$key}}" class="kt-datatable__row" style="left: 0px;">
												<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 30px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																
																<!--begin::Accordion-->
																<div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
																	<div class="card">
																		<div class="card-header" id="headingTwo{{$key}}">
																			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo{{$key}}" aria-expanded="false" aria-controls="collapseTwo{{$key}}">
																				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon get_donation_invoice_list" data-order-id="{{$record->id}}">
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
												<td data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 200px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																<a href="#" class="kt-user-card-v2__name">
																	@if(!empty($record->company_name))
																		{{ $record->company_name }}
																	@else
																		{{ $record->full_name }}
																	@endif
																</a>
																<span class="kt-user-card-v2__desc">
																	@if($record->project_module == 1)
																		Ansar
																	@elseif($record->project_module == 2)
																		Sepecial Projects
																	@else
																		Dana Lestari
																	@endif
																</span><br />	
																<span class="kt-user-card-v2__desc">{{ $record->sub_project_name }}</span>
															</div>
														</div>
													</span>
												</td>
												<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
													<span style="width: 130px;">
														<span class="kt-font-bold">{{ date("d/m/Y",strtotime($record->created_at)) }}</span>
													</span>
												</td>
												<td data-field="Status" class="kt-datatable__cell">
													<span style="width: 120px;">
													@if($record->main_payment_status == 1)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.waiting_approval') }}</span>
													@elseif($record->main_payment_status == 2)
														<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.success') }}</span>
													@elseif($record->main_payment_status == 3)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
													@elseif($record->main_payment_status == 5)
														<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.expired') }}</span>
													@else
														<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.not_paid') }}</span>
													@endif
													</span>
												</td>
												<td data-field="Actions" class="kt-datatable__cell">
													<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
														
														  <a href="{{URL('/infaq/'.$record->sub_project_slug)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-eye"></i>
														  </a> 
														
														  <a href="{{URL('/edit-donation-plan/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-edit"></i>
														  </a> 
														
														  <a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}">
															<i class="la la-trash"></i>
														  </a> 
														
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
										  @endforeach
										 @endif
										</tbody>
									</table>
								  </div>
								  <!--end: Datatable -->
								</div>
								
								<div class="tab-pane" id="kt_widget4_tab3_content">
								  <!--begin: Datatable -->
								  <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
									<table class="kt-datatable__table" style="display: block;height: auto;">
										<thead class="kt-datatable__head">
											<tr class="kt-datatable__row" style="left: 0px;">
												<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 30px;"></span>
												</th>
												<th data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 200px;">{{ trans('messages.personal_information.full_name') }}</span>
												</th>
												<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans('messages.dashboard.date') }}</span>
												</th>
												<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans("messages.book_plan.payment_status") }}</span>
												</th>
												<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 120px;">{{ trans("messages.admin_dashboard.actions") }}</span>
												</th>
											</tr>
										</thead>
										<tbody style="height: auto;" class="kt-datatable__body ps ps--active-y">
										 @if(!empty($recentPendingOrders))
										   @foreach($recentPendingOrders as $key=>$record)
											<tr data-row="{{$key}}" class="kt-datatable__row" style="left: 0px;">
												<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 30px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																
																<!--begin::Accordion-->
																<div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
																	<div class="card">
																		<div class="card-header" id="headingTwo{{$key}}">
																			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo{{$key}}" aria-expanded="false" aria-controls="collapseTwo{{$key}}">
																				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon get_donation_invoice_list" data-order-id="{{$record->id}}">
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
												<td data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 200px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																<a href="#" class="kt-user-card-v2__name">
																	@if(!empty($record->company_name))
																		{{ $record->company_name }}
																	@else
																		{{ $record->full_name }}
																	@endif
																</a>
																<span class="kt-user-card-v2__desc">
																	@if($record->project_module == 1)
																		Ansar
																	@elseif($record->project_module == 2)
																		Sepecial Projects
																	@else
																		Dana Lestari
																	@endif
																</span><br />	
																<span class="kt-user-card-v2__desc">{{ $record->sub_project_name }}</span>
															</div>
														</div>
													</span>
												</td>
												<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
													<span style="width: 130px;">
														<span class="kt-font-bold">{{ date("d/m/Y",strtotime($record->created_at)) }}</span>
													</span>
												</td>
												<td data-field="Status" class="kt-datatable__cell">
													<span style="width: 120px;">
													@if($record->main_payment_status == 1)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.waiting_approval') }}</span>
													@elseif($record->main_payment_status == 2)
														<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.success') }}</span>
													@elseif($record->main_payment_status == 3)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
													@elseif($record->main_payment_status == 5)
														<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.expired') }}</span>
													@else
														<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.not_paid') }}</span>
													@endif
													</span>
												</td>
												<td data-field="Actions" class="kt-datatable__cell">
													<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
														
														  <a href="{{URL('/infaq/'.$record->sub_project_slug)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-eye"></i>
														  </a> 
														
														  <a href="{{URL('/edit-donation-plan/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-edit"></i>
														  </a> 
														
														  <a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}">
															<i class="la la-trash"></i>
														  </a> 
														
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
										  @endforeach
										 @endif
										</tbody>
									</table>
								  </div>
								  <!--end: Datatable -->
								</div>
								
								<div class="tab-pane" id="kt_widget4_tab4_content">
								  <!--begin: Datatable -->
								  <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
									<table class="kt-datatable__table" style="display: block;height: auto;">
										<thead class="kt-datatable__head">
											<tr class="kt-datatable__row" style="left: 0px;">
												<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 30px;"></span>
												</th>
												<th data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 200px;">{{ trans('messages.personal_information.full_name') }}</span>
												</th>
												<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans('messages.dashboard.date') }}</span>
												</th>
												<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sort">
													<span style="width: 130px;">{{ trans("messages.book_plan.payment_status") }}</span>
												</th>
												<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
													<span style="width: 120px;">{{ trans("messages.admin_dashboard.actions") }}</span>
												</th>
											</tr>
										</thead>
										<tbody style="height: auto;" class="kt-datatable__body ps ps--active-y">
										 @if(!empty($recentWaitingOrders))
										   @foreach($recentWaitingOrders as $key=>$record)
											<tr data-row="{{$key}}" class="kt-datatable__row" style="left: 0px;">
												<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 30px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																
																<!--begin::Accordion-->
																<div class="accordion accordion-light  accordion-svg-icon" id="accordionExample7">
																	<div class="card">
																		<div class="card-header" id="headingTwo{{$key}}">
																			<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo{{$key}}" aria-expanded="false" aria-controls="collapseTwo{{$key}}">
																				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon get_donation_invoice_list" data-order-id="{{$record->id}}">
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
												<td data-field="FullName" data-autohide-disabled="false" class="kt-datatable__cell">
													<span style="width: 200px;">                        
														<div class="kt-user-card-v2">                            
															<div class="kt-user-card-v2__details">
																<a href="#" class="kt-user-card-v2__name">
																	@if(!empty($record->company_name))
																		{{ $record->company_name }}
																	@else
																		{{ $record->full_name }}
																	@endif
																</a>
																<span class="kt-user-card-v2__desc">
																	@if($record->project_module == 1)
																		Ansar
																	@elseif($record->project_module == 2)
																		Sepecial Projects
																	@else
																		Dana Lestari
																	@endif
																</span><br />	
																<span class="kt-user-card-v2__desc">{{ $record->sub_project_name }}</span>	
															</div>
														</div>
													</span>
												</td>
												<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
													<span style="width: 130px;">
														<span class="kt-font-bold">{{ date("d/m/Y",strtotime($record->created_at)) }}</span>
													</span>
												</td>
												<td data-field="Status" class="kt-datatable__cell">
													<span style="width: 120px;">
													@if($record->main_payment_status == 1)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.waiting_approval') }}</span>
													@elseif($record->main_payment_status == 2)
														<span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.success') }}</span>
													@elseif($record->main_payment_status == 3)
														<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
													@elseif($record->main_payment_status == 5)
														<span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.expired') }}</span>
													@else
														<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.not_paid') }}</span>
													@endif
													</span>
												</td>
												<td data-field="Actions" class="kt-datatable__cell">
													<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
														
														  <a href="{{URL('/infaq/'.$record->sub_project_slug)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-eye"></i>
														  </a> 
														
														  <a href="{{URL('/edit-donation-plan/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
															<i class="la la-edit"></i>
														  </a> 
														
														  <a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$record->sub_project_slug.'/'.$record->unique_donation_id)}}">
															<i class="la la-trash"></i>
														  </a> 
														
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
										  @endforeach
										 @endif
										</tbody>
									</table>
								  </div>
								  <!--end: Datatable -->
								</div>

							</div>
						</div>
					</div>

					<!--end:: Widgets/New Users-->
				</div>

				<div class="clearfix"></div>

				<?php /* <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
					<!--begin:: Widgets/Daily Sales-->
					<div class="kt-portlet kt-portlet--height-fluid">
						<div class="kt-widget14">
							<div class="kt-widget14__header kt-margin-b-30">
								<h3 class="kt-widget14__title">
									View Statistics
								</h3>
								<span class="kt-widget14__desc">
									Check out each column for more details
								</span>
							</div>
							<div class="kt-widget14__chart" style="height:120px;">
								<canvas id="kt_chart_daily_statistics"></canvas>
							</div>
						</div>
					</div>

					<!--end:: Widgets/Daily Sales-->
				</div> */ ?>

			</div>

			<!--End::Row-->

			<!--End::Dashboard 3-->
		</div>

		<!-- end:: Content  -->
	</div>
</div>

<?php $totalPaidContributionAmount = ($ansarTotalContribution + $specialTotalContribution + $danaTotalContribution); ?>

<script>
function removeCustomSelected() {
	var customSession = "<?php echo Session::forget('dateArray'); ?>";
	location.reload();
	//alert(customSession);
}


$('#kt_daterangepicker_12').daterangepicker({
	buttonClasses: ' btn',
	applyClass: 'btn-primary',
	cancelClass: 'btn-secondary',
	maxDate: moment(),
}, function(start, end, label) {
	$('#kt_daterangepicker_12 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
	
	$.ajax({
		url: '{{ route("User.getDashboardChartData") }}',
		type:'POST',
		data: {'from_date':start.format('YYYY-MM-DD'), 'to_date':end.format('YYYY-MM-DD') },
		success: function(response){
			//console.log(response);
			//loadCustomChartData(response);
			location.reload();
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
	
});


var KTAdminDashboard = function() {
	
	var monthNameArray = [
		<?php foreach($SparklineGraph as $graphRecord){ ?>
		"<?php echo $graphRecord['month']; ?>",
		<?php } ?>
	];
	var GraphTotalContributions = [
		<?php foreach($SparklineGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributions']) ? round($graphRecord['TotalContributions'],2) : 0; ?>,
		<?php } ?>
	];
	var GraphTotalContributors = [
		<?php foreach($SparklineGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributors']) ? round($graphRecord['TotalContributors'],2) : 0; ?>,
		<?php } ?>
	];
	
	
    // Sparkline Chart helper function
    var _initSparklineChart = function(src, data, color, border) {
        if (src.length == 0) {
            return;
        }

        var config = {
            type: 'line',
            data: {
                labels: monthNameArray,
                datasets: [{
                    label: "",
                    borderColor: color,
                    borderWidth: border,

                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 12,
                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    fill: false,
                    data: data,
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    enabled: false,
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false,
                    labels: {
                        usePointStyle: false
                    }
                },
                responsive: true,
                maintainAspectRatio: true,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },

                elements: {
                    point: {
                        radius: 4,
                        borderWidth: 12
                    },
                },

                layout: {
                    padding: {
                        left: 0,
                        right: 10,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        return new Chart(src, config);
    }

	// Bandwidth Charts 2.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var adWordsStat = function() {
		
	   if ($('#kt_infaq_contribution_chart').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_infaq_contribution_chart").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#ffefce').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#ffefce').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: monthNameArray,
                datasets: [/* {
                    label: "Register Contributors",

                    backgroundColor: KTApp.getStateColor('brand'),
                    borderColor: KTApp.getStateColor('brand'),

                    pointBackgroundColor: KTApp.getStateColor('brand'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('brand'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: GraphTotalContributors
                },  */{
                    label: "Collected Fund",
                    backgroundColor: KTApp.getStateColor('success'),
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: KTApp.getStateColor('success'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('success'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: GraphTotalContributions
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }
	
	
	// Bandwidth Charts 30 days data SparklineGraphDaily
    // Based on Chartjs plugin - http://www.chartjs.org/
    
	var dailyNameArray = [
		<?php foreach($SparklineGraphDaily as $graphRecord){ ?>
		"<?php echo $graphRecord['day']; ?>",
		<?php } ?>
	];
	var dailyGraphTotalContributions = [
		<?php foreach($SparklineGraphDaily as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributions']) ? round($graphRecord['TotalContributions'],2) : 0; ?>,
		<?php } ?>
	];
	var dailyGraphTotalContributors = [
		<?php foreach($SparklineGraphDaily as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributors']) ? round($graphRecord['TotalContributors'],2) : 0; ?>,
		<?php } ?>
	];
	
	var dailyContributionStat = function() {
		
	   if ($('#kt_infaq_daily_contribution_chart').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_infaq_daily_contribution_chart").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#ffefce').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#ffefce').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: dailyNameArray,
                datasets: [/* {
                    label: "Register Contributors",

                    backgroundColor: KTApp.getStateColor('brand'),
                    borderColor: KTApp.getStateColor('brand'),

                    pointBackgroundColor: KTApp.getStateColor('brand'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('brand'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: dailyGraphTotalContributors
                },  */{
                    label: "Collected Fund",
                    backgroundColor: KTApp.getStateColor('success'),
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: KTApp.getStateColor('success'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('success'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: dailyGraphTotalContributions
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }
	
	
	//custom chart
	
	var monthNameArrayCustom = [
		<?php if(!empty(Session::get('SparklineGraphDaily'))){
			foreach(Session::get('SparklineGraphDaily') as $graphRecord){ ?>
			"<?php echo $graphRecord['day']; ?>",
		<?php } } ?>
	];
	var GraphTotalContributionsCustom = [
		<?php if(!empty(Session::get('SparklineGraphDaily'))){
			foreach(Session::get('SparklineGraphDaily') as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributions']) ? round($graphRecord['TotalContributions'],2) : 0; ?>,
		<?php } } ?>
	];
	var GraphTotalContributorsCustom = [
		<?php if(!empty(Session::get('SparklineGraphDaily'))){
			foreach(Session::get('SparklineGraphDaily') as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributors']) ? round($graphRecord['TotalContributors'],2) : 0; ?>,
		<?php } } ?>
	];
	
	
	var customContributionStat = function() {
		
	   if ($('#kt_infaq_contribution_chart_custom').length == 0) {
            return;
        }

        var ctx = document.getElementById("kt_infaq_contribution_chart_custom").getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, Chart.helpers.color('#ffefce').alpha(1).rgbString());
        gradient.addColorStop(1, Chart.helpers.color('#ffefce').alpha(0.3).rgbString());

        var config = {
            type: 'line',
            data: {
                labels: monthNameArrayCustom,
                datasets: [/* {
                    label: "Register Contributors",

                    backgroundColor: KTApp.getStateColor('brand'),
                    borderColor: KTApp.getStateColor('brand'),

                    pointBackgroundColor: KTApp.getStateColor('brand'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('brand'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: GraphTotalContributorsCustom
                },  */{
                    label: "Collected Fund",
                    backgroundColor: KTApp.getStateColor('success'),
                    borderColor: KTApp.getStateColor('success'),

                    pointBackgroundColor: KTApp.getStateColor('success'),
                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                    pointHoverBackgroundColor: KTApp.getStateColor('success'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),
                    data: GraphTotalContributionsCustom
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                    position: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        stacked: true,
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.0000001
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 10,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }
	
	
	
	
	
	var monthArray = [
		<?php foreach($QuickStateGraph as $graphRecord){ ?>
		"<?php echo $graphRecord['month']; ?>",
		<?php } ?>
	];
	var TotalContributions = [
		<?php foreach($QuickStateGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributions']) ? round($graphRecord['TotalContributions'],2) : 0; ?>,
		<?php } ?>
	];
	var TotalApprovedTransactions = [
		<?php foreach($QuickStateGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalApprovedTransactions']) ? round($graphRecord['TotalApprovedTransactions'],2) : 0; ?>,
		<?php } ?>
	];
	var TotalContributors = [
		<?php foreach($QuickStateGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalContributors']) ? round($graphRecord['TotalContributors'],2) : 0; ?>,
		<?php } ?>
	];
	var TotalTransactions = [
		<?php foreach($QuickStateGraph as $graphRecord){ ?>
		<?php echo !empty($graphRecord['TotalTransactions']) ? round($graphRecord['TotalTransactions'],2) : 0; ?>,
		<?php } ?>
	];
	// Quick Stat Charts

    var quickStats = function() {

        _initSparklineChart($('#kt_chart_quick_stats_1'), TotalContributions, monthArray, KTApp.getStateColor('brand'), 3);

        _initSparklineChart($('#kt_chart_quick_stats_2'), TotalContributors, monthArray, KTApp.getStateColor('danger'), 3);

        _initSparklineChart($('#kt_chart_quick_stats_3'), TotalApprovedTransactions, monthArray, KTApp.getStateColor('success'), 3);

        _initSparklineChart($('#kt_chart_quick_stats_4'), TotalTransactions, monthArray, KTApp.getStateColor('warning'), 3);

    }
	
    // Quick Stat Chart helper function

    var _initSparklineChart = function(src, data, monthArray, color, border) {

        if (src.length == 0) {

            return;

        }

        var config = {

            type: 'line',

            data: {

                labels: monthArray,

                datasets: [{

                    label: "",

                    borderColor: color,

                    borderWidth: border,



                    pointHoverRadius: 4,

                    pointHoverBorderWidth: 12,

                    pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),

                    pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),

                    pointHoverBackgroundColor: KTApp.getStateColor('danger'),

                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                    fill: false,

                    data: data,

                }]

            },

            options: {

                title: {

                    display: true,

                },

                tooltips: {

                    enabled: true,

                    intersect: true,

                    mode: 'nearest',

                    xPadding: 10,

                    yPadding: 10,

                    caretPadding: 10

                },

                legend: {

                    display: false,

                    labels: {

                        usePointStyle: true

                    }

                },

                responsive: true,

                maintainAspectRatio: true,

                hover: {

                    mode: 'index'

                },

                scales: {

                    xAxes: [{

                        display: false,

                        gridLines: false,

                        scaleLabel: {

                            display: true,

                            labelString: 'Month'

                        }

                    }],

                    yAxes: [{

                        display: false,

                        gridLines: false,

                        scaleLabel: {

                            display: true,

                            labelString: 'Value'

                        },

                        ticks: {

                            beginAtZero: true

                        }

                    }]

                },


                elements: {

                    point: {

                        radius: 4,

                        borderWidth: 12

                    },

                },


                layout: {

                    padding: {

                        left: 0,

                        right: 10,

                        top: 5,

                        bottom: 0

                    }

                }

            }

        };


        return new Chart(src, config);

    }


	
	// Daily Sales chart.
    // Based on Chartjs plugin - http://www.chartjs.org/
    var dailyStatistics = function() {
        var chartContainer = KTUtil.getByID('kt_chart_daily_statistics');
		
        if (!chartContainer) {
            return;
        }

        var chartData = {
            labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5", "Label 6", "Label 7", "Label 8", "Label 9", "Label 10", "Label 11", "Label 12", "Label 13", "Label 14", "Label 15", "Label 16"],
            datasets: [{
                //label: 'Dataset 1',
                backgroundColor: KTApp.getStateColor('success'),
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }, {
                //label: 'Dataset 2',
                backgroundColor: '#f3f3fb',
                data: [
                    15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                ]
            }]
        };

        var chart = new Chart(chartContainer, {
            type: 'bar',
            data: chartData,
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                barRadius: 4,
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        stacked: true
                    }],
                    yAxes: [{
                        display: false,
                        stacked: true,
                        gridLines: false
                    }]
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    }
                }
            }
        });
    }


	
	// Support Tickets Chart.
	// Based on Morris plugin - http://morrisjs.github.io/morris.js/
	var revenueChangeDashboard = function() {
		if ($('#kt_chart_revenue_change').length == 0) {
			return;
		}

		Morris.Donut({
			element: 'kt_chart_revenue_change',
			data: [
					{ label: "Ansar", value: {{ !empty($ansarTotalContribution)? round((($ansarTotalContribution/$totalPaidContributionAmount)*100),2):"0" }} },
					{ label: "Special Project", value: {{ !empty($specialTotalContribution)? round((($specialTotalContribution/$totalPaidContributionAmount)*100),2):"0" }} },
					{ label: "Dana Lestari", value: {{ !empty($danaTotalContribution)? round((($danaTotalContribution/$totalPaidContributionAmount)*100),2):"0" }} }
			],
			labelColor: '#a7a7c2',
			colors: [
				KTApp.getStateColor('brand'),
				KTApp.getStateColor('success'),
				KTApp.getStateColor('danger')
			],
			formatter: function (x) { return x + "%"}
		});
	}




	return {
        // Init demos
        init: function() {
            // init charts
            adWordsStat();
            dailyContributionStat();
            quickStats();
            dailyStatistics();
            revenueChangeDashboard();
            customContributionStat(dailyNameArray,dailyGraphTotalContributors,dailyGraphTotalContributions);
			
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

$("#kt_widget4_tab13_content").click(function(){
	KTAdminDashboard.init();
})

</script>

<script>
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


</script>

@stop