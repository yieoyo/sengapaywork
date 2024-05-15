@extends('admin.layouts.default')

@section('content')

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
@stop
