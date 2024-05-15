@extends('front.layouts.default')
@section('content')

{{HTML::script('js/combodate.js') }}
<script>
	var  jan_text_string		=	"<?php echo  trans("Jan");?>";
	var  feb_text_string		=	"<?php echo  trans("Feb");?>";
	var  march_text_string		=	"<?php echo  trans("March");?>";
	var  april_text_string		=	"<?php echo  trans("April");?>";
	var  may_text_string		=	"<?php echo  trans("May");?>";
	var  june_text_string		=	"<?php echo  trans("June");?>";
	var  july_text_string		=	"<?php echo  trans("July");?>";
	var  august_text_string		=	"<?php echo  trans("Aug");?>";
	var  september_text_string	=	"<?php echo  trans("Sept");?>";
	var  october_text_string	=	"<?php echo  trans("Oct");?>";
	var  november_text_string	=	"<?php echo  trans("Nov");?>";
	var  december_text_string	=	"<?php echo  trans("Dec");?>";
</script>
{{ HTML::script('js/moment.js') }}
<section class="site_content_holder">
    <div class="about_us_wrapper sign-in-page">
        <div class="container">
			{{ Form::open(['role' => 'form','URL' => 'signup','class' => 'mws-form','files'=>'true','id'=>'signup_form']) }}
            <div class="wrapper-heading">{{trans('messages.signup.sign_up_for_your')}}</div>
            <h3>{{trans('messages.signup.please_enter_your_detail')}}</h3>
            <div class="row">
                <div class="col-sm-9">
                    <form class="form-horizontal row">
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.title')}}*</label>                         
									<select name="title" class="form-control">
                                      <option value="mr">{{trans('messages.signup.mr')}}</option>
                                      <option value="mrs">{{trans('messages.signup.mrs')}}</option>
                                      <option value="ms">{{trans('messages.signup.ms')}}</option>
                                    </select>
									<div class="help-inline">
									</div>
                                </div>
                         </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>{{trans('messages.signup.first_name')}} *</label>
                              {{ Form::text('first_name','',['class'=>'form-control']) }}
							  <div class="help-inline">
									</div>
                          </div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>{{trans('messages.signup.last_name')}}*</label>
                              {{ Form::text('last_name','',['class'=>'form-control']) }}
								<div class="help-inline">
									</div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{trans('messages.signup.date_of_birth')}}*</label><br/>
								{{ Form::text("date_of_birth",'', ['class'=>'form-control','id'=>'datepicker','readonly'=>'readonly','data-format'=>"YYYY-MM-DD",'data-template'=>"D MMM YYYY"]) }}
								
                                <?php /* <div class="row">
                                    <div class="col-sm-4">
                                      <select class="form-control">
                                        <option>{{trans('messages.signup.day')}}</option>
                                        <option>1</option>
                                        <option>2</option>
                                      </select>
                                    </div>

                                    <div class="col-sm-4">
                                      <select class="form-control">
                                        <option>{{trans('messages.signup.month')}}</option>
                                        <option>Jan</option>
                                        <option>Feb</option>
                                      </select>
                                    </div>
                                    <div class="col-sm-4">
                                      <select class="form-control">
                                        <option>{{trans('messages.signup.year')}}</option>
                                        <option>2017</option>
                                        <option>2016</option>
                                      </select>
                                    </div>
                                </div> */ ?>
                            </div>
							<div class="help-inline date_of_birth_error"></div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="seperator"></div>
                        </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.phone')}}*</label>
                                  {{ Form::text('phone','',['class'=>'form-control']) }}
								 <div class="help-inline">
									</div>
                              </div>
                          </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.mobile')}}</label>
                                   {{ Form::text('mobile','',['class'=>'form-control']) }}
                              </div>
                          </div>
						  <div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.aleternative_email_address')}}</label>
                                {{ Form::text('aleternative_email','',['class'=>'form-control']) }}
                              </div>
                          </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.address')}} 1*</label>
                                 {{ Form::text('address','',['class'=>'form-control']) }}
								  <div class="help-inline">
									</div>
                              </div>
                          </div>
						  <div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.dept_suite_dist')}}</label>
                                 {{ Form::text('district','',['class'=>'form-control']) }}
                              </div>
                          </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{trans('messages.signup.country')}}</label>
								 {{ Form::select('country',[''=>trans('messages.signup.select_country')]+$country_list,'',['class'=>'form-control']) }}
								  <div class="help-inline country_error">
									</div>
                            </div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.state_prev_dept')}}*</label>
                                  {{ Form::text('state','',['class'=>'form-control']) }}
								 <div class="help-inline">
									</div>
                              </div>
                          </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.city')}}*</label>
                                  {{ Form::text('city','',['class'=>'form-control']) }}
								 <div class="help-inline">
									</div>
                              </div>
                          </div>
						  <div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.zip_code')}}*</label>
                                  {{ Form::text('zip_code','',['class'=>'form-control']) }}
								 <div class="help-inline">
									</div>
                              </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{trans('messages.signup.preferred_lang')}}</label>
                                   {{ Form::select('language',['en'=>trans('messages.english'),'ru'=>trans('messages.russian')],'',['class'=>'form-control']) }}
                            </div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.referrer_email')}}</label>
                                  {{ Form::text('referrer_email','',['class'=>'form-control']) }}
                              </div>
                        </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.how_did_you_hear')}}</label>
                                {{ Form::text('hear_about','',['class'=>'form-control']) }}
                              </div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-12">
                            <div class="confirm-field">
                                <h3>{{trans('messages.signup.confirm_your_email')}}</h3>
                                <h5>{{trans('messages.signup.this_will_allow_you_to')}}</h5>
                            </div>
                        </div>
						<?php $email	=	(!empty($email)?(base64_decode($email)):''); ?>
                        <div class="col-sm-12">
                             <div class="form-group">
                                <label>{{trans('messages.signup.email')}}*</label>
								   {{ Form::text('email',$email,['class'=>'form-control']) }}
								    <div class="help-inline">
								</div>
							</div>
                        </div>
						<div class="clearfix"></div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.password')}}*</label>
                                  {{ Form::password('password',['class'=>'form-control']) }}
								  <div class="help-inline">
									</div>
                              </div>
                          </div>
                        <div class="col-sm-6">
                              <div class="form-group">
                                <label>{{trans('messages.signup.re_enter_password')}}*</label>
                                   {{ Form::password('confirm_password',['class'=>'form-control']) }}
								  <div class="help-inline">
									</div>
                              </div>
                          </div>
						  <div class="clearfix"></div>
                        <div class="col-sm-9">
                             <div class="checkbox">
                                <label>
                                  <input name="terms" type="checkbox">{{trans('messages.signup.i_accept_to_receive_special')}} <br/>
                                   {{trans('messages.signup.by_signing_up')}}<a href="{{route('home.terms')}}"; target="_blank" class="page-link">{{trans('messages.signup.terms_and_condtion')}}</a>
								   <div class="help-inline terms_error">
									</div>
                                </label>
                              </div>
                        </div>
                        <div class="col-sm-3">
                              <div class="form-group mt-2">
                                <label class="small text-danger pull-right">
                                 {{trans('messages.signup.required_fields')}}</label>
                              </div>
                          </div>
						  
                        <div class="text-center sign-in-button">
                              <button type="button" onclick="signup()" class="btn btn-custom">{{trans('messages.signup.sign_up')}}</button>
                          </div>
                        </form>                  
                </div>
                <div class="col-sm-3">
                    <div class="secure">
                        <h4>100% {{trans('messages.signup.secure')}}</h4>
                        <p>{{trans('messages.signup.all_transaction_are')}}</p>
                        <img src="https://www.wintrillions.com/images_v3/godaddy.gif"/>
                    </div>
                    <div class="clearfix"></div>
                    <div class="why-lottery-left-section gurantee">
                        <div class="why-play-lottery">
                          <h4>{{trans('messages.signup.our_guarantee')}}</h4>
                          <ul>
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>{{trans('messages.signup.with_draw_each')}}</li>
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>{{trans('messages.signup.frequent_rollovers')}}</li>
                            <li><i class="fa fa-check-circle" aria-hidden="true"></i>{{trans('messages.signup.the_record_jackpot')}}</li>
                          </ul>
                          <div class="play-lottery text-center"><a href="javascript:void(0)">{{trans('messages.signup.play_now')}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
			{{ Form::close() }}
        </div>
    </div>
</section>
<script>
function signup() {
		$('#loader_img').show();
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("signup") }}',
			type:'POST',
			data: $('#signup_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				datas			=	JSON.parse(error_array);
				if(datas['success'] == 1) {
					window.location.href	 =	"{{ URL('signup') }}";
				}else {
					$.each(datas['errors'],function(index,html){
						if(index == "terms"){
							$(".terms_error").addClass('error');
							$(".terms_error").html(html);
						}else if(index == "date_of_birth"){
							$(".date_of_birth_error").addClass('error');
							$(".date_of_birth_error").html(html);
						}else if(index == "country"){
							$(".country_error").addClass('error');
							$(".country_error").html(html);
						}else {
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
	$(function(){
		$('#datepicker').combodate({
			minYear: 1960,
			maxYear: new Date().getFullYear() - 18,
		});
	}); 
        
	$(".help-inline").hover(function(){
		$(this).removeClass("error");
		$(this).empty("");
	});
</script>
@stop