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
							<h3 class="kt-portlet__head-title">
								{{ trans("messages.project_template.ansar_module") }}
							</h3>
						</div>
					</div>
					
					<div class="dynamic_project_content_1">
					
						<?php /* <div class="kt-portlet_project_info_block">
							
							<ul>
								<li>
									<div class="kt-portlet_project_info_item_block">
										<div class="kt-portlet_project_info_item_heading">Ansar Initiative</div>
										<div class="kt-portlet_project_info_detail_block">
											<div class="kt-portlet_project_info_detail_item">
												<div class="kt-portlet_project_info_detail_heading">Ansar Initiative</div>
												<div class="kt-portlet_project_info_detail_edit">
													<a href="{{URL('/project-edit')}}" class="btn btn-success btn-bold btn_1">Edit</a>
													<button type="button" onclick="" class="btn btn-danger btn-bold btn_1">Delete</button>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
									
								<li>
									<div class="kt-portlet_project_info_item_block">
										<div class="kt-portlet_project_info_item_heading">Ansar Korporat</div>
										<div class="kt-portlet_project_info_detail_block">
											<div class="kt-portlet_project_info_detail_item">
												<div class="kt-portlet_project_info_detail_heading">Ansar Korporat</div>
												<div class="kt-portlet_project_info_detail_edit">
													<a href="{{URL('/project-edit')}}" class="btn btn-success btn-bold btn_1">Edit</a>
													<button type="button" onclick="" class="btn btn-danger btn-bold btn_1">Delete</button>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
									
								<li>
									<div class="kt-portlet_project_info_item_block">
										<div class="kt-portlet_project_info_item_heading">Ansar Angkasa</div>
										<div class="kt-portlet_project_info_detail_block">
											<div class="kt-portlet_project_info_detail_item">
												<div class="kt-portlet_project_info_detail_heading">Angkasa</div>
												<div class="kt-portlet_project_info_detail_edit">
													<a href="{{URL('/project-edit')}}" class="btn btn-success btn-bold btn_1">Edit</a>
													<button type="button" onclick="" class="btn btn-danger btn-bold btn_1">Delete</button>
												</div>
											</div>
											
											<div class="kt-portlet_project_info_detail_item">
												<div class="kt-portlet_project_info_detail_heading">Swasta</div>
												<div class="kt-portlet_project_info_detail_edit">
													<a href="{{URL('/project-edit')}}" class="btn btn-success btn-bold btn_1">Edit</a>
													<button type="button" onclick="" class="btn btn-danger btn-bold btn_1">Delete</button>
												</div>
											</div>
											
										</div>
										<div class="clearfix"></div>
									</div>
								</li>
								
							</ul>
							
						</div> */ ?>
						
						
						<!--begin::Form-->
						{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"AnsarAddProjectForm"]) }}
							{{ Form::hidden('project_module', '1', ['class'=>'form-control','autocomplete'=>'off']) }}
							<div class="kt-portlet__body">
							
								<div class="row">
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_project") }}</div>
										
										<div class="form-group">
											{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.project_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddProject(1)" class="btn btn-success btn-bold btn_1">
													{{ trans("messages.project_template.add_project") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
									
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_subproject") }}</div>
										<div class="form-group">
											{{ Form::text('sub_project_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.subproject_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="form-group">
											{{ Form::select('project_id',$ansarProjectLists ,'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.select_a_project") ]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddSubProject(1)" class="btn btn-brand btn-bold btn_1">
													{{ trans("messages.project_template.add_subproject") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
								</div>
							</div>
						{{ Form::close() }}

						<!--end::Form-->
					</div>
					
				</div>
				
			</div>
 

			<!--  special project start  -->
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
								{{ trans("messages.project_template.special_projects") }}
							</h3>
						</div>
					</div>
					
					<div class="dynamic_project_content_2">
						
						<!--begin::Form-->
						{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"SpecialAddProjectForm"]) }}
							{{ Form::hidden('project_module', '2', ['class'=>'form-control','autocomplete'=>'off']) }}
							<div class="kt-portlet__body">
							
								<div class="row">
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_project") }}</div>
										<div class="form-group">
											{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.project_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddProject(2)" class="btn btn-success btn-bold btn_1">{{ trans("messages.project_template.add_project") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
									
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_subproject") }}</div>
										<div class="form-group">
											{{ Form::text('sub_project_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.subproject_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="form-group">
											{{ Form::select('project_id',$specialProjectLists ,'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.select_a_project")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddSubProject(2)" class="btn btn-brand btn-bold btn_1">
													{{ trans("messages.project_template.add_subproject") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
								</div>
							</div>
						{{ Form::close() }}

						<!--end::Form-->
					</div>
					
				</div>
				
			</div>

			
			<!--  Dana Lestari start  -->
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
								{{ trans('messages.dashboard.dana_lestari') }}
							</h3>
						</div>
					</div>
					
					<div class="dynamic_project_content_3">
					
						<!--begin::Form-->
						{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"DanaAddProjectForm"]) }}
							{{ Form::hidden('project_module', '3', ['class'=>'form-control','autocomplete'=>'off']) }}
							<div class="kt-portlet__body">
							
								<div class="row">
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_project") }}</div>
										<div class="form-group">
											{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.project_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddProject(3)" class="btn btn-success btn-bold btn_1"> 
													{{ trans("messages.project_template.add_project") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
									
									<div class="col-sm-6">
									  @if(!empty($addTemplateValGlobal))
										<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_subproject") }}</div>
										<div class="form-group">
											{{ Form::text('sub_project_name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.subproject_name")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="form-group">
											{{ Form::select('project_id',$danaLestariProjectLists ,'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.select_a_project")]) }}
											<span class="form-text text-muted"></span>
										</div>
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-6 col-xl-6">
													<button type="button" onclick="AddSubProject(3)" class="btn btn-brand btn-bold btn_1">{{ trans("messages.project_template.add_subproject") }}</button>
												</div>
											</div>
										</div>
									  @endif
									</div>
								</div>
							</div>
						{{ Form::close() }}

						<!--end::Form-->
					</div>
				</div>
				
			</div>


		
			
		

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>


<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> {{ trans("messages.project_template.move") }}<b><span class="moveble_col_name"></span></b></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
			</div>
			<div class="modal-body">
				{{ Form::open(['role' => 'form','files'=>'true', 'class' => 'kt-form','id'=>"ChangeSubProjectLocation"]) }}
					{{ Form::hidden('sub_project_id', '', ['class'=>'','id'=>'sub_project_id']) }}
					<div class="form-group">
						<label for="project_id" class="form-control-label">Select "<span class="moveble_col_name"></span>" 
						{{ trans("messages.project_template.destination_block")}} :</label>
						{{ Form::select('project_id',array() ,'', ['class'=>'form-control', 'id'=>'project_id','placeholder'=>trans("messages.project_template.select_a_project_block")]) }}
					</div>
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.personal_information.cancel') }}</button>
				<button type="button" class="btn btn-primary saveMoveProjectBlock">{{ trans('messages.personal_information.save_change') }}</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->

<!--begin::Modal update project name-->
<div class="modal fade" id="kt_modal_4_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> {{ trans("messages.project_template.update_project_name") }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> </button>
			</div>
			<div class="modal-body">
				{{ Form::open(['role' => 'form','files'=>'true', 'class' => 'kt-form','id'=>"UpdateProjectName"]) }}
					{{ Form::hidden('project_id', '', ['class'=>'','id'=>'update_project_id']) }}
					<div class="form-group">
						<label for="update_project_name" class="form-control-label">{{ trans("messages.project_template.project_name")}} :</label>
						{{ Form::text('name', '', ['class'=>'form-control', 'id'=>'update_project_name', 'autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.project_name")]) }}
						<span class="form-text text-muted"></span>
					</div>
				{{ Form::close() }}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.personal_information.cancel') }}</button>
				<button type="button" class="btn btn-primary saveProjectName">{{ trans('messages.personal_information.save_change') }}</button>
			</div>
		</div>
	</div>
</div>
<!--end::Modal-->


<script>
$(document).ready(function(){
	getProjectHtml(1);
})
$(document).ready(function(){
	getProjectHtml(2);
})
$(document).ready(function(){
	getProjectHtml(3);
})

function AddProject(MainProjectNumber){
	$('#loader_img').show();
	$('.text-muted').html('');
	$('.text-muted').removeClass('error');
	if(MainProjectNumber ==1){
		var formData  = $('#AddProjectForm_1')[0];
	}else if(MainProjectNumber ==2){
		var formData  = $('#AddProjectForm_2')[0];
	}else{
		var formData  = $('#AddProjectForm_3')[0];
	}
	
	var KeyVal = "1";
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.AddNewProject") }}',
		type:'POST',
		//data: $('#AnsarAddProjectForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				getProjectHtml(datas['ProjectModule']);
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "name"){
						$(".name_error_"+MainProjectNumber).addClass('error');
						$(".name_error_"+MainProjectNumber).html(html);
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

function AddSubProject(MainProjectNumber){
	$('#loader_img').show();
	$('.text-muted').html('');
	$('.text-muted').removeClass('error');
	if(MainProjectNumber ==1){
		var formData  = $('#AddProjectForm_1')[0];
	}else if(MainProjectNumber ==2){
		var formData  = $('#AddProjectForm_2')[0];
	}else{
		var formData  = $('#AddProjectForm_3')[0];
	}
	
	var KeyVal = "1";
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.AddNewSubProject") }}',
		type:'POST',
		data: $('#AnsarAddProjectForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				getProjectHtml(datas['ProjectModule']);
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "sub_project_name"){
						$(".sub_project_name_error_"+MainProjectNumber).addClass('error');
						$(".sub_project_name_error_"+MainProjectNumber).html(html);
					}else if(index == "project_id"){
						$(".project_name_error_"+MainProjectNumber).addClass('error');
						$(".project_name_error_"+MainProjectNumber).html(html);
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


function getProjectHtml(ModuleId){
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("User.GetSubProjects") }}',
		type:'POST',
		data: {'ModuleId':ModuleId},
		// dataType: 'json',
		// contentType: false,       // The content type used when sending data to the server.
		// cache: false,             // To unable request pages to be cached
		// processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['error'] == 1) {
				location.reload();
			}else {
				$(".dynamic_project_content_"+ModuleId).html(r);
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}


$(document.body).on('click', '.moveSubProjectBlock' ,function(){
	$('#kt_modal_4').modal({backdrop: 'static', keyboard: false})  
	var moduleId		=	$(this).attr("data-module-id");
	var subProjectId	=	$(this).attr("data-sub-project-id");
	
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("User.getDestinationProjectBlock") }}',
		type:'POST',
		data: {'moduleId':moduleId, 'subProjectId':subProjectId},
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['error'] == 1) {
				location.reload();
			}else if(datas['error'] == 2){
				swal.fire({
					"title": datas['message'],
					"text": "",
					"type": "success",
					"confirmButtonClass": "btn btn-secondary"
				});
			}else if(datas['success'] == 1){
				$("#kt_modal_4").modal("show");
				$(".moveble_col_name").text(datas['movableProjectName']);
				$("#sub_project_id").val(subProjectId);
				
				if(datas['projectBlockList'] != ""){
				  $('#project_id').empty();
				  $('select[name="project_id"]').append('<option value="">Select a Project Block</option>');
				  $.each(datas['projectBlockList'], function(key, value) {
					$('select[name="project_id"]').append('<option value="'+ key +'">'+ value +'</option>');
				  });
				}
			}else {
				//location.reload();
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
})

$(".saveMoveProjectBlock").click(function(){
	var subProjectId			=	$("#sub_project_id").val();
	var dastinationProjectId	=	$("#project_id").val();
	
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("User.MoveSubProjectBlock") }}',
		type:'POST',
		data: {'dastinationProjectId':dastinationProjectId, 'subProjectId':subProjectId},
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['error'] == 1) {
				//location.reload();
			}else if(datas['success'] == 1){
				$("#kt_modal_4").modal('hide');
				getProjectHtml(1);
				getProjectHtml(2);
				getProjectHtml(3);
			}else {
				//location.reload();
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
})


$(document.body).on('click', '.openUpdateProjectTitlePopup' ,function(){
	$('#kt_modal_4_update').modal({backdrop: 'static', keyboard: false})  
	var prjctId		=	$(this).attr("rel");
	var prjctName	=	$(this).attr("data-projct-nm");
	
	$("#update_project_id").val(prjctId);
	$("#update_project_name").val(prjctName);
	
})

$(".saveProjectName").click(function(){
	var ProjectId		=	$("#update_project_id").val();
	var ProjectName		=	$("#update_project_name").val();
	
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("User.UpdateProjectName") }}',
		type:'POST',
		data: {'ProjectId':ProjectId, 'ProjectName':ProjectName},
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['error'] == 1) {
				//location.reload();
			}else if(datas['success'] == 1){
				$("#kt_modal_4_update").modal('hide');
				getProjectHtml(1);
				getProjectHtml(2);
				getProjectHtml(3);
			}else {
				//location.reload();
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
})

$(document.body).on('change', '.changeProjectOrder' ,function(){
	if($(this).val() > 0){
		$('#loader_img').show();
		var blockId = $(this).attr("data-project-rel");
		var ModuleId = $(this).attr("data-rel-module");
		$.ajax({
			url: '{{ route("User.ChangeProjectOrder") }}',
			type:'POST',
			data: {'blockId':blockId, 'ModuleId':ModuleId, 'order':$(this).val()},
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['error'] == 1) {
					location.reload();
				}else {
					//$("#sub_project_block_container_"+SubProjectBlockId).remove();
					getProjectHtml(ModuleId);
					swal.fire({
						"title": "",
						"text": datas['message'],
						"type": "success",
						"confirmButtonClass": "btn btn-secondary"
					});
				}
				$('#loader_img').hide();
			},
			error: function(r){
				$('#loader_img').hide();
			},
		});
	}
})

</script>



@stop