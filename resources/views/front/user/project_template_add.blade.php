@extends('front.layouts.default')
@section('content')


<!--- ckeditor js start  here -->
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/ckeditor/ckeditor.js') }}

<script>
$(function(){
	$('.campaign_start_date').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD HH:mm',
		changeMonth: true,
		changeYear : true,
		weekStart : 0,
		time: true,
		yearRange: '-100:+100',
		minDate : new Date()  
	}).on('change', function(e, date)
	{
		$(".campaign_end_date").val("");
		$('.campaign_end_date').bootstrapMaterialDatePicker('setMinDate', date);
	});
	$('.campaign_end_date').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD HH:mm',
		changeMonth: true,
		changeYear : true,
		weekStart : 0,
		time: true,
		nowButton : true,
		switchOnClick : true,
		yearRange: '-100:+100',
		//maxDate : new Date()  
		//minDate : new Date()  
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
						{{ trans("messages.header.project_template") }}</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="#" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.header.project_template") }} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="{{ route('user.project_template') }}" class="kt-subheader__breadcrumbs-link">
								{{$subProjectDetails->sub_project_name}}</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<span class="kt-subheader__breadcrumbs-link">
								 {{ trans("messages.project_template.add_template") }}</span>
						</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::App-->
			{{ Form::open(['role' => 'form','route' => "User.SaveProjectTemplate",'files'=>'true', 'class' => 'kt-form','id'=>"ProjectTemplateForm"]) }}
			{{ Form::hidden('sub_project_id', !empty($subProjectDetails->id) ? $subProjectDetails->id: '', ['class'=>'', 'autocomplete'=>'off']) }}
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.customize_template") }}
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subproject_name") }}</label>
									<div class="col-5">
										{{ Form::text('sub_project_name', !empty($subProjectDetails->sub_project_name) ? $subProjectDetails->sub_project_name: '', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_subproject_name")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subproject_type")}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('subject_type','0','1',['class'=>'subject_type']) }} {{trans('messages.cms_pages.default')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('subject_type','1','',['class'=>'subject_type']) }} {{trans('messages.edit_book_plan.enquiry')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.edit_book_plan.payment_type') }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('payment_type','2','1',['class'=>'']) }} {{trans('messages.project_template.fix_price')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.payment_method")}}</label>
									<div class="col-9">
										<div class="kt-checkbox-inline">
											@if(!empty($paymentMethods))
											  @foreach($paymentMethods as $methodId=>$MethodName)
												<label class="kt-checkbox">
													{{ Form::checkbox('payment_method[]',$methodId,'', ['class'=>'']) }} {{$MethodName}}
													<span></span>
												</label>
											  @endforeach
											@endif
											<span class="help-inline payment_method_error"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.contributor_type")}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contributor_type','personal','1',['class'=>'']) }} {{trans('messages.project_template.personal')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contributor_type','company','',['class'=>'']) }} {{trans('messages.project_template.company')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.target_achievement")}}</label>
									<div class="col-5">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm")}}</span></div>
											{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_targeted_amount")]) }}
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="col-2">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												{{ Form::checkbox('client_view',1,'', ['class'=>'']) }} {{trans('messages.project_template.enable_client_view')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.donation_button")}}</label>
									<div class="col-3">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('donation_btn_type','default','1',['class'=>'']) }} {{trans('messages.project_template.active')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('donation_btn_type','url','',['class'=>'']) }} {{trans('messages.project_template.url_link')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="col-4">
										<div class="input-group donation_btn_url_blk">
											{{ Form::text('donation_btn_url', '', ['class'=>'form-control', 'id'=>'donation_btn_url', 'autocomplete'=>'off']) }}
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
							</div>
						</div>
							
					</div>
				</div>
				
			</div>


			
			@if($subProjectDetails->project_module == 3)
				
			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.customize_plan_properties")}}
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__tab_block_options">
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',5,'1',['class'=>'customize_plan_option', 'id'=>'customize_plan_option5']) }}
									<label for="customize_plan_option5">{{ trans("messages.cms_pages.default") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',6,'',['class'=>'customize_plan_option', 'id'=>'customize_plan_option6']) }}
									<label for="customize_plan_option6">{{ trans("messages.project_template.property")}}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',7,'',['class'=>'customize_plan_option', 'id'=>'customize_plan_option7']) }}
									<label for="customize_plan_option7">{{ trans("messages.project_template.vendor")}}</label>
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="kt-portlet__body">
						<div class="tab-content">
							
							<div class="tab-pane active" id="kt_widget5_tab5_content" aria-expanded="true">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.book_plan.plan")}}:</label>
									<div class="col-9">
										<div class="get_default_dana_project_plan_block">
											
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDefaultDanaPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.project_template.add_project_plan")}}</button>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab6_content">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.property_type")}}:</label>
									<div class="col-9">
										<div class="get_dana_property_type_block">
											
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMorePropertyType()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.project_template.add_property") }}</button>
										</div>
										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.account_contributors.price") }}:</label>
									<div class="col-9">
										<div class="get_property_price_range_block">
											
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMorePropertyPriceRange()" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.project_template.add_price_range") }}</button>
										</div>
										
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-3">
										<div class="kt-form__group--inline">
											<div class="kt-form__label">
												<label>{{ trans("messages.project_template.vendor")}}</label>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="kt-form__group--inline">
											{{ Form::select('vendor',$vendorLists,'',['class'=>'form-control' ]) }}
										</div>
										<div class="d-md-none kt-margin-b-10"></div>
									</div>
								</div>
								
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab7_content">
								<div class="form-group row">
									<div class="col-md-3">
										<div class="kt-form__group--inline">
											<div class="kt-form__label">
												<label>{{ trans("messages.project_template.vendor")}}</label>
											</div>
										</div>
									</div>
									<div class="col-md-5">
										<div class="kt-form__group--inline">
											{{ Form::select('vendors[]',$vendorLists,'',['class'=>'form-control kt-selectpicker', 'multiple'=> true, 'data-live-search'=>true, 'data-actions-box'=>true, 'title'=>trans("messages.project_template.select_vendors"), 'data-selected-text-format'=>'count > 4' ]) }}
										</div>
										<div class="d-md-none kt-margin-b-10"></div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				
				</div>
				
			</div>


			@elseif($subProjectDetails->project_module == 2)
			
			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.customize_plan_properties")}}
							</h3>
						</div>
						<div class="kt-portlet__head-toolbar">
							<div class="kt-portlet__tab_block_options">
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',1,'1',['class'=>'customize_plan_option', 'id'=>'customize_plan_option1']) }}
									<label for="customize_plan_option1">{{ trans("messages.cms_pages.default") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',2,'',['class'=>'customize_plan_option', 'id'=>'customize_plan_option2']) }}
									<label for="customize_plan_option2">{{ trans("messages.project_template.seat_reservation")}}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',3,'',['class'=>'customize_plan_option', 'id'=>'customize_plan_option3']) }}
									<label for="customize_plan_option3">{{ trans("messages.sub_project_detail.quantity") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',4,'',['class'=>'customize_plan_option', 'id'=>'customize_plan_option4']) }}
									<label for="customize_plan_option4">{{ trans("messages.project_template.section")}}</label>
								</div>
							</div>
							
							<?php /* <ul class="nav nav-pills nav-pills-sm nav-pills-button nav-pills-bold" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab" aria-selected="true">
										Default
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab" aria-selected="false">
										Seat Reservation
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab" aria-selected="false">
										Quantity
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab4_content" role="tab" aria-selected="false">
										Section
									</a>
								</li>
							</ul> */ ?>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="tab-content">
							
							<div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="get_default_project_plan_block">
											
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDefaultProjectPlan()" class="btn btn-label-brand"><i class="la la-plus"></i> {{ trans("messages.project_template.add_project_plan")}}</button>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab2_content">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}}:</label>
									<div class="col-5">
										{{ Form::text('seat_reservation_main_title', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.no_of_subtitle") }}:</label>
									<div class="col-5">
										{{ Form::select('seat_reservation_total_subtitle',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5') ,'', ['class'=>'custom-select form-control seat_reservation_total_subtitle', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.selec_no_of_subtitle")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="special_project_dynamic_subtitle_html">
									
								</div>
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.sub_project_detail.manual_contribution") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('seat_reservation_menual_contribution','1','',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('seat_reservation_menual_contribution','0','1',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}} :</label>
									<div class="col-5">
										{{ Form::text('seat_reservation_main_title_2', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab3_content">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="get_quantity_project_plan_block">
											
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreQuantityProjectPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.sub_project_detail.add_seat") }}</button>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab4_content">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.section_title") }}:</label>
									<div class="col-5">
										{{ Form::text('section_title', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_section_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.section") }}:</label>
									<div class="col-9">
										<div class="get_section_project_plan_block">
										
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreSectionProjectPlan()" class="btn btn-label-brand"><i class="la la-plus"></i> {{ trans("messages.sub_project_detail.add_seat") }}</button>
										</div>
										
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.multiple_participant") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('is_multiple_participate','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.enable') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('is_multiple_participate','0','',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
							</div>
						
						</div>
					</div>
				
				</div>
				
				
			</div>

			@else
			
			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.customize_plan_properties")}}
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_status") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('daily_status','1','1',['class'=>'', 'id'=>'daily_status1']) }} {{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('daily_status','2','',['class'=>'', 'id'=>'daily_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('daily_status','0','',['class'=>'', 'id'=>'daily_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('daily_description', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('daily_description_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_plan") }}</label>
									<div class="col-9">
										<div class="daily_plan_block">
											<?php /* <div class="form-group">
												<label>Price</label>
												<div class="row">
													<div class="col-3 input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">RM</span></div>
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'50']) }}
													</div>
													<div class="col-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::checkbox('primary',1,'1', ['class'=>'']) }} {{trans('Primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-2">
														<button type="button" onclick="" class="btn btn-label-danger"><i class="la la-trash"></i>Delete</button>
													</div>
												</div>
											</div> */ ?>
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('daily_plan_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{trans('messages.project_template.add_more_price')}}</button>
										</div>
										
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.daily_period')}}</label>
									<div class="col-9">
										<div class="daily_period_block">
											
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('daily_period_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPeriod()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{trans('messages.project_template.add_more_period')}}</button>
										</div>
										
										
									</div>
								</div>
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.monthly_status')}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('monthly_status','1','1',['class'=>'', 'id'=>'monthly_status1']) }}{{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('monthly_status','2','',['class'=>'', 'id'=>'monthly_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('monthly_status','0','',['class'=>'', 'id'=>'monthly_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('monthly_description', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_monthly_description_english")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('monthly_description_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_monthly_description_malay")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_plan") }}</label>
									<div class="col-9">
										<div class="monthly_plan_block">
											<?php /* <div class="form-group">
												<label>Price</label>
												<div class="row">
													<div class="col-3 input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">RM</span></div>
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'50']) }}
													</div>
													<div class="col-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::checkbox('primary',1,'1', ['class'=>'']) }} {{trans('Primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-2">
														<button type="button" onclick="" class="btn btn-label-danger"><i class="la la-trash"></i>Delete</button>
													</div>
												</div>
											</div> */ ?>
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('monthly_plan_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreMonthlyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{trans('messages.project_template.add_more_price')}}</button>
										</div>
										
										
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_period") }}</label>
									<div class="col-9">
										<div class="monthly_period_block">
											<?php /* <div class="form-group">
												<label>Period</label>
												<div class="row">
													<div class="col-3 input-group">
														{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'12']) }}
														<div class="input-group-append"><span class="input-group-text" id="basic-addon2">Day</span></div>
													</div>
													<div class="col-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::checkbox('primary',1,'1', ['class'=>'']) }} {{trans('Primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-2">
														<button type="button" onclick="" class="btn btn-label-danger"><i class="la la-trash"></i>Delete</button>
													</div>
												</div>
											</div> */ ?>
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('monthly_period_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreMonthlyPeriod()" class="btn btn-label-brand"><i class="la la-plus"></i>{{trans('messages.project_template.add_more_period')}}</button>
										</div>
										
										
									</div>
								</div>
								
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.yearly_status')}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('yearly_status','1','1',['class'=>'', 'id'=>'yearly_status1']) }} {{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('yearly_status','2','',['class'=>'', 'id'=>'yearly_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('yearly_status','0','',['class'=>'', 'id'=>'yearly_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('yearly_description', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_yearly_description_english")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('yearly_description_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_yearly_description_malay")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_plan") }}</label>
									<div class="col-9">
										<div class="yearly_plan_block">
											
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('yearly_plan_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreYearlyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i> {{trans('messages.project_template.add_more_price')}}</button>
										</div>
										
										
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.yearly_period')}}</label>
									<div class="col-9">
										<div class="yearly_period_block">
											
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('yearly_period_allow_other',1,'', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreYearlyPeriod()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans('messages.project_template.add_more_period') }}</button>
										</div>
										
									</div>
								</div>
								
								
							</div>
						</div>
						
					</div>
				</div>
				
			</div>

			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans('messages.project_template.customize_editor') }}
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.project_template.editor') }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('editor_status','1','',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('editor_status','0','1',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-12">
										{{ Form::textarea('editor', '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'editor', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
										<span class="help-inline editor_error"></span>
									</div>
									<script type="text/javascript">
										// For CKEDITOR //
										CKEDITOR.replace( 'editor',
										{
											height: 350,
											//width: 507,
											filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
											filebrowserImageWindowWidth : '640',
											filebrowserImageWindowHeight : '480',
											enterMode : CKEDITOR.ENTER_BR
										});
										CKEDITOR.config.allowedContent = true;	
									</script>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.cms_pages.editor_malay") }}</label>
								</div>
								<div class="form-group row">
									<div class="col-12">
										{{ Form::textarea('editor_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'editor_ms', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
										<span class="help-inline editor_error"></span>
									</div>
									<script type="text/javascript">
										// For CKEDITOR //
										CKEDITOR.replace( 'editor_ms',
										{
											height: 350,
											//width: 507,
											filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
											filebrowserImageWindowWidth : '640',
											filebrowserImageWindowHeight : '480',
											enterMode : CKEDITOR.ENTER_BR
										});
										CKEDITOR.config.allowedContent = true;	
									</script>
								</div>
								
								
							</div>
						</div>
						
					</div>
				</div>
				
			</div>


			@endif
			


			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->
				
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.frontend_detail_page") }}
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.upload_header_background_image") }}:</label>
									<div class="col-5">
										<div class="dropzone dropzone-default" id="upload_images">
											<div class="dropzone-msg dz-message needsclick">
												<h3 class="dropzone-msg-title">{{ trans("messages.project_template.drop_files_here_or_click_to_upload") }}</h3>
												<span class="dropzone-msg-desc"></span>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.title_english") }}:</label>
									<div class="col-5">
										{{ Form::text('title', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title_name_english")]) }}
										<span class="help-inline title_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.title_malay") }}:</label>
									<div class="col-5">
										{{ Form::text('title_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title_name_malay")]) }}
										<span class="help-inline title_ms_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle_english") }}:</label>
									<div class="col-5">
										{{ Form::text('sub_title', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_subtitle_english")]) }}
										<span class="help-inline sub_title_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle_malay") }}:</label>
									<div class="col-5">
										{{ Form::text('sub_title_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_subtitle_malay")]) }}
										<span class="help-inline sub_title_ms_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.slider") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('slider_position','center','1',['class'=>'']) }} {{trans('messages.project_template.center')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('slider_position','left','',['class'=>'']) }} {{trans('messages.project_template.left')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('slider_position','right','',['class'=>'']) }} {{trans('messages.project_template.right')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.upload_image_slider") }}:</label>
									<div class="col-6">
										<div class="dropzone dropzone-multi" id="uploadSliderImages">
											<div class="dropzone-panel">
												<a class="dropzone-select btn btn-label-brand btn-bold btn-sm">
												{{ trans("messages.project_template.attach_files") }}</a>
												<a class="dropzone-upload btn btn-label-brand btn-bold btn-sm">
												{{ trans("messages.project_template.upload_all") }}</a>
												<a class="dropzone-remove-all btn btn-label-brand btn-bold btn-sm">
												{{ trans("messages.project_template.remove_all") }}</a>
											</div>
											<div class="dropzone-items">
												<div class="dropzone-item" style="display:none">
													<div class="dropzone-file">
														<div class="dropzone-filename" title="some_image_file_name.jpg"><span data-dz-name>some_image_file_name.jpg</span> <strong>(<span  data-dz-size>340kb</span>)</strong></div>
														<div class="dropzone-error" data-dz-errormessage></div>
													</div>
													<div class="dropzone-progress">
														<div class="progress">
															<div class="progress-bar kt-bg-brand" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress></div>
														</div>
													</div>
													<div class="dropzone-toolbar">
														<span class="dropzone-start"><i class="flaticon2-arrow"></i></span>
														<span class="dropzone-cancel" data-dz-remove style="display: none;"><i class="flaticon2-cross"></i></span>
														<span class="dropzone-delete" data-dz-remove><i class="flaticon2-cross"></i></span>
													</div>
													
													<?php /* <div class="kt-checkbox-inline">
														<label class="kt-checkbox">
															{{ Form::radio('is_featured',1,'', ['class'=>'', 'id'=>'is_featured_image']) }} {{trans('Featured')}}
															<span></span>
														</label>
													</div> */ ?>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_start") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_start_date', '', ['class'=>'form-control campaign_start_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time")]) }}
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
										<div class="clearfix"></div>
										<span class="help-inline campaign_start_date_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_end") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_end_date', '', ['class'=>'form-control campaign_end_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time")]) }}
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
										<span class="help-inline campaign_end_date_error"></span>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.show_plan") }}:</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('plan_show_status','1','1',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('plan_show_status','0','',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.share") }}:</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('share_btn_status','1','1',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('share_btn_status','0','',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.cms_pages.editor_english") }}</label>
								</div>
								
								<div class="form-group row">
									<div class="col-12">
										{{ Form::textarea('project_description', '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'project_description', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
										<span class="help-inline project_description_error"></span>
									</div>
									<script type="text/javascript">
										// For CKEDITOR //
										CKEDITOR.replace( 'project_description',
										{
											height: 350,
											//width: 507,
											filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
											filebrowserImageWindowWidth : '640',
											filebrowserImageWindowHeight : '480',
											enterMode : CKEDITOR.ENTER_BR
										});
										CKEDITOR.config.allowedContent = true;	
									</script>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.cms_pages.editor_malay") }}</label>
								</div>
								
								<div class="form-group row">
									<div class="col-12">
										{{ Form::textarea('project_description_ms', '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'project_description_ms', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
										<span class="help-inline project_description_error"></span>
									</div>
									<script type="text/javascript">
										// For CKEDITOR //
										CKEDITOR.replace( 'project_description_ms',
										{
											height: 350,
											//width: 507,
											filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
											filebrowserImageWindowWidth : '640',
											filebrowserImageWindowHeight : '480',
											enterMode : CKEDITOR.ENTER_BR
										});
										CKEDITOR.config.allowedContent = true;	
									</script>
								</div>
								
							
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_title") }}:</label>
									<div class="col-5">
										{{ Form::text('meta_title', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_keywords") }}:</label>
									<div class="col-5">
										{{ Form::text('meta_keywords', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_keywords")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_description") }}:</label>
									<div class="col-5">
										{{ Form::text('meta_description', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								
							</div>
							
							<div class="kt-portlet__foot">
								<div class="kt-form__actions">
									<div class="row">
										<div class="col-lg-3 col-xl-3">
										</div>
										<div class="col-lg-9 col-xl-9">
											<button type="button" onclick="saveProjectTemplate()" class="btn btn-success">
											{{ trans('messages.cms_page_details.submit') }}</button>&nbsp;
											<!--<button type="reset" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</button>-->
											<a href="{{ route('user.project_template') }}" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</a>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
			</div>
			

			{{ Form::close() }}
			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>


<script>
$(".donation_btn_url_blk").hide();
$('input[type=radio][name=donation_btn_type]').change(function() {
	if($(this).val() == "url"){
		$(".donation_btn_url_blk").show();
	}else{
		$(".donation_btn_url_blk").hide();
		$("#donation_btn_url").val("");
	}
})


$(".subject_type").click(function(){
	jQuery("#ProjectTemplateForm input:radio[id^=yearly_status]:first").attr('disabled', true);
	if(jQuery("#ProjectTemplateForm input:radio[id^=yearly_status]:first").is(':checked')){
		jQuery("#ProjectTemplateForm input:radio[id^=yearly_status]:first").removeAttr('checked');
		jQuery("#ProjectTemplateForm input:radio[id^=yearly_status2]").attr('checked', 'checked');
	}
	jQuery("#ProjectTemplateForm input:radio[id^=monthly_status]:first").attr('disabled', true);
	if(jQuery("#ProjectTemplateForm input:radio[id^=monthly_status]:first").is(':checked')){
		jQuery("#ProjectTemplateForm input:radio[id^=monthly_status]:first").removeAttr('checked');
		jQuery("#ProjectTemplateForm input:radio[id^=monthly_status2]").attr('checked', 'checked');
	}
	jQuery("#ProjectTemplateForm input:radio[id^=daily_status]:first").attr('disabled', true);
	if(jQuery("#ProjectTemplateForm input:radio[id^=daily_status]:first").is(':checked')){
		jQuery("#ProjectTemplateForm input:radio[id^=daily_status]:first").removeAttr('checked');
		jQuery("#ProjectTemplateForm input:radio[id^=daily_status2]").attr('checked', 'checked');
	}
	
	
	/* jQuery(".").each(function(i) {
		jQuery(this).attr('disabled', 'disabled');
	}); */
})


function saveProjectTemplate(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#ProjectTemplateForm')[0];
	for (instance in CKEDITOR.instances){
		CKEDITOR.instances[instance].updateElement();
	}

	var KeyVal = "1";
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.SaveProjectTemplate") }}',
		type:'POST',
		data: $('#ProjectTemplateForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				window.location.href	 =	"{{ route('user.project_template') }}";
			}else if(datas['error'] == 1){
				Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: datas['message'],
				  //footer: '<a href>Why do I have this issue?</a>'
				})
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "payment_method"){
						$(".payment_method_error").addClass('error');
						$(".payment_method_error").html(html);
					}else if(index == "project_description"){
						$(".project_description_error").addClass('error');
						$(".project_description_error").html(html);
					}else if(index == "title"){
						$(".title_error").addClass('error');
						$(".title_error").html(html);
					}else if(index == "sub_title"){
						$(".sub_title_error").addClass('error');
						$(".sub_title_error").html(html);
					}else if(index == "editor"){
						$(".editor_error").addClass('error');
						$(".editor_error").html(html);
					}else if(index == "campaign_start_date"){
						$(".campaign_start_date_error").addClass('error');
						$(".campaign_start_date_error").html(html);
					}else if(index == "campaign_end_date"){
						$(".campaign_end_date_error").addClass('error');
						$(".campaign_end_date_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
						$("select[name = "+index+"]").next().addClass('error');
						$("select[name = "+index+"]").next().html(html); 
					}
				});
			}
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
		error: function(r){
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
	});
}


addMoreDailyPlan();
function addMoreDailyPlan(){
	var get_last_id			=	$('.daily_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-daily-plan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".daily_plan_block").append(response);
		}
	});
}

function deleteMoreDailyPlan(id){
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
		$(".delete_more_daily_plan_"+id).remove();
	  }
	})
} 

addMoreMonthlyPlan();
function addMoreMonthlyPlan(){
	var get_last_id			=	$('.monthly_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-monthly-plan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".monthly_plan_block").append(response);
		}
	});
}

function deleteMoreMonthlyPlan(id){
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
		$(".delete_more_monthly_plan_"+id).remove();
	  }
	})
} 

addMoreYearlyPlan();
function addMoreYearlyPlan(){
	var get_last_id			=	$('.yearly_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-yearly-plan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".yearly_plan_block").append(response);
		}
	});
}

function deleteMoreYearlyPlan(id){
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
		$(".delete_more_yearly_plan_"+id).remove();
	  }
	})
} 

//for period
addMoreDailyPeriod();
function addMoreDailyPeriod(){
	var get_last_id			=	$('.daily_period_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-daily-period") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".daily_period_block").append(response);
		}
	});
}

function deleteMoreDailyPeriod(id){
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
		$(".delete_more_daily_period_"+id).remove();
	  }
	})
} 

addMoreMonthlyPeriod();
function addMoreMonthlyPeriod(){
	var get_last_id			=	$('.monthly_period_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-monthly-period") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".monthly_period_block").append(response);
		}
	});
}

function deleteMoreMonthlyPeriod(id){
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
		$(".delete_more_monthly_period_"+id).remove();
	  }
	})
} 

addMoreYearlyPeriod();
function addMoreYearlyPeriod(){
	var get_last_id			=	$('.yearly_period_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-yearly-period") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".yearly_period_block").append(response);
		}
	});
}

function deleteMoreYearlyPeriod(id){
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
		$(".delete_more_yearly_period_"+id).remove();
	  }
	})
} 


</script>


<script>
//special project scripts

jQuery('.alphabetRestriction').keypress(function (event) { 
   return event.keyCode < 32 || (event.keyCode >= 48 && event.keyCode <= 57);
});

addMoreDefaultProjectPlan();
function addMoreDefaultProjectPlan(){
	var get_last_id			=	$('.get_default_project_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-default-project-plan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_default_project_plan_block").append(response);
		}
	});
}

function deleteMoreDefaultProjectPlan(id){
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
		$(".delete_more_default_plan_"+id).remove();
	  }
	})
} 


$(".customize_plan_option").click(function(){
	var optionId = $(this).val();
	$(".tab-pane").hide();
	$("#kt_widget5_tab"+optionId+"_content").show();
	
})

$(".seat_reservation_total_subtitle").change(function(){
	var subtitleCount = $(this).val();
	$.ajax({
		url:'{{ URL("/add-more-seat-reservation-subtitle") }}',
		'type':'post',
		data:{'counter':subtitleCount},
		success:function(response){
			$('#loader_img').hide();
			$(".special_project_dynamic_subtitle_html").html(response);
		}
	});
});

function addMoreSeatReservationPlan(SubtitleCount){
	var get_last_id			=	$('.seat_reservation_plan_block_'+SubtitleCount+' section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-seat-reservation-plan") }}',
		'type':'post',
		data:{'counter':counter,'subTitleCount':SubtitleCount},
		success:function(response){
			$('#loader_img').hide();
			$(".seat_reservation_plan_block_"+SubtitleCount).append(response);
		}
	});
}

function deleteMoreSeatReservationPlan(id,subTitleCount){
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
		$(".delete_more_seat_reservation_plan_"+subTitleCount+id).remove();
	  }
	})
} 

addMoreQuantityProjectPlan();
function addMoreQuantityProjectPlan(){
	var get_last_id			=	$('.get_quantity_project_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ route("User.AddMoreQuantityProjectPlan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_quantity_project_plan_block").append(response);
		}
	});
}

function deleteMoreQuantityProjectPlan(id){
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
		$(".delete_more_quantity_project_plan_"+id).remove();
	  }
	})
} 

addMoreSectionProjectPlan();
function addMoreSectionProjectPlan(){
	var get_last_id			=	$('.get_section_project_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ route("User.AddMoreSectionProjectPlan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_section_project_plan_block").append(response);
		}
	});
}

function deleteMoreSectionProjectPlan(id){
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
		$(".delete_more_section_project_plan_"+id).remove();
	  }
	})
} 

</script>

<script>
//dana letsari project scripts

addMoreDefaultDanaPlan();
function addMoreDefaultDanaPlan(){
	var get_last_id			=	$('.get_default_dana_project_plan_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-default-dana-plan") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_default_dana_project_plan_block").append(response);
		}
	});
}

function deleteMoreDefaultDanaPlan(id){
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
		$(".delete_more_default_dana_plan_"+id).remove();
	  }
	})
} 


addMorePropertyType();
function addMorePropertyType(){
	var get_last_id			=	$('.get_dana_property_type_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ URL("/add-more-dana-property-type") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_dana_property_type_block").append(response);
		}
	});
}

function deleteMoreDanaPropertyType(id){
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
		$(".delete_more_property_type_"+id).remove();
	  }
	})
} 


addMorePropertyPriceRange();
function addMorePropertyPriceRange(){
	var get_last_id			=	$('.get_property_price_range_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
	if(typeof  get_last_id === "undefined"){
		var counter = 0;
	}else{
		var counter  = parseInt(get_last_id) + 1;
	} 
	$.ajax({
		url:'{{ route("User.AddMoreDanaPropertyPriceRange") }}',
		'type':'post',
		data:{'counter':counter},
		success:function(response){
			$('#loader_img').hide();
			$(".get_property_price_range_block").append(response);
		}
	});
}

function deleteMoreDanaPropertyPriceRange(id){
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
		$(".delete_more_property_price_range_"+id).remove();
	  }
	})
} 

</script>

<script>

var KTDropzoneDemo = function () {
    // Private functions
    var demo1 = function () {
        var URL = '{{ route("User.UploadTemplateHeaderImage") }}';
        //var DeleteURL = '{{ route("User.DeleteCmsImages") }}';
        // file type validation
        $('#upload_images').dropzone({
            url: URL, // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 1,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
			/* removedfile: function(file) {
				var name = file.name;        
				$.ajax({
					type: 'POST',
					url: DeleteURL,
					data: "id="+name,
					dataType: 'html'
				});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
			}, */
            acceptedFiles: "image/*",
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    }

    var demo2 = function () {
        // set the dropzone container id
		
        //acceptedFiles: "image/*,application/pdf,.psd",
        var id = '#uploadSliderImages';

		var SliderUrl = '{{route("User.UploadTemplateSliderImages")}}';
		
        // set the preview element template
        var previewNode = $(id + " .dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parent('.dropzone-items').html();
        previewNode.remove();

        var myDropzone4 = new Dropzone(id, { // Make the whole body a dropzone
            url: SliderUrl, // Set the url for your upload script location
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            maxFilesize: 2, // Max filesize in MB
            autoQueue: true, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone4.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { myDropzone4.enqueueFile(file); };
            $(document).find( id + ' .dropzone-item').css('display', '');
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
			 
			 caption = file.upload.filename == undefined ? "1" : file.upload.filename;
              file._captionLabel = Dropzone.createElement("<p>File Info:</p>")
              file._captionBox = Dropzone.createElement("<div class='kt-checkbox-inline'><label class='kt-checkbox'><input id='"+file.upload.uuid+"' type='radio' class='slider_img' name='is_featured' value='"+caption+"' >Featured<span></span></label></div>");
              file.previewElement.appendChild(file._captionLabel);
              file.previewElement.appendChild(file._captionBox);
        });


        // Update the total progress bar
        myDropzone4.on("totaluploadprogress", function(progress) {
            $(this).find( id + " .progress-bar").css('width', progress + "%");
        });

        myDropzone4.on("sending", function(file) {
            // Show the total progress bar when upload starts
            $( id + " .progress-bar").css('opacity', '1');
            // And disable the start button
            file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone4.on("complete", function(progress) {
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function(){
                $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
            }, 300)

        });

        // Setup the buttons for all transfers
        document.querySelector( id + " .dropzone-upload").onclick = function() {
            myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED));
        };

        // Setup the button for remove all files
        document.querySelector(id + " .dropzone-remove-all").onclick = function() {
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
            myDropzone4.removeAllFiles(true);
        };

        // On all files completed upload
        myDropzone4.on("queuecomplete", function(progress){
            $( id + " .dropzone-upload").css('display', 'none');
        });

        // On all files removed
        myDropzone4.on("removedfile", function(file){
            if(myDropzone4.files.length < 1){
                $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
            }
        });
		
        //send all the form data along with the files:
        myDropzone4.on("sendingmultiple", function(data, xhr, formData) {
            formData.append('yourPostName',data._captionBox.value);
        });
    }

    var demo3 = function () {
         // set the dropzone container id
         var id = '#kt_dropzone_5';

         // set the preview element template
         var previewNode = $(id + " .dropzone-item");
         previewNode.id = "";
         var previewTemplate = previewNode.parent('.dropzone-items').html();
         previewNode.remove();

         var myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
             url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
             parallelUploads: 20,
             maxFilesize: 1, // Max filesize in MB
             previewTemplate: previewTemplate,
             previewsContainer: id + " .dropzone-items", // Define the container to display the previews
             clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
         });

         myDropzone5.on("addedfile", function(file) {
             // Hookup the start button
             $(document).find( id + ' .dropzone-item').css('display', '');
         });

         // Update the total progress bar
         myDropzone5.on("totaluploadprogress", function(progress) {
             $( id + " .progress-bar").css('width', progress + "%");
         });

         myDropzone5.on("sending", function(file) {
             // Show the total progress bar when upload starts
             $( id + " .progress-bar").css('opacity', "1");
         });

         // Hide the total progress bar when nothing's uploading anymore
         myDropzone5.on("complete", function(progress) {
             var thisProgressBar = id + " .dz-complete";
             setTimeout(function(){
                 $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
             }, 500)
         });
    }

    return {
        // public functions
        init: function() {
            demo1();
            demo2();
            demo3();
        }
    };
}();

KTUtil.ready(function() {
    KTDropzoneDemo.init();
});


$(".slider_img").click(function(){
	alert($(this).val());
})
</script>


@stop