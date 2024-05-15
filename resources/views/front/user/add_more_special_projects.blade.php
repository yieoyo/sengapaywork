<section class="form-group delete_more_seat_reservation_plan_{{$subTitleCount.$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-2 form-group">
			<label class="form-label">{{ trans("messages.project_template.seat_price") }}:</label>
			<div class="input-group">
				<div class="input-group-prepend"><span class="input-group-text">{{ trans("messages.sub_project_detail.rm")}}</span></div>
				{{ Form::text('SeatReservation['.$subTitleCount.'][SpecialProjectSubtitle]['.$counter.'][seat_price]', '', ['class'=>'form-control alphabetRestriction', 'aria-describedby'=>'basic-addon1', 'autocomplete'=>'off']) }} 
			</div>
		</div>
		
		<div class="col-2 form-group">
			<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
			<div class="input-group">
				{{ Form::text('SeatReservation['.$subTitleCount.'][SpecialProjectSubtitle]['.$counter.'][seat_max_unit]', '', ['class'=>'custom-select form-control alphabetRestriction', 'autocomplete'=>'off']) }}
			</div>
		</div>
		
		
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.project_template.max_unit") }}:</label>
			{{ Form::text('SeatReservation['.$subTitleCount.'][SpecialProjectSubtitle]['.$counter.'][seat_name]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.project_template.enter_seat_name")]) }}
		</div>
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.project_template.seat_description") }}:</label>
			{{ Form::text('SeatReservation['.$subTitleCount.'][SpecialProjectSubtitle]['.$counter.'][seat_description]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreSeatReservationPlan({{$counter}},{{$subTitleCount}})" class="btn btn-label-danger"><i class="la la-trash"></i>{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
	
</section>