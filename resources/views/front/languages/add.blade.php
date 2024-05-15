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
						{{ trans('messages.language_settings.add_translation') }} 
					</h3>					
					<div class="kt-subheader__breadcrumbs">						
						<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>						
						<span class="kt-subheader__breadcrumbs-separator"></span>						
						<a href="#" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.general") }} 						
						</a>						
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{URL::to('/language-settings')}}" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.header.translation") }} 						
						</a>						
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link">							
							{{ trans('messages.language_settings.add_translation') }} 
						</a>					
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
							<h3 class="kt-portlet__head-title">{{ trans('messages.language_settings.add_translation_form') }}</h3>						
						</div>					
					</div>					
					{{ Form::open(['role' => 'form','url' => 'language-settings/add-setting','class' => 'kt-form kt-form--label-left']) }}						
						<div class="kt-portlet__body">							
							<div class="kt-section kt-section--first">								
								<div class="kt-section__body">									
									<div class="form-group row">										
										{{  Form::label('default', 'Default', ['class' => 'col-sm-2 col-form-label']) }}	
										<div class="col-sm-4">											
											<div class="input-group">{{ Form::text('default', '', ['class' => 'form-control']) }}</div>
											<div class="error-message help-inline"><?php echo $errors->first('default'); ?></div>
										</div>									
									</div>									
									@if(!empty($languages))					
										@foreach($languages as $key => $val)
											<div class="form-group row">				
												{{  Form::label('name', $val->title.' '.trans('messages.language_settings.language'), ['class' => 'col-sm-2 col-form-label']) }}									
												<div class="col-sm-4">					
													<div class="input-group">				
														{{ Form::text("language[$val->lang_code]",'', ['class' => 'form-control', 'aria-describedby'=>'basic-addon1']) }} 									
													</div>								
													<div class="error-message help-inline"><?php echo $errors->first('language['.$val->lang_code.']'); ?></div>						
												</div>		
											</div>		
										@endforeach					
									@endif							
									<?php /* <div class="form-group row">
												<label class="col-sm-2 col-form-label">English Language</label>
												<div class="col-sm-4">
													<div class="input-group">
														<input type="text" class="form-control" value="Booking" placeholder="" aria-describedby="basic-addon1">
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-2 col-form-label">Malay Language</label>
												<div class="col-sm-4">
													<div class="input-group">
														<input type="text" class="form-control" value="Tempahan" placeholder="" aria-describedby="basic-addon1">
													</div>
												</div>
											</div> */ ?>	
								</div>			
							</div>					
						</div>				
						<div class="kt-portlet__foot">		
							<div class="kt-form__actions">			
								<div class="row">				
									<div class="col-lg-2 col-xl-2"></div>	
									<div class="col-lg-10 col-xl-10">		
										<button type="submit" class="btn btn-success">{{ trans('messages.cms_page_details.submit') }}</button>&nbsp;
										<a href="{{URL::to('/language-settings')}}" class="btn btn-secondary">			
											{{ 	trans('messages.personal_information.cancel') }}										
										</a>									
									</div>								
								</div>							
							</div>						
						</div>					
					</form>				
				</div>			
			</div>			
			<!--End::App-->		
		</div>		
		<!-- end:: Content -->	
	</div>
</div>



<?php /* 
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
		<span> {{ trans("Add New Word") }}</span>
		<a href="{{URL::to('admin/language-settings')}}" class="btn btn-success btn-small align">{{ trans("Back To Language Settings") }} </a>
	</div>
	<div class="mws-panel-body no-padding">
		{{ Form::open(['role' => 'form','url' => 'admin/language-settings/add-setting','class' => 'mws-form']) }}
			<div class="mws-form-inline">
				<div class="mws-form-row">
					{{  Form::label('default', 'Default', ['class' => 'mws-form-label']) }}
					<div class="mws-form-item">
						{{ Form::text('default', '', ['class' => 'small']) }}  <span class="asterisk">*</span>
						<div class="error-message help-inline">
							<?php echo $errors->first('default'); ?>
						</div>
					</div>
				</div>
				@if(!empty($languages))
					@foreach($languages as $key => $val)
						<div class="mws-form-row">
							{{  Form::label('email', $val->title, ['class' => 'mws-form-label']) }}
							<div class="mws-form-item">
								{{ Form::text("language[$val->lang_code]",'', ['class' => 'small']) }} 
								<div class="error-message help-inline">
									<?php echo $errors->first('email'); ?>
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
			<div class="mws-button-row">
				<div class="input" >
					<input type="submit" value="{{ trans('Save') }}" class="btn btn-danger">
					<a href="{{URL::to('admin/language-settings/add-setting')}}" class="btn primary"><i class=\"icon-refresh\"></i> {{ trans('Reset') }}</a>
				</div>
			</div>
		{{ Form::close() }}
	</div>    	
</div>
 */ ?>
 
@stop
