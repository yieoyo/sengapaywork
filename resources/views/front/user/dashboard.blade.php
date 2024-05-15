@extends('front.layouts.default')
@section('content')
<style>
.kt-datatable__toggle-subtable .ineer_table_blok {
    width: 100%;
    top: 50% !important;
    z-index: 2 !important;
    padding: 0 30px;
    background-color: #fff;
    will-change: initial !important;
    left: 0% !important;
    transform: initial !important;
}

@media (max-width: 767px) {
.kt-datatable.kt-datatable--default.kt-datatable--loaded {
    overflow:auto;
}

.kt-datatable.kt-datatable--default > .kt-datatable__table { 
    min-width:800px;
}
}
</style>

<div class="kt-grid kt-grid--hor kt-grid--root">
 <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
   <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						{{ trans('messages.dashboard.user_dashboard') }} </h3>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				@include('front.elements.navigation');
				
				<!--Begin:: App Content-->
				<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
					<div class="row">
						<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
							<div class="row">
								<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
									<!--begin:: Widgets/New Users-->
									<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
										<div class="kt-portlet__body">
											<!--begin::New Feedbacks-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															{{ trans('messages.dashboard.total_contributions') }}
														</h4>
														<span class="kt-widget24__desc">{{ trans('messages.dashboard.all_project') }}  </span>
													</div>
													<span class="kt-widget24__stats kt-font-primary">
														{{Currency}} {{number_format($totalApprovedContribution,2)}}
													</span>
												</div>
											</div>
											<!--end::New Feedbacks-->
											<div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
											<!--begin::New Feedbacks-->
											<div class="kt-widget24">
												<div class="kt-widget24__details">
													<div class="kt-widget24__info">
														<h4 class="kt-widget24__title">
															{{ trans('messages.dashboard.no_of_contributions') }}
														</h4>
														<span class="kt-widget24__desc">
															{{ trans('messages.dashboard.all_project') }}
														</span>
													</div>
													<span class="kt-widget24__stats kt-font-danger">
														{{$allContributions}}
													</span>
												</div>
											</div>
											<!--end::New Feedbacks-->
										</div>
									</div>

									<!--end:: Widgets/New Users-->
								</div>
								<div class="col-lg-6 col-xl-6 order-lg-1 order-xl-1">
									<!--begin:: Widgets/New Users-->
									<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
										<div class="kt-portlet__head">
											<div class="kt-portlet__head-label">
												<h3 class="kt-portlet__head-title">
													{{ trans('messages.dashboard.contribution_proportion') }} 
												</h3>
											</div>
											<div class="kt-portlet__head-toolbar" style="padding: 15px 0px;">
												<a href="#" class="btn btn-label-brand btn-sm  btn-bold dropdown-toggle" data-toggle="dropdown">
													{{ trans('messages.dashboard.all_project') }}
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">

													<!--begin::Nav-->
													<ul class="kt-nav">
														
														
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																
																<span class="kt-nav__link-text">{{ trans('messages.dashboard.ansar') }} </span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																
																<span class="kt-nav__link-text">{{ trans('messages.dashboard.special_project') }} </span>
															</a>
														</li>
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																
																<span class="kt-nav__link-text">{{ trans('messages.dashboard.dana_lestari') }}</span>
															</a>
														</li>
													</ul>

													<!--end::Nav-->
												</div>
											</div>
										</div>
										<div class="kt-portlet__body">
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
													<div class="kt-widget16__item">
														<span class="kt-widget16__date">
															{{ trans('messages.dashboard.ansar') }}
														</span>
														<span class="kt-widget16__price  kt-font-brand">
															{{Currency}} {{ number_format($AnsarTotalPayments,2) }}
														</span>
													</div>
													<div class="kt-widget16__item">
														<span class="kt-widget16__date">
															{{ trans('messages.dashboard.special_project') }}
														</span>
														<span class="kt-widget16__price  kt-font-success">
															{{Currency}} {{ number_format($SpecialTotalPayments,2) }}
														</span>
													</div>
													<div class="kt-widget16__item">
														<span class="kt-widget16__date">
															{{ trans('messages.dashboard.dana_lestari') }}
														</span>
														<span class="kt-widget16__price  kt-font-danger">
															{{Currency}} {{ number_format($DanaLestariTotalPayments,2) }}
														</span>
													</div>
												</div>
												<div class="kt-widget20__stats">
													<div class="kt-widget16__visual">
														<div id="kt_chart_revenue_change" style="height: 160px; width: 160px;"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end:: Widgets/New Users-->
								</div>

								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">
							<!--begin: Datatable -->
						<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
						  <table class="kt-datatable__table" style="display: block;height: auto;">
							<thead class="kt-datatable__head">
								<tr class="kt-datatable__row" style="left: 0px;">
									<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 30px;"></span>
									</th>
									<th data-field="Project" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans('messages.dashboard.project') }}</span>
									</th>
									<th data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans('messages.dashboard.total_contribution') }}</span>
									</th>
									<th data-field="Date" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 100px;">{{ trans('messages.dashboard.date') }}</span>
									</th>
									<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sorted" data-sort="asc">
										<span style="width: 120px;">{{ trans('messages.dashboard.status') }}<i class="flaticon2-arrow-up"></i></span>
									</th>
									<?php /* <th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 120px;">Actions</span>
									</th> */ ?>
								</tr>
							</thead>
							<tbody style="height: auto;" class="kt-datatable__body ps ps--active-y">
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
									<td data-field="Project" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details">
													<a href="#" class="kt-user-card-v2__name">{{$record->project_module_name}}</a>
													<span class="kt-user-card-v2__desc">{{$record->sub_project_name}}</span>	
												</div>
											</div>
										</span>
									</td>
									<td data-field="TotalContribution" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details">
													<a href="#" class="kt-user-card-v2__name">{{Currency. number_format($record->projectPayment,2) }}</a>
												</div>
											</div>
										</span>
									</td>
									<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="Date">
										<span style="width: 100px;">
											<span class="kt-font-bold">{{!empty($record->created_at) ? date("d/m/Y",strtotime($record->created_at)):"";}}</span>
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
									<?php /* <td data-field="Actions" class="kt-datatable__cell">
										
										<span style="overflow: visible;position: relative;width: 120px;display: inline-block;">
											<div class="dropdown">
												<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
													<i class="flaticon-more-1"></i>                            
												</a>                            
												<div class="dropdown-menu dropdown-menu-right">                                
													<ul class="kt-nav"> 
														@if($record->is_recurring == 1)
															<li class="kt-nav__item">
																<a href="{{ route('User.cancelRecurringPlan',$record->unique_donation_id) }}" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-cancel-music"></i>
																	<span class="kt-nav__link-text">Cancel Recurring Plan</span>
																</a> 
															</li>
														@endif
														<li class="kt-nav__item">
															<a href="#" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon-download"></i>
																<span class="kt-nav__link-text">Export Individual Donator Payment History</span>
															</a> 
														</li>
														@if($record->is_enquiry == 0)
															<li class="kt-nav__item">
																<a href="{{ route('User.sendRemainder',$record->unique_donation_id) }}" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-mail-1"></i>
																	<span class="kt-nav__link-text">Send Reminder</span>
																</a> 
															</li>
														@endif
													</ul>
												</div>
											</div>  
											@if($editaccountValGlobal != 0)
											<a href="{{URL('/edit-donation-plan/'.$subProjectDetails->slug.'/'.$record->unique_donation_id)}}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
												<i class="la la-edit"></i>
											</a> 
											@endif
											
											@if($deleteaccountValGlobal != 0)
											<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-donation-order/'.$subProjectDetails->slug.'/'.$record->unique_donation_id)}}">
												<i class="la la-trash"></i>
											</a> 
											@endif
											
										</span>
										
									</td> */ ?>
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
				

				<!--End:: App Content-->
			</div>

			<!--End::App-->
		</div>
		

    </div>
   </div>

  </div>
 </div>
</div>


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

var KTAdminDashboard = function() {
	
	// Support Tickets Chart.
	// Based on Morris plugin - http://morrisjs.github.io/morris.js/
	var revenueChange = function() {
		if ($('#kt_chart_revenue_change').length == 0) {
			return;
		}

		Morris.Donut({
			element: 'kt_chart_revenue_change',
			data: [{{$pieChartData}}
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
            revenueChange();
        }
    };
	
}();

// Class initialization on page load
jQuery(document).ready(function() {
    KTAdminDashboard.init();
});

</script>


@stop