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
						{{ trans("messages.language_settings.translation_management") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.translation") }} </a>
						<!--<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Profile 1 </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							Email Settings </a>-->
					</div>
				</div>
				
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<a href="#" class="btn kt-subheader__btn-secondary">
							{{ trans("messages.language_settings.reports") }}
						</a>
						<!--<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions" data-placement="top">
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
									{{ trans("messages.language_settings.translation_list") }}
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									<a href="#" class="btn btn-clean btn-icon-sm">
										<i class="la la-long-arrow-left"></i>
										{{ trans('messages.sub_project_lists.back') }}
									</a>
									&nbsp;
									&nbsp;
									<div class="dropdown dropdown-inline">
										<button type="button" class="btn btn-brand btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="flaticon2-plus"></i> {{ trans('messages.sub_project_lists.add_new') }}
										</button>
										
									</div>
								</div>
							</div>
						</div>
					
					
					<div class="kt-portlet__body">

							<!--begin: Search Form -->
							<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
								<div class="row align-items-center">
									<div class="col-xl-8 order-2 order-xl-1">
										<div class="row align-items-center">
											<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
												<div class="kt-input-icon kt-input-icon--left">
													<input type="text" class="form-control" placeholder="Search..." id="generalSearch">
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
														<div class="dropdown bootstrap-select form-control dropup"><select class="form-control bootstrap-select" id="kt_form_status" tabindex="-98">
															<option value="">{{ trans("messages.admin_dashboard.all") }}</option>
															<option value="1">{{ trans('messages.navigation.active') }}</option>
															<option value="2">{{ trans('messages.navigation.not_active') }}</option>
														</select><button type="button" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="kt_form_status" title="Nothing selected"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">{{ trans("messages.admin_dashboard.all") }}</div></div> </div></button><div class="dropdown-menu" style="max-height: 262px; overflow: hidden; min-height: 0px;"><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1" style="max-height: 236px; overflow-y: auto; min-height: 0px;"><ul class="dropdown-menu inner show" role="presentation" style="margin-top: 0px; margin-bottom: 0px;"><li><a role="option" class="dropdown-item" id="bs-select-1-0" tabindex="0"><span class="text">{{ trans("messages.admin_dashboard.all") }}</span></a></li><li><a role="option" class="dropdown-item" id="bs-select-1-1" tabindex="0"><span class="text">{{ trans('messages.navigation.active') }}</span></a></li><li><a role="option" class="dropdown-item" id="bs-select-1-2" tabindex="0"><span class="text">{{ trans('messages.navigation.not_active') }}</span></a></li></ul></div></div></div>
													</div>
												</div>
											</div> 
										</div>
									</div>
									
								</div>
							</div>

							<!--end: Search Form -->
						</div>
					
					<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded ">
						<table id="table_content">
						  <tr>
							<th>#</th>
							<th>{{ trans("messages.language_settings.english_language") }}</th>
							<th>{{ trans("messages.language_settings.malay_Language") }}</th>
							<th>{{ trans("messages.language_settings.page_list") }}</th>
							<th>{{ trans('messages.dashboard.status') }}</th>
							<th>{{ trans("messages.language_settings.action") }}</th>
						  </tr>
						  <tr>
							<td>1</td>
							<td>{{ trans("messages.language_settings.booking") }}</td>
							<td>{{ trans("messages.language_settings.booking") }}</td>
							<td>{{ trans("messages.cms_pages.page") }} 1</td>
							<td><span class="active_status">{{ trans('messages.navigation.active') }}</span></td>
							<td>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<div class="dropdown">
										<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
											<i class="flaticon-more-1"></i>                            
										</a>                            
										<div class="dropdown-menu dropdown-menu-right">                                
											<ul class="kt-nav">                                    
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-expand"></i>
														<span class="kt-nav__link-text">{{ trans("messages.admin_account.view") }}</span>
													</a>                                    
												</li>                                    
												<li class="kt-nav__item">
													<a href="{{URL('/translation-edit')}}" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-contract"></i>
														<span class="kt-nav__link-text">Edit</span>
													</a>
												</li>
												<li class="kt-nav__item"> 
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-trash"></i>
														<span class="kt-nav__link-text">{{ trans("messages.sub_project_detail.delete") }}</span>
													</a>
												</li>
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-mail-1"></i>
														<span class="kt-nav__link-text">Export</span>
													</a> 
												</li>
											</ul>
										</div>
									</div>                    
								</span>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
										<i class="fa fa-trash-alt"></i>                            
									</a>                    
								</span>
								
							</td>
						  </tr>
						  <tr>
							<td>2</td>
							<td>Best Deal</td>
							<td>Deal Terbaik</td>
							<td>Page 1</td>
							<td><span class="not_active_status">Inactive</span></td>
							<td>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<div class="dropdown">
										<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
											<i class="flaticon-more-1"></i>                            
										</a>                            
										<div class="dropdown-menu dropdown-menu-right">                                
											<ul class="kt-nav">                                    
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-expand"></i>
														<span class="kt-nav__link-text">View</span>
													</a>                                    
												</li>                                    
												<li class="kt-nav__item">
													<a href="{{URL('/translation-edit')}}" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-contract"></i>
														<span class="kt-nav__link-text">Edit</span>
													</a>
												</li>
												<li class="kt-nav__item"> 
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-trash"></i>
														<span class="kt-nav__link-text">Delete</span>
													</a>
												</li>
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-mail-1"></i>
														<span class="kt-nav__link-text">Export</span>
													</a> 
												</li>
											</ul>
										</div>
									</div>                    
								</span>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
										<i class="fa fa-trash-alt"></i>                            
									</a>                    
								</span>
								
							</td>
						  </tr>
						  <tr>
							<td>3</td>
							<td>Buy</td>
							<td>Beli</td>
							<td>Page 1</td>
							<td><span class="active_status">Success</span></td>
							<td>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<div class="dropdown">
										<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
											<i class="flaticon-more-1"></i>                            
										</a>                            
										<div class="dropdown-menu dropdown-menu-right">                                
											<ul class="kt-nav">                                    
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-expand"></i>
														<span class="kt-nav__link-text">View</span>
													</a>                                    
												</li>                                    
												<li class="kt-nav__item">
													<a href="{{URL('/translation-edit')}}" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-contract"></i>
														<span class="kt-nav__link-text">Edit</span>
													</a>
												</li>
												<li class="kt-nav__item"> 
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-trash"></i>
														<span class="kt-nav__link-text">Delete</span>
													</a>
												</li>
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-mail-1"></i>
														<span class="kt-nav__link-text">Export</span>
													</a> 
												</li>
											</ul>
										</div>
									</div>                    
								</span>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
										<i class="fa fa-trash-alt"></i>                            
									</a>                    
								</span>
								
							</td>
						  </tr>
						  <tr>
							<td>4</td>
							<td>Bring</td>
							<td>Bawa</td>
							<td>Page 10</td>
							<td><span class="active_status">Success</span></td>
							<td>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<div class="dropdown">
										<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
											<i class="flaticon-more-1"></i>                            
										</a>                            
										<div class="dropdown-menu dropdown-menu-right">                                
											<ul class="kt-nav">                                    
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-expand"></i>
														<span class="kt-nav__link-text">View</span>
													</a>                                    
												</li>                                    
												<li class="kt-nav__item">
													<a href="{{URL('/translation-edit')}}" class="kt-nav__link"> 
														<i class="kt-nav__link-icon flaticon2-contract"></i>
														<span class="kt-nav__link-text">Edit</span>
													</a>
												</li>
												<li class="kt-nav__item"> 
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-trash"></i>
														<span class="kt-nav__link-text">Delete</span>
													</a>
												</li>
												<li class="kt-nav__item">
													<a href="#" class="kt-nav__link">
														<i class="kt-nav__link-icon flaticon2-mail-1"></i>
														<span class="kt-nav__link-text">Export</span>
													</a> 
												</li>
											</ul>
										</div>
									</div>                    
								</span>
								<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
									<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
										<i class="fa fa-trash-alt"></i>                            
									</a>                    
								</span>
								
							</td>
						  </tr>
						</table>
						
						<div class="kt-datatable__pager kt-datatable--paging-loaded">
							<ul class="kt-datatable__pager-nav">
							  <li><a title="First" class="kt-datatable__pager-link kt-datatable__pager-link--first kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-fast-back"></i></a></li>
							  <li><a title="Previous" class="kt-datatable__pager-link kt-datatable__pager-link--prev kt-datatable__pager-link--disabled" data-page="1" disabled="disabled"><i class="flaticon2-back"></i></a></li>
							  <li style=""></li>
							  <li style="display: none;"><input type="text" class="kt-pager-input form-control" title="Page number"></li>
							  <li><a class="kt-datatable__pager-link kt-datatable__pager-link-number kt-datatable__pager-link--active" data-page="1" title="1">1</a></li>
							  <li><a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="2" title="2">2</a></li>
							  <li><a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="3" title="3">3</a></li>
							  <li><a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="4" title="4">4</a></li>
							  <li><a class="kt-datatable__pager-link kt-datatable__pager-link-number" data-page="5" title="5">5</a></li>
							  <li></li>
							  <li><a title="Next" class="kt-datatable__pager-link kt-datatable__pager-link--next" data-page="2"><i class="flaticon2-next"></i></a></li>
							  <li><a title="Last" class="kt-datatable__pager-link kt-datatable__pager-link--last" data-page="20"><i class="flaticon2-fast-next"></i></a></li>
							</ul>
							<div class="kt-datatable__pager-info">
							  <div class="dropdown bootstrap-select kt-datatable__pager-size" style="width: 60px;">
								 <select class="selectpicker kt-datatable__pager-size" title="Select page size" data-width="60px" data-container="body" data-selected="10" tabindex="-98">
									<option class="bs-title-option" value=""></option>
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="100">100</option>
								 </select>
								<!-- <button type="button" class="btn dropdown-toggle btn-light" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" title="Select page size">
									<div class="filter-option">
									   <div class="filter-option-inner">
										  <div class="filter-option-inner-inner">10</div>
									   </div>
									</div>
								 </button>-->
								 <div class="dropdown-menu ">
									<div class="inner show" role="listbox" id="bs-select-1" tabindex="-1">
									   <ul class="dropdown-menu inner show" role="presentation"></ul>
									</div>
								 </div>
							  </div>
							  <span class="kt-datatable__pager-detail">Showing 1 - 10 of 200</span>
							</div>
						</div>
						
						
					</div>
					
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
			<!--	<div class="cover_content_block">
					<div class="cover_content_header">
						<div class="cover_content_header_left">
							<div class="cover_content_header_hd"><span class="flaticon2-line-chart"></span>Sale Type List</div>
						</div>
						<div class="cover_content_header_right">
							<div class="cover_content_header_btn_blk">
								<ul>
									<li><a href="javascript:void(0);"><span class="flaticon2-left-arrow-1"></span> Back</a></li>
									<li><a class="cover_content_btn_highlight" href="javascript:void(0);"><span class="flaticon2-plus"></span> Add New</a></li>
									<div class="clearfix"></div>
								</ul>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					
					
					
					<div class="cover_content_search_blk">
						<div class="cover_content_search">
							<form role="form" method="get" action="">
								<div class="cover_content_search_form">
									<button type="submit"><span class="flaticon-search"></span></button>
									<input type="text" name="" id="" value="" placeholder="Search ...">
								</div>
							</form>
						</div>
						<div class="cover_content_status_blk"><span>Status:</span>
							<a href="#" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								All
							</a>
							<div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right" style="">
								
								<ul class="kt-nav">
									
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon flaticon2-drop"></i>
											<span class="kt-nav__link-text">Activity</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon flaticon2-calendar-8"></i>
											<span class="kt-nav__link-text">FAQ</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="#" class="kt-nav__link">
											<i class="kt-nav__link-icon flaticon2-telegram-logo"></i>
											<span class="kt-nav__link-text">Settings</span>
										</a>
									</li>
								</ul>

								
							</div>
						</div>
						
					</div>
					
					<div class="cover_content_table_block">
						<div class="kt-portlet  kt-portlet--mobile ">
							<div class="kt-portlet__body kt-portlet__body--fit">
								<div class="kt-portlet__body kt-portlet__body--fit">
									<div class="kt-datatable" id="kt_datatable_latest_orders"></div>	
								</div>
							</div>
						</div>
					</div>
					
				</div>-->


			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



@stop