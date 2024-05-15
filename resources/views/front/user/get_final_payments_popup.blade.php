<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<style>
.kt-form.kt-form--label-right .form-group label:not(.kt-checkbox):not(.kt-radio):not(.kt-option) {
    text-align: left;
}
</style>

<div class="modal-header">
	<h5 class="modal-title">
		{{ trans('messages.get_finalpayment.payment_form') }}
	</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
  <!--begin: Search Form -->
  {{ Form::open(['role' => 'form','class' => 'kt-form kt-form--label-right', 'files'=>'true', 'id'=>'OrderPaymentForm']) }}
  {{ Form::hidden('payment_id',$PaymentId, ['class'=>'payment_id', 'autocomplete'=>'off', 'readonly'=>'true']) }}
	<div class="kt-portlet__body">
		<div id="form_errors"></div>
		<div class="form-group row">
			<div class="col-lg-1 col-md-9 col-sm-12"></div>
			<div class="col-lg-4 col-md-9 col-sm-12">
				<div class="col-form-label kt-payment_form_heading">{{ trans('messages.get_finalpayment.payment_amount') }}</div>
			</div>
		</div>
		
		<div class="form-group row form_dv">
			<label class="col-form-label col-lg-1 col-md-9 col-sm-12"></label>
			<div class="col-lg-4 col-md-9 col-sm-12">
				<div class="input-group">
					<div class="input-group-prepend"><span class="input-group-text">{{CURRENCY}}</span></div>
					{{ Form::text('price',$planPrice, ['class'=>'form-control payment_amount', 'autocomplete'=>'off', 'readonly'=>'true', 'aria-describedby'=>'basic-addon1']) }}
				</div>
			</div>
		</div>
		
		<div class="form-group row">
			<div class="col-lg-1 col-md-9 col-sm-12"></div>
			<div class="col-lg-4 col-md-9 col-sm-12">
				<div class="col-form-label kt-payment_form_heading">{{ trans('messages.get_finalpayment.payment_option') }}</div>
			</div>
		</div>
		
		
		<div class="form-group row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<div class="row">
				@if(!empty($paymentOptions))
				  @foreach($paymentOptions as $paymentOption)
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option',$paymentOption->id,($orderDetails->payment_method == $paymentOption->id)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span>
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										{{$paymentOption->name}}
									</span>
								</span>
								<span class="kt-option__body">
									{{$paymentOption->description}}
								</span>
							</span>
						</label>
					</div>
				  @endforeach
				@endif
				
					<?php /* <div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','1',($orderDetails->payment_method == 1)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span>
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										QR Pay
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div>
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','2',($orderDetails->payment_method == 2)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span>
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										Cheque
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div>
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','5',($orderDetails->payment_method == 5)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span>
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										FPX
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div>
					
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','4',($orderDetails->payment_method == 4)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span>
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										Bank Transfer
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div>
					
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','3',($orderDetails->payment_method == 3)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span> 
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										CDM
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div>
					
					<div class="col-sm-3">
						<label class="kt-option kt-option--plain">
							<span class="kt-option__control">
								<span class="kt-radio kt-radio--brand">
									{{ Form::radio('payment_option','6',($orderDetails->payment_method == 6)?$orderDetails->payment_method:'', ['class'=>'']) }}
									<span></span> 
								</span>
							</span>
							<span class="kt-option__label">
								<span class="kt-option__head">
									<span class="kt-option__title">
										Credit Card / Debit Card
									</span>
								</span>
								<span class="kt-option__body">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
								</span>
							</span>
						</label>
					</div> */ ?>
					
				</div>
			</div>
			<div class="col-sm-1"></div> 
		</div>
		<div class="form-group row refrence_number">
			{{ Form::hidden('order_id',$orderDetails->id, ['class'=>'form-control', 'autocomplete'=>'off']) }}
			{{ Form::hidden('total_payment',$planPrice, ['class'=>'total_payment_blk', 'autocomplete'=>'off']) }}
			<div class="col-lg-1 col-md-9 col-sm-12"></div>
			<label class="col-form-label col-lg-2 col-sm-12">{{ trans("messages.book_plan.reference_id")}}: </label>
			<div class="col-lg-3 col-md-9 col-sm-12">
				<div class="input-group">
					{{ Form::text('reference_id',!empty($orderDetails->refrence_id)?$orderDetails->refrence_id:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
				</div>
			</div>
		</div>
		<div class="form-group row refrence_number">
			<div class="col-lg-1 col-md-9 col-sm-12"></div>
			<label class="col-form-label col-lg-2 col-sm-12">{{ trans("messages.book_plan.upload_receipt")}}: </label>
			<div class="col-lg-6 col-md-9 col-sm-12">
				<div class="form-group">
					{{ Form::file('receipt', ['class'=>'form-control', 'accept'=>'application/pdf,image/*', 'id'=>'customFile']) }}
					<span class="form-text help-inline"></span>
				</div>
			</div>
		</div>
		
	</div>
  {{ Form::close() }}
 <!--end: Search Form -->
</div>
<div class="modal-footer">
	<div class="kt-total_payment_form_heading">{{ trans('messages.edit_book_plan.total_payment') }}: {{ trans("messages.sub_project_detail.rm")}} <span class="total_amount_blk">0</span></div>
	<button type="reset" class="btn btn-danger btn-bold btn_1" data-dismiss="modal">{{ trans('messages.personal_information.cancel') }}</button>
	<button type="button" class="btn btn-success btn-bold btn_1" id="payNow">{{ trans('messages.get_finalpayment.confirm_payment') }}</button>
</div>

<script>
$(document).ready(function(){
	/* if ($('input[type=radio][name=payment_option]').value == '1' || $('input[type=radio][name=payment_option]').value == '5') { */
	if ($('input[type=radio][name=payment_option]').value == '5') {
		$(".refrence_number").hide();
    }else{
		$(".refrence_number").show();
	}

})

$('input[type=radio][name=payment_option]').change(function(){
	/* if (this.value == '1' || this.value == '5') { */
	if (this.value == '5') {
		$(".refrence_number").hide();
    }else{
		$(".refrence_number").show();
	}
})

var TotalValue = Number(0);
$(".form_dv .payment_amount").each(function() {
	//alert($(this).val());
	if($(this).val() != ""){
		TotalValue += parseFloat($(this).val());
	}
});
$(".total_amount_blk").text(TotalValue);
$(".total_payment_blk").val(TotalValue);

$(".payment_amount").keyup(function(){
	var TotalValue = Number(0);
	$(".form_dv .payment_amount").each(function() {
		//alert($(this).val());
		if($(this).val() != ""){
			TotalValue += parseFloat($(this).val());
		}
	});
	$(".total_amount_blk").text(TotalValue);
	$(".total_payment_blk").val(TotalValue);
})


var showErrorMsg = function(form, type, msg) {
	var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
		<div class="alert-text">'+msg+'</div>\
		<div class="alert-close">\
			<i class="flaticon2-cross kt-icon-sm" data-dismiss="alert"></i>\
		</div>\
	</div>');

	form.find('.alert').remove();
	//alert.prependTo(form);
	$("#form_errors").find('.alert').remove();
	alert.prependTo("#form_errors");
	//alert.animateClass('fadeIn animated');
	KTUtil.animateClass(alert[0], 'fadeIn animated');
	alert.find('span').html(msg);
}

$("#payNow").click(function(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	
	setTimeout(function(){ 
		Timer();
	}, 3000);
	
	var form = $(this).closest('form');
	var KeyVal = "1";
	var formData  = $('#OrderPaymentForm')[0];
	
	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.PayNow") }}',
		type:'POST',
		data: $('#OrderPaymentForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			setTimeout(function(){ 
				Swal.close()
			}, 2900);
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				$("#kt_modal_payment_form").modal('hide');
				//location.reload();
				//window.location.href	 =	"{{ route('User.dashboard') }}";
				location.reload();
			}else if(datas['success'] == 2){
				window.location.href	 =	datas['billUrl'];
			}else if(datas['error'] == 1){
				showErrorMsg(form, 'danger', datas['message']);
			}else if(datas['error'] == 2){
				showErrorMsg(form, 'danger', datas['message']);
			}else{
				//location.reload();
			}
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
		error: function(r){
			Swal.close();
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
	});
})

function Timer(){
	
	let timerInterval
	Swal.fire({
	  position: 'top-end',
	  title: 'Auto close alert!',
	  html: 'I will close in <b></b> milliseconds.',
	  timer: 22000,
	  timerProgressBar: true,
	  onBeforeOpen: () => {
		Swal.showLoading()
		timerInterval = setInterval(() => {
		  const content = Swal.getContent()
		  if (content) {
			const b = content.querySelector('b')
			if (b) {
			  b.textContent = Swal.getTimerLeft()
			}
		  }
		}, 1000)
	  },
	  onClose: () => {
		clearInterval(timerInterval)
	  }
	}).then((result) => {
	  /* Read more about handling dismissals below */
	  if (result.dismiss === Swal.DismissReason.timer) {
		console.log('I was closed by the timer')
	  }
	});
	
}

function TimerClose(){
	
	let timerInterval
	Swal.fire({
	  onClose: () => {
		clearInterval(timerInterval)
	  }
	}).then((result) => {
	 
	});
	
}
</script>