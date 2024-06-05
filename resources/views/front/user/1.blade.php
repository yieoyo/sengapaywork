

_token: bVM7lYmCfATio7F8tRRbOm0XjrAnX5kE4Bp1vwiE
sub_project_id: 150
plan_type: monthly
plan_project: 60
plan_price: 247
plan_price: 247
other_plan_price: 
time_period: 231
other_time_period: 
full_name: john
ic_number: 
phone: 6565655656
email: john@gmail.com
postcode: 9898
payment_method: 11
refrence_id: 
receipt: (binary)
terms: 1

payment_method

<div class="dynamic_plan_option_block">
    <div class="form-group">
      <div class="kt-portlet__tab_block_options">
          <div class="kt-portlet__tab_block_options_item">
              {{ Form::radio('senang_onetime','SenangPay Fpx', ['class'=>'plan_price', 'id'=>'tab_'.$key]) }}
              <label for="tab_{{$key}}">{{Currency." ".$dailyPlanDetail->price}}</label>
          </div>
          <div class="kt-portlet__tab_block_options_item">
              {{ Form::radio('plan_price','other', ($selectedPlanPrice == 'other')?$selectedPlanPrice:'', ['class'=>'plan_price', 'id'=>'allow_other']) }}
              <label for="allow_other">{{ trans("messages.sub_project_detail.others")}}</label>
          </div>
      </div>  
      <div class="col-6 form-group customized_plan_cls" style="display:none;">
          <label></label>
          <div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">{{Currency}}</span></div>
              {{ Form::text('other_plan_price', $selectedOtherPlanPrice, ['class'=>'form-control customized_plan alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.sub_project_detail.enter_customized_plan")]) }}
              <span class="help-inline"></span>
          </div>
      </div>
      
    </div>
  
    <div class="form-group"></div>
  
  
    <div class="form-group">
      <label>{{ trans("messages.sub_project_detail.choose_period") }}</label>
      @if(!empty($dailyPeriodDetails))
      <div class="kt-radio-inline">
          <label class="kt-radio" for="time_period_{{$key}}">
              {{ Form::radio('time_period',$dailyPeriodDetail->id, $activePeriod, ['class'=>'time_period', 'id'=>'time_period_'.$key]) }} {{trans($dailyPeriodDetail->quantity.' '.ucfirst(trans("messages.sub_project_detail.".$selectedPlan)))}}
              <span></span>
          </label>
          <label class="kt-radio"for="time_period_other">
              {{ Form::radio('time_period','other','',['class'=>'time_period', 'id'=>'time_period_other']) }} {{ trans("messages.sub_project_detail.others")}}
              <span></span>
          </label>
      </div>
      <div class="col-6 form-group customized_period_cls" style="display:none;">
          <label></label>
          <div class="input-group">
              {{ Form::text('other_time_period', '', ['class'=>'form-control customized_time alphabetRestriction', 'autocomplete'=>'off', 'placeholder'=>trans("messages.book_plan.enter_customized_period")]) }}
              <span class="help-inline"></span>
          </div>
      </div>
    </div>
  </div>


  

$(document.body).on('click', '.senang_type' ,function(){
	$(".senang_type").removeAttr('checked');
	$(this).attr('checked', 'checked');
	if ($(this).is(':checked')){
		 var radioID = $(this).attr('id');
		 
		if(radioID == 'tab_onetime'){
			$(".tab_onetime").removeClass('d-none');
			$(".tab_recurring").addClass('d-none');
		} else {
			$(".tab_onetime").addClass('d-none');
			$(".tab_recurring").removeClass('d-none');
		}
	}
})

<div class="form-group form-group-marginless">
    <label>{{ trans("messages.sub_project_detail.choose_payment_option")}}:</label>
    <div class="row">
      <div class="col-sm-6">
          <label class="kt-option">
              <span class="kt-option__control">
                  <span class="kt-radio">
                      {{ Form::radio('payment_methods',0,1,['class'=>'payment_methods_change']) }}
                      <span></span>
                  </span>
              </span>
              <span class="kt-option__label">
                  <span class="kt-option__head">
                      <span class="kt-option__title">
                          SenangPay <!--(Recurring)-->
                      </span>
                      
                  </span>
                  <span class="kt-option__body">
                      senang
                  </span>
              </span>
          </label>
      </div>
      @if(!empty($paymentMethods))
          <div class="dynamic_plan_option_block">
              <div class="form-group">
                  <div class="kt-portlet__tab_block_options">
                      @foreach($paymentMethods as $paymentMethod)
                          @if($paymentMethod->id == 11)
                          <div class="kt-portlet__tab_block_options_item">
                              {{ Form::radio('senang_type','onetime', 1, ['class'=>'senang_type', 'id'=>'tab_onetime']) }}
                              <label for="tab_onetime">{{ trans("messages.sub_project_detail.ONETIME")}}</label>
                          </div>
                          @endif
                          
                          @if(in_array($paymentMethod->id, [12,13]))
                          <div class="kt-portlet__tab_block_options_item">
                              {{ Form::radio('senang_type','recurring', ['class'=>'senang_type', 'id'=>'tab_recurring']) }}
                              <label for="tab_recurring">{{ trans("messages.sub_project_detail.RECURRING")}}</label>
                          </div>
                          <?php break; ?>
                          @endif

                      @endforeach
                  
                  </div>
              
              </div>

              <div>
                  <div class="tab_onetime" >
                      senang onetime
                  </div>
                  <div class="tab_recurring d-none">
                      recuring
                  </div>
              </div>
          </div>
      @endif
    </div>
</div>