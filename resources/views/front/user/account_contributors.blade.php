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
						 {{ trans("messages.account_contributors.contributor_management") }}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.admin_account.account") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.account_contributors.contributors") }} </span>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<a href="{{route('User.exportContributorExcel')}}" class="btn kt-subheader__btn-secondary">
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
								{{ trans("messages.account_contributors.contributor_list") }}
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
								<?php /* @if($addaccountValGlobal != 0)
								<a href="{{URL('/contributor-add')}}" class="btn btn-brand btn-icon-sm">
									<i class="flaticon2-plus"></i>
									Add New
								</a>
								@endif */ ?>
							</div>
						</div>
					</div>
					
					
					<div class="kt-portlet__body">
						<!--begin: Search Form -->
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							{{ Form::open(['role' => 'form','URL' => '/account-contributor','method'=>'get','class' => 'mws-form','files'=>'true','id'=>'searchsalesPersonForm']) }}
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												{{ Form::text('keyword', !empty($searchVariable['keyword'])?$searchVariable['keyword']:'', ['class'=>'form-control','autocomplete'=>'off','id'=>'generalSearch', 'placeholder'=> trans('messages.sub_project_lists.search')]) }}
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>{{ trans('messages.dashboard.status') }}:</label>
												</div>
												<div class="kt-form__control">
												  <div class="form-control">
													{{ Form::select('is_active',array('1'=>trans('messages.navigation.active')), !empty($searchVariable['is_active'])? $searchVariable['is_active']:'', ['class'=>'form-control bootstrap-select', 'autocomplete'=>'off', 'placeholder'=>trans('messages.admin_dashboard.all')]) }}
													
												  </div>
												</div>
											</div>
										</div> 
										
										<button type="submit" class="btn btn-success">{{ trans('messages.sub_project_lists.search') }}</button>&nbsp;
										<a href="{{ route('user.account_contributor') }}" class="btn btn-danger">{{ trans('messages.sub_project_lists.reset') }}</a>
									</div>
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<!--end: Search Form -->
					</div>
					
					
				
					
					<div class="cover_content_table_block">
					  <div class="kt-portlet__body kt-portlet__body--fit">

						<!--begin: Datatable -->
						<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable kt-datatable--loaded" id="kt_datatable_latest_orders" style="">
						  <table class="kt-datatable__table" style="display: block;height: auto;">
							<thead class="kt-datatable__head">
								<tr class="kt-datatable__row" style="left: 0px;">
									<th data-field="#" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 40px;">#</span>
									</th>
									<th data-field="FirstName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans("messages.account_contributors.contributor_name") }}</span>
									</th>
									<th data-field="VendorNumber" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans("messages.account_contributors.contributor_number") }}</span>
									</th>
									<th data-field="Email" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 200px;">{{ trans("messages.account_contributors.contributor_email") }}</span>
									</th>
									<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sorted" data-sort="asc">
										<span style="width: 100px;">{{ trans('messages.dashboard.status') }}<i class="flaticon2-arrow-up"></i></span>
									</th>
									<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 100px;">{{ trans("messages.admin_dashboard.actions") }}</span>
									</th>
								</tr>
							</thead>
							<tbody style="height: auto;display: contents;" class="kt-datatable__body ps ps--active-y">
							@if(!empty($result))
							  <?php $i = 1; ?>
							  @foreach($result as $record)
								<tr data-row="0" class="kt-datatable__row" style="left: 0px;">
									<td data-field="#" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 40px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$i;}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="FirstName" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$record->full_name}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="VendorNumber" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$record->phone}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="Email" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 200px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$record->email}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="Status" class="kt-datatable__cell">
										<span style="width: 100px;">
										@if($record->is_active == 1)
											<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">{{ trans('messages.navigation.active') }}</span>
										@elseif($record->user_role_id != 3)
											<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">
											{{ trans('messages.language_settings.not_registered') }}</span>
										@else
											<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">
											{{ trans('messages.language_settings.in_active') }}</span>
										@endif
										</span>
									</td>
									<td data-field="Actions" class="kt-datatable__cell">
										<span style="overflow: visible;position: relative;width: 100px;display: inline-block;">
										  @if($record->user_role_id == 3)
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
														</li> */ ?>                                 
													  @if($editaccountValGlobal != 0)	
														<li class="kt-nav__item">
															<a href="{{URL('/contributor-edit/'.$record->slug)}}" class="kt-nav__link"> 
																<i class="kt-nav__link-icon flaticon2-contract"></i>
																<span class="kt-nav__link-text">{{ trans('messages.language_settings.edit_details') }}</span>
															</a>
														</li>
														@if($record->is_active == 1)
														<li class="kt-nav__item"> 
															<a href="{{URL('/change-status-contributor/'.$record->slug.'/0')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-drop"></i>
																<span class="kt-nav__link-text">{{ trans('messages.language_settings.in_active') }}</span>
															</a>
														</li> 
														@else
														<li class="kt-nav__item"> 
															<a href="{{URL('/change-status-contributor/'.$record->slug.'/1')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-drop"></i>
																<span class="kt-nav__link-text">{{ trans('messages.navigation.active') }}</span>
															</a>
														</li>
														@endif
													  @endif
													</ul>
												</div>
											</div>  
											@if($deleteaccountValGlobal != 0)
											<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-url="{{URL('/delete-contributor/'.$record->slug)}}">
												<i class="fa fa-trash-alt"></i>                            
											</a> 
											@endif
										  @endif
										</span>
										
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



@stop