<section class="form-group delete_more_daily_period_{{$counter}}" rel="{{$counter}}">
	<label>{{ trans("messages.book_plan.period") }}</label>
	<div class="row">
		<div class="col-3 input-group">
			{{ Form::text('DailyPeriod['.$counter.'][quantity]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
			<div class="input-group-append"><span class="input-group-text" id="basic-addon2">{{ trans("messages.account_contributors.day") }}</span></div>
		</div>
		<div class="col-2">
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					{{ Form::radio('DailyPeriod_is_primary',$counter,'', ['class'=>'']) }} {{ trans('messages.sub_project_detail.primary') }}
					<span></span>
				</label>
			</div>
		</div>
		<div class="col-2">
			<button type="button" onclick="deleteMoreDailyPeriod({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>
