@extends('front.layouts.default')
@section('content')
<style>
span.help-inline.edit_error.error {
    width: 35%;
}
form.details {
    font: 14px Arial, sans-serif;
}
#personal_information form.your-details fieldset {
    border-bottom: solid 2px #CBCBCB;
}
form.details .wrap, fieldset.details .wrap, #main.new_payment .wrap {
    overflow: hidden;
    min-height: 38px;
    margin-bottom: 10px;
    padding: 0!important;
    display: inline-table;
}
form.details .wrap, fieldset.details .wrap {
    width: 100%;
}
.account-content-box .wrap {
    padding: 2px 15px;
}
#personal_information form.your-details .inputborder input {
    width: 250px;
}
form.details .inputborder input {
    width: 150px;
} 
#personal_information form.your-details label {
    width: 88px!important;
}
form.details label strong {
    font-weight: bold;
}
.inputborder {
    display: block; 
    font-weight: bold;
    color: #666;
    font-size: 100%;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
    overflow: hidden;
    margin-bottom: 3px;
}
#personal_information form.your-details .legend {
    border-bottom: 0;
    padding-bottom: 0;
    margin-bottom: 10px;
}
.ChunkFiveMe {
    font-family: 'museo_700regular', Arial, Helvetica, sans-serif !important;
}
.bt_grey_big span {
    border: 1px solid #fff;
    display: table-cell;
    vertical-align: middle;
    padding: 0px 14px;
    font-weight: bold;
    height: 34px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
}
#personal_information form.your-details .buttons {
    padding-right: 2px;
}
form.details .legend, form.details legend {
    display: block;
    width: 100%;
    font-size: 23px;
    line-height: 20px;
    color: #5fb602;
    margin-bottom: 13px;
    padding-bottom: 13px;
    border-bottom: solid 2px #98dd3d;
}
form.details label {
    width: 110px;
    /* font: 12px/18px Arial, Helvetica, sans-serif; */
    color: #102100;
    display: table-cell;
    vertical-align: middle;
    padding-right: 10px;
}
</style>
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
    <div class="about_us_wrapper">
        <div class="container">
            <div class="wrapper-heading">{{Auth::user()->first_name}}, these are your Personal Information</div>
            <div class="row">
                <div class="col-sm-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="heading">Your Games</li>
                        <li><a href="{{route('User.dashboard')}}">Subscriptions</a></li>
                        <?php /*  <li><a href="{{route('User.scratchCard')}}">Scratch Cards</a></li> */ ?>
                        <li><a href="{{route('User.winnings')}}">Winnings</a></li>
                        <li><a href="{{route('User.VIPLoyalityPoint')}}">VIP Loyality Points</a></li>
                        <li class="heading">Your Payments</li>
                       <?php /*  <li><a href="javascript:void(0);">Add / Change  Payment Details</a></li> */ ?>
                        <li><a href="javascript:void(0);">Transaction History</a></li>
                        <li class="heading">Your Details</li>
                        <li class="active-tab"><a href="{{route('User.editProfile')}}">Personal information</a></li>
                        <li><a href="{{route('User.messages')}}">Messages</a></li>
                        <li class="heading">Your Preferences</li>
                        <li><a href="{{route('User.yourAlerts')}}">Your Alerts</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <form name="orderForm"  method="post" action="#" class="your-details details" id="save_user_info">
	           		<input type="hidden" name="make_order">
					<fieldset>
						<div class="wrap">
							<label><strong>Title*</strong></label>
							  <span class="select">
								{{ Form::select('title',['mr'=>'Mr','mrs'=>'Mrs','ms'=>'Ms'],$userDetail->title,['class'=>'width90','id'=>"usr_title"]) }} 
								<span class="help-inline edit_error"></span>
							  </span>
						</div>
						<div class="wrap from-group">
							<label><strong>First Name*</strong></label>
							<span class="inputborder">
								<input class="form-control"  name="first_name" id="usr_name" tabindex="2" value="{{$userDetail->first_name}}" maxlength="30">
								<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>Last Name*</strong></label><span class="inputborder">
							<input class="form-control" name="last_name" id="usr_lastname" tabindex="3" value="{{$userDetail->last_name}}" maxlength="30">
							<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>Date of Birth*</strong></label>
							<div>
								<span class="inputborder">
								 {{ Form::text("date_of_birth",$userDetail->date_of_birth, ['class'=>'','id'=>'datepicker','readonly'=>'readonly','data-format'=>"YYYY-MM-DD",'data-template'=>"D MMM YYYY"]) }}
								</span>
							</div>
							 <span class="help-inline edit_error date_of_birth_error"></span>
						</div>
					</fieldset>
					<fieldset>
						<div class="wrap">
							<label><strong>Alternative email address</strong></label>
							<span class="inputborder">
							<input class="form-control" name="alternative_email" id="usr_altEmail" tabindex="7" value="{{$userDetail->alternative_email}}">
							<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>Address 1*</strong></label>
		  					<span class="inputborder">
							<input class="form-control" type="text" name="address" id="usr_address1" value="{{$userDetail->address}}" maxlength="40" tabindex="8">
							<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>Dept / Suite / District</strong></label>
		  					<span class="inputborder">
							<input class="form-control" type="text" name="district" id="usr_address2" value="{{$userDetail->district}}" maxlength="40" tabindex="9">
							<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>City*</strong></label>
							<span class="inputborder">
							<input class="form-control" type="text" name="city" id="usr_city" value="{{$userDetail->city}}" maxlength="30" tabindex="10">
							<span class="help-inline edit_error"></span>
							</span>
						</div>
						<div class="wrap">
							<label><strong>Country*</strong></label>
							<span class="select">
								{{ Form::select('country',[''=>'Select Country']+$country_list,$userDetail->country,['class'=>'form-control country','id'=>"country"]) }}  
								<span class="help-inline edit_error"></span>
							</span>
						</div> 
						<div class="wrap" id="view_state_field" style="''">
							<label><strong>State / Prov / Dept.*</strong></label>
							<span class="inputborder">
								<input class="form-control" type="text" name="state" id="usr_state_field" value="{{$userDetail->state}}" tabindex="13" maxlength="30">
								<span class="help-inline edit_error"></span>
							</span>
						</div>

						<div class="wrap">
							<label><strong>Zip Code*</strong></label>
							<span class="inputborder">
								<input class="form-control" type="text" name="zip_code" id="usr_zipcode" tabindex="14" value="{{$userDetail->zip_code}}" maxlength="10">
								<span class="help-inline edit_error"></span>
							</span>
						</div> 
					</fieldset>

                            <fieldset>
                            	<div class="wrap">
									<label><strong>Phone*</strong></label>
									<span class="inputborder">
										<input class="form-control" type="text" name="phone" id="usr_phone" value="{{$userDetail->phone_number}}" maxlength="20" tabindex="15">
										<span class="help-inline edit_error"></span>
									</span>
								</div>
                                <div class="wrap">
									<label><strong>Mobile</strong></label>
									<span class="inputborder">
									<input class="form-control" name="mobile" id="usr_mobile" tabindex="16" value="{{$userDetail->mobile}}">
									<span class="help-inline edit_error"></span>
									</span>
								</div>
								<div class="wrap">
									<label><strong>Preferred language</strong></label>
									<span class="select">
										{{ Form::select('language',[''=>'Select Language','en'=>'English','ru'=>'Russian'],$userDetail->language,['class'=>' country','id'=>"usr_language"]) }} 
										<span class="help-inline edit_error"></span>
									</span>
								</div>
							</fieldset>

						<span class="legend green">
							<span class="ChunkFiveMe">Your Login Details</span>
						</span>
							<fieldset class="last">
								<div class="wrap">
									<label><strong>Email*</strong></label>
                 					 <span class="from-control inputborder inputname">
									{{Auth::user()->email}}
									 <input type="hidden" name="email" value="{{$userDetail->email}}">
									 </span>
								</div>
								<div class="wrap">
									<label><strong>Password*</strong></label>
									<span class="inputborder">
									<input class="form-control" type="password" name="password" maxlength="20" tabindex="18" value="">
									<span class="help-inline edit_error password_error"></span>
									</span>
								</div>
								<div class="wrap">
									<label class="double"><strong>Re-enter Password*</strong></label>
                  					<span class="inputborder">
									<input class="form-control" type="password" name="confirm_password" maxlength="20" tabindex="19" value="">
									<span class="help-inline edit_error confirm_password_error"></span>
									</span>
								</div>
								<div class="wrap"> 
                                    <label><small>*required fields</small></label>
                                    <input type="hidden" name="update_info" value="ok">
                                    <p class="buttons">
                                    	<a href="javascript:void(0)" onclick="saveUserDetail()" tabindex="20" class="btn btn-primary grad_grey bt_grey_big link" ><span>Update your personal information</span></a>
                                    </p>
								</div>
							</fieldset>
						</form>
                </div>
                <div class="col-sm-3">
                    <div class="about_right_section">
                         @include('front.elements.nagivation_right')
                    </div>
                    <div class="secure">
                        <h4>100% Secure</h4>
                        <p>All transactions are 100% secure and protected by a 256-bit SSL encryption.</p>
                        <img src="{{WEBSITE_IMG_URL}}godaddy.gif"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
	function saveUserDetail(){ 
		var formData  = $('#save_user_info')[0];
		$('#loader_img').show();
		$('.help-inline edit_error').html('');
		$('.help-inline edit_error').removeClass('error'); 
		$.ajax({
			url: '{{ route("User.updateUserProfile") }}',
			type:'post',
			data: $('#save_user_info').serialize(),
			data: new FormData(formData),
			dataType: 'json',
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,
			success: function(r){   
				error_array 	= 	JSON.stringify(r);
				data			=	JSON.parse(error_array);
				if(data['success'] == 1){
					show_message("Your profile information have been updated.","success");
					location.reload();
				}else{ 
					$.each(data['errors'],function(index,html){
						if(index=="date_of_birth"){
							$(".date_of_birth_error").addClass('error');
							$(".date_of_birth_error").html(html);
						}if(index=="password"){
							$(".password_error").addClass('error');
							$(".password_error").html(html);
						}if(index=="confirm_password"){
							$(".confirm_password_error").addClass('error');
							$(".confirm_password_error").html(html);
						}else{ 
							$("input[name = "+index+"]").next().addClass('error');
							$("input[name = "+index+"]").next().html(html);
							$("select[name = "+index+"]").next().addClass('error');
							$("select[name = "+index+"]").next().html(html); 
						}
					});
				}
				$('#loader_img').hide();
			}
		});
	}
	
$(function(){
	$('#datepicker').combodate({
		minYear: 1960,
		maxYear: new Date().getFullYear() - 18,
	});
}); 
</script>
@stop