<table class="table">
	<thead>
	  <tr>
		 <th>{{ trans('messages.sub_project_detail.invoice_id') }}</th>
		 <th>{{ trans('messages.sub_project_detail.referral_id') }}</th>
		 <th>{{ trans('messages.invoice_generate.invoice_date') }}</th>
		 <th>{{ trans('messages.sub_project_detail.contribution') }}</th>
		 <th>{{ trans('messages.dashboard.status') }}</th>
		 <th>{{ trans('messages.edit_book_plan.payment_type') }}</th>
		 <th>{{ trans("messages.language_settings.action") }}</th>
	  </tr>
	</thead>
	<tbody>
	 @if(!empty($DonationInvoiceLists))
	  @foreach($DonationInvoiceLists as $key=>$DonationInvoiceList)
	   <tr>
		<td>{{$DonationInvoiceList->invoice_id}}</td>
		<td>{{$DonationInvoiceList->reference_id}}</td>
		<td>{{date("d/m/Y",strtotime($DonationInvoiceList->created_at))}}</td>
		<td>{{CURRENCY}} {{$DonationInvoiceList->amount}}</td>
		<td class="status_blk_{{$DonationInvoiceList->id}}">
		 @if($DonationInvoiceList->payment_status == 1)
			<div class="btn-group">
				<?php 
					$statusClass = "btn btn-warning";
					$statusName = "Waiting Approval";
				?>
				<button type="button" class="status_btn_cls_btn status_btn_cls_name_{{$DonationInvoiceList->id}} {{$statusClass}}">{{$statusName}}</button>
				<button type="button" class="status_btn_cls_btn status_btn_cls_{{$DonationInvoiceList->id}} {{$statusClass}} dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">{{ trans('messages.booking_template_edit.toggle_dropdown') }}</span>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item chnage_status" data-status-id="0" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-danger" type="button">
						{{ trans("messages.dashboard.not_paid") }}</a>
					<a class="dropdown-item chnage_status" data-status-id="1" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-warning" type="button">
					{{ trans('messages.dashboard.waiting_approval') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="2" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-success" type="button">
					{{ trans('messages.edit_book_plan.approved') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="3" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-warning" type="button">
					{{ trans('messages.dashboard.pending') }}</a>
					<a class="dropdown-item chnage_status" data-status-id="4" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-danger" type="button">
					{{ trans('messages.personal_information.cancel') }}</a>
					<?php /* <a class="dropdown-item chnage_status" data-status-id="5" data-payment-id="{{$DonationInvoiceList->id}}" data-project-id="{{$DonationInvoiceList->order_id}}" data-statusClass="btn btn-primary" type="button">
					{{ trans('Refund') }}</a> */ ?>
				</div>
			</div>
		
			<?php /* <span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('Waiting Approval') }}</span> */ ?>
		 @elseif($DonationInvoiceList->payment_status == 2)
			<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">{{ trans('messages.edit_book_plan.approved') }}</span>
		 @elseif($DonationInvoiceList->payment_status == 3)	
			<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
		 @elseif($DonationInvoiceList->payment_status == 4)	
			<span class="kt-badge  kt-badge--dark kt-badge--inline kt-badge--pill">{{ trans('messages.personal_information.cancel') }}</span>
		 @elseif($DonationInvoiceList->payment_status == 5)	
			<span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill">{{ trans('messages.edit_book_plan.refund') }}</span>
		 @elseif($DonationInvoiceList->payment_status == 6)	
			<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.edit_book_plan.enquiry') }}</span>
		 @else
			<span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill">{{ trans('messages.dashboard.pending') }}</span>
		 @endif
		</td>
		<td>
		 @if($DonationInvoiceList->payment_option == 1)	
			<span class="payment_method-qr-code">{{ trans('messages.project_templates_dana_lestari.qr_pay') }}</span>
		 @elseif($DonationInvoiceList->payment_option == 2)
			<span class="payment_method-cash">{{ trans('messages.project_templates_dana_lestari.check') }}</span>
		 @elseif($DonationInvoiceList->payment_option == 3)
			<span class="payment_method-qr-code">{{ trans('messages.project_templates_dana_lestari.cdm') }}</span>
		 @elseif($DonationInvoiceList->payment_option == 4)
			<span class="payment_method-bank">{{ trans('messages.project_templates_dana_lestari.bank_transfer') }}</span>
		 @elseif($DonationInvoiceList->payment_option == 5)
			<span class="payment_method-qr-code">{{ trans('messages.project_templates_dana_lestari.online_banking') }}</span>
		 @elseif($DonationInvoiceList->payment_option == 6)
			<span class="payment_method-bank">{{ trans('messages.project_templates_dana_lestari.credit_card_debit_card') }}</span>
		 @else
			<span class="payment_method-cash">{{ trans('messages.project_templates_dana_lestari.cash') }}</span>
		 @endif
		 
		</td>
		<td><button type="button" onclick="window.open('{{route('user.invoice_generate',$DonationInvoiceList->invoice_id)}}','_blank');" class="btn btn-brand btn-sm kt-font-transform-u btn-mini">{{ trans("messages.invoice_generate.view_invoice")}}</button><td>
	   </tr>
	  @endforeach
	 @else
	  <tr><td colspan="6">{{ trans('messages.get_guest_payment.amount_not_paid_yet') }}</td></tr>
	 @endif
	</tbody>
</table>

<script>

$(document).on("click", ".chnage_status", function(){
//$(".chnage_status").click(function(){
	var paymentId = $(this).attr("data-payment-id");
	var paymentStatus = $(this).attr("data-status-id");
	var StatusClass = $(this).attr("data-statusClass");
	var projectId = $(this).attr("data-project-id");
	//alert(StatusClass);
	
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#SignUpForm')[0];
	$.ajax({
		url: '{{ route("User.UpdateBookingPaymentStatus") }}',
		type:'POST',
		data: {'paymentId': paymentId, 'paymentStatus': paymentStatus},
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				//window.location.href	 =	"{{ URL('/dashboard') }}";
				if(paymentStatus == 2){
					$(".btn-group").remove();
					$(".status_blk_"+paymentId).html('<span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>');
					$(".badge_"+projectId).removeClass('kt-badge--warning');
					$(".badge_"+projectId).addClass('kt-badge--success');
					$(".badge_"+projectId).text('Success');
				}else{
					$(".status_btn_cls_"+paymentId).removeClass("btn btn-warning");
					$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-warning");
					$(".status_btn_cls_"+paymentId).removeClass("btn btn-danger");
					$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-danger");
					$(".status_btn_cls_"+paymentId).removeClass("btn btn-success");
					$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-success");
					$(".status_btn_cls_"+paymentId).removeClass("btn btn-primary");
					$(".status_btn_cls_name_"+paymentId).removeClass("btn btn-primary");
					
					$(".status_btn_cls_"+paymentId).addClass(StatusClass);
					$(".status_btn_cls_name_"+paymentId).addClass(StatusClass);
					$(".status_btn_cls_name_"+paymentId).text($(this).text());
					
					$("#paymentStatus_"+paymentId).val(paymentStatus);
				}
			}else if(datas['error'] == 1){
				//location.reload();
			}else if(datas['error'] == 100){
				swal.fire({
					"title": "",
					"text": datas['message'],
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			}else {
				//location.reload();
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
	
	
})

</script>