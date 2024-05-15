<section class="form-group delete_more_default_dana_plan_{{$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.price") }}:</label>
			{{ Form::text('DefaultDanaPlan['.$counter.'][amount]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_Plan_price")]) }}
		</div>
		<div class="col-4 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
			{{ Form::text('DefaultDanaPlan['.$counter.'][title]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
		</div>
		<div class="col-2 form-group">
			<label class="form-label"></label>
			<div class="kt-checkbox-inline">
				<label class="kt-checkbox">
					{{ Form::radio('default_dana_is_primary',$counter,'', ['class'=>'']) }} {{ trans('messages.sub_project_detail.primary') }}
					<span></span>
				</label>
			</div>
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreDefaultDanaPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div> 
</section>
