<style>
.display_hide_cls {
	display:none;
}
</style>
<?php
	$display_hide_cls_plan = "display_hide_cls";
	$display_hide_cls_period = "display_hide_cls";
?>
<div class="form-group">
	<label>{{ trans("messages.sub_project_detail.choose_plan") }}</label>
	@if(!empty($PlanDetails))
		<div class="kt-portlet__tab_block_options">
		  @foreach($PlanDetails as $key=>$PlanDetail)
			@if(!empty($OrderPlanPrice))
				@if($OrderPlanPrice == $PlanDetail->id)
					<?php 
						$activePlanPrice = Currency." ".$PlanDetail->price;
						$activeClass = "1";
					?>
				@else
					<?php 
						$activeClass = ""; 
						$activePlanPrice = ""; 
					?>
				@endif
			@else
				@if($PlanDetail->is_primary == 1)
					<?php 
						$activePlanPrice = Currency." ".$PlanDetail->price;
						$activeClass = "1";
					?>
				@else
					<?php 
						$activeClass = ""; 
					?>
				@endif
			@endif
			<div class="kt-portlet__tab_block_options_item">
				{{ Form::radio('plan_price',$PlanDetail->id,$activeClass,['class'=>'plan_price', 'id'=>'tab_'.$key]) }}
				<label for="tab_{{$key}}" id="planPrice_{{$PlanDetail->id}}">{{Currency." ".$PlanDetail->price}}</label>
			</div>
		  @endforeach
		  @if(($plan_type == "daily" && $subProjectDetails->daily_plan_allow_other == 1) || ($plan_type == "monthly" && $subProjectDetails->monthly_plan_allow_other == 1) || ($plan_type == "yearly" && $subProjectDetails->yearly_plan_allow_other == 1))
			<?php
				if(!empty($OrderPlanOtherPrice)){
					$selectedOther = "1";
					$display_hide_cls_plan = "";
					$activePlanPrice = Currency." ".$OrderPlanOtherPrice;
				}else{
					$selectedOther = "";
					$display_hide_cls_plan = "display_hide_cls";
				}
			?>
			<div class="kt-portlet__tab_block_options_item">
				{{ Form::radio('plan_price','other',$selectedOther,['class'=>'plan_price', 'id'=>'allow_other']) }}
				<label for="allow_other">{{ trans('messages.sub_project_detail.others') }}</label>
			</div>
		  @endif
		</div>
		<div class="col-6 form-group customized_plan_cls {{$display_hide_cls_plan}}">
			<label></label>
			<div class="input-group">
				<div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
				{{ Form::text('other_plan_price', $OrderPlanOtherPrice, ['class'=>'form-control customized_plan alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans('messages.sub_project_detail.enter_customized_plan')]) }}
				<span class="help-inline"></span>
			</div>
		</div>
		<span class="form-text text-muted">* <span class="selected_plan_price">{{$activePlanPrice}}</span> {{ trans('messages.book_plan.will_deduct_from_your_account_on') }} <?php /* {{ trans('messages.sub_project_detail.it_will_deduct_from_your_account_on') }} */ ?> {{trans("messages.sub_project_detail.".$plan_type)}} {{ trans('messages.sub_project_detail.basis') }}</span>
	@else
		<span class="form-text text-muted">{{ trans('messages.sub_project_detail.no_plan_found_on') }} {{trans("messages.sub_project_detail.".$plan_type)}} {{ trans('messages.sub_project_detail.basis') }}</span>
	@endif
	
</div>

<div class="form-group"></div>


<div class="form-group">
	<?php
		if($plan_type == "daily"){
			$periodName = trans("messages.sub_project_detail.days");
		}else if($plan_type == "monthly"){
			$periodName = trans("messages.sub_project_detail.months");
		}else if($plan_type == "yearly"){
			$periodName = trans("messages.sub_project_detail.years");
		}else{
			$periodName = "";
		}
	?>
	<label>{{ trans("messages.sub_project_detail.choose_period") }}</label>
	@if(!empty($PeriodDetails))
	<div class="kt-radio-inline">
	  @foreach($PeriodDetails as $key=>$PeriodDetail)
		@if($OrderPlanPeriod == $PeriodDetail->id)
			<?php 
				$activePeriod = "1";
			?>
		@else
			@if($PeriodDetail->is_primary == 1)
				<?php 
					$activePeriod = "1";
				?>
			@else
				<?php 
					$activePeriod = ""; 
				?>
			@endif
		@endif
		<label class="kt-radio" for="time_period_{{$key}}">
			{{ Form::radio('time_period',$PeriodDetail->id,$activePeriod,['class'=>'time_period', 'id'=>'time_period_'.$key]) }} {{ $PeriodDetail->quantity.' '.$periodName }}
			<span></span>
		</label>
	  @endforeach
	  @if(($plan_type == "daily" && $subProjectDetails->daily_period_allow_other == 1) || ($plan_type == "monthly" && $subProjectDetails->monthly_period_allow_other == 1) || ($plan_type == "yearly" && $subProjectDetails->yearly_period_allow_other == 1))
		<?php 
			if(!empty($OrderPlanOtherPeriod)){
				$selectedOtherPeriod = "1";
				$display_hide_cls_period = "";
			}else{
				$selectedOtherPeriod = "";
				$display_hide_cls_period = "display_hide_cls";
			}
		?>
		<label class="kt-radio" for="time_period_other">
			{{ Form::radio('time_period','other',$selectedOtherPeriod,['class'=>'time_period', 'id'=>'time_period_other']) }} {{ trans("messages.sub_project_detail.others")}}
			<span></span>
		</label>
	  @endif
		
	</div>
	<div class="col-6 form-group customized_period_cls {{$display_hide_cls_period}}">
		<label></label>
		<div class="input-group">
			{{ Form::text('other_time_period', $OrderPlanOtherPeriod, ['class'=>'form-control customized_time alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.book_plan.enter_customized_period")]) }}
			<span class="help-inline"></span>
		</div>
	</div>
	@else
		<span class="form-text text-muted">No Period Found On {{ ucfirst(trans("messages.sub_project_detail.".$plan_type)) }} {{ trans('messages.sub_project_detail.basis') }}</span>
	@endif
</div>

<script>

jQuery('.alphabetRestriction').keypress(function (event) { 
   return event.keyCode < 32 || (event.keyCode >= 48 && event.keyCode <= 57);
});
</script>