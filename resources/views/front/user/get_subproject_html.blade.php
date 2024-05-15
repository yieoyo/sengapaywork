<style>
input.change_project_order {
    height: calc(0.5em + 0.5rem + 10px);
    padding: 2px 2px 2px 6px;
    font-size: 12px;
	font-weight: 600;
    text-align: center;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {  
   opacity: 1;
}
</style>
<div class="kt-portlet__body">
	<div class="kt-portlet_project_info_block">

		<ul>
			@if(!empty($projectLists))
			  @foreach($projectLists as $projectList) 
				<li id="project_block_container_{{$projectList->id}}">
					<div class="kt-portlet_project_info_item_block">
						<div class="kt-portlet_project_info_item_heading">{{$projectList->name}} 
						  <div class="kt-portlet_project_info_detail_edit">
							<button type="button" onclick="" class="btn btn-success btn-bold btn_1 openUpdateProjectTitlePopup" rel="{{$projectList->id}}" data-projct-nm="{{$projectList->name}}">{{ trans("messages.edit_book_plan.edit") }}</button>
							@if(count($projectList->SubProjects) == 0)
							  @if(!empty($deleteTemplateValGlobal))
								<button type="button" onclick="" class="btn btn-danger btn-bold btn_1 deleteProjectBlock" rel="{{$projectList->id}}">{{ trans("messages.sub_project_detail.delete") }}</button>
							  @endif
							@endif
							<input type="number" name="project_order" class="form-control change_project_order changeProjectOrder" value="{{$projectList->order}}" min="1" data-rel-module="{{$projectList->project_module}}" data-project-rel="{{$projectList->id}}" />
						  </div>
						</div>
						<div class="kt-portlet_project_info_detail_block">
							@if(!empty($projectList->SubProjects))
							  @foreach($projectList->SubProjects as $subProjects)
								<div class="kt-portlet_project_info_detail_item" id="sub_project_block_container_{{$subProjects->id}}">
									<div class="kt-portlet_project_info_detail_heading">{{$subProjects->sub_project_name}}</div>
									<div class="kt-portlet_project_info_detail_edit">
									  @if($subProjects->target_amount > 0)
									   @if(!empty($editTemplateValGlobal))
										<a href="{{URL('/project-edit/'.$subProjects->slug)}}" class="btn btn-success btn-bold btn_1">
											{{ trans("messages.edit_book_plan.edit") }}
										</a>
									   @endif
									  @else
									   @if(!empty($addTemplateValGlobal))
										<a href="{{URL('/project-add/'.$subProjects->slug)}}" class="btn btn-info btn-bold btn_1">
											{{ trans("messages.book_plan.add") }}
										</a>
									   @endif
									  @endif
									   @if(!empty($deleteTemplateValGlobal))
										<button type="button" onclick="" class="btn btn-danger btn-bold btn_1 delete_smll_btn deleteSubProjectBlock" data-subproject-rel="{{$subProjects->id}}">{{ trans("messages.sub_project_detail.delete") }}</button>
									   @endif
										<button type="button" onclick="" class="btn btn-primary btn-bold btn_1 moveSubProjectBlock" data-module-id="{{$projectList->project_module}}" data-sub-project-id="{{$subProjects->id}}">
										{{ trans("messages.account_contributors.move") }}</button>
									  
									</div>
								</div>
							  @endforeach
							@endif
						</div>
						<div class="clearfix"></div>
					</div>
				</li>
			  @endforeach
			@endif
			
			<?php /* <li>
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
			</li> */ ?>
			
		</ul>
		
	</div>
</div>


<!--begin::Form-->
{{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"AddProjectForm_".$module_id]) }}
	{{ Form::hidden('project_module', $module_id, ['class'=>'form-control','autocomplete'=>'off']) }}
	<div class="kt-portlet__body">
	
		<div class="row">
			<div class="col-sm-6">
			  @if(!empty($addTemplateValGlobal))
				<div class="kt-portlet_body_form_block_title">{{ trans("messages.project_template.add_new_project") }}</div>
				<div class="form-group">
					{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.project_name")]) }}
					<span class="form-text text-muted name_error_{{$module_id}}"></span>
				</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-6 col-xl-6">
							<button type="button" onclick="AddProject({{$module_id}})" class="btn btn-success btn-bold btn_1">{{ trans("messages.project_template.add_project") }}</button>
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
					<span class="form-text text-muted sub_project_name_error_{{$module_id}}"></span>
				</div>
				<div class="form-group">
					{{ Form::select('project_id',$Projects ,'', ['class'=>'form-control', 'autocomplete'=>'off','placeholder'=>trans("messages.project_template.select_a_project")]) }}
					<span class="form-text text-muted project_name_error_{{$module_id}}"></span>
				</div>
				<div class="kt-form__actions">
					<div class="row">
						<div class="col-lg-6 col-xl-6">
							<button type="button" onclick="AddSubProject({{$module_id}})" class="btn btn-brand btn-bold btn_1">
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

<script>
$(".deleteProjectBlock").click(function(){
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
		var blockId = $(this).attr("rel");
		//alert(blockId);
		//$('#loader_img').show();
		$.ajax({
			url: '{{ route("User.DeleteProjectBlock") }}',
			type:'POST',
			data: {'blockId':blockId},
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['error'] == 1) {
					location.reload();
				}else {
					$("#project_block_container_"+blockId).remove();
					swal.fire({
						"title": "",
						"text": "Project Block Delete Successfully.",
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
})

$(".deleteSubProjectBlock").click(function(){
	Swal.fire({
	  title: 'Are you sure?',
	  text: "Once you delete it You can not make donation with this project.",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
		var SubProjectBlockId = $(this).attr("data-subproject-rel");
		//alert(blockId);
		//$('#loader_img').show();
		$.ajax({
			url: '{{ route("User.DeleteSubProjectBlock") }}',
			type:'POST',
			data: {'SubProjectBlockId':SubProjectBlockId},
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['error'] == 1) {
					location.reload();
				}else {
					$("#sub_project_block_container_"+SubProjectBlockId).remove();
					swal.fire({
						"title": "",
						"text": "Project Delete Successfully.",
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
})

</script>