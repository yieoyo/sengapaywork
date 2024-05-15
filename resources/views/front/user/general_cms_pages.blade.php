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
						{{ trans("messages.cms_pages.cms_pages") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link"> {{ trans("messages.header.general") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link"> {{ trans("messages.cms_pages.cms_pages") }} </span>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<!--<a href="" class="btn kt-subheader__btn-secondary">
							Reports
						</a>
						<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
							<a href="#" class="btn btn-danger kt-subheader__btn-options" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Products
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>
								<a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>
								<a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
							</div>
						</div>-->
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
								{{ trans("messages.cms_pages.cms_pages_list") }}
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
								@if($addgeneralValGlobal != 0)
								<a href="{{URL('/cms-pages-add')}}" class="btn btn-brand btn-icon-sm">
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
							{{ Form::open(['role' => 'form','URL' => '/cms-pages','method'=>'get','class' => 'mws-form','files'=>'true','id'=>'searchCMSForm']) }}
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
										<div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
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
										<a href="{{ route('user.general_cms_pages') }}" class="btn btn-danger">{{ trans('messages.sub_project_lists.reset') }}</a>
									</div>
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<!--end: Search Form -->
					</div>
                    
					
					
					<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable kt-datatable--loaded">
						<table class="kt-datatable__table" id="table_content">
						  <tbody style="height: auto;display: contents;" >
						  <tr>
							<th style="width: 5%;">#</th>
							<th style="width: 12%;">{{ trans("messages.cms_pages.page_name") }}</th>
							<th style="width: 60%;"> {{ trans("messages.cms_pages.page_slug") }}</th>
							<th style="width: 10%;">{{ trans('messages.dashboard.status') }}</th>
							<th style="width: 10%;">{{ trans("messages.language_settings.action") }}</th>
						  </tr>
						  
						  
						  
						  @if(!empty($result))
							<?php $i = 1;?>
							@foreach($result as $record)
							  <tr>
								<td>{{$i;}}</td>
								<td>{{$record->page_name}}</td>
								<td>{{WEBSITE_URL."projects/".$record->slug}}</td>
								<td>
									@if($record->is_active == 1)
										<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">{{ trans('messages.navigation.active') }}</span>
									@else
										<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.language_settings.in_active') }}</span>
									@endif
								</td>
								<td>
								  @if($editgeneralValGlobal != 0)
									<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
										<div class="dropdown">
											<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
												<i class="flaticon-more-1"></i>                            
											</a>                            
											<div class="dropdown-menu dropdown-menu-right">                                
												<ul class="kt-nav">                                    
													<li class="kt-nav__item">
														<a href="{{URL('/cms-pages-edit/'.$record->slug)}}" class="kt-nav__link"> 
															<i class="kt-nav__link-icon flaticon2-contract"></i>
															<span class="kt-nav__link-text">{{ trans('messages.language_settings.edit_details') }}</span>
														</a>
													</li>
													@if($record->is_active == 1)
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-cms-pages/'.$record->slug.'/0')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">{{ trans('messages.language_settings.in_active') }}</span>
														</a> 
													  </li>
													@else
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-cms-pages/'.$record->slug.'/1')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">{{ trans('messages.navigation.active') }}</span>
														</a> 
													  </li>
													@endif
												</ul>
											</div>
										</div>                    
									</span>
								  @endif
								  @if($deletegeneralValGlobal != 0)
									<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">   
										<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" data-url="{{URL('/delete-cms-pages/'.$record->slug)}}">
											<i class="fa fa-trash-alt"></i>                            
										</a>
									</span>
								  @endif
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
					
				</div>		
				
			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



@stop