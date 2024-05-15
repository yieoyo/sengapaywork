@extends('front.layouts.default')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						{{ trans("messages.invoice_generate.invoice")}}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link">
							 {{ trans("messages.invoice_generate.infoq")}}</span>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ !empty($subProjectDetails) ? $subProjectDetails->project_name:''; }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="" class="kt-subheader__breadcrumbs-link">
							{{ !empty($subProjectDetails) ? $subProjectDetails->sub_project_name:''; }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link">
							{{ trans("messages.invoice_generate.invoice")}}</a>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet">
				<div class="kt-portlet__body kt-portlet__body--fit">
					<div class="kt-invoice-2">
						<div class="kt-invoice__head">
							<div class="kt-invoice__container">
								<div class="kt-invoice__brand">
									<h1 class="kt-invoice__title">{{ trans("messages.invoice_generate.invoice")}}</h1>
									<div href="{{WEBSITE_URL}}" class="kt-invoice__logo" >
										<?php
											if(!empty(Config::get("Settings.logo")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.logo"))){
												$logo = SYSTEM_IMAGE_URL . Config::get("Settings.logo");
											}else{
												$logo = WEBSITE_IMG_URL . "logo.png";
											}
										?>
										<a href="{{WEBSITE_URL}}" style="margin: auto;"><img src="{{$logo}}" style=" width: 150px;"></a>
										<span class="kt-invoice__desc">
											<span>{{Config::get("Settings.business_address")}}</span>
										</span>
									</div>
								</div>
								<div class="kt-invoice__items">
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.invoice_generate.invoice_date")}}</span>
										<span class="kt-invoice__text">{{date("M d,Y",strtotime($orderDetails->created_at))}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.invoice_generate.invoice_no")}}</span>
										<span class="kt-invoice__text">{{$orderDetails->bill_id}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.invoice_generate.invoice_to")}}</span>
										<span class="kt-invoice__text">{{$orderDetails->full_name}},<br>{{$orderDetails->address}}</span>
									</div>
								</div>

								<div class="kt-invoice__items">
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.book_plan.payment_options") }}</span>
										<span class="kt-invoice__text">{{$orderDetails->payment_method_name}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.book_plan.reference_id")}}</span>
										<span class="kt-invoice__text">{{$orderDetails->refrence_id}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">{{ trans("messages.book_plan.payment_type")}}</span>
										<span class="kt-invoice__text">
											@if($orderDetails->payment_type == 1)
												{{ trans("messages.book_plan.recuring")}}
											@else
												{{ trans("messages.book_plan.one_time_payment") }}
											@endif
										</span>
									</div>
									
									<?php $paymentPending = ""; ?>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle"> {{ trans("messages.book_plan.payment_status") }} </span>
										@if(!empty($paymentInvoice))
										  @if($paymentInvoice->payment_status == 1)
											<button class="btn btn-warning" style="width: 100%">{{ trans("messages.book_plan.waiting_approval") }}</button>
										  @elseif($paymentInvoice->payment_status == 2)
											@if($paymentInvoice->payment_option == 1 || $paymentInvoice->payment_option == 5)
												<button class="btn btn-success" style="width: 100%">{{ trans("messages.book_plan.auto_approve") }}</button>
											@else
												<button class="btn btn-success" style="width: 100%">{{ trans("messages.book_plan.success") }}</button>
											@endif	
										  @elseif($paymentInvoice->payment_status == 3)
											<button class="btn btn-warning" style="width: 100%">{{ trans("messages.book_plan.pending") }}</button>
											<?php $paymentPending = "1"; ?>
										  @elseif($paymentInvoice->payment_status == 4)
											<button class="btn btn-danger" style="width: 100%">{{ trans("messages.book_plan.reject") }}</button>
										  @elseif($paymentInvoice->payment_status == 5)
											<button class="btn btn-info" style="width: 100%">{{ trans("messages.book_plan.expired") }}</button>
										  @else
											<button class="btn btn-warning" style="width: 100%">{{ trans("messages.book_plan.pending") }}</button> 
											<?php $paymentPending = "1"; ?>
										  @endif
										@else
											<button class="btn btn-warning" style="width: 100%">{{ trans("messages.book_plan.pending") }}</button>
											<?php $paymentPending = "1"; ?>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="kt-invoice__body">
							<div class="kt-invoice__container">
								<div class="table-responsive">
									<table class="table">
									 @if($subProjectDetails->project_module == 1)
										<thead>
											<tr>
												<th>{{ trans("messages.invoice_generate.description")}}</th>
												<th>
													@if($orderDetails->plan_type == "yearly")
														{{ trans("messages.invoice_generate.years")}}
													@elseif($orderDetails->plan_type == "monthly")
														{{ trans("messages.invoice_generate.months")}}
													@else
														{{ trans("messages.invoice_generate.days")}}
													@endif
												</th>
												<th>{{ trans("messages.invoice_generate.amount")}}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{ trans("messages.book_plan.plan")}} {{CURRENCY.$planPrice}} {{!empty($orderDetails->other_plan_price)? "(other)":"";}}</td>
												<td>{{$planPeriod}}</td>
												<td class="kt-font-danger kt-font-lg">{{CURRENCY.$planPrice}}</td>
											</tr>
										</tbody>
									 @elseif($subProjectDetails->project_module == 2)
										<thead>
											<tr>
												<th>{{ trans("messages.invoice_generate.description")}}</th>
												@if($subProjectDetails->customize_plan_option == 2 || $subProjectDetails->customize_plan_option == 4)
													<th>{{ trans("messages.invoice_generate.unit")}}</th>
												@elseif($subProjectDetails->customize_plan_option == 3)
													<th>{{ trans("messages.sub_project_detail.quantity") }}</th>
												@endif
												<th>{{ trans("messages.invoice_generate.amount")}}</th>
											</tr>
										</thead>
										<tbody>
											@if($subProjectDetails->customize_plan_option == 2)
												@if(!empty($orderDetails->planDescription))
												  @foreach($orderDetails->planDescription as $planDescription)
													<tr>
														<td>{{$subProjectDetails->seat_reservation_main_title}} - {{$planDescription->seat_name}} - {{$planDescription->total_attendance}} Attend</td>
														<td>{{$planDescription->total_seat}}</td>
														<td class="kt-font-danger kt-font-lg">{{CURRENCY}} {{$planDescription->total_seat * $planDescription->amount}}</td>
													</tr>
												  @endforeach
												@endif
												<tr>
													<td>{{$subProjectDetails->seat_reservation_main_title_2}}</td>
													<td>1</td>
													<td class="kt-font-danger kt-font-lg">{{CURRENCY}} {{ !empty($orderDetails->seat_reservation_plan_price_2)?$orderDetails->seat_reservation_plan_price_2:0 }}</td>
												</tr>
											@elseif($subProjectDetails->customize_plan_option == 3)
												<tr>
													<td>{{ trans("messages.book_plan.plan")}} {{$planName}}</td>
													<td>{{$orderDetails->quantity}}</td>
													<td class="kt-font-danger kt-font-lg">{{CURRENCY}} 
													  @if(!empty($paymentInvoice->amount))
														{{ $paymentInvoice->amount }} 
													  @else
														{{!empty($planPrice) ? ($planPrice + $orderDetails->total_contribution) : $orderDetails->total_contribution; }}
													  @endif
													</td>
												</tr>
											@elseif($subProjectDetails->customize_plan_option == 4)
												@if(!empty($orderDetails->planDescription))
												  @foreach($orderDetails->planDescription as $planDescription)
													<tr>
														<td>{{$planDescription->name}} - {{$planDescription->plan_name}}</td>
														<td>1</td>
														<td class="kt-font-danger kt-font-lg">{{CURRENCY}} 
														  {{$planDescription->price}}
														</td>
													</tr>
												  @endforeach
												@endif
											@else
												<tr>
													<td>{{ trans("messages.book_plan.plan")}} {{$planName}}</td>
													<td class="kt-font-danger kt-font-lg">{{CURRENCY}} {{!empty($planPrice) ? ($planPrice + $orderDetails->total_contribution) : $orderDetails->total_contribution; }}</td>
												</tr>
											@endif
										</tbody>
									 @elseif($subProjectDetails->project_module == 3)
										<thead>
											<tr>
												<th>{{ trans("messages.invoice_generate.description")}}</th>
												@if($subProjectDetails->customize_plan_option == 6)
													<th>{{ trans("messages.invoice_generate.vendor")}}</th>
												@endif
												<th>{{ trans("messages.invoice_generate.unit")}}</th>
												<th>{{ trans("messages.invoice_generate.amount")}}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{$planName}}</td>
												@if($subProjectDetails->customize_plan_option == 6)
													<td>{{ !empty($subProjectDetails->vendor_name)?$subProjectDetails->vendor_name:'' }}</td>
												@endif
												<td>1</td>
												<td class="kt-font-danger kt-font-lg">{{CURRENCY.$orderDetails->total_contribution}}</td>
											</tr>
										</tbody>
									 @endif
									</table>
									<table class="table" style="background-color:#f9f9f9">
										<tbody>
											<tr>
												<td>Total Amount</td>
												<td class="kt-font-danger kt-font-lg">
													@if(!empty($paymentInvoice->amount))
														{{ CURRENCY." ".$paymentInvoice->amount }} 
													@else 
														{{CURRENCY." ".$orderDetails->total_contribution}}
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@if($subProjectDetails->project_module == 1)
						<div class="kt-invoice__footer">
							<div class="kt-invoice__container">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>{{ trans("messages.invoice_generate.commitment_type")}}</th>
												<th>{{ trans("messages.invoice_generate.period")}}</th>
												<th>{{ trans("messages.invoice_generate.end_date")}}</th>
												<th>{{ trans("messages.book_plan.total_amount") }}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>{{ucfirst($orderDetails->plan_type)}}</td>
												<td>
													{{$planPeriod}} 
													@if($orderDetails->plan_type == "yearly")
														{{ trans("messages.invoice_generate.years")}}
														<?php $periodType = "years"; ?>
													@elseif($orderDetails->plan_type == "monthly")
														{{ trans("messages.invoice_generate.months")}}
														<?php $periodType = "months"; ?>
													@else
														{{ trans("messages.invoice_generate.days")}}
														<?php $periodType = "days"; ?>
													@endif
												</td>
												<td>{{date("M d,Y",strtotime("+ ".$planPeriod." ".$periodType,strtotime($orderDetails->created_at)))}}</td>
												<td class="kt-font-danger kt-font-xl kt-font-boldest">{{CURRENCY.$planPrice}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						@endif
						<div class="kt-invoice__actions">
							<div class="kt-invoice__container">
								<button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">{{ trans("messages.invoice_generate.download_invoice")}}</button>
								@if(!empty(Auth::user()))
									<button type="button" class="btn btn-label-success btn-bold btn_1" onclick="location.href='{{URL('/dashboard')}}';">{{ trans("messages.header.go_to_dashboard") }}</button>
								@else
								  <button type="button" class="btn btn-label-success btn-bold btn_1 openSignupModel">{{ trans("messages.header.go_to_dashboard") }}</button>
								@endif
								@if($paymentPending == 1)
									<button type="button" class="btn btn-brand btn-bold btn_1 order_final_payment" data-order-id="{{$orderDetails->id}}" data-toggle="modal" data-target="#kt_modal_payment_form">{{ trans("messages.invoice_generate.make_payment")}}</button>
								@else
								<button type="button" class="btn btn-danger btn-bold" onclick="window.print();">{{ trans("messages.invoice_generate.print_invoice")}}</button>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Content -->
	</div>
</div>



<div id="kt_modal_payment_form" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="min-height: 590px;">
			
			<div class="order_payment_data"></div>
			
		</div>
	</div>
</div>


<?php 
	$PaymentMethod = Session::get('PaymentMethod'); 
	if(!empty($PaymentMethod)){ ?>
		<script>
			$( document ).ready(function() {
				$(".order_final_payment").trigger("click");
			})
		</script>
<?php
	}
?>

<script>
$(".order_final_payment").click(function(){
	var OrderId = "<?php echo $orderDetails->id; ?>";
	var PaymentId = "<?php echo $paymentInvoice->id; ?>";
	$('#loader_img').show();
	$.ajax({
		url: '{{ route("User.GetFinalPaymentDetails") }}',
		type:'POST',
		data: {'OrderId':OrderId,'PaymentId':PaymentId},
		success: function(response){
			$('#loader_img').hide();
			$(".order_payment_data").html(response);
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
	
})

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script>
function onClick() {
  var pdf = new jsPDF('p', 'pt', 'letter');
  pdf.canvas.height = 72 * 11;
  pdf.canvas.width = 72 * 8.5;

  pdf.fromHTML(document.body);

  pdf.save('test.pdf');
};

var element = document.getElementById("clickbind");
element.addEventListener("click", onClick);
</script>

@stop