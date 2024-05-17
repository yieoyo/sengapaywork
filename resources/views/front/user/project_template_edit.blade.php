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

<style>
.img_blk {
    padding-right: 10px;
}
.img_blk_holder {
    display: inline-flex;
    margin: 6px;
}
span.delete_blk {
    display: block;
    background-color: red;
    width: 16px;
    height: 16px;
    position: absolute;
    cursor: pointer;
    border-radius: 33px;
    color: #fff;
    font-size: 14px;
    padding: 0px 3px;
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
								{{ trans("messages.account_contributors.edit_template") }} </span>
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
									<div class="col-2">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												{{ Form::checkbox('is_active',1,($subProjectDetails->is_active == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.show_status')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label"> {{ trans("messages.project_template.subproject_type")}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('subject_type','0',($subProjectDetails->subject_type == 0) ? 1: '',['class'=>'subject_type']) }} {{ trans('messages.cms_pages.default') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('subject_type','1',($subProjectDetails->subject_type == 1) ? 1: '',['class'=>'subject_type']) }} {{ trans('messages.edit_book_plan.enquiry') }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.edit_book_plan.payment_type') }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											@if($subProjectDetails->project_module == 1)
												<label class="kt-radio">
													{{ Form::radio('payment_type','1',($subProjectDetails->payment_type == 1) ? 1: '',['class'=>'payment-type']) }} 
													{{ trans('messages.project_template.recurring') }}
													<span></span>
												</label>
											@endif
											<label class="kt-radio">
												{{ Form::radio('payment_type','2',($subProjectDetails->payment_type == 2) ? 1: '',['class'=>'payment-type']) }} 
												{{ trans('messages.project_template.fix_price') }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.payment_method")}}</label>
									<div class="col-9">
										<div class="kt-checkbox-inline">
											@if(!empty($paymentMethods))
											  <?php $selectedMethodArray = !empty($subProjectDetails->payment_method) ? explode(",",$subProjectDetails->payment_method):''; ?>
											  @foreach($paymentMethods as $methodId=>$MethodName)
												<?php $selected = ""; ?>
												@if(!empty($selectedMethodArray))
													@if(in_array($methodId,$selectedMethodArray))
														<?php $selected = "1"; ?>
													@endif
												@endif
												<label class="kt-checkbox">
													{{ Form::checkbox('payment_method[]',$methodId,$selected, ['class'=>'payment-option']) }} {{$MethodName}}
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
												{{ Form::radio('contributor_type','personal',($subProjectDetails->contributor_type == 'personal') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.personal')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contributor_type','company',($subProjectDetails->contributor_type == 'company') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.company')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.target_achievement")}}</label>
									<div class="col-5">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm")}}</span></div>
											{{ Form::text('target_amount', !empty($subProjectDetails->target_amount) ? $subProjectDetails->target_amount: '', ['class'=>'form-control','aria-describedby'=>'basic-addon1', 'autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_targeted_amount")]) }}
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="col-2">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												{{ Form::checkbox('client_view',1,($subProjectDetails->client_view == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.enable_client_view')}}
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
												{{ Form::radio('donation_btn_type','default',($subProjectDetails->donation_btn_type == 'default') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.active')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('donation_btn_type','url',($subProjectDetails->donation_btn_type == 'url') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.url_link')}}
												<span></span>
											</label>
											<span class="help-inline"></span>
										</div>
									</div>
									<div class="col-4">
										<div class="input-group donation_btn_url_blk">
											{{ Form::text('donation_btn_url',(!empty($subProjectDetails->donation_btn_url) ? $subProjectDetails->donation_btn_url: ''), ['class'=>'form-control', 'id'=>'donation_btn_url', 'autocomplete'=>'off']) }}
											<span class="help-inline"></span>
										</div>
									</div>
								</div>
								
							</div>
						</div>
							
					</div>
				</div>
				
			</div>


			<!--Begin::App-->
			
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
									{{ Form::radio('customize_plan_option',5,($subProjectDetails->customize_plan_option == 5) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option5']) }}
									<label for="customize_plan_option5">{{ trans("messages.cms_pages.default") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',6,($subProjectDetails->customize_plan_option == 6) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option6']) }}
									<label for="customize_plan_option6">{{ trans("messages.project_template.property")}}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',7,($subProjectDetails->customize_plan_option == 7) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option7']) }}
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
											@if(!empty($defaultDanaPlanDetails))
												<?php $counter = "0"; ?>
												@foreach($defaultDanaPlanDetails as $defaultDanaPlanDetail)
													<section class="form-group delete_more_default_dana_plan_{{$counter}}" rel="{{$counter}}">
														{{ Form::hidden('DefaultDanaPlan['.$counter.'][id]', !empty($defaultDanaPlanDetail->id)?$defaultDanaPlanDetail->id:'', ['class'=>'form-control']) }}
														<div class="row">
															<div class="col-3 form-group">
																<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
																{{ Form::text('DefaultDanaPlan['.$counter.'][amount]', !empty($defaultDanaPlanDetail->amount)?$defaultDanaPlanDetail->amount:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_Plan_price")]) }}
															</div>
															<div class="col-4 form-group">
																<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
																{{ Form::text('DefaultDanaPlan['.$counter.'][title]', !empty($defaultDanaPlanDetail->title)?$defaultDanaPlanDetail->title:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
															</div>
															<div class="col-2 form-group">
																<label class="form-label"></label>
																<div class="kt-checkbox-inline">
																	<label class="kt-checkbox">
																		{{ Form::radio('default_dana_is_primary',$counter, ($defaultDanaPlanDetail->is_primary == 1) ? 1 :'', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																		<span></span>
																	</label>
																</div>
															</div>
															<div class="col-2">
																<label class="form-label" style="display: block; height: 19px;"></label>
																<button type="button" onclick="deleteMoreDefaultDanaPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
															</div>
														</div>
													</section>
													
													<?php $counter++; ?>
												@endforeach
											@endif
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
										<div class="get_property_type_block">
										  @if(!empty($PropertyTypeDanaPlanDetails))
											<?php $counter = "0"; ?>
											@foreach($PropertyTypeDanaPlanDetails as $PropertyTypeDanaPlanDetail)
											  <section class="form-group delete_more_property_type_{{$counter}}" rel="{{$counter}}">
												{{ Form::hidden('PropertyType['.$counter.'][id]', !empty($PropertyTypeDanaPlanDetail['id'])?$PropertyTypeDanaPlanDetail['id']:'', ['class'=>'form-control']) }}
												<div class="row">
													<div class="col-3 form-group">
														<label class="form-label">{{ trans("messages.account_contributors.property_name") }}:</label>
														{{ Form::text('PropertyType['.$counter.'][title]', !empty($PropertyTypeDanaPlanDetail['title'])?$PropertyTypeDanaPlanDetail['title']:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_property_name")]) }}
													</div>
													<div class="col-7 form-group">
														<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
														{{ Form::text('PropertyType['.$counter.'][description]', !empty($PropertyTypeDanaPlanDetail['description'])?$PropertyTypeDanaPlanDetail['description']:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
													</div>
													<div class="col-2">
														<label class="form-label" style="display: block; height: 19px;"></label>
														<button type="button" onclick="deleteMoreDanaPropertyType({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											  </section>

											<?php $counter++; ?>
											@endforeach
										  @endif
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
										  @if(!empty($PriceRangeDanaPlanDetails))
											<?php $counter = "0"; ?>
											@foreach($PriceRangeDanaPlanDetails as $PriceRangeDanaPlanDetail)
											  <section class="form-group delete_more_property_price_range_{{$counter}}" rel="{{$counter}}">
												{{ Form::hidden('PriceRangeDanaPlanDetail['.$counter.'][id]', !empty($PriceRangeDanaPlanDetail['id'])?$PriceRangeDanaPlanDetail['id']:'', ['class'=>'form-control']) }}
												<div class="row">
													<div class="col-3 form-group">
														<label class="form-label">{{ trans("messages.account_contributors.min_price") }}:</label>
														{{ Form::text('PriceRangeDanaPlanDetail['.$counter.'][min_price]', !empty($PriceRangeDanaPlanDetail['min_price'])?$PriceRangeDanaPlanDetail['min_price']:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_min_price")]) }}
													</div>
													<div class="col-3 form-group">
														<label class="form-label">{{ trans("messages.account_contributors.max_price") }}:</label>
														{{ Form::text('PriceRangeDanaPlanDetail['.$counter.'][max_price]', !empty($PriceRangeDanaPlanDetail['max_price'])?$PriceRangeDanaPlanDetail['max_price']:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_max_price")]) }}
													</div>
													<div class="col-2">
														<label class="form-label" style="display: block; height: 19px;"></label>
														<button type="button" onclick="deleteMoreDanaPropertyPriceRange({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											  </section>

											<?php $counter++; ?>
											@endforeach
										  @endif
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
											{{ Form::select('vendor',$vendorLists,!empty($subProjectDetails->vendor)?$subProjectDetails->vendor:'', ['class'=>'form-control', 'placeholder'=>trans("messages.project_template.select_a_vendor") ]) }}
											<span class="help-inline vendor_error"></span>
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
											<select name="vendors[]" class="form-control kt-selectpicker" multiple data-selected-text-format="count > 4" data-live-search=true data-actions-box=true title="Select Vendors">
											  @if(!empty($vendorLists))
												@foreach($vendorLists as $vanderId=>$vendorName)
												  @if(in_array($vanderId,$selectedVendors))
													  <option value="{{$vanderId}}" selected>{{$vendorName}}</option>													  
												  @else
													  <option value="{{$vanderId}}" >{{$vendorName}}</option>
												  @endif
												@endforeach
											  @endif
											</select>
											<?php /* {{ Form::select('vendors[]',$vendorLists,$selectedVendors,['class'=>'form-control kt-selectpicker', 'multiple'=> true, 'data-live-search'=>true, 'data-actions-box'=>true, 'title'=>'Select Vendors', 'data-selected-text-format'=>'count > 4']) }} */ ?>
											<span class="help-inline vendors_error"></span>
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
									{{ Form::radio('customize_plan_option',1,($subProjectDetails->customize_plan_option == 1) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option1']) }}
									<label for="customize_plan_option1">{{ trans("messages.cms_pages.default") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',2,($subProjectDetails->customize_plan_option == 2) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option2']) }}
									<label for="customize_plan_option2">{{ trans("messages.project_template.seat_reservation")}}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',3,($subProjectDetails->customize_plan_option == 3) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option3']) }}
									<label for="customize_plan_option3">{{ trans("messages.sub_project_detail.quantity") }}</label>
								</div>
								<div class="kt-portlet__tab_block_options_item">
									{{ Form::radio('customize_plan_option',4,($subProjectDetails->customize_plan_option == 4) ? 1: '',['class'=>'customize_plan_option', 'id'=>'customize_plan_option4']) }}
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
											@if(!empty($defaultPlanDetails))
												<?php $counter = "0"; ?>
												@foreach($defaultPlanDetails as $defaultPlanDetail)
													<section class="form-group delete_more_default_plan_{{$counter}}" rel="{{$counter}}">
														{{ Form::hidden('DefaultPlan['.$counter.'][id]', !empty($defaultPlanDetail->id)?$defaultPlanDetail->id:'', ['class'=>'form-control']) }}
														<div class="row">
															<div class="col-3 form-group">
																<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
																{{ Form::text('DefaultPlan['.$counter.'][title]', !empty($defaultPlanDetail->title)?$defaultPlanDetail->title:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
															</div>
															<div class="col-7 form-group">
																<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
																{{ Form::text('DefaultPlan['.$counter.'][description]', !empty($defaultPlanDetail->description)?$defaultPlanDetail->description:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
															</div>
															<div class="col-2">
																<label class="form-label" style="display: block; height: 19px;"></label>
																<button type="button" onclick="deleteMoreDefaultProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
															</div>
														</div>
													</section>
													<?php $counter++; ?>
												@endforeach
											@endif
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDefaultProjectPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.project_template.add_project_plan")}}</button>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab2_content">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}}:</label>
									<div class="col-5">
										{{ Form::text('seat_reservation_main_title', !empty($subProjectDetails->seat_reservation_main_title) ? $subProjectDetails->seat_reservation_main_title: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.no_of_subtitle")}}:</label>
									<div class="col-5">
										@if(!empty($subProjectDetails->seat_reservation_total_subtitle))
											{{ Form::hidden('seat_reservation_total_subtitle', !empty($subProjectDetails->seat_reservation_total_subtitle) ? $subProjectDetails->seat_reservation_total_subtitle: '', ['class'=>'']) }}
											
											{{ Form::select('seat_reservation_total_subtitle',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5') ,!empty($subProjectDetails->seat_reservation_total_subtitle) ? $subProjectDetails->seat_reservation_total_subtitle: '', ['class'=>'custom-select form-control seat_reservation_total_subtitle', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.selec_no_of_subtitle"), 'readonly'=> true, 'disabled'=> true]) }}
										@else
											{{ Form::select('seat_reservation_total_subtitle',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5') ,!empty($subProjectDetails->seat_reservation_total_subtitle) ? $subProjectDetails->seat_reservation_total_subtitle: '', ['class'=>'custom-select form-control seat_reservation_total_subtitle', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.selec_no_of_subtitle")]) }}
										@endif
										<span class="help-inline srts_error"></span>
									</div>
								</div>
								
								<div class="special_project_dynamic_subtitle_html">
									@if(!empty($seatReservationPlans))
										<?php 
											$count = "1";
											$subTitleCount = !empty($subProjectDetails->seat_reservation_main_title_2) ? $subProjectDetails->seat_reservation_main_title_2: 0;
										?>
										@foreach($seatReservationPlans as $seatReservationPlan)
											<div class="form-group row">
												<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle")}} {{$count}}:</label>
												<div class="col-5">
													{{ Form::hidden('SeatReservation['.$count.'][id]', !empty($seatReservationPlan->id)?$seatReservationPlan->id:'', ['class'=>'']) }}
													{{ Form::text('SeatReservation['.$count.'][description]', !empty($seatReservationPlan->description)?$seatReservationPlan->description:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
											</div>

											<div class="form-group row">
												<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
												<div class="col-9">
													<div class="seat_reservation_plan_block_{{$count}}">
													 @if(!empty($seatReservationPlan->ReservationSeats))
													  <?php $counter = 0; ?>
													  @foreach($seatReservationPlan->ReservationSeats as $seatReservationData)
														
														<section class="form-group delete_more_seat_reservation_plan_{{$count.$counter}}" rel="{{$counter}}">
															{{ Form::hidden('SeatReservation['.$count.'][SpecialProjectSubtitle]['.$counter.'][id]', !empty($seatReservationData->id)?$seatReservationData->id:'', ['class'=>'']) }} 
															<div class="row">
																<div class="col-2 form-group">
																	<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
																	<div class="input-group">
																		<div class="input-group-prepend"><span class="input-group-text">
																		{{ trans("messages.sub_project_detail.rm")}}</span></div>
																		{{ Form::text('SeatReservation['.$count.'][SpecialProjectSubtitle]['.$counter.'][seat_price]', !empty($seatReservationData->seat_price)?$seatReservationData->seat_price:'', ['class'=>'form-control alphabetRestriction', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off']) }} 
																	</div>
																</div>
																
																<div class="col-2 form-group">
																	<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
																	<div class="input-group">
																		{{ Form::number('SeatReservation['.$count.'][SpecialProjectSubtitle]['.$counter.'][seat_max_unit]', !empty($seatReservationData->seat_max_unit)?$seatReservationData->seat_max_unit:'', ['class'=>' form-control alphabetRestriction', 'autocomplete'=>'off']) }}
																	</div>
																</div>
																
																
																<div class="col-3 form-group">
																	<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
																	{{ Form::text('SeatReservation['.$count.'][SpecialProjectSubtitle]['.$counter.'][seat_name]', !empty($seatReservationData->seat_name)?$seatReservationData->seat_name:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name")]) }}
																</div>
																<div class="col-3 form-group">
																	<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
																	{{ Form::text('SeatReservation['.$count.'][SpecialProjectSubtitle]['.$counter.'][seat_description]', !empty($seatReservationData->seat_description)?$seatReservationData->seat_description:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
																</div>
																<div class="col-2">
																	<label class="form-label" style="display: block; height: 19px;"></label>
																	<button type="button" onclick="deleteMoreSeatReservationPlan({{$counter}},{{$count}})" class="btn btn-label-danger"><i class="la la-trash"></i>
																	{{ trans("messages.sub_project_detail.delete") }}</button>
																</div>
															</div>
															
														</section>
														<?php $counter++; ?>
													   @endforeach
													 @endif
													</div>
													
													<div class="form-group">
														<button type="button" onclick="addMoreSeatReservationPlan({{$count}})" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.sub_project_detail.add_seat") }}</button>
													</div>
													
												</div>
											</div>

											<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
											<?php $count++; ?>
										@endforeach
									@else
										<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
									@endif
								</div>
								
								<?php /* <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div> */ ?>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.sub_project_detail.manual_contribution") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('seat_reservation_menual_contribution','1',($subProjectDetails->seat_reservation_menual_contribution == 1) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('seat_reservation_menual_contribution','0',($subProjectDetails->seat_reservation_menual_contribution == 0) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}}:</label>
									<div class="col-5">
										{{ Form::text('seat_reservation_main_title_2', !empty($subProjectDetails->seat_reservation_main_title_2) ? $subProjectDetails->seat_reservation_main_title_2: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								
							</div>
							
							<div class="tab-pane" id="kt_widget5_tab3_content">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="get_quantity_project_plan_block">
										  @if(!empty($quantityPlans))
											<?php $counter = 0; ?>
											@foreach($quantityPlans as $quantityPlan)
												<section class="form-group delete_more_quantity_project_plan_{{$counter}}" rel="{{$counter}}">
													{{ Form::hidden('QuantityPlan['.$counter.'][id]', !empty($quantityPlan->id)?$quantityPlan->id:'', ['class'=>'']) }} 
													<div class="row">
														<div class="col-2 form-group">
															<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text">
																{{ trans("messages.sub_project_detail.rm")}}</span></div>
																{{ Form::text('QuantityPlan['.$counter.'][price]', !empty($quantityPlan->price)?$quantityPlan->price:'', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off']) }} 
															</div>
														</div>
														
														<div class="col-2 form-group">
															<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
															{{ Form::text('QuantityPlan['.$counter.'][plan_title]', !empty($quantityPlan->plan_title)?$quantityPlan->plan_title:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
														</div>
														<div class="col-6 form-group">
															<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
															{{ Form::text('QuantityPlan['.$counter.'][plan_description]', !empty($quantityPlan->plan_description)?$quantityPlan->plan_description:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
														</div>
														<div class="col-2">
															<label class="form-label" style="display: block; height: 19px;"></label>
															<button type="button" onclick="deleteMoreQuantityProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
														</div>
													</div>
												</section>
												<?php $counter++; ?>
											@endforeach
										  @endif
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
										{{ Form::text('section_title', !empty($subProjectDetails->section_title) ? $subProjectDetails->section_title: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_section_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.section") }}:</label>
									<div class="col-9">
										<div class="get_section_project_plan_block">
										 @if(!empty($sectionPlans))
										  <?php $counter = 0; ?>
										  @foreach($sectionPlans as $sectionPlan)
											<section class="form-group delete_more_section_project_plan_{{$counter}}" rel="{{$counter}}">
												{{ Form::hidden('SectionPlan['.$counter.'][id]', !empty($sectionPlan->id)?$sectionPlan->id:'', ['class'=>'']) }} 
												<div class="row">
													<div class="col-3 form-group">
														<label class="form-label">{{ trans("messages.project_template.section_price") }}:</label>
														<div class="input-group">
															<div class="input-group-prepend"><span class="input-group-text">
															{{ trans("messages.sub_project_detail.rm")}}</span></div>
															{{ Form::text('SectionPlan['.$counter.'][price]', !empty($sectionPlan->price)?$sectionPlan->price:'', ['class'=>'form-control alphabetRestriction','aria-describedby'=>'basic-addon1','autocomplete'=>'off']) }} 
														</div>
													</div>
													
													<div class="col-4 form-group">
														<label class="form-label">{{ trans("messages.project_template.section_name") }}:</label>
														{{ Form::text('SectionPlan['.$counter.'][section_name]', !empty($sectionPlan->section_name)?$sectionPlan->section_name:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
													</div>
													<div class="col-2">
														<label class="form-label" style="display: block; height: 19px;"></label>
														<button type="button" onclick="deleteMoreSectionProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
										  <?php $counter++; ?>
										  @endforeach
										 @endif
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreSectionProjectPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>{{ trans("messages.sub_project_detail.add_seat") }}</button>
										</div>
										
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.multiple_participant") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('is_multiple_participate','1',($subProjectDetails->is_multiple_participate == 1) ? 1: '',['class'=>'']) }} {{ trans('messages.cms_pages.enable') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('is_multiple_participate','0',($subProjectDetails->is_multiple_participate == 0) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
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
												{{ Form::radio('daily_status','1',($subProjectDetails->daily_status == 1) ? 1: '',['class'=>'', 'id'=>'daily_status1']) }} {{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('daily_status','2',($subProjectDetails->daily_status == 2) ? 1: '',['class'=>'', 'id'=>'daily_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('daily_status','0',($subProjectDetails->daily_status == 0) ? 1: '',['class'=>'', 'id'=>'daily_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('daily_description',!empty($subProjectDetails->daily_description) ? $subProjectDetails->daily_description: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('daily_description_ms',!empty($subProjectDetails->daily_description_ms) ? $subProjectDetails->daily_description_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.daily_plan") }}</label>
									<div class="col-9">
										<div class="daily_plan_block">
										@if(!empty($dailyPlanDetails))
										  <?php $counter = "0"; ?>
										  @foreach($dailyPlanDetails as $dailyPlanDetail)
											{{ Form::hidden('DailyPlan['.$counter.'][id]', !empty($dailyPlanDetail->id)?$dailyPlanDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_daily_plan_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.account_contributors.price") }}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('DailyPlan['.$counter.'][price]', !empty($dailyPlanDetail->price)?$dailyPlanDetail->price:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('DailyPlan_is_primary',$counter,($dailyPlanDetail->is_primary == 1)? 1:'', ['class'=>'']) }} {{trans('Primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreDailyPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
										   <?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('daily_plan_allow_other',1,($subProjectDetails->daily_plan_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>{{trans('messages.project_template.add_more_price')}}</button>
										</div>
										
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.daily_period')}}</label>
									<div class="col-9">
										<div class="daily_period_block">
										@if(!empty($dailyPeriodDetails))
										  <?php $counter = "0"; ?>
										  @foreach($dailyPeriodDetails as $dailyPeriodDetail)
											{{ Form::hidden('DailyPeriod['.$counter.'][id]', !empty($dailyPeriodDetail->id)?$dailyPeriodDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_daily_period_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.book_plan.period")}}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														{{ Form::text('DailyPeriod['.$counter.'][quantity]', !empty($dailyPeriodDetail->quantity)?$dailyPeriodDetail->quantity:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														<div class="input-group-append"><span class="input-group-text" id="basic-addon2">
														{{ trans("messages.account_contributors.day") }}</span></div>
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('DailyPeriod_is_primary',$counter,($dailyPeriodDetail->is_primary == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreDailyPeriod({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
											<?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('daily_period_allow_other',1,($subProjectDetails->daily_period_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPeriod()" class="btn btn-label-brand"><i class="la la-plus"></i>{{trans('messages.project_template.add_more_period')}}</button>
										</div>
										
										
									</div>
								</div>
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.monthly_status')}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('monthly_status','1',($subProjectDetails->monthly_status == 1) ? 1: '', ['class'=>'', 'id'=>'monthly_status1']) }} {{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('monthly_status','2',($subProjectDetails->monthly_status == 2) ? 1: '', ['class'=>'', 'id'=>'monthly_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('monthly_status','0',($subProjectDetails->monthly_status == 0) ? 1: '', ['class'=>'', 'id'=>'monthly_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('monthly_description', !empty($subProjectDetails->monthly_description) ? $subProjectDetails->monthly_description: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_monthly_description_english")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('monthly_description_ms', !empty($subProjectDetails->monthly_description_ms) ? $subProjectDetails->monthly_description_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_monthly_description_malay")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.monthly_plan") }}</label>
									<div class="col-9">
										<div class="monthly_plan_block">
										@if(!empty($monthlyPlanDetails))
										  <?php $counter = "0"; ?>
										  @foreach($monthlyPlanDetails as $monthlyPlanDetail)
											{{ Form::hidden('MonthlyPlan['.$counter.'][id]', !empty($monthlyPlanDetail->id)?$monthlyPlanDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_monthly_plan_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.account_contributors.price") }}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('MonthlyPlan['.$counter.'][price]', !empty($monthlyPlanDetail->price)?$monthlyPlanDetail->price:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('MonthlyPlan_is_primary',$counter,($monthlyPlanDetail->is_primary == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreMonthlyPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
											<?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('monthly_plan_allow_other',1,($subProjectDetails->monthly_plan_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
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
										@if(!empty($monthlyPeriodDetails))
										  <?php $counter = "0"; ?>
										  @foreach($monthlyPeriodDetails as $monthlyPeriodDetail)
											{{ Form::hidden('MonthlyPeriod['.$counter.'][id]', !empty($monthlyPeriodDetail->id)?$monthlyPeriodDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_monthly_period_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.book_plan.period")}}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														{{ Form::text('MonthlyPeriod['.$counter.'][quantity]', !empty($monthlyPeriodDetail->quantity)?$monthlyPeriodDetail->quantity:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'']) }}
														<div class="input-group-append"><span class="input-group-text" id="basic-addon2">
														{{ trans("messages.project_template.month") }}</span></div>
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('MonthlyPeriod_is_primary',$counter,($monthlyPeriodDetail->is_primary == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreMonthlyPeriod({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
											<?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('monthly_period_allow_other',1,($subProjectDetails->monthly_period_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreMonthlyPeriod()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{trans('messages.project_template.add_more_period')}}</button>
										</div>
										
										
									</div>
								</div>
								
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.yearly_status')}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('yearly_status','1',($subProjectDetails->yearly_status == 1) ? 1: '', ['class'=>'', 'id'=>'yearly_status1']) }} {{trans('messages.project_template.frontend_backend')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('yearly_status','2',($subProjectDetails->yearly_status == 2) ? 1: '', ['class'=>'', 'id'=>'yearly_status2']) }} {{trans('messages.project_template.backend_only')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('yearly_status','0',($subProjectDetails->yearly_status == 0) ? 1: '', ['class'=>'', 'id'=>'yearly_status3']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_description_english") }}</label>
									<div class="col-8">
										{{ Form::text('yearly_description', !empty($subProjectDetails->yearly_description) ? $subProjectDetails->yearly_description: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_yearly_description_english")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_description_malay") }}</label>
									<div class="col-8">
										{{ Form::text('yearly_description_ms', !empty($subProjectDetails->yearly_description_ms) ? $subProjectDetails->yearly_description_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_yearly_description_malay")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.yearly_plan") }}</label>
									<div class="col-9">
										<div class="yearly_plan_block">
										@if(!empty($yearlyPlanDetails))
										  <?php $counter = "0"; ?>
										  @foreach($yearlyPlanDetails as $yearlyPlanDetail)
											{{ Form::hidden('YearlyPlan['.$counter.'][id]', !empty($yearlyPlanDetail->id)?$yearlyPlanDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_yearly_plan_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.account_contributors.price") }}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('YearlyPlan['.$counter.'][price]', !empty($yearlyPlanDetail->price)?$yearlyPlanDetail->price:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('YearlyPlan_is_primary',$counter,($yearlyPlanDetail->is_primary == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreYearlyPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
											</section>
											<?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('yearly_plan_allow_other',1,($subProjectDetails->yearly_plan_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
													<span></span>
												</label>
											</div>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreYearlyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>{{trans('messages.project_template.add_more_price')}}</button>
										</div>
										
										
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_template.yearly_period')}}</label>
									<div class="col-9">
										<div class="yearly_period_block">
										@if(!empty($yearlyPeriodDetails))
										  <?php $counter = "0"; ?>
										  @foreach($yearlyPeriodDetails as $yearlyPeriodDetail)
											{{ Form::hidden('YearlyPeriod['.$counter.'][id]', !empty($yearlyPeriodDetail->id)?$yearlyPeriodDetail->id:'', ['class'=>'']) }}
											<section class="form-group delete_more_yearly_period_{{$counter}}" rel="{{$counter}}">
												<label>{{ trans("messages.book_plan.period")}}</label>
												<div class="row">
													<div class="col-sm-3 input-group">
														{{ Form::text('YearlyPeriod['.$counter.'][quantity]', !empty($yearlyPeriodDetail->quantity)?$yearlyPeriodDetail->quantity:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
														<div class="input-group-append"><span class="input-group-text" id="basic-addon2">{{trans('messages.project_template.yearly')}}</span></div>
													</div>
													<div class="col-sm-2">
														<div class="kt-checkbox-inline">
															<label class="kt-checkbox">
																{{ Form::radio('YearlyPeriod_is_primary',$counter,($yearlyPeriodDetail->is_primary == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.sub_project_detail.primary')}}
																<span></span>
															</label>
														</div>
													</div>
													<div class="col-sm-2">
														<button type="button" onclick="deleteMoreYearlyPeriod({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
													</div>
												</div>
											</section>
											<?php $counter++; ?>
										  @endforeach
										@endif
										
										</div>
										
										<div class="form-group">
											<div class="kt-checkbox-inline">
												<label class="kt-checkbox">
													{{ Form::checkbox('yearly_period_allow_other',1,($subProjectDetails->yearly_period_allow_other == 1) ? 1: '', ['class'=>'']) }} {{trans('messages.project_template.allow_others')}}
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
												{{ Form::radio('editor_status','1',($subProjectDetails->editor_status == 1) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('editor_status','0',($subProjectDetails->editor_status == 0) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-12">
										{{ Form::textarea('editor',  !empty($subProjectDetails->editor) ? $subProjectDetails->editor: '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'editor', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
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
										{{ Form::textarea('editor_ms',  !empty($subProjectDetails->editor_ms) ? $subProjectDetails->editor_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'editor_ms', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
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
									<label class="col-sm-3 col-form-label">{{ trans("messages.project_template.upload_header_background_image") }}:</label>
									<div class="col-sm-5">
										<div class="dropzone dropzone-default" id="upload_images">
											<div class="dropzone-msg dz-message needsclick">
												<h3 class="dropzone-msg-title">{{ trans("messages.project_template.drop_files_here_or_click_to_upload") }}</h3>
												<span class="dropzone-msg-desc"></span>
											</div>
											@if(!empty($subProjectDetails->header_image))
												<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete header_img_blk">
													<div class="dz-image">
														<img data-dz-thumbnail="" alt="logo-4-md.png" src="<?php echo WEBSITE_URL.'image.php?width=120px&image='.TEMPLATE_IMG_URL . $subProjectDetails->header_image; ?>">
													</div>  
													<div class="dz-details">    
														<?php /*<div class="dz-size"><span data-dz-size=""><strong></strong> </span></div> */ ?>   
														<div class="dz-filename"><span data-dz-name=""><?php echo str_replace(substr($subProjectDetails->header_image, 0, strpos($subProjectDetails->header_image, "/")).'/','',$subProjectDetails->header_image); ?></span></div>  
													</div> 
													<a class="dz-remove delete_header_blk" data-project-id="{{$subProjectDetails->id}}" href="javascript:undefined;" data-dz-remove="">Remove file</a>
												</div>
											@endif
											
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.title_english") }}:</label>
									<div class="col-5">
										{{ Form::text('title', !empty($subProjectDetails->title) ? $subProjectDetails->title: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title_name_english")]) }}
										<span class="help-inline title_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.title_malay") }}:</label>
									<div class="col-5">
										{{ Form::text('title_ms', !empty($subProjectDetails->title_ms) ? $subProjectDetails->title_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title_name_malay")]) }}
										<span class="help-inline title_ms_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle_english") }}:</label>
									<div class="col-5">
										{{ Form::text('sub_title', !empty($subProjectDetails->sub_title) ? $subProjectDetails->sub_title: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_subtitle_english")]) }}
										<span class="help-inline sub_title_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle_malay") }}:</label>
									<div class="col-5">
										{{ Form::text('sub_title_ms', !empty($subProjectDetails->sub_title_ms) ? $subProjectDetails->sub_title_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_subtitle_malay")]) }}
										<span class="help-inline sub_title_ms_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.slider") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('slider_position','center',($subProjectDetails->slider_position == 'center') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.center')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('slider_position','left',($subProjectDetails->slider_position == 'left') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.left')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('slider_position','right',($subProjectDetails->slider_position == 'right') ? 1: '',['class'=>'']) }} {{trans('messages.project_template.right')}}
												<span></span>
											</label>
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
										<div class="img_blk_holder">
											@if(!empty($sliderImages))
												@foreach($sliderImages as $sliderImage)
												  @if(!empty($sliderImage->image) && File::exists( TEMPLATE_IMG_ROOT_PATH . $sliderImage->image))
													<?php
														if($sliderImage->is_featured == 1){
															$featured = "checked";
														}else{
															$featured = "";
														}
													?>
													<div class="img_blk img_blk_{{$sliderImage->id}}">
														<span class="close delete_blk" data-img-id="{{$sliderImage->id}}">X</span>
														<img src="{{ TEMPLATE_IMG_URL . $sliderImage->image }}" width="80px">
														<div class='kt-checkbox-inline'>
															<label class='kt-checkbox'><input id='slider_image_{{$sliderImage->id}}' type='radio' class='slider_img' name='is_featured' {{$featured}} value="{{$sliderImage->image}}" >Featured<span></span></label>
														</div>
													</div>
												  @endif
												@endforeach
											@endif
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_start") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_start_date', !empty($subProjectDetails->campaign_start_date) ? $subProjectDetails->campaign_start_date: '', ['class'=>'form-control campaign_start_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time")]) }}
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
										<span class="help-inline campaign_start_date_error"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_end") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_end_date', !empty($subProjectDetails->campaign_end_date) ? $subProjectDetails->campaign_end_date: '', ['class'=>'form-control campaign_end_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time")]) }}
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
												{{ Form::radio('plan_show_status','1',($subProjectDetails->plan_show_status == 1) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('plan_show_status','0',($subProjectDetails->plan_show_status == 0) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
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
												{{ Form::radio('share_btn_status','1',($subProjectDetails->share_btn_status == 1) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('share_btn_status','0',($subProjectDetails->share_btn_status == 0) ? 1: '',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
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
										{{ Form::textarea('project_description', !empty($subProjectDetails->project_description) ? $subProjectDetails->project_description: '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'project_description', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
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
										{{ Form::textarea('project_description_ms', !empty($subProjectDetails->project_description_ms) ? $subProjectDetails->project_description_ms: '', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'project_description_ms', 'placeholder'=>trans("messages.project_template.enter_yearly_description")]) }}
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
										{{ Form::text('meta_title', !empty($subProjectDetails->meta_title) ? $subProjectDetails->meta_title: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_keywords") }}:</label>
									<div class="col-5">
										{{ Form::text('meta_keywords', !empty($subProjectDetails->meta_keywords) ? $subProjectDetails->meta_keywords: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_keywords")]) }}
										<span class="help-inline"></span>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_description") }}:</label>
									<div class="col-5">
										{{ Form::text('meta_description', !empty($subProjectDetails->meta_description) ? $subProjectDetails->meta_description: '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
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
											<button type="button" onclick="location.href = '{{ route('user.project_template') }}';" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</button>
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
	// payment module
	// Function to handle radio button change
	function handleRadioChange(event) {
		// Update selectedValue when a radio button is changed
		var selectedValue = event.target.value;
	
		// Show or hide specific payment options based on selected value
		switch(selectedValue) {
			case '1':
				// Hide the payment option for value 13
				document.querySelector('input[value="13"].payment-option').parentNode.style.display = 'none';
				document.querySelector('input[value="11"].payment-option').parentNode.style.display = 'block';
				document.querySelector('input[value="12"].payment-option').parentNode.style.display = 'block';
				break;
			case '2':
				// Show the payment option for value 13 and hide the options for values 11 and 12
				document.querySelector('input[value="13"].payment-option').parentNode.style.display = 'block';
				document.querySelector('input[value="11"].payment-option').parentNode.style.display = 'none';
				document.querySelector('input[value="12"].payment-option').parentNode.style.display = 'none';
				break;
		}
	}
	
	// Get all elements with class "payment-type"
	var paymentTypeRadios = document.querySelectorAll('.payment-type');
	
	// Loop through each radio button
	paymentTypeRadios.forEach(function(radio) {
		// Add event listener to each radio button
		radio.addEventListener('change', handleRadioChange);
	});
	
	// Initialize selectedValue to the initially selected radio button's value
	var selectedValue = '';
	paymentTypeRadios.forEach(function(radio) {
		if (radio.checked) {
			selectedValue = radio.value;
			// Trigger the change event initially to set up visibility
			radio.dispatchEvent(new Event('change'));
		}
	});
	
	</script>
<script>
$(".donation_btn_url_blk").hide();
$(document).ready(function(){
	$('input[type=radio][name=donation_btn_type]').each(function() {
		if($(this).is(":checked") && $(this).val() == "url"){
			$(".donation_btn_url_blk").show();
		}else{
			$(".donation_btn_url_blk").hide();
		}
	})
})

$('input[type=radio][name=donation_btn_type]').change(function() {
	if($(this).val() == "url"){
		$(".donation_btn_url_blk").show();
	}else{
		$(".donation_btn_url_blk").hide();
		//$("#donation_btn_url").val("");
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
		url: '{{ route("User.UpdateProjectTemplate") }}',
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
					}else if(index == "vendor"){
						$(".vendor_error").addClass('error');
						$(".vendor_error").html(html);
					}else if(index == "vendors"){
						$(".vendors_error").addClass('error');
						$(".vendors_error").html(html);
					}else if(index == "seat_reservation_total_subtitle"){
						$(".srts_error").addClass('error');
						$(".srts_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
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


$( document ).ready(function() {
	$( ".customize_plan_option" ).each(function() {
		if($(this).is(":checked")){
			var optionId = $(this).val();
			$(".tab-pane").hide();
			$("#kt_widget5_tab"+optionId+"_content").show();
		}
	})
})

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


function addMorePropertyType(){
	var get_last_id			=	$('.get_property_type_block section:last').attr('rel'); //$('.choose_attributes':last section:last').attr('rel');
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
			$(".get_property_type_block").append(response);
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
            //maxFiles: 1,
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
				$(".dz-image-preview").html("");
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
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone4.on("addedfile", function(file) {
            // Hookup the start button
            console.log(file);
			file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { myDropzone4.enqueueFile(file); };
            $(document).find( id + ' .dropzone-item').css('display', '');
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
			 
			  caption = file.upload.filename == undefined ? "1" : file.upload.filename;
              file._captionLabel = Dropzone.createElement("<p>File Info:</p>")
              file._captionBox = Dropzone.createElement("<div class='kt-checkbox-inline'><label class='kt-checkbox'><input id='"+file.upload.uuid+"' type='radio' class='slider_img' name='is_featured' value="+caption+" >Featured<span></span></label></div>");
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
	//alert($(this).val());
})
</script>

<script>
$(".delete_blk").click(function(){
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
		var imageId = $(this).attr("data-img-id");
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ route("User.DeleteTemplateImage") }}',
			type:'POST',
			data: { 'imageId':imageId },
			dataType: 'json',
			success: function(r){
				//alert(".img_blk_"+imageId);
				$(".img_blk_"+imageId).html("");
				$('#loader_img').hide();
			},
			error: function(r){
				$('#loader_img').hide();
			},
		});
		Swal.fire(
		  'Deleted!',
		  'Your file has been deleted.',
		  'success'
		)
	  }
	})
})

$(".delete_header_blk").click(function(){
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
		var projectId = $(this).attr("data-project-id");
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ route("User.DeleteHeaderImage") }}',
			type:'POST',
			data: { 'projectId':projectId },
			dataType: 'json',
			success: function(r){
				$(".header_img_blk").html("");
				$('#loader_img').hide();
			},
			error: function(r){
				$('#loader_img').hide();
			},
		});
		Swal.fire(
		  'Deleted!',
		  'Header image has been deleted.',
		  'success'
		)
	  }
	})
})

</script>

@stop