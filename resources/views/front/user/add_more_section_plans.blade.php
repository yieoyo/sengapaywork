<section class="form-group delete_more_section_project_plan_{{$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.project_template.section_price") }}:</label>
			<div class="input-group">
				<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm")}}</span></div>
				{{ Form::text('SectionPlan['.$counter.'][price]', '', ['class'=>'form-control alphabetRestriction','aria-describedby'=>'basic-addon1','autocomplete'=>'off']) }} 
			</div>
		</div>
		
		<div class="col-4 form-group">
			<label class="form-label">{{ trans('messages.project_templates_charity.section_name') }}:</label>
			{{ Form::text('SectionPlan['.$counter.'][section_name]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>'']) }}
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreSectionProjectPlan({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>
