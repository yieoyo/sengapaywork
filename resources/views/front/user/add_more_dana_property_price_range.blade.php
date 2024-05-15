<section class="form-group delete_more_property_price_range_{{$counter}}" rel="{{$counter}}">
	<div class="row">
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.min_price") }}:</label>
			{{ Form::text('PropertyPriceRange['.$counter.'][min_price]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_min_price")]) }}
		</div>
		<div class="col-3 form-group">
			<label class="form-label">{{ trans("messages.account_contributors.max_price") }}:</label>
			{{ Form::text('PropertyPriceRange['.$counter.'][max_price]', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans("messages.account_contributors.enter_max_price")]) }}
		</div>
		<div class="col-2">
			<label class="form-label" style="display: block; height: 19px;"></label>
			<button type="button" onclick="deleteMoreDanaPropertyPriceRange({{$counter}})" class="btn btn-label-danger"><i class="la la-trash"></i>
			{{ trans("messages.sub_project_detail.delete") }}</button>
		</div>
	</div>
</section>
