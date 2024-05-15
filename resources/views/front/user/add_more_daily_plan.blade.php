<section class="form-group delete_more_daily_plan_{{$counter}}" rel="{{$counter}}">
	<label>{{ trans("messages.account_contributors.price") }}</label>
	<div class="row">
		<div class="col-3 input-group">
			<div class="input-group-prepend"><span class="input-group-text" id="basic-addon2">{{ trans("messages.sub_project_detail.rm")}}</span></div>
			{{ Form::text('DailyPlan['.$counter.'][price]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
		</div>
		<div class="col-2">
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					{{ Form::radio('DailyPlan_is_primary',$counter,'', ['class'=>'']) }} {{ trans('messages.sub_project_detail.primary') }}
					<span></span>
				</label>
			</div>
		</div>
		<div class="col-2">
			<button type="button" onclick="deleteMoreDailyPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>
