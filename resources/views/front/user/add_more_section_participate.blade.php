<section class="form-group row delete_more_section_item_{{$counter}}" rel="{{$counter}}">
	<div data-repeater-list="" class="col-lg-12">
		<div data-repeater-item="" class="form-group row align-items-center">
			<div class="col-md-5">
				<div class="kt-form__group--inline">
					<div class="kt-form__label">
						<label>{{ trans("messages.sub_project_detail.participant_name")}}:</label>
					</div>
					<div class="kt-form__control">
						{{ Form::text('Section['.$counter.'][name]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_participant_name"), 'aria-describedby'=>'emailHelp']) }}
					</div>
				</div>
				<div class="d-md-none kt-margin-b-10"> </div>
			</div>

			<div class="col-md-5">
				<div class="kt-form__group--inline">
					<div class="kt-form__label">
						<label class="kt-label m-label--single">{{ trans("messages.sub_project_detail.parts_tails")}}:</label>
					</div>
					<div class="kt-form__control">
						<select name="Section[{{$counter}}][section_plan]" class="form-control" id="exampleSelect1">
							<option>Pilih Bahagian </option>
							@if(!empty($sectionPlans))
							  @foreach($sectionPlans as $sectionPlan)
								<option value="{{$sectionPlan->id}}" data-plan-price="{{$sectionPlan->price}}">{{$sectionPlan->section_name}} - {{Currency . $sectionPlan->price}}</option>
							  @endforeach
							@endif
						</select>

					</div>
				</div>
				<div class="d-md-none kt-margin-b-10"> </div>
			</div>

			@if($counter != 0)
				<div class="col-md-2">
					<div class="kt-form__label">
						<label class="kt-label m-label--single"style="display: block; height: 19px;"></label>
					</div>
					<button type="button" onclick="deleteMoreSectionParticipateItem({{$counter}})" class="btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
				</div>
			@endif
		</div>


	</div>
</section>

