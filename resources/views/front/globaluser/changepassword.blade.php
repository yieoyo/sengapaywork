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
						 {{ trans('messages.change_password.change_password') }}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{route('User.dashboard')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans('messages.navigation.dashboard') }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							{{ trans('messages.change_password.change_password') }} </span>
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

				<!--Begin:: App Aside-->
				<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

					@include('front.elements.navigation');
					
				</div>

				<!--End:: App Aside-->

				<!--Begin:: App Content-->
				<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
					<div class="row">
						<div class="col-xl-12">
							<div class="kt-portlet kt-portlet--height-fluid">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">{{ trans('messages.change_password.change_password') }}<small>{{ trans('messages.change_password.change_or_reset_your_account_password') }}</small></h3>
									</div>
								</div>
								{{ Form::open(['role' => 'form','url' => "saveResetPassword",'id'=>"user_profile_form","class"=>"kt-form kt-form--label-right"]) }}
									<div class="kt-portlet__body">
										<div class="kt-section kt-section--first">
											<div class="kt-section__body">
												<div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
													<div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
													<div class="alert-text">{{ trans('messages.change_password.configure_user_passwords_to_expire_periodically_users_will_need_warning_that_their_passwords_are_going_to_expire') }}
													 <br>{{ trans('messages.change_password.or_they_might_inadvertently_get_locked_out_of_the_system') }}</div>
													<div class="alert-close">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true"><i class="la la-close"></i></span>
														</button>
													</div>
												</div>
												<div class="row">
													<label class="col-xl-3"></label>
													<div class="col-lg-9 col-xl-6">
														<h3 class="kt-section__title kt-section__title-sm">{{ trans('messages.change_password.change_or_recover_your_password') }}:</h3>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.change_password.current_password') }}</label>
													<div class="col-lg-9 col-xl-6">
														{{Form::password("old_password",['class'=>'form-control', 'placeholder'=>trans('messages.change_password.current_password')]) }}
														<span class="help-inline"></span>
														<?php /*<a href="#" class="kt-link kt-font-sm kt-font-bold kt-margin-t-5">Forgot password ?</a>*/ ?>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.change_password.new_password') }}</label>
													<div class="col-lg-9 col-xl-6">
														{{Form::password("new_password",['class'=>'form-control', 'placeholder'=>trans('messages.change_password.new_password')]) }}
														<span class="help-inline"></span>
													</div>
												</div>
												<div class="form-group form-group-last row">
													<label class="col-xl-3 col-lg-3 col-form-label">{{ trans('messages.change_password.verify_password') }}</label>
													<div class="col-lg-9 col-xl-6">
														{{Form::password("confirm_password",['onkeyup' => 'passwordStrength(this.value)', 'class'=>'form-control', 'placeholder'=>trans('messages.change_password.confirm_password')]) }}
														<span class="help-inline"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="kt-portlet__foot">
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-3 col-xl-3">
												</div>
												<div class="col-lg-9 col-xl-9">
													<button type="button" onclick="savepassword();" class="btn btn-brand btn-bold">{{ trans('messages.change_password.change_password') }}</button>&nbsp;
													<button type="reset" class="btn btn-secondary">{{ trans('messages.personal_information.cancel') }}</button>
												</div>
											</div>
										</div>
									</div>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>

				<!--End:: App Content-->
			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



<script>
function savepassword() {
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ URL("savechangepassword") }}',
		type:'post',
		data: $('#user_profile_form').serialize(),
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			data			=	JSON.parse(error_array);
			if(data['success'] == 1) {
				window.location.href	 =	"{{ URL('dashboard') }}";
			}
			else {
				$.each(data['errors'],function(index,html){
					$("input[name = "+index+"]").next().addClass('error');
					$("input[name = "+index+"]").next().html(html);
					
				});
			}
			$('#loader_img').hide();
		}
	});
}

$('#user_profile_form').each(function() {
	$(this).find('input').keypress(function(e) {
	   if(e.which == 10 || e.which == 13) {
			savepassword();
			return false;
		}
	});
});
	
</script>
@stop