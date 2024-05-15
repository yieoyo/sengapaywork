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
						{{ trans("messages.admin_account.add_admin") }}</h3>
						
						<div class="kt-subheader__breadcrumbs">
							<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.admin_account.account") }} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.email_template.admin") }} </a>
							<span class="kt-subheader__breadcrumbs-separator"></span>
							<a href="" class="kt-subheader__breadcrumbs-link">
								{{ trans("messages.admin_account.add_admin") }} </a>
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
								{{ trans("messages.admin_account.add_admin_form") }}
							</h3>
						</div>
					</div>
					
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="form-group row">
									<div class="col-6">
										<label class="form-label">{{ trans("messages.admin_account.first_name") }}:</label>
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'', 'placeholder'=>trans('messages.admin_account.enter_first_name')]) }}
									</div>
									<div class="col-6">
										<label class="form-label">{{ trans("messages.admin_account.last_name") }}:</label>
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'', 'placeholder'=>trans('messages.admin_account.enter_last_name')]) }}
									</div>
								</div>
								<div class="form-group row">
									<div class="col-6">
										<label class="form-label">{{ trans("messages.admin_account.contact_number") }}:</label>
										{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'', 'placeholder'=>trans('messages.admin_account.enter_contact_number')]) }}
									</div>
									<div class="col-6">
										<label class="form-label">{{ trans('messages.cms_page_details.email') }}:</label>
										<div class="input-group flex-nowrap mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="la la-envelope-o"></i></span>
											</div>
											{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'', 'placeholder'=>'']) }}
										</div>
										
									</div>
								</div>
								<div class="form-group row">
									<div class="col-6">
										<label class="form-label">{{ trans("messages.admin_account.password") }}:</label>
										<div class="input-group flex-nowrap mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1"><i class="flaticon-safe-shield-protection"></i></span>
											</div>
											{{ Form::text('field_name', '', ['class'=>'form-control','autocomplete'=>'off','value'=>'', 'placeholder'=>'']) }}
										</div>
										
									</div>
									<div class="col-6">
										<label class="form-label">{{ trans('messages.dashboard.status') }}:</label>
										{{ Form::select('field_name',array('val_1'=>'Active','val_2'=>'Not Active') ,'', ['class'=>'custom-select form-control', 'autocomplete'=>'off','placeholder'=>'Active']) }}
									</div>
								</div>
								
								
								<div class="kt-heading kt-heading--md">{{ trans("messages.admin_account.role_permission") }}</div>
								
								<div class="form-group row">
									<div class="col-12">
										<div class="kt-checkbox-inline">
											<label class="kt-checkbox">
												{{ Form::checkbox('field_name',1,'1', ['class'=>'']) }} {{ trans("messages.admin_account.select_all_remove_all") }}
												<span></span>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-3">
										<div class="kt-heading kt-heading--md">{{ trans("messages.admin_account.view") }}:</div>
										
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.home") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.dashboard") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.ansar') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.special_project') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.dana_lestari') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.project_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.general") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.setting") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.email_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.sms_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.translation") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.cms_page") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.admin_account.account") }} 
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.email_template.admin") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.sub_project_lists.vendor') }}
												<span></span>
											</label>
											
										</div>
									</div>
									
									<div class="col-3">
										<div class="kt-heading kt-heading--md">{{ trans("messages.book_plan.add") }}:</div>
										
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.ansar') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.special_project') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.dana_lestari') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.project_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.translation") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.cms_page") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.email_template.admin") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.sub_project_lists.vendor') }}
												<span></span>
											</label>
											
										</div>
									</div>
									
									<div class="col-3">
										<div class="kt-heading kt-heading--md">{{ trans("messages.edit_book_plan.edit") }}:</div>
										
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.dashboard") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.ansar') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.special_project') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.dana_lestari') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.project_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.setting") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.email_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.sms_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.translation") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.cms_page") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.email_template.admin") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.sub_project_lists.vendor') }}
												<span></span>
											</label>
											
										</div>
									</div>
									
									<div class="col-3">
										<div class="kt-heading kt-heading--md">{{ trans("messages.admin_account.remove") }}:</div>
										
										<div class="kt-checkbox-list">
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.dashboard") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.ansar') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.special_project') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.dashboard.dana_lestari') }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.project_template") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.translation") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.header.cms_page") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans("messages.email_template.admin") }}
												<span></span>
											</label>
											<label class="kt-checkbox kt-checkbox--solid">
												<input type="checkbox"> {{ trans('messages.sub_project_lists.vendor') }}
												<span></span>
											</label>
											
										</div>
									</div>
									
								</div>
							</div>
						</div>
							
						<hr>
							
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-12 col-xl-12">
									<button type="button" onclick="" class="btn btn-success">{{ trans("messages.general_setting.save") }}</button>
									<button type="button" onclick="" class="btn btn-brand">{{ trans("messages.admin_account.save_add_new") }}</button>
									<button type="reset" class="btn btn-secondary">{{ trans("messages.book_plan.previous") }}</button>
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