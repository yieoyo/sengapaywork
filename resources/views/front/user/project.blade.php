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
						Projects Management </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link"> General </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link"> Projects </span>
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
								Project List
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__head-wrapper">
								<a href="{{ URL::previous() }}" class="btn btn-clean btn-icon-sm">
									<i class="la la-long-arrow-left"></i>
									Back
								</a>
								&nbsp;
								&nbsp;
								<a href="{{URL('/project-add')}}" class="btn btn-brand btn-icon-sm">
									<i class="flaticon2-plus"></i>
									Add New
								</a>
							</div>
						</div>
					</div>


					<div class="kt-portlet__body">
						<!--begin: Search Form -->
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
							{{ Form::open(['role' => 'form','URL' => '/projects','method'=>'get','class' => 'mws-form','files'=>'true','id'=>'searchProjectForm']) }}
							<div class="row align-items-center">
								<div class="col-xl-8 order-2 order-xl-1">
									<div class="row align-items-center">
										<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-input-icon kt-input-icon--left">
												<input type="text" name="keyword" class="form-control" placeholder="Search..." id="generalSearch" value="{{!empty($searchVariable['keyword'])? $searchVariable['keyword']:'';}}">
												<span class="kt-input-icon__icon kt-input-icon__icon--left">
													<span><i class="la la-search"></i></span>
												</span>
											</div>
										</div>
										<div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
											<div class="kt-form__group kt-form__group--inline">
												<div class="kt-form__label">
													<label>Status:</label>
												</div>
												<div class="kt-form__control">
												  <div class="form-control">
													{{ Form::select('is_active',array('1'=>'Active','0'=>'InActive'), !empty($searchVariable['is_active'])? $searchVariable['is_active']:'', ['class'=>'form-control bootstrap-select', 'autocomplete'=>'off', 'placeholder'=>trans('All')]) }}
													
												  </div>
												</div>
											</div>
										</div> 
										<button type="submit" class="btn btn-success">Search</button>&nbsp;
										<a href="{{ route('user.project') }}" class="btn btn-danger">Reset</a>
									</div>
								</div>
							</div>
							{{ Form::close() }}
						</div>

						<!--end: Search Form -->
					</div>
                    
					
					<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded cover_table_content_block">
						<table id="table_content">
						  <tbody>
						  <tr>
							<th>#</th>
							<th>Project Name</th>
							<th>Status</th>
							<th>Action</th>
						  </tr>
						  @if(!empty($result))
							<?php $i = 1;?>
							@foreach($result as $record)
							  <tr>
								<td>{{$i;}}</td>
								<td>{{$record->name}}</td>
								<td>
									@if($record->is_active == 1)
										<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Active</span>
									@else
										<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">InActive</span>
									@endif
								</td>
								<td>
									<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">                        
										<div class="dropdown">
											<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
												<i class="flaticon-more-1"></i>                            
											</a>                            
											<div class="dropdown-menu dropdown-menu-right">                                
												<ul class="kt-nav">                                    
													<li class="kt-nav__item">
														<a href="{{URL('/project-edit/'.$record->slug)}}" class="kt-nav__link"> 
															<i class="kt-nav__link-icon flaticon2-contract"></i>
															<span class="kt-nav__link-text">Edit Details</span>
														</a>
													</li>
													@if($record->is_active == 1)
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-project/'.$record->slug.'/0')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">InActive</span>
														</a> 
													  </li>
													@else
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-project/'.$record->slug.'/1')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">Active</span>
														</a> 
													  </li>
													@endif
												</ul>
											</div>
										</div>                    
									</span>
									<span style="overflow: visible;position: relative;width: 25px;display: inline-block;">   
										<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" data-url="{{URL('/delete-project/'.$record->slug)}}">
											<i class="fa fa-trash-alt"></i>                            
										</a>
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
					
					
				</div>		
				
			
			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



@stop