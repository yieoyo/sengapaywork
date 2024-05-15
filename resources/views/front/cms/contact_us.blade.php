@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
    <div class="contact_us_wrapper" style="background-image:url('<?php echo WEBSITE_IMG_URL ; ?>contact_us_bg.png')">
        <div class="container">
            <!--<div class="wrapper-heading">{{trans('messages.home.contact_us')}}</div>-->
			
			<div class="contact_form_blk">
				<div class="row">
					<div class="col-sm-6">
						<div class="contact_lottery_content">
							<h2 class="contact_lottery_content_head">{{trans('messages.home.contact_us')}}</h2>
							<div class="contact_lottery_content_head_border"></div>
							{{ Form::open(['role' => 'form','URL' => 'contact','class' => 'mws-form','files'=>'true']) }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group <?php echo ($errors->first('name')) ? 'has-error' : ''; ?>">
										{{ HTML::decode( Form::label('name', trans("messages.home.name").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
										<div class="mws-form-item">
											{{ Form::text('name','',['class'=>'form-control']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('name'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo ($errors->first('email')) ? 'has-error' : ''; ?>">
										{{ HTML::decode( Form::label('email', trans("messages.home.email").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
										<div class="mws-form-item">
											{{ Form::text('email','',['class'=>'form-control']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('email'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-6">
									<div class="form-group <?php echo ($errors->first('phone_number')) ? 'has-error' : ''; ?>">
										{{ HTML::decode( Form::label('phone_number', trans("messages.home.phone_number").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
										<div class="mws-form-item">
											{{ Form::text('phone_number','',['class'=>'form-control']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('phone_number'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group <?php echo ($errors->first('subject')) ? 'has-error' : ''; ?>">
										{{ HTML::decode( Form::label('subject', trans("messages.home.subject").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
										<div class="mws-form-item">
											{{ Form::text('subject','',['class'=>'form-control']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('subject'); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-md-12">
									<div class="form-group <?php echo ($errors->first('message')) ? 'has-error' : ''; ?>">
										{{ HTML::decode( Form::label('message', trans("messages.home.message").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
										<div class="mws-form-item">
											{{ Form::textarea('message','',['class'=>'form-control']) }}
											<div class="error-message help-inline">
												<?php echo $errors->first('message'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="mws-button-row">
								<div class="contact_form_submit_btn" >
									<input type="submit" value="{{ trans('messages.contact.submit') }}" class="btn btn-danger">
								</div>
							</div>
							{{ Form::close() }}<br/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="contact_form_map" id="map">
							<div class="map_bg_design1"></div>
							{{Config::get('Contact.map')}}
							<div class="map_bg_design2"></div>
						</div>
					</div>
				</div>
			</div>
			
        </div>
    </div>
</section>
@stop