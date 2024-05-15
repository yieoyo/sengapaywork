@extends('front.layouts.default')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{ trans("messages.admin_account.admin_management") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.admin_account.account") }} </span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.email_template.admin") }} </span>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<a href="{{route('User.exportAdminExcel')}}" class="btn kt-subheader__btn-secondary">
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
									{{ trans("messages.admin_account.admin_list") }} 
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
									@if($addaccountValGlobal != 0)
									<a href="{{route('user.account_admin_add')}}" class="btn btn-brand btn-icon-sm">
										<i class="flaticon2-plus"></i>
										{{ trans('messages.sub_project_lists.add_new') }}
									</a>
									@endif
								</div>
							</div>
						</div>
					
					<div class="kt-portlet__body">

						<!--begin: Search Form -->
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							{{ Form::open(['role' => 'form','URL' => '/account-admin','method'=>'get','class' => 'mws-form','files'=>'true','id'=>'searchAdminForm']) }}
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												{{ Form::text('keyword', !empty($searchVariable['keyword'])?$searchVariable['keyword']:'', ['class'=>'form-control','autocomplete'=>'off','id'=>'generalSearch', 'placeholder'=> trans('messages.sub_project_lists.search')]) }}
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
										<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>{{ trans('messages.dashboard.status') }}:</label>
												</div>
												<div class="kt-form__control">
												  <div class="form-control">
													{{ Form::select('is_active',array('1'=>trans('messages.navigation.active'),'0'=>trans('messages.language_settings.in_active')), !empty($searchVariable['is_active'])? $searchVariable['is_active']:'', ['class'=>'form-control bootstrap-select', 'autocomplete'=>'off', 'placeholder'=>trans('messages.admin_dashboard.all')]) }}
													
												  </div>
												</div>
											</div>
										</div> 
										<button type="submit" class="btn btn-success">{{ trans('messages.sub_project_lists.search') }}</button>&nbsp;
										<a href="{{ route('user.account_admin') }}" class="btn btn-danger">{{ trans('messages.sub_project_lists.reset') }}</a>
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
										<span style="width: 150px;">{{ trans('messages.personal_information.full_name') }}</span>
									</th>
									<th data-field="LastName" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 150px;">{{ trans("messages.sub_project_detail.phone_number")}}</span>
									</th>
									<th data-field="Email" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 250px;">{{ trans('messages.cms_page_details.email') }}</span>
									</th>
									<th data-field="ShipDate" class="kt-datatable__cell kt-datatable__cell--sort kt-datatable__cell--sorted" data-sort="asc">
										<span style="width: 110px;">{{ trans("messages.admin_account.last_login") }} <i class="flaticon2-arrow-up"></i></span>
									</th>
									<th data-field="Status" class="kt-datatable__cell kt-datatable__cell--sort" data-sort="asc">
										<span style="width: 100px;">{{ trans('messages.dashboard.status') }}</span>
									</th>
									<th data-field="Actions" data-autohide-disabled="false" class="kt-datatable__cell kt-datatable__cell--sort">
										<span style="width: 100px;">{{ trans("messages.admin_dashboard.actions") }}</span>
									</th>
								</tr>
							</thead>
							<tbody style="height: auto;display: contents;" class="kt-datatable__body ps ps--active-y">
							@if(!empty($adminLists))
							  <?php $i = 1; ?>
							  @foreach($adminLists as $adminList)
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
										<span style="width: 150px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$adminList->full_name}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="LastName" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 150px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$adminList->phone}}</a>
												</div>
											</div>
										</span>
									</td>
									<td data-field="email" data-autohide-disabled="false" class="kt-datatable__cell">
										<span style="width: 250px;">                        
											<div class="kt-user-card-v2">                            
												<div class="kt-user-card-v2__details"><a href="#" class="kt-user-card-v2__name">{{$adminList->email}}</a>
												</div>
											</div>
										</span>
									</td>
									<td class="kt-datatable__cell--sorted kt-datatable__cell" data-field="ShipDate">
										<span style="width: 110px;">
											<span class="kt-font-bold">{{!empty($adminList->last_active_date) ? date("d/M/Y h:i A",strtotime($adminList->last_active_date)):"Not Login Yet!";}}</span>
										</span>
									</td>
									<td data-field="Status" class="kt-datatable__cell">
										<span style="width: 100px;">
										@if($adminList->is_active == 1)
											<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">
											{{ trans('messages.navigation.active') }}</span>
										@else
											<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">
											{{ trans('messages.language_settings.in_active') }}</span>
										@endif
										</span>
									</td>
									<td data-field="Actions" class="kt-datatable__cell">
										<span style="overflow: visible;position: relative;width: 100px;">                        
											@if($editaccountValGlobal != 0)
											<div class="dropdown">
												<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
													<i class="flaticon-more-1"></i>                            
												</a>                            
												<div class="dropdown-menu dropdown-menu-right" style="">                                
													<ul class="kt-nav">                                    
														<li class="kt-nav__item">
															<a href="{{URL('/edit-admin/'.$adminList->slug)}}" class="kt-nav__link"> 
																<i class="kt-nav__link-icon flaticon2-contract"></i>
																<span class="kt-nav__link-text">{{ trans('messages.language_settings.edit_details') }}</span>
															</a>
														</li>
														
														@if($adminList->is_active == 1)
														  <li class="kt-nav__item">
															<a href="{{URL('/change-status-admin/'.$adminList->slug.'/0')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-mail-1"></i>
																<span class="kt-nav__link-text">{{ trans('messages.language_settings.in_active') }}</span>
															</a> 
														  </li>
														@else
														  <li class="kt-nav__item">
															<a href="{{URL('/change-status-admin/'.$adminList->slug.'/1')}}" class="kt-nav__link">
																<i class="kt-nav__link-icon flaticon2-mail-1"></i>
																<span class="kt-nav__link-text">{{ trans('messages.navigation.active') }}</span>
															</a> 
														  </li>
														@endif
													</ul>
												</div>
											</div>                    
											@endif
											@if($deleteaccountValGlobal != 0)
											 <a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" data-url="{{URL('/delete-admin/'.$adminList->slug)}}">
												<i class="fa fa-trash-alt"></i>                            
											 </a>
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
						 @include('pagination.front', ['paginator' => $adminLists])
						 
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
$(".delete_record").click(function(){
	var dataUrl = $(this).attr("data-url");
	
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
		window.location.href	 =	dataUrl;
	  }
	})
})
</script>

@stop