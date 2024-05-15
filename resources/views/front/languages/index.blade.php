@extends('front.layouts.default')
@section('content')
<script>
	$(function(){
		/**
		 * Function to change status
		 *
		 * @param null
		 *
		 * @return void
		 */
		$(document).on('click', '.default_any_item', function(e){ 
			e.stopImmediatePropagation();
			url = $(this).attr('href');
			bootbox.confirm("Are you sure want to make default this language ?",
			function(result){
				if(result){
					window.location.replace(url);
				}
			});
			e.preventDefault();
		});
	});
</script>
<script type="text/javascript">
$(function(){
	/**
	 * Function to edit string
	 *
	 * @param null
	 *
	 * @return void
	 */
	$("a.edit_button").click(function(e){ 
		var btn			=	$(this);
		btn.button('loading');
		var id			=	this.id.replace('edit_','');
		var save_url	=	this.href; 
		//alert(save_url);return false;
		$("#actual_div_"+id).hide();
		$("#edit_div_"+id).show();
		$.ajax({
			url:this.href,
			success:function(r){ 
				btn.button('reset');
				$("#edit_div_"+id).empty().html(r);
				$("#edit_div_"+id).find("#cancel").click(function(e){
					$("#actual_div_"+id).show();
					$("#edit_div_"+id).hide();
					return false;
				});
				$("#edit_div_"+id).find("#editgroup").click(function(e){ 
					$("#editgroup").button('loading');
					if($("#edit_msgstr").val()==''){
						$("#edit_msgstr").css( {'color':'#EE5F5B','border-color':'#EE5F5B'});
						$("#editgroup").button('reset');
						return false;
					}else{  
						var msg =  $("#edit_msgstr").val(); 
						$.ajax({ 
							url:"{{{ URL::to('admin/language-settings/edit-setting/') }}}",
							type: "POST",
							data: {'id':id,'msgstr':msg},
							success: function(r){ 
								window.location.href	=	window.location.href;
								return false;
							}
						});	
					}
				});
			}
		});
		return false;
	});
});
</script>


<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						{{ trans("messages.language_settings.translation_management") }}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.translation") }} </span>
					</div>
				</div>
				<div class="kt-subheader__toolbar">
					<div class="kt-subheader__wrapper">
						<a href="{{route('User.exportLanguageExcel')}}" class="btn kt-subheader__btn-secondary">
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
								{{ trans("messages.language_settings.translation_list") }}
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
								@if(Config::get('app.debug'))
								<div class="dropdown dropdown-inline">
									<a href="{{route('LanguageSetting.add')}}" class="btn btn-brand btn-icon-sm">
										<i class="flaticon2-plus"></i> {{ trans('messages.sub_project_lists.add_new') }}
									</a>
									
								</div>
								@endif
							</div>
						</div>
					</div>
					
					
					<div class="kt-portlet__body">

						<!--begin: Search Form -->
						{{ Form::open(['method' => 'get','role' => 'form','route' => "LanguageSetting.index",'class' => 'mws-form']) }}
						{{ Form::hidden('display') }}
						<div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
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
													{{ Form::select('is_active',array('1'=>trans('messages.navigation.active'),'0'=>trans('messages.language_settings.in_active')), !empty($searchVariable['is_active'])? $searchVariable['is_active']:'', ['class'=>'form-control bootstrap-select', 'autocomplete'=>'off', 'placeholder'=>trans("messages.admin_dashboard.all")]) }}
												  </div>
												</div>
											</div>
										</div> 
										<button type="submit" class="btn btn-success">{{ trans('messages.sub_project_lists.search') }}</button>&nbsp;
										<a href="{{ route('LanguageSetting.index') }}" class="btn btn-danger">{{ trans('messages.sub_project_lists.reset') }}</a>
										
									</div>
								</div>
								
							</div>
						</div>
						{{ Form::close() }}
						<!--end: Search Form -->
					</div>
					
					<div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded ">
						<table id="table_content">
						  <tr>
							<th>#</th>
							<th>
								{{
									link_to_route(
										"LanguageSetting.index",
										trans("messages.language_settings.english_language"),
										array(
											'sortBy' => 'msgstr',
											'order' => ($sortBy == 'msgstr' && $order == 'desc') ? 'asc' : 'desc'
										),
									   array('class' => (($sortBy == 'msgstr' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'msgstr' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
								}}
							</th>
							<th>
								{{
									link_to_route(
										"LanguageSetting.index",
										trans("messages.language_settings.malay_Language"),
										array(
											'sortBy' => 'msgstr',
											'order' => ($sortBy == 'msgstr' && $order == 'desc') ? 'asc' : 'desc'
										),
									   array('class' => (($sortBy == 'msgstr' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'msgstr' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
								}}
							</th>
							<!--<th>Page List</th>-->
							<th>
								{{
									link_to_route(
										"LanguageSetting.index",
										trans("messages.dashboard.status"),
										array(
											'sortBy' => 'is_active',
											'order' => ($sortBy == 'is_active' && $order == 'desc') ? 'asc' : 'desc'
										),
									   array('class' => (($sortBy == 'is_active' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'is_active' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
								}}
							</th>
							<th>{{ trans("messages.language_settings.action") }}</th>
						  </tr>
						  @if(!$result->isEmpty())
							<?php $counter = "1"; ?>
							@foreach($result as $results)
							  <tr>
								<td>{{$counter}}</td>
								<td>
									{{ stripslashes($results->msgstr) }}
								</td>
								<td>{{ stripslashes($results->ms_msgstr) }}</td>
								<!--<td>Page 1</td>--->
								<td>
									@if($results->is_active == 1)
										<span class="active_status">{{ trans('messages.navigation.active') }}</span>
									@else
										<span class="not_active_status">{{ trans('messages.language_settings.in_active') }}</span>
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
														<a href="{{URL('/language-settings/edit-setting/'.$results->msgid)}}" class="kt-nav__link"> 
															<i class="kt-nav__link-icon flaticon2-contract"></i>
															<span class="kt-nav__link-text">{{ trans('messages.language_settings.edit_details') }}</span>
														</a>
													</li>
													@if($results->is_active == 1)
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-language/'.$results->msgid.'/0')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">{{ trans('messages.language_settings.in_active') }}</span>
														</a> 
													  </li>
													@else
													  <li class="kt-nav__item">
														<a href="{{URL('/change-status-language/'.$results->msgid.'/1')}}" class="kt-nav__link">
															<i class="kt-nav__link-icon flaticon2-mail-1"></i>
															<span class="kt-nav__link-text">{{ trans('messages.navigation.active') }}</span>
														</a> 
													  </li>
													@endif
												</ul>
											</div>
										</div>                    
									</span>
									<a href="javascript:void();" class="delete_record btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" data-url="{{URL('/language-settings/delete-setting/'.$results->msgid)}}">
										<i class="fa fa-trash-alt"></i>                            
									</a>
									
								</td>
							  </tr>
							  <?php $counter++; ?>
							@endforeach
						  @endif
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
