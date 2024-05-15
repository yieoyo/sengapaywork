<section class="form-group delete_more_offline_ayment_{{$counter}}" rel="{{$counter}}">
  <div class="row">
	<label class="col-xl-3 col-lg-3 col-form-label">Option {{$counter + 1}}</label>
	<div class="col-lg-6 col-xl-6">
		{{ Form::text("Offline[".$counter."][name]", '', ['class'=>'form-control', 'autocomplete'=>'off']) }}
		<span class="form-text text-muted"></span>
	</div>
  </div>
  <div class="row">
	<label class="col-xl-3 col-lg-3 col-form-label">Description {{$counter + 1}}</label>
	<div class="col-lg-6 col-xl-6">
		{{ Form::text("Offline[".$counter."][description]", '', ['class'=>'form-control', 'autocomplete'=>'off']) }}
		<span class="form-text text-muted"></span>
	</div>
  </div>
</section>
