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
							{{ trans("messages.header.project_template") }}</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.header.project_template") }} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								Infaq Abadi</a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.project_templates_dana_lestari.add_edit_template") }}</a>
						</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::App-->
			{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"saveAppSettingForm"]) }}
			
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
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'Charity', 'placeholder'=>trans("messages.project_template.enter_subproject_name")]) }}
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subproject_type")}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.cms_pages.default") }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.edit_book_plan.enquiry') }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.edit_book_plan.payment_type') }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.project_template.recurring")}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.project_template.fix_price")}}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.payment_method")}}</label>
									<div class="col-9">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} 
												{{ trans("messages.project_templates_dana_lestari.online_banking") }}
												<span></span>
											</label>
											
											<label class="kt-checkbox">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} 
												{{ trans("messages.project_templates_dana_lestari.credit_card_debit_card") }}
												<span></span>
											</label>
											
											<label class="kt-checkbox">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} 
												{{ trans("messages.project_templates_dana_lestari.bank_transfer") }}
												<span></span>
											</label>
											
											<label class="kt-checkbox">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.cdm')}}
												<span></span>
											</label>

											<label class="kt-checkbox">
												{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.qr_pay')}}
												<span></span>
											</label>
											
											<label class="kt-checkbox">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.cheque')}}
												<span></span>
											</label>
											
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{trans('messages.project_templates_dana_lestari.contributor_type')}}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.personal')}}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.company')}}
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
											{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_targeted_amount")]) }} 
										</div>
									</div>
									<div class="col-2">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												<input class="" name="client_view" type="checkbox" value="1">
												{{ trans('messages.project_templates_dana_lestari.enable_client_view') }} 
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
							<ul class="nav nav-pills nav-pills-sm nav-pills-button nav-pills-bold" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#kt_widget5_tab1_content" role="tab" aria-selected="true">
										{{ trans("messages.cms_pages.default") }}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab2_content" role="tab" aria-selected="false">
										{{ trans("messages.project_template.property")}}
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#kt_widget5_tab3_content" role="tab" aria-selected="false">
										{{ trans("messages.project_template.vendor")}}
									</a>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="tab-content">
							<div class="tab-pane active" id="kt_widget5_tab1_content" aria-expanded="true">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.book_plan.plan")}}:</label>
									<div class="col-9">
										<div class="daily_plan_block">
																					
										<section class="form-group delete_more_daily_plan_0" rel="0">
											<div class="row">
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
												</div>
												<div class="col-2 form-group">
													<label class="form-label"></label>
													<div class="kt-checkbox-inline">
														<label class="kt-checkbox">
															{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} {{trans('messages.project_templates_dana_lestari.online_banking')}}
															<span></span>
														</label>
													</div>
												</div>
												<div class="col-2 form-group">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
												</div>
												<div class="col-2 form-group">
													<label class="form-label"></label>
													<div class="kt-checkbox-inline">
														<label class="kt-checkbox">
															{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} 
															{{ trans("messages.project_templates_dana_lestari.online_banking") }}
															<span></span>
														</label>
													</div>
												</div>
												<div class="col-2 form-group">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
												</div>
												<div class="col-2 form-group">
													<label class="form-label"></label>
													<div class="kt-checkbox-inline">
														<label class="kt-checkbox">
															{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} 
															{{ trans("messages.project_templates_dana_lestari.online_banking") }}
															<span></span>
														</label>
													</div>
												</div>
												<div class="col-2 form-group">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
												</div>
												<div class="col-2 form-group">
													<label class="form-label"></label>
													<div class="kt-checkbox-inline">
														<label class="kt-checkbox">
															{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} 
															{{ trans("messages.project_templates_dana_lestari.online_banking") }}
															<span></span>
														</label>
													</div>
												</div>
												<div class="col-2 form-group">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
										</section>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.book_plan.add") }}</button>
										</div>
										
									</div>
								</div>
							</div>
							<div class="tab-pane" id="kt_widget5_tab2_content">
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.no_of_subtitle")}}:</label>
									<div class="col-5">
										{{ Form::select('field_name',array('val_1'=>'1','val_2'=>'2') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'2']) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle")}} 1:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="daily_plan_block">
																					
										<section class="form-group delete_more_daily_plan_0" rel="0">
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
													<div class="input-group">
														{{ Form::select('field_name',array('val_1'=>'1000','val_2'=>'2000') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'10']) }}
													</div>
												</div>
												
												
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
													<div class="input-group">
														{{ Form::select('field_name',array('val_1'=>'1000','val_2'=>'2000') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'10']) }}
													</div>
												</div>
												
												
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
													<div class="input-group">
														{{ Form::select('field_name',array('val_1'=>'1000','val_2'=>'2000') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'10']) }}
													</div>
												</div>
												
												
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
										</section>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.sub_project_detail.add_seat") }}</button>
										</div>
										
										
									</div>
								</div>
								
									<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
									
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle")}} 2:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="daily_plan_block">
																					
										<section class="form-group delete_more_daily_plan_0" rel="0">
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
													<div class="input-group">
														{{ Form::select('field_name',array('val_1'=>'1000','val_2'=>'2000') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'10']) }}
													</div>
												</div>
												
												
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
													<div class="input-group">
														{{ Form::select('field_name',array('val_1'=>'1000','val_2'=>'2000') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'10']) }}
													</div>
												</div>
												
												
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_name") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-3 form-group">
													<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
										</section>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.sub_project_detail.add_seat") }}</button>
										</div>
										
										
									</div>
								</div>
								
								<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.sub_project_detail.manual_contribution") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.enable') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.disable') }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.main_title")}}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
									</div>
								</div>
								
								
							</div>
							<div class="tab-pane" id="kt_widget5_tab3_content">
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
									<div class="col-9">
										<div class="daily_plan_block">
																					
										<section class="form-group delete_more_daily_plan_0" rel="0">
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-6 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-6 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-6 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
											<div class="row">
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
													<div class="input-group">
														<div class="input-group-prepend"><span class="input-group-text">
														{{ trans("messages.sub_project_detail.rm")}}</span></div>
														{{ Form::text('target_amount', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off', 'placeholder'=>'1000']) }} 
													</div>
												</div>
												
												<div class="col-2 form-group">
													<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name"),'Value'=>'Meja Emas']) }}
												</div>
												<div class="col-6 form-group">
													<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
													{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
												</div>
												<div class="col-2">
													<button type="button" onclick="deleteMoreDailyPlan(0)" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
												</div>
											</div>
											
										</section>
										</div>
										
										<div class="form-group">
											<button type="button" onclick="addMoreDailyPlan()" class="btn btn-label-brand"><i class="la la-plus"></i>
											{{ trans("messages.sub_project_detail.add_seat") }}</button>
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
										<div class="dropzone dropzone-default dz-clickable" id="upload_images">
											<div class="dropzone-msg dz-message needsclick">
												<h3 class="dropzone-msg-title">{{ trans("messages.project_template.drop_files_here_or_click_to_upload") }}</h3>
												<span class="dropzone-msg-desc"></span>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.title") }}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle")}}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.project_templates_dana_lestari.enter_subtitle')]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.slider") }}</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.project_template.center") }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.project_template.left") }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans("messages.project_template.right") }}
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
												<a class="dropzone-select btn btn-label-brand btn-bold btn-sm dz-clickable">
												{{ trans("messages.project_template.attach_files") }}</a>
												<a class="dropzone-upload btn btn-label-brand btn-bold btn-sm">
												{{ trans("messages.project_template.upload_all") }}</a>
												<a class="dropzone-remove-all btn btn-label-brand btn-bold btn-sm">
												{{ trans("messages.project_template.remove_all") }}</a>
											</div>
											<div class="dropzone-items">
												
											</div>
										<div class="dz-default dz-message"><button class="dz-button" type="button">
										{{ trans('messages.project_templates_dana_lestari.drop_files_here_to_upload') }} </button></div></div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_start") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_start_date', '', ['class'=>'form-control campaign_start_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time"),'data-dtp'=>'dtp_tObiw']) }}
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.campaign_end") }}:</label>
									<div class="col-5">
										<div class="input-group date">
											{{ Form::text('campaign_end_date', '', ['class'=>'form-control campaign_end_date','autocomplete'=>'off','id'=>'kt_datetimepicker_2' ,'placeholder'=>trans("messages.project_template.select_date_time"),'data-dtp'=>'dtp_NCL1P']) }}
											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.show_plan") }}:</label>
									<div class="col-9">
										<div class="kt-radio-inline">
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.enable') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.disable') }}
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
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.enable') }}
												<span></span>
											</label>
											<label class="kt-radio">
												{{ Form::radio('contactus_status','1','1',['class'=>'']) }} {{ trans('messages.cms_pages.disable') }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans('messages.project_template.editor') }}</label>
									
								</div>
								
								<div class="form-group row">
									{{ Form::textarea('field_name', '', ['class'=>'form-control','autocomplete'=>'off','id'=>'editor', 'placeholder'=>'', 'rows'=>'','cols'=>'']) }} 
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
									<label class="col-3 col-form-label">{{ trans('messages.cms_pages.meta_title') }}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_keywords") }}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_keywords")]) }}
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-3 col-form-label">{{ trans("messages.project_template.meta_description") }}:</label>
									<div class="col-5">
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
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
											<button type="reset" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</button>
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


@stop