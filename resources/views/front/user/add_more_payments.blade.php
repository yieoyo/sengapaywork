<script>
$(function(){
	$('.date_of_birth').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD',
		changeMonth: true,
		changeYear : true,
		weekStart : 0,
		time: false,
		nowButton : true,
		switchOnClick : true,
		yearRange: '-100:+100',
		maxDate : new Date()  
		//minDate : new Date()  
	});
});
</script>

<section class="delete_add_more_payment_{{$counter}} payment_section" rel="{{$counter}}">
	<?php 
		$readonlyClass = "";
		$disableClass = "";
		$darkClass = "";
		$autoApprove = "";
	?>
		
	<div class="form-group row">
		<div class="col-sm-3">
			<div class="form-group cot_form_input_holder">
				<label class="col-form-label">{{$counter + 1}} Payment (Deposit):</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">{{CURRENCY}}</span>
					</div>
					{{ Form::text('Payment['.$counter.'][amount]','',["class"=>"form-control valid payment_amount paid_amount", 'aria-describedby'=>'basic-addon1']) }}
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<label class="col-form-label">{{ trans('messages.edit_book_plan.payment_type') }}:</label>
			{{ Form::select('Payment['.$counter.'][payment_option]',$paymentMethods,'', ['class'=>'form-control ', 'autocomplete'=>'off', 'placeholder'=>trans('messages.edit_book_plan.payment_type')]) }}
		</div>
		<div class="col-sm-2">
			<div class="form-group cot_form_input_holder">
				<label class="col-form-label">{{ trans('messages.edit_book_plan.payment_date') }}:</label>
				{{ Form::text('Payment['.$counter.'][payment_date]',date("d/m/Y",time()), ["class"=>"form-control valid date_of_birth"]) }}
			</div>
		</div>
		<div class="col-sm-2">
			<div class="form-group cot_form_input_holder">
				<label class="col-form-label">{{ trans('messages.edit_book_plan.refrence_id') }}:</label>
				{{ Form::text('Payment['.$counter.'][reference_id]','', ["class"=>"form-control valid"]) }}
			</div>
		</div>
		<div class="col-sm-2">
			<label class="col-form-label">{{ trans('messages.edit_book_plan.confirmation') }}:</label>
			<div class="btn-group">
				<?php 					
					$statusClass = "btn btn-danger";
					$statusName = "Not Paid";
				?>
				{{ Form::hidden('Payment['.$counter.'][payment_status]','', ['class'=>'payment_status', 'id'=>'paymentStatus_'.$counter]) }}
				<button type="button" class="status_btn_cls_name_{{$counter}} {{$statusClass}}">{{$statusName}}</button>
				<button type="button" class="status_btn_cls_{{$counter}} {{$statusClass}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" {{$readonlyClass}} {{$disableClass}} >
					<span class="sr-only">Toggle Dropdown</span>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item chnage_status" data-status-id="0" data-payment-id="{{$counter}}" data-statusClass="btn btn-danger" type="button">{{ trans('messages.dashboard.not_paid') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="1" data-payment-id="{{$counter}}" data-statusClass="btn btn-warning" type="button">{{ trans('messages.dashboard.pending') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="2" data-payment-id="{{$counter}}" data-statusClass="btn btn-success" type="button">{{ trans('messages.edit_book_plan.approved') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="4" data-payment-id="{{$counter}}" data-statusClass="btn btn-danger" type="button">{{ trans('messages.personal_information.cancel') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="5" data-payment-id="{{$counter}}" data-statusClass="btn btn-primary" type="button">{{ trans('messages.edit_book_plan.refund') }}</a>
				</div>
			</div>
			<span class="form-text text-muted">{{$autoApprove}}</span>
		</div>
		@if($counter > 0)
		  <div class="col-sm-2">
			<a href="javascript:void();" onclick="deleteMorePayment({{$counter}})" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>{{ trans("messages.sub_project_detail.delete") }}</a>
		  </div>
		@endif
	</div>
	
</section>
