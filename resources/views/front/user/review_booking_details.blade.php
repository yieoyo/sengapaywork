<h3 class="kt-heading kt-heading--md">Review your Details and Submit</h3>

<div class="home_detail_review_blk">
	<div class="home_detail_review_blk_hd">Package Details</div>
	<div class="home_detail_review_blk_txt">Category: Direct Flight</div>
	<div class="home_detail_review_blk_txt">Year: {{$orderDetails->year}}</div>
	<div class="home_detail_review_blk_txt">Season: {{$orderDetails->season}}</div>
	<div class="home_detail_review_blk_txt">Hotel Category: {{$orderDetails->hotel_category}}</div>
	<div class="home_detail_review_blk_txt">Flight: {{$orderDetails->flight}}</div>
	<div class="home_detail_review_blk_txt">Departure: Arrival Date: {{$orderDetails->date}}</div>
	<div class="home_detail_review_blk_txt">Hotel Makkah/Madinah: {{$orderDetails->hotel}}</div>
</div>

<hr>

<div class="home_detail_review_blk">
	<div class="home_detail_review_blk_hd">Contact Details</div>
	<div class="home_detail_review_blk_txt">{{$orderDetails->contact_name}}</div>
	<div class="home_detail_review_blk_txt">Phone: {{$orderDetails->contact_phone}}</div>
	<div class="home_detail_review_blk_txt">Email: {{$orderDetails->contact_email}}</div>
</div>

<hr>

<div class="home_detail_review_blk">
	<div class="home_detail_review_blk_hd">Your Guest Details</div>
</div>

@if(!empty($guestDetails))
  @foreach($guestDetails as $key=>$guestDetail)
	<div class="home_detail_review_blk">
		<div class="home_detail_review_blk_txt">Guest {{$key + 1}} {{($key == 0)?"(Primary)":'';}} </div>
		<div class="home_detail_review_blk_txt">Name: {{$guestDetail->name}} </div>
		<div class="home_detail_review_blk_txt">IC No: {{$guestDetail->ic_number}}</div>
		<div class="home_detail_review_blk_txt">Phone No: {{$guestDetail->phone}}</div>
		<div class="home_detail_review_blk_txt">Address: {{$guestDetail->address}}</div>
		<div class="home_detail_review_blk_txt">Email: {{$guestDetail->email}}</div>
		<div class="home_detail_review_blk_txt">Birth Date: {{date("d/m/Y",strtotime($guestDetail->dob))}}</div>
		<div class="home_detail_review_blk_txt">Birth Place: {{$guestDetail->birth_place}}</div>
		<div class="home_detail_review_blk_txt">Type of Chronic Disease: {{$guestDetail->chronic_disease}}</div>
		<div class="home_detail_review_blk_txt">Work: {{$guestDetail->work}}</div>
		<div class="home_detail_review_blk_txt">Representative Name: {{$guestDetail->representative_name}}</div>
		<div class="home_detail_review_blk_txt">Representative Phone: {{$guestDetail->representative_phone}}</div>
		<div class="home_detail_review_blk_txt">Relation: {{$guestDetail->relationship}}</div>
	</div>
	<hr>
  @endforeach
@endif

<div class="home_detail_review_blk">
 <div class="home_detail_review_blk_hd">Price Details</div>
 <?php $deposite = "0"; ?>
 @if(!empty($guestDetails))
  @foreach($guestDetails as $key=>$guestDetail)
	<?php $deposite += $guestDetail->min_deposite; ?>
	<div class="home_detail_review_blk_txt">{{$guestDetail->room_name}} - {{ucfirst($guestDetail->type)}} (RM): {{$guestDetail->price}} </div>
  @endforeach
 @endif
	<div class="home_detail_review_blk_txt">Total Price (RM): {{$orderDetails->total_price}}</div>
	<div class="home_detail_review_blk_txt">Deposit (RM): {{$deposite}}</div>
</div>
