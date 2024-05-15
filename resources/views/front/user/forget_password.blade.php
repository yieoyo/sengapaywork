@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
    <div class="about_us_wrapper">
        <div class="container">
            <div class="wrapper-heading"><center>{{trans('messages.forget_password')}}</center></div>
            <div class="row">
                <div class="col-sm-4">
				</div>
                <div class="col-sm-4 signin-page">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-header">
                                {{trans('messages.signup.existing_users')}} 
                            </div>
                            <div class="card card-container">
                                <img id="profile-img" class="profile-img-card" src="{{WEBSITE_IMG_URL}}avatar_2x.png" />
                               {{ Form::open(['role' => 'form','route' => "home.forgetPassword",'class' => 'form-signin','id'=>"forget_password_form"]) }}
									<div class="alert alert-danger display_error" style="display:none"></div>
                                    {{ Form::text('forgot_email','',['id'=>'inputEmail','class'=>'form-control','placeholder'=>trans('messages.login.enter_your_email')]) }}
									<span class="help-inline"></span>
                                    <button class="btn btn-lg btn-blue btn-block btn-signin" type="button" onclick="submit_forgot_password()">{{trans('messages.Signup.submit')}}</button>
								{{ Form::close() }} 
                            </div><!-- /card-container -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	function submit_forgot_password() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ route("home.forgetPassword") }}',
			type:'post',
			data: $('#forget_password_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1) {
					window.location.href	 =	"{{ URL('/') }}";
				}else if(datas['success'] == 2) {
					document.getElementById("forget_password_form").reset();
					show_message(datas['message'],"error");
				}else {
					$.each(datas['message'],function(index,html){
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					});
				}
				$('#loader_img').hide();
			}
		});
	}
</script>
@stop