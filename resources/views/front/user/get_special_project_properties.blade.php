@if(!empty($counter))
	@for($count = 1;$count <= $counter; $count++)
		<div class="form-group row">
			<label class="col-3 col-form-label">{{ trans("messages.project_template.subtitle")}} {{$count}}:</label>
			<div class="col-5">
				{{ Form::text('SeatReservation['.$count.'][description]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_description")]) }}
			</div>
		</div>

		<div class="form-group row">
			<label class="col-3 col-form-label">{{ trans('messages.sub_project_lists.project_plan') }}:</label>
			<div class="col-9">
				<div class="seat_reservation_plan_block_{{$count}}">
					
				</div>
				
				<div class="form-group">
					<button type="button" onclick="addMoreSeatReservationPlan({{$count}})" class="btn btn-label-brand"><i class="la la-plus"></i>
					{{ trans("messages.sub_project_detail.add_seat") }}</button>
				</div>
				
				
			</div>
		</div>

		<div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>
	@endfor
@endif
