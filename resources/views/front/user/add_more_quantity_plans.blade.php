<section class="form-group delete_more_section_project_plan_{{$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-2 form-group">
			<label class="form-label">{{ trans("messages.sub_project_detail.price_unit") }}:</label>
			<div class="input-group">
				<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm")}}</span></div>
				{{ Form::text('QuantityPlan['.$counter.'][price]', '', ['class'=>'form-control','aria-describedby'=>'basic-addon1','autocomplete'=>'off']) }} 
			</div>
		</div>
		
		<div class="col-2 form-group">
			<label class="form-label">{{ trans("messages.project_template.title") }}:</label>
			{{ Form::text('QuantityPlan['.$counter.'][plan_title]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_title")]) }}
		</div>
		<div class="col-6 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.description") }}:</label>
			{{ Form::text('QuantityPlan['.$counter.'][plan_description]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreQuantityProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>
