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
						Edit Project </h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link"> General </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{ route('user.project') }}" class="kt-subheader__breadcrumbs-link"> Projects </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link"> Edit Project </span>
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
							<h3 class="kt-portlet__head-title">Edit Project Form</h3>
						</div>
					</div>
					{{ Form::open(['role' => 'form','url'=>"projects", 'class'=>'kt-form kt-form--label-left', 'id'=>"editProjectForm"]) }}
					{{ Form::hidden('id',$result->id,['class'=>'']) }}
					<div class="kt-portlet__body">
						<div class="kt-section kt-section--first">
							<div class="kt-section__body">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Project Name:</label>
									<div class="col-sm-4">
										<div class="input-group">
											{{ Form::text('name',$result->name,['class'=>'form-control','autocomplete'=>'off', 'aria-describedby'=>'basic-addon1', 'placeholder'=>trans('Enter Project name')]) }}
										</div>
										<span class="form-text text-muted name_error"></span>
									</div>
								</div>
								
							</div>
						</div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions">
							<div class="row">
								<div class="col-lg-2 col-xl-2"></div>
								<div class="col-lg-10 col-xl-10">
									<input type="button" onclick="saveRoom(1)" value="Update" class="btn btn-success btn_1">&nbsp;
									<input type="button" onclick="saveRoom(2)" class="btn btn-brand btn_2" value="Update & Create New" >&nbsp;
									<a href="{{ route('user.project') }}" class="btn btn-secondary">Cancel</a>
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
function saveRoom(KeyVal){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.ProjectUpdate") }}',
		type:'POST',
		data: $('#editProjectForm').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				if(KeyVal == 2){
					//location.reload();
					window.location.href	 =	"{{ route('user.project_add') }}";
				}else{
					window.location.href	 =	"{{ route('user.project') }}";
				}
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "email"){
						$(".email_error").addClass('error');
						$(".email_error").html(html);
					}else if(index == "package_category"){
						$(".package_category_error").addClass('error');
						$(".package_category_error").html(html);
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

</script>


@stop