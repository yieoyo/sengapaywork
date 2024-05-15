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
							{{ trans("messages.admin_account.edit_admin") }} </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.admin_account.account") }}  </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{route('user.account_admin')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.email_template.admin") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.admin_account.edit_admin") }} </a>
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
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">{{ trans("messages.admin_account.edit_admin_form") }}</h3>
						</div>
					</div>
					{{ Form::open(['role' => 'form','url' => "update-admin",'class' => 'kt-form','id'=>"editAdminForm"]) }}
					{{ Form::hidden('id',$adminDetails->id,['class'=>'','autocomplete'=>'off']) }}
					<div class="cover_content_edit_admin_block">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.first_name") }}:</label>
									{{ Form::text('first_name',$adminDetails->first_name,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.enter_last_name')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.last_name") }}:</label>
									{{ Form::text('last_name',$adminDetails->last_name,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.enter_last_name')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.contact_number") }}:</label>
									{{ Form::text('phone',$adminDetails->phone,['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.enter_contact_number')]) }}
									<span class="form-text text-muted"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans('messages.cms_page_details.email') }}:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="flaticon-email"></i></span>
										</div>
										{{ Form::text('email',$adminDetails->email,['class'=>'form-control','autocomplete'=>'off', 'aria-describedby'=>'basic-addon1', 'placeholder'=>trans('')]) }}
									</div>
									<span class="form-text text-muted email_error"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans("messages.admin_account.password") }}:</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="flaticon-safe-shield-protection"></i></span>
										</div>
										{{ Form::password('password',['class'=>'form-control','autocomplete'=>'off', 'aria-describedby'=>'basic-addon1', 'placeholder'=>trans('')]) }}
									</div>
									<span class="form-text text-muted password_error"></span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group cot_form_input_holder">
									<label class="col-form-label">{{ trans('messages.dashboard.status') }}:</label>
									{{ Form::select('is_active',array('1'=>trans('messages.navigation.active'),'0'=>trans('messages.language_settings.in_active')),$adminDetails->is_active, ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.admin_account.select_status')]) }}
									<span class="form-text text-muted active_error"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="role_permission_blk">
					  <div class="role_permission_blk_hd">{{ trans("messages.admin_account.role_permission") }}</div>
					  <div class="row">
						<?php
							$viewDashboardVal = "0";
							$addDashboardVal = "0";
							$editDashboardVal = "0";
							$deleteDashboardVal = "0";
							
							$viewAnsarVal = "0";
							$addAnsarVal = "0";
							$editAnsarVal = "0";
							$deleteAnsarVal = "0";
							
							$viewSpecialProjectVal = "0";
							$addSpecialProjectVal = "0";
							$editSpecialProjectVal = "0";
							$deleteSpecialProjectVal = "0";
							
							$viewDanaProjectVal = "0";
							$addDanaProjectVal = "0";
							$editDanaProjectVal = "0";
							$deleteDanaProjectVal = "0";
							
							$viewTemplateVal = "0";
							$addTemplateVal = "0";
							$editTemplateVal = "0";
							$deleteTemplateVal = "0";
							
							$viewgeneralVal = "0";
							$addgeneralVal = "0";
							$editgeneralVal = "0";
							$deletegeneralVal = "0";
							
							$viewaccountVal = "0";
							$addaccountVal = "0";
							$editaccountVal = "0";
							$deleteaccountVal = "0";
							
							if(!empty($adminPermissions)){
								if(!empty($adminPermissions->dashboard)){
									$dashboardArray = explode(",",$adminPermissions->dashboard);
									if(!empty($dashboardArray)){
										if(in_array('1',$dashboardArray)){
											$viewDashboardVal = "1";
										}
										if(in_array('2',$dashboardArray)){
											$addDashboardVal = "2";
										}
										if(in_array('3',$dashboardArray)){
											$editDashboardVal = "3";
										}
										if(in_array('4',$dashboardArray)){
											$deleteDashboardVal = "4";
										}
										
									}else{
										$viewDashboardVal = "0";
										$addDashboardVal = "0";
										$editDashboardVal = "0";
										$deleteDashboardVal = "0";
									}
								}
								if(!empty($adminPermissions->ansar)){
									$ansarArray = explode(",",$adminPermissions->ansar);
									if(!empty($ansarArray)){
										if(in_array('1',$ansarArray)){
											$viewAnsarVal = "1";
										}
										if(in_array('2',$ansarArray)){
											$addAnsarVal = "2";
										}
										if(in_array('3',$ansarArray)){
											$editAnsarVal = "3";
										}
										if(in_array('4',$ansarArray)){
											$deleteAnsarVal = "4";
										}
										
									}else{
										$viewAnsarVal = "0";
										$addAnsarVal = "0";
										$editAnsarVal = "0";
										$deleteAnsarVal = "0";
									}
								}
								if(!empty($adminPermissions->special_project)){
									$specialProjectArray = explode(",",$adminPermissions->special_project);
									if(!empty($specialProjectArray)){
										if(in_array('1',$specialProjectArray)){
											$viewSpecialProjectVal = "1";
										}
										if(in_array('2',$specialProjectArray)){
											$addSpecialProjectVal = "2";
										}
										if(in_array('3',$specialProjectArray)){
											$editSpecialProjectVal = "3";
										}
										if(in_array('4',$specialProjectArray)){
											$deleteSpecialProjectVal = "4";
										}
										
									}else{
										$viewSpecialProjectVal = "0";
										$addSpecialProjectVal = "0";
										$editSpecialProjectVal = "0";
										$deleteSpecialProjectVal = "0";
									}
								}
								if(!empty($adminPermissions->dana_project)){
									$danaProjectArray = explode(",",$adminPermissions->dana_project);
									if(!empty($danaProjectArray)){
										if(in_array('1',$danaProjectArray)){
											$viewDanaProjectVal = "1";
										}
										if(in_array('2',$danaProjectArray)){
											$addDanaProjectVal = "2";
										}
										if(in_array('3',$danaProjectArray)){
											$editDanaProjectVal = "3";
										}
										if(in_array('4',$danaProjectArray)){
											$deleteDanaProjectVal = "4";
										}
										
									}else{
										$viewDanaProjectVal = "0";
										$addDanaProjectVal = "0";
										$editDanaProjectVal = "0";
										$deleteDanaProjectVal = "0";
									}
								}
								if(!empty($adminPermissions->template)){
									$danaTemplateArray = explode(",",$adminPermissions->template);
									if(!empty($danaTemplateArray)){
										if(in_array('1',$danaTemplateArray)){
											$viewTemplateVal = "1";
										}
										if(in_array('2',$danaTemplateArray)){
											$addTemplateVal = "2";
										}
										if(in_array('3',$danaTemplateArray)){
											$editTemplateVal = "3";
										}
										if(in_array('4',$danaTemplateArray)){
											$deleteTemplateVal = "4";
										}
										
									}else{
										$viewTemplateVal = "0";
										$addTemplateVal = "0";
										$editTemplateVal = "0";
										$deleteTemplateVal = "0";
									}
								}
								if(!empty($adminPermissions->general)){
									$generalArray = explode(",",$adminPermissions->general);
									if(!empty($generalArray)){
										if(in_array('1',$generalArray)){
											$viewgeneralVal = "1";
										}
										if(in_array('2',$generalArray)){
											$addgeneralVal = "2";
										}
										if(in_array('3',$generalArray)){
											$editgeneralVal = "3";
										}
										if(in_array('4',$generalArray)){
											$deletegeneralVal = "4";
										}
										
									}else{
										$viewgeneralVal = "0";
										$addgeneralVal = "0";
										$editgeneralVal = "0";
										$deletegeneralVal = "0";
									}
								}
								if(!empty($adminPermissions->account)){
									$accountArray = explode(",",$adminPermissions->account);
									if(!empty($accountArray)){
										if(in_array('1',$accountArray)){
											$viewaccountVal = "1";
										}
										if(in_array('2',$accountArray)){
											$addaccountVal = "2";
										}
										if(in_array('3',$accountArray)){
											$editaccountVal = "3";
										}
										if(in_array('4',$accountArray)){
											$deleteaccountVal = "4";
										}
										
									}else{
										$viewaccountVal = "0";
										$addaccountVal = "0";
										$editaccountVal = "0";
										$deleteaccountVal = "0";
									}
								}
								
							}
						
						?>
						<div class="col-sm-3">
							<div class="role_permission_blk_subhd">{{ trans("messages.admin_account.view") }}:</div>
							<div class="role_permission_list_blk">
								
								<ul>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('dashboard[]',1,$viewDashboardVal, ['class'=>'']) }}
												&nbsp;<span></span> 
												{{ trans("messages.header.dashboard") }}
											</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('ansar_projects[]',1,$viewAnsarVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.admin_account.ansar_projects") }}
											</label> 
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('special_projects[]',1,$viewSpecialProjectVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.admin_account.special_projects") }}
											</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('dana_projects[]',1,$viewDanaProjectVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.admin_account.dana_lestari_projects") }}
											</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('project_template[]',1,$viewTemplateVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.admin_account.projects_template") }}
											</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('general[]',1,$viewgeneralVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.header.general") }}
											</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">
												{{ Form::checkbox('account[]',1,$viewaccountVal, ['class'=>'']) }}&nbsp;<span></span> 
												{{ trans("messages.admin_account.account") }} 
											</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="role_permission_blk_subhd">{{ trans("messages.book_plan.add") }}:</div>
							<div class="role_permission_list_blk">
								<ul>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt- kt-checkbox--solid">&nbsp;<span></span></label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('ansar_projects[]',2,$addAnsarVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.ansar_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('special_projects[]',2,$addSpecialProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.special_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('dana_projects[]',2,$addDanaProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.dana_lestari_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('project_template[]',2,$addTemplateVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.projects_template") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('general[]',2,$addgeneralVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.header.general") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('account[]',2,$addaccountVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.account") }}</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="role_permission_blk_subhd">{{ trans("messages.edit_book_plan.edit") }}:</div>
							<div class="role_permission_list_blk">
								<ul>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt- kt-checkbox--solid">&nbsp;<span></span></label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('ansar_projects[]',3,$editAnsarVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.ansar_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('special_projects[]',3,$editSpecialProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.special_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('dana_projects[]',3,$editDanaProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.dana_lestari_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('project_template[]',3,$editTemplateVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.projects_template") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('general[]',3,$editgeneralVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.header.general") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('account[]',3,$editaccountVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.account") }}</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="role_permission_blk_subhd">{{ trans("messages.admin_account.remove") }}:</div>
							<div class="role_permission_list_blk">
								<ul>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt- kt-checkbox--solid">&nbsp;<span></span></label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('ansar_projects[]',4,$deleteAnsarVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.ansar_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('special_projects[]',4,$deleteSpecialProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.special_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('dana_projects[]',4,$deleteDanaProjectVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.dana_lestari_projects") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('project_template[]',4,$deleteTemplateVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.projects_template") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('general[]',4,$deletegeneralVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.header.general") }}</label>
										</div>
									</li>
									<li>
										<div class="role_permission__checkbox">
											<label class="kt-checkbox kt-checkbox--solid">{{ Form::checkbox('account[]',4,$deleteaccountVal, ['class'=>'']) }}&nbsp;<span></span> {{ trans("messages.admin_account.account") }}</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
					  </div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-9 col-xl-9">
									<input type="button" onclick="saveAdmin(1)" value='{{ trans("messages.general_setting.save") }}' class="btn btn-success">&nbsp;
									<input type="button" onclick="saveAdmin(2)" class="btn btn-brand" value='{{ trans("messages.admin_account.save_add_new") }}' >&nbsp;
									<a href="{{ route('user.account_admin') }}" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</a>
								</div>
							</div>
						</div>
					</div>
					{{ Form::close() }}
				</div>
				
			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>

<script>
function saveAdmin(KeyVal){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ route("User.accountAdminUpdate") }}',
		type:'POST',
		data: $('#editAdminForm').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				if(KeyVal == 2){
					window.location.href	 =	"{{ route('user.account_admin_add') }}";
				}else{
					window.location.href	 =	"{{ route('user.account_admin') }}";
				}
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email"){
						$(".email_error").addClass('error');
						$(".email_error").html(html);
					}else if(index == "password"){
						$(".password_error").addClass('error');
						$(".password_error").html(html);
					}else if(index == "is_active"){
						$(".active_error").addClass('error');
						$(".active_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
				});
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}

</script>

@stop