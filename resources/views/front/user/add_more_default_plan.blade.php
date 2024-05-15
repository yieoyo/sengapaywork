<section class="form-group delete_more_default_plan_{{$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.title_name") }}:</label>
			{{ Form::text('DefaultPlan['.$counter.'][title]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_title_name")]) }}
		</div>
		<div class="col-7 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
			{{ Form::text('DefaultPlan['.$counter.'][description]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreDefaultProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>