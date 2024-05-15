@extends('front.layouts.default')
@section('content')

<?php $imageTumbUrl = WEBSITE_URL.'image.php?height=300&width=300&cropratio=1:1&image='; ?>

<style>
.project_heading_blk {
    font-size: 26px;
    font-weight: bold;
    margin: 0px 0px 24px 24px;
    border-bottom: 4px solid #646c9a;
    display: inline-block;
}
.blk_btn_holder {
    display: flex;
}
a.kt-nav__link {
    margin-right: 4px;
}
</style>

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	
	<div id="project_cms_slider" class="owl-carousel owl-theme">
		 @if(!empty($sliderImages))
		  @foreach($sliderImages as $sliderImage)
			@if(!empty($sliderImage->image) && File::exists(CMS_IMG_ROOT_PATH . $sliderImage->image))
			  <div class="item"> 
				<div class="campaign_project_img" style="background: url('{{CMS_IMG_URL . $sliderImage->image}}');"></div>
			  </div>
			@endif
		  @endforeach
		<?php /* @else
			<div class="item"> 
				<div class="campaign_project_img" style="background: url('{{WEBSITE_IMG_URL}}bg/frontend-bg.jpg');"></div>
			</div> */ ?>
		 @endif
	</div>
	
	<?php /* <img src='{{WEBSITE_IMG_URL}}bg/frontend-bg.jpg'  /><br></br> */ ?>
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet" style="-webkit-box-shadow:none; box-shadow:none;">
				<div class="kt-portlet__body kt-portlet__body--fit">
					
					@if(!empty($cmsPageDetails))
						<div class="kt-widget kt-widget--project-1" style="">
						{{ $cmsPageDetails->body }}
						</div>
					@endif
					<?php /* <div class="kt-widget kt-widget--project-1" style="padding: 100px;">
						<div class="kt-widget__body">
							
						</div>
						<div class="row" style="text-align: center; margin: auto; font-size: 26px;font-weight: bold; ">ANSAR</div><p></p>
						<div class="row" style="text-align: center; margin: auto; font-size: 20px;">Donate Regularly</div><p></p>
						<br>
						<hr style="text-align: center; margin: auto; width: 40%; height: 3px; border: 0; background: #9ad260; "><br>
						<div class="row" style='text-align: center; margin: auto; font-size: 16px;' ><p></p>Ansar adalah satu usaha Hidayah Centre Foundation(HCF)<br>untuk mengajak orang ramai menyumbang desgn mudan serendah RMI sehari.Dengan  Ansar  anda dapat bersama sama dalam usaha menyampaikan mesej lslam yang sebenar kepada orang ramai.  Ansar juga bertujuan membantu golongan saudara baru yang baru berhijrah kembail kepada agama lslam sebagai jalan hidup mereka.<p></p><br /><br />Nama Ansar dipilih khusus mengambil semangat golongan  Ansar di Madinah <br />yang membantu golon  Muhajirin  dari Mekah dalam peristiwa Hijrah. Semoga dengan Ansar, sumbangan yang sedikit tetapi berterusan mampu memberrikan kwaN yang signifiken dalam menyokong usaha murni HCF damam melaksanakan kweajipan memperluasaskan penyampaian mesej islam kepata maysaarakat dan elhirkan saudara baru sebagal muslim contoh.<br><br><i style="text-align: center;margin: auto;"><p><br></p>"The most beloved deed to Alah is the most regular and constant even if it were little"*Hodith Narrated by Bukkari</i></div><p></p>
						<hr style="text-align: center; margin: auto; width: 80%; height: 1px; border: 0; background: #9ad260;"><br><br><p></p>
						<div class="row" style="text-align: center; margin: auto;font-size: 16px;">Bantuan Golongan Saudara Baru</div><br><p></p>
						<div class="row" style="text-align: center; margin: auto;">
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-kaaba"></i></div>
								<div class="row" style="margin: auto;font-size: 16px;">Pendidikan<br>Mualaf</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-shopping-basket"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Kebajikan<br>Mualaf</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-calendar"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Aktiviti<br>Dakwah</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-suitcase"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Latihan<br>Dakwah</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-home"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Pusat<br>Komuniti</div>
							</div>
						</div>
						<br>
					</div>
					*/ ?>
					
					@if(!empty($allProjectLists))
					<div class="row" style="margin: auto; font-size: 26px; font-weight: bold;">{{ trans('messages.cms_page_details.projects') }}<p></p></div><p><br><br></p>
					<br>
					  @if($cmsPageDetails->sub_project_row == 5)
						<?php 
							$columnCount = "3";
							$body_main_class = "-4";
							$styleDisplay = "display:block;";
						?>
					  @elseif($cmsPageDetails->sub_project_row == 4)
						<?php 
							$columnCount = "4";
							$body_main_class = "-4";
							$styleDisplay = "display:block;";
						?>
					  @elseif($cmsPageDetails->sub_project_row == 3)
						<?php 
							$columnCount = "6";
							$body_main_class = "-2";
							$styleDisplay = "display:block;";
						?>
					  @else
						 <?php 
							$columnCount = "12";
							$body_main_class = "";
							$styleDisplay = "display:inline-block;";
						?> 
					  @endif
					  
						<div class="kt-widget kt-widget--project-1">
						 <div class="row">
						  @foreach($allProjectLists as $key=>$allProjectList)
						   @if($cmsPageDetails->arrangement == 2)
							   @if($key == 0)
								<?php $currentProject = $allProjectList->project_id; ?>
								<div class="col-lg-12"><div class="project_heading_blk">{{ $allProjectList->project_name }}</div></div><p><br><br></p>
							   @endif	
							   @if($allProjectList->project_id != $currentProject)
								<div class="col-lg-12"><div class="project_heading_blk">{{ $allProjectList->project_name }}</div></div><p><br><br></p>
								<?php $currentProject = $allProjectList->project_id; ?>
							   @endif
						   @endif
						   <div class="col-lg-{{$columnCount}}">
							<div class="kt-widget__body project_main_blk{{$body_main_class}}" style="{{$styleDisplay}}">
								<?php
									if(!empty($allProjectList->project_image) && File::exists(TEMPLATE_IMG_ROOT_PATH . $allProjectList->project_image)){
										$projectImage = $imageTumbUrl . TEMPLATE_IMG_URL . $allProjectList->project_image;
									}else{
										$projectImage = WEBSITE_IMG_URL . "admin/no_image.jpg";
									}
								?>
								<a href="{{route('Globaluser.sub_project_detail',$allProjectList->slug)}}"><div class="project_img_blk" style="background: url('{{ $projectImage }}'); background-size: 100%; padding:10px;"></div></a>
								<div class="project_content_blk">
									<div class="row">
										<div class="col">
											<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5">
												<a href="{{route('Globaluser.sub_project_detail',$allProjectList->slug)}}">{{ $allProjectList->sub_project_name }}</a>
											</span>
										</div>
									</div>
									<div class="kt-widget__container kt-widget__stats kt-margin-t-20">
										<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
											<span class="kt-widget__date kt-padding-0 kt-margin-r-10">
												{{ trans('messages.cms_page_details.start') }}
											</span>
											<div class="kt-widget__label">
												<span class="btn btn-label-brand btn-sm btn-bold btn-upper">
													{{ date("d M, y",strtotime($allProjectList->campaign_start_date)) }}
												</span>
											</div>
										</div>
										<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
											<span class="kt-widget__date kt-padding-0 kt-margin-r-10">
												{{ trans('messages.cms_page_details.due') }}
											</span>
											<div class="kt-widget__label">
												<span class="btn btn-label-danger btn-sm btn-bold btn-upper">
													{{ date("d M, y",strtotime($allProjectList->campaign_end_date)) }}
												</span>
											</div>
										</div>
									</div>
									
									@if($allProjectList->client_view == 1)
										<div class="kt-widget__container">
											<span class="kt-widget__subtitel">{{ trans('messages.cms_page_details.progress') }}</span>
											<div class="kt-widget__progress d-flex align-items-center flex-fill">
												<div class="progress" style="height: 5px;width: 100%;">
													<div class="progress-bar kt-bg-success" role="progressbar" style="width: {{$allProjectList->progressAvg}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
												<span class="kt-widget__stat">
													{{$allProjectList->progressAvg}}%
												</span>
											</div>
										</div>
										<div class="kt-widget__container">
											{{ trans('messages.cms_page_details.raised') }} : <span> &nbsp;{{Currency ." ". $allProjectList->totalRaised}} </span> &nbsp; &nbsp; &nbsp; {{ trans('messages.cms_page_details.goal') }} : <span> &nbsp;{{Currency ." ". $allProjectList->target_amount}}</span>
										</div>
									@endif
									
									<div class="blk_btn_holder">
									  @if($allProjectList->plan_show_status != 1)
									   @if($allProjectList->donation_btn_type != 'default' && !empty($allProjectList->donation_btn_url))
										<a href="{{$allProjectList->donation_btn_url}}" class="kt-nav__link">
											<button class="btn btn-label-success" style="float: left;">{{ trans('messages.cms_page_details.donate_now') }} </button>&nbsp;
										</a>
									   @else
										<a href="javascript:;" onclick="openBookingModal('{{$allProjectList->slug}}')" class="kt-nav__link">
											<button class="btn btn-label-success" style="float: left;">{{ trans('messages.cms_page_details.donate_now') }} </button>&nbsp;
										</a>
									   @endif
									  @endif
										<a href="{{route('Globaluser.sub_project_detail',$allProjectList->slug)}}" class="kt-nav__link">
											<button class="btn btn-label-primary" style="float: left;">{{ trans('messages.cms_page_details.read_more') }} </button>
										</a>
									</div>
									
								</div>
							   <div class="clearfix"></div>
							</div>
						   </div>
						  @endforeach
						 </div>
						</div>
					@endif
					
					@if(!empty($cmsPageDetails))
						<div class="kt-widget kt-widget--project-1" style="">
						{{ $cmsPageDetails->footer_body }}
						</div>
					@endif
					
					<?php /* <div class="kt-widget kt-widget--project-1" style="padding: 100px;">
						<div class="kt-widget__body" style="margin: auto; text-align: center;">
							<span style="color: #b3df99; font-size: 26px;">Cara Sumbangan</span> <span style="font-size: 26px;">Alternatif</span><br><br>
							<span style="font-size: 20px;">salurkan terus ke akaun bank:</span><br><br>
							<span style="font-size: 26px; color: #97f161; font-weight: bold;">The trustees of <br/>Hidayah Centre Foundation Registered</span><br>
							<br>
							<div>
								<ul style="list-style: none; font-size: 20px;">
									<li><span><strong>Maybank islamic</strong></span> : 5622 0962 4421</li>
									<li><span><strong>Bank islam</strong></span> : 1211 3010 3494 33</li>
									<li><span><strong>Bank Rakyat</strong></span> : 1104 6100 0356</li>
								</ul>
							</div>
							<br>
						</div>
					</div> */ ?>
					
					@if(!empty($cmsPageDetails) && ($cmsPageDetails->contactus_status == 1))
						<div class="kt-widget kt-widget--project-1" style="">
						  {{ Form::open(['role' => 'form','url' => "/",'files'=>'true', 'class' => 'kt-form','id'=>"contactusForm"]) }}
							<div class="kt-widget__body" style="">
								<span style="color: #b3df99;font-size: 26px;text-align: center;display: block;">{{ trans('messages.cms_page_details.contact_us') }}</span><br><br>
								<div class="row">
									<div class="col-lg-7">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;"  >{{ trans('messages.cms_page_details.name') }}</label>
											<div class="col-sm-9">
												{{ Form::text('name', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_name')]) }}
												<span class="help-inline"></span>
											</div>
										</div>
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;">{{ trans('messages.cms_page_details.email') }}</label>
											<div class="col-sm-9">
												{{ Form::text('email', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_email')]) }}
												<span class="help-inline"></span>
											</div>
										</div>
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label" style="font-size: 16px;">{{ trans('messages.cms_page_details.message') }}</label>
											<div class="col-sm-9">
												{{ Form::textarea('message', '', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_page_details.enter_message'), 'rows'=>'3']) }}
												<span class="help-inline message_error"></span>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-3"></div>
											<div class="col-sm-9">
												<button type="button" onclick="saveContactUsForm()" class="btn btn-success btn-block">{{ trans('messages.cms_page_details.submit') }}</button>
											</div>
										</div>
									</div>
									<div class="col-lg-5" style="font-size: 16px;text-align: center;" align="left">
										{{Config::get("Settings.business_name")}}<br>
										{{Config::get("Settings.business_address")}}<br>
										P : {{Config::get("Settings.business_contact")}}<br><br>
										{{ trans('messages.cms_page_details.email') }} : {{Config::get("Settings.business_email")}}<br><br>
										{{ trans('messages.cms_page_details.website') }} : {{Config::get("Settings.business_url")}}
									</div>
								</div>
							</div>
						  {{ Form::close() }}
						</div>
					@endif
					
				</div>
			</div>
		</div>
		

		<!-- end:: Content -->
	</div>
</div>


<script>
function saveContactUsForm(){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#contactusForm')[0];
	
	$.ajax({
		url: '{{ URL("/contact") }}',
		type:'POST',
		data: $('#contactusForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				//location.reload();
				$("#contactusForm")[0].reset()
				swal.fire({
					"title": "Thank You",
					"text": "We got your contactus query. Our exicutive answer you soon.",
					"type": "success",
					"confirmButtonClass": "btn btn-secondary"
				});
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "message"){
						$(".message_error").addClass('error');
						$(".message_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
				});
			}
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
}

</script>


<script type="text/javascript"> 
$(document).ready(function() {	
	$("#project_cms_slider").owlCarousel({
				
		items:1,

		itemsDesktop:[1000,1],

		itemsDesktopSmall:[979,1],

		itemsTablet:[768,1],

		pagination:false,

		navigation:false,

		navigationText:["",""],

		slideSpeed:1000,

		autoPlay:true,
		stopOnHover:true,
	}); 
});	

</script>


@stop