<?php
	$segment2	=	Request::segment(1);
	$segment3	=	Request::segment(2); 
	$segment4	=	Request::segment(3); 
	$segment5	=	Request::segment(4); 
	$class 		=	''; 
?>
<?php /* <ul class="nav nav-pills nav-stacked">
	<li class="{{($segment2=='about')?'active':''}}"><a href="{{route('home.about_us')}}">{{trans('messages.home.about_us')}}</a></li>
	<li class="{{($segment2=='our-guarantee')?'active':''}}"><a href="{{route('home.ourGuarantee')}}">{{trans('messages.home.our_gurantee')}}</a></li>
	<li class="{{($segment2=='our-mission')?'active':''}}"><a href="{{route('home.ourMission')}}">{{trans('messages.home.our_mission')}}</a></li>
	<li><a href="javascript:void(0);">{{trans('messages.home.blog')}}</a></li>
	<li class="{{($segment2=='follow-us')?'active':''}}"><a href="{{route('home.followUs')}}">{{trans('messages.home.follow_us')}}</a></li>
	<li class="{{($segment2=='email-alert')?'active':''}}"><a href="{{route('home.emailAlert')}}">{{trans('messages.home.email_alerts')}}</a></li>
	<li class="{{($segment2=='contact')?'active':''}}"><a href="{{URL('contact')}}">{{trans('messages.home.contact_us')}}</a></li>
</ul> */ ?>

<?php $userDetails	=	CustomHelper::getSideMenuDetails(); ?>

@if(!empty($userDetails) && ($userDetails->user_role_id == 1))
<!--begin:: Widgets/Applications/User/Profile1-->
<div class="kt-portlet kt-portlet--height-fluid-">
	<div class="kt-portlet__head  kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title">
			</h3>
		</div>
	</div>
	<div class="kt-portlet__body kt-portlet__body--fit-y">
		<!--begin::Widget -->
		<div class="kt-widget kt-widget--user-profile-1">
			<div class="kt-widget__head">
				<div class="kt-widget__media">
					<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
						<?php 
							echo ucfirst(substr($userDetails->full_name,0,1));
							$nameArray = explode(" ",$userDetails->full_name);
							if(!empty($nameArray)){
								if(!empty($nameArray['1'])){
									echo ucfirst(substr($nameArray['1'],0,1));
								}
							}
						?>
					</div>
					<!--<img src="<?php echo WEBSITE_IMG_URL; ?>users/100_13.jpg" alt="image">-->
				</div>
				<div class="kt-widget__content">
					<div class="kt-widget__section">
						<a href="#" class="kt-widget__username">
						{{$userDetails->full_name}}
							<i class="flaticon2-correct kt-font-success"></i>
						</a>
						<span class="kt-widget__subtitle">
							
						</span>
					</div>
					<!--<div class="kt-widget__action">
						<button type="button" class="btn btn-info btn-sm">chat</button>&nbsp;
						<button type="button" class="btn btn-success btn-sm">follow</button>
					</div>-->
				</div>
			</div>
			<div class="kt-widget__body">
				<div class="kt-widget__content">
					<div class="kt-widget__info">
						<span class="kt-widget__label">{{ trans('messages.cms_page_details.email') }}:</span>
						<a href="#" class="kt-widget__data">{{$userDetails->email}}</a>
					</div>
					<div class="kt-widget__info">
						<span class="kt-widget__label">{{ trans('messages.navigation.phone') }}:</span>
						<a href="#" class="kt-widget__data">{{$userDetails->phone}}</a>
					</div>
				</div>
				<div class="kt-widget__items">
					<a href="{{URL('/dashboard')}}" class="kt-widget__item kt-widget__item--{{($segment2=='dashboard')?'active':''}}">
						<span class="kt-widget__section">
							<span class="kt-widget__icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero" />
										<path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg> </span>
							<span class="kt-widget__desc">
								{{ trans('messages.navigation.profile_overview') }}
							</span>
						</span>
					</a>
					<a href="{{URL('/personal-information')}}" class="kt-widget__item kt-widget__item--{{($segment2=='personal-information')?'active':''}}">
						<span class="kt-widget__section">
							<span class="kt-widget__icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg> </span>
							<span class="kt-widget__desc">
								{{ trans('messages.navigation.personal_information') }}
							</span>
						</span>
					</a>
					<a href="{{URL('/change-password')}}" class="kt-widget__item kt-widget__item--{{($segment2=='change-password')?'active':''}}">
						<span class="kt-widget__section">
							<span class="kt-widget__icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
										<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
										<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
									</g>
								</svg> </span>
							<span class="kt-widget__desc">
								{{ trans('messages.navigation.change_password') }}
							</span>
						</span>
						<!--<span class="kt-badge kt-badge--unified-danger kt-badge--sm kt-badge--rounded kt-badge--bolder">5</span>-->
					</a>
				</div>
			</div>
		</div>

		<!--end::Widget -->
	</div>
</div>

<!--end:: Widgets/Applications/User/Profile1-->
@else

<!--Begin:: App Aside Mobile Toggle-->
<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
	<i class="la la-close"></i>
</button>

<!--End:: App Aside Mobile Toggle-->

<!--Begin:: App Aside-->
<div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">

  <div class="kt-portlet kt-portlet--height-fluid">
	<div class="kt-portlet__body">

		<!--begin::Widget -->
		<div class="kt-widget kt-widget--user-profile-4">
			<div class="kt-widget__head">
				<div class="kt-widget__media" style="margin: auto;">
					@if(!empty($userDetails->image) && File::exists(USER_PROFILE_IMAGE_ROOT_PATH . $userDetails->image))
						<img class="kt-widget__img kt-hidden-" src="{{USER_PROFILE_IMAGE_URL . $userDetails->image}}" alt="image">
					@else
						<div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light "> <!--kt-hidden-->
							<?php 
								echo ucfirst(substr($userDetails->full_name,0,1));
								$nameArray = explode(" ",$userDetails->full_name);
								if(!empty($nameArray)){
									if(!empty($nameArray['1'])){
										echo ucfirst(substr($nameArray['1'],0,1));
									}
								}
							?>
						</div>
					@endif
				</div>
				
				<div class="kt-widget__content">
					<div class="kt-widget__section">
						<a href="#" class="kt-widget__username">
							{{$userDetails->full_name}}
						</a>
						<div class="kt-widget__button">
							<span class="btn btn-label-warning btn-sm">{{ trans('messages.navigation.active') }}</span>
						</div>
					<!--<div class="kt-widget__action">
							<a href="#" class="btn btn-icon btn-circle btn-label-facebook">
								<i class="socicon-facebook"></i>
							</a>
							<a href="#" class="btn btn-icon btn-circle btn-label-twitter">
								<i class="socicon-twitter"></i>
							</a>
							<a href="#" class="btn btn-icon btn-circle btn-label-google">
								<i class="socicon-google"></i>
							</a>
						</div>-->
					</div>
				</div>
			</div>
			<div class="kt-widget__body">
				<a href="{{URL('/dashboard')}}" class="kt-widget__item {{($segment2=='dashboard')?'kt-widget__item--active':''}}">
					{{ trans('messages.navigation.dashboard') }}
				</a>
				<a href="{{URL('/personal-information')}}" class="kt-widget__item {{($segment2=='personal-information')?'kt-widget__item--active':''}}">
					{{ trans('messages.navigation.account_info') }}
				</a>
				<a href="{{URL('/change-password')}}" class="kt-widget__item {{($segment2=='change-password')?'kt-widget__item--active':''}}">
					{{ trans('messages.navigation.change_password') }}
				</a>
				
			</div>
		</div>

		<!--end::Widget -->
	</div>
  </div>

</div>
<!--End:: App Aside-->
@endif