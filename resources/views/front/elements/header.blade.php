<?php
	$segment2	=	Request::segment(1);
	$segment3	=	Request::segment(2); 
	$segment4	=	Request::segment(3); 
	$segment5	=	Request::segment(4); 
	$class 		=	''; 

	$headerMenuArray = CustomHelper::getHeaderMenus();
	$headerHomeMenu = CustomHelper::getHeaderHomeMenus();

	//pr($headerMenuArray); die;
?>

<style>
.kt-menu__link:hover {
    background: rgba(78, 74, 74, 0.1) !important;
}
.kt-header.front-header {
    background-color: #fff;
}
.front-user-cls {
    color: #959cb6 !important;
}
</style>

<?php
	if(empty(Auth::user())){
		$front_header	=	"front-header";
		$front_user		=	"front-user-cls";
	}else if(!empty(Auth::user()) && Auth::user()->user_role_id == 3){
		$front_header	=	"front-header";
		$front_user		=	"front-user-cls";
	}else{
		$front_header	=	"";
		$front_user		=	"";
	}
?>

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed ">
	<div class="kt-header-mobile__logo">
		<a href="{{WEBSITE_URL}}">
			<?php
					if(!empty(Config::get("Settings.logo")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.logo"))){
					$logo = SYSTEM_IMAGE_URL . Config::get("Settings.logo");
				}else{
					$logo = WEBSITE_IMG_URL . "logo.png";
				}
			?>
			<img alt="Logo" src="{{$logo}}" />
		</a>
	</div>
	<div class="kt-header-mobile__toolbar">
		<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
		<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
	</div>
</div>
<!-- end:: Header Mobile -->


<!-- begin:: Header -->
<div id="kt_header" class="kt-header {{$front_header}} kt-header--fixed " data-ktheader-minimize="on">
	<div class="kt-container ">

		<!-- begin:: Brand -->
		<div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
			<a class="kt-header__brand-logo" href="{{WEBSITE_URL}}">
				<?php
					if(!empty(Config::get("Settings.logo")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.logo"))){
						$logo = SYSTEM_IMAGE_URL . Config::get("Settings.logo");
						$logo_backend = SYSTEM_IMAGE_URL . Config::get("Settings.logo_backend");
					}else{
						$logo = WEBSITE_IMG_URL . "logo.png";
						$logo_backend = WEBSITE_IMG_URL . "logo.png";
					}
				?>
				@if(!empty(Auth::user()) && (Auth::user()->user_role_id == 1))
					<img alt="Logo" src="<?php echo $logo_backend; ?>" class="kt-header__brand-logo-default" width="100px" />
				@else
					<img alt="Logo" src="<?php echo $logo; ?>" class="kt-header__brand-logo-default" width="100px" />
				@endif
				<img alt="Logo" src="<?php echo $logo; ?>" class="kt-header__brand-logo-sticky" />
			</a>
		</div>
		<!-- end:: Brand -->

		<!-- begin: Header Menu -->
		<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
		<div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
			<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
				<ul class="kt-menu__nav ">
				 @if(!empty(Auth::user()) && Auth::user()->user_role_id == 1) 
				  <?php /* @if(!empty(Auth::user()) && Auth::user()->user_role_id == 1)
					<li class="kt-menu__item kt-menu__item--{{($segment2 == 'home') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/home')}}" class="kt-menu__link"><span class="kt-menu__link-text">{{ trans("Home") }}</span></a></li>
					
					<li class="kt-menu__item kt-menu__item--{{($segment2 == 'dashboard' || $segment2 == 'personal-information' || $segment2 == 'change-password') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/dashboard')}}" class="kt-menu__link"><span class="kt-menu__link-text">{{ trans("messages.header.dashboard") }}</span></a></li>
				  @else */ ?>
					<li class="kt-menu__item kt-menu__item--{{($segment2 == 'home') ? '':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="https://hidayahcentre.org.my/" class="kt-menu__link"><span class="kt-menu__link-text">{{ trans("messages.header.home") }}</span></a></li>
					
					@if(!empty($viewDashboardValGlobal))
					 <li class="kt-menu__item kt-menu__item--{{($segment2 == 'admin-dashboard') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/admin-dashboard')}}" class="kt-menu__link"><span class="kt-menu__link-text">{{ trans("messages.header.dashboard") }}</span></a></li>
					@endif
					
					@if(!empty($headerMenuArray))
						@foreach($headerMenuArray as $headerMenuMain)
							@if(count($headerMenuMain->Projects) == 0)
								<li class="kt-menu__item kt-menu__item--{{($segment2 == $headerMenuMain->slug) || ($segment2 == 'project-template') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/project-template')}}" class="kt-menu__link"><span class="kt-menu__link-text">{{ $headerMenuMain->name }}</span></a></li>
							@else
							 @if(($headerMenuMain->id == 1 && !empty($viewAnsarValGlobal)) || ($headerMenuMain->id == 2 && !empty($viewSpecialProjectValGlobal)) || ($headerMenuMain->id == 3 && !empty($viewDanaProjectValGlobal)))	
								<li class="kt-menu__item kt-menu__item--{{($segment2 == $headerMenuMain->slug || $headerMenuMain->activeMainAction == 1) ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{URL('/project-template')}}" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{ $headerMenuMain->name }}</span></a>
									<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
										<ul class="kt-menu__subnav">
											@if(!empty($headerMenuMain->Projects))
											  @foreach($headerMenuMain->Projects as $ProjectMenu) <?php //pr($ProjectMenu); ?>
											   @if(count($ProjectMenu->SubProjects) == 0)
												<li class="kt-menu__item kt-menu__item--{{($segment2 == $ProjectMenu->slug || $segment3 == $ProjectMenu->slug || $ProjectMenu->activeAction == 1) ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/project-template')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ $ProjectMenu->name }}</span></a></li>
											   @elseif(count($ProjectMenu->SubProjects) == 1)
												<li class="kt-menu__item kt-menu__item--{{($segment3 == $ProjectMenu->SubProjects['0']->slug) ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/infaq/'.$ProjectMenu->SubProjects['0']->slug)}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ $ProjectMenu->name }}</span></a></li>
											   @else
												
												<li class="kt-menu__item kt-menu__item--{{($segment2 == $ProjectMenu->slug || $segment3 == $ProjectMenu->slug || $ProjectMenu->activeAction == 1) ? 'active':'';}} kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{URL('/infaq/'.$ProjectMenu->slug)}}" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ $ProjectMenu->name }}</span></a>
													<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
														<ul class="kt-menu__subnav">
														  @if(!empty($ProjectMenu->SubProjects))
															@foreach($ProjectMenu->SubProjects as $SubProjectMenu)
															   <li class="kt-menu__item kt-menu__item--{{($segment3 == $SubProjectMenu->slug) ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/infaq/'.$SubProjectMenu->slug)}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ $SubProjectMenu->sub_project_name }}</span></a></li>
															@endforeach
														  @endif
															
														</ul>
													</div>
												</li>
												
											   @endif
											
											  @endforeach
											 
											@endif
											
										</ul>
									</div>
								</li>
							  @endif
							@endif
							
						@endforeach
					
					@endif
					
					@if(!empty($viewTemplateValGlobal))
					 <li class="kt-menu__item kt-menu__item--{{($segment2 == 'project-template') || ($segment2 == 'project-add') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/project-template')}}" class="kt-menu__link"><span class="kt-menu__link-text">{{ trans("messages.header.project_template") }}</span></a></li>
					@endif
					
					@if(!empty($viewgeneralValGlobal))
					 <li class="kt-menu__item kt-menu__item--{{($segment2 == 'general-setting') || ($segment2 == 'pdf-template') || ($segment2 == 'email-template') || ($segment2 == 'sms-template') || ($segment2 == 'cms-pages') || ($segment2 == 'general-translation') || ($segment2 == 'language-settings') || ($segment2 == 'email-manager') || ($segment2 == 'pdf-manager') || ($segment2 == 'sms-manager') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{ trans("messages.header.general") }}</span></a>
						<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
							<ul class="kt-menu__subnav">
								<li class="kt-menu__item  kt-menu__item--{{($segment2 == 'general-setting') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/general-setting')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.setting") }}</span></a></li>
								<!--<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:void(0);" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Payment Getaways</span></a></li>
								<li class="kt-menu__item  kt-menu__item--{{($segment2 == 'pdf-manager') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/pdf-manager')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("PDF Template") }}</span></a></li>-->
								<li class="kt-menu__item  kt-menu__item--{{($segment2 == 'email-manager') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/email-manager')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.email_template") }}</span></a></li>
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'sms-manager') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/sms-manager')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.sms_template") }}</span></a></li>
								<!--<li class="kt-menu__item " aria-haspopup="true"><a href="javascript:void(0);" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Email Template</span></a></li>-->
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'language-settings') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/language-settings')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.translation") }}</span></a></li>
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'cms-pages') ? 'active':'';}}" aria-haspopup="true"><a href="{{route('user.general_cms_pages')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.cms_page") }}</span></a></li>

							</ul>
						</div>
					 </li>
					@endif
					
					@if(!empty($viewaccountValGlobal))
					 <li class="kt-menu__item kt-menu__item--{{($segment2 == 'account-admin') || ($segment2 == 'account-vendors') || ($segment2 == 'account-contributor') ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{ trans("messages.header.accounts") }}</span></a>
						<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
							<ul class="kt-menu__subnav">
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'account-admin') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/account-admin')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.admin") }}</span></a></li>
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'account-vendors') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/account-vendors')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.vendors") }}</span></a></li>
								<li class="kt-menu__item kt-menu__item--{{($segment2 == 'account-contributor') ? 'active':'';}}" aria-haspopup="true"><a href="{{URL('/account-contributor')}}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ trans("messages.header.contributors") }}</span></a></li>
							</ul>
						</div>
					 </li>
					@endif
					
					
				 @else
					
					@if(!empty($headerHomeMenu))
						<li class="kt-menu__item kt-menu__item--{{($segment2 == '/projects' || $segment3 == $headerHomeMenu->slug) ? '':'';}} kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="https://hidayahcentre.org.my/" class="kt-menu__link "><span class="kt-menu__link-text" style="color : #6c7293">{{ trans("messages.header.home") }}</span></a></li>
					@else
						<li class="kt-menu__item kt-menu__item--{{($segment2 == '/') ? '':'';}} kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="https://hidayahcentre.org.my/" class="kt-menu__link "><span class="kt-menu__link-text" style="color : #6c7293">{{ trans("messages.header.home") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a></li>	
					@endif
					
					@if(!empty(Auth::user()))
						<li class="kt-menu__item kt-menu__item--{{($segment2 == 'dashboard' || $segment2 == 'personal-information' || $segment2 == 'change-password') ? 'open':'';}} kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="{{URL('/dashboard')}}" class="kt-menu__link"><span class="kt-menu__link-text" style="color : #6c7293">
						{{ trans("messages.header.dashboard") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a></li>
					@else
					  @if($segment2 == 'invoice' || $segment3 == 'invoice')
						<li class="kt-menu__item kt-menu__item--{{($segment2 == 'dashboard' || $segment2 == 'personal-information' || $segment2 == 'change-password') ? 'open':'';}} kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:void();" class="kt-menu__link openSignupModel"><span class="kt-menu__link-text" style="color : #6c7293">
						{{ trans("messages.header.dashboard") }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a></li>
					  @endif
					@endif
					
					@if(!empty($headerMenuArray))
					  @foreach($headerMenuArray as $headerMenuMain)
						<li class="kt-menu__item kt-menu__item--{{($segment2 == '/projects' || $segment3 == $headerMenuMain->slug) ? 'open':'';}} kt-menu__item--submenu kt-menu__item--rel"><a href="{{URL('/projects/'.$headerMenuMain->slug)}}" class="kt-menu__link"><span class="kt-menu__link-text" style="color : #6c7293">{{ $headerMenuMain->page_name }}</span></a></li>
					  @endforeach
					@endif
					
					
				 @endif

				</ul>
			</div>
		</div>

		<!-- end: Header Menu -->

		<!-- begin:: Header Topbar -->
		
		<div class="kt-header__topbar kt-grid__item">

			

			<!--begin: User bar -->
			@if(!empty(Auth::user()))
			
			<div class="kt-header__topbar-item kt-header__topbar-item--user">
				<div class="kt-header__topbar-item kt-header__topbar-item--langs">
					<?php
						if (Session::has('applocale')) {	

							$select_lang		=		Session::get('applocale');	

						}else{						

							$select_lang		=		Config::get('app.fallback_locale');	

						}
					?>
					<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
						<span class="kt-header__topbar-icon">
							
							@if($select_lang == "en")

								<img class="" src="<?php echo WEBSITE_IMG_URL ?>flags/226-united-states.svg" alt="" />

							@elseif ($select_lang == "ms")

								<img class="" src="<?php echo WEBSITE_IMG_URL ?>flags/118-malasya.svg" alt="" />

							@endif

						</span>
					</div>
					
					<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
						
						<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
							<li class="kt-nav__item kt-nav__item--{{($select_lang == 'en')? 'active':''}}">
								<a href="{{URL::to('change-language-settings/'.'en')}}" class="kt-nav__link">
									<span class="kt-nav__link-icon"><img src="<?php echo WEBSITE_IMG_URL ?>flags/226-united-states.svg" alt="" /></span>
									<span class="kt-nav__link-text">{{ trans("English") }}</span>
								</a>
							</li>
							<li class="kt-nav__item kt-nav__item--{{($select_lang == 'ms')? 'active':''}}">
								<a href="{{URL::to('change-language-settings/'.'ms')}}" class="kt-nav__link">
									<span class="kt-nav__link-icon"><img src="<?php echo WEBSITE_IMG_URL ?>flags/118-malasya.svg" alt="" /></span>
									<span class="kt-nav__link-text">{{ trans("Malay") }}</span>
								</a>
							</li>
						</ul>
					</div>
					
				</div>
				
			</div>
			<div class="kt-header__topbar-item kt-header__topbar-item--user">
				
				<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
					<span class="kt-header__topbar-welcome {{$front_user}}">{{ trans("messages.header.hi") }},</span>
					<span class="kt-header__topbar-username {{$front_user}}">{{Auth::user()->full_name}}</span>
					<span class="kt-header__topbar-icon {{$front_user}}"><b class="{{$front_user}}">
						<?php 
							echo ucfirst(substr(Auth::user()->full_name,0,1));
							$nameArray = explode(" ",Auth::user()->full_name);
							if(!empty($nameArray)){
								if(!empty($nameArray['1'])){
									echo ucfirst(substr($nameArray['1'],0,1));
								}
							}
						?>
					</b></span>
					<img alt="Pic" src="<?php echo WEBSITE_IMG_URL ?>users/300_21.jpg" class="kt-hidden" />
				</div>
				<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

					<!--begin: Head -->
					<div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(<?php echo WEBSITE_IMG_URL ?>misc/bg-1.jpg)">
						<div class="kt-user-card__avatar">
							<img class="kt-hidden" alt="Pic" src="<?php echo WEBSITE_IMG_URL ?>users/300_25.jpg" />

							<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
							<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">
							<?php 
								echo ucfirst(substr(Auth::user()->full_name,0,1));
								$nameArray = explode(" ",Auth::user()->full_name);
								if(!empty($nameArray)){
									if(!empty($nameArray['1'])){
										echo ucfirst(substr($nameArray['1'],0,1));
									}
								}
							?>
							</span>
						</div>
						<div class="kt-user-card__name">
							{{Auth::user()->full_name}}
						</div>
					</div>

					<!--end: Head -->

					<!--begin: Navigation -->
					<div class="kt-notification">
						<a href="{{URL('/personal-information')}}" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon2-calendar-3 kt-font-success"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title kt-font-bold">
									{{ trans("messages.header.my_profile") }} 
								</div>
								<div class="kt-notification__item-time">
									{{ trans("messages.header.account_settings_and_more") }}
								</div>
							</div>
						</a>
						<a href="{{URL('/change-password')}}" class="kt-notification__item">
							<div class="kt-notification__item-icon">
								<i class="flaticon-safe-shield-protection kt-font-success"></i>
							</div>
							<div class="kt-notification__item-details">
								<div class="kt-notification__item-title kt-font-bold">
									{{ trans("messages.header.manage_password") }}
								</div>
								<div class="kt-notification__item-time">
									{{ trans("messages.header.change_and_reset_password") }}
								</div>
							</div>
						</a>
						
						<div class="kt-notification__custom kt-space-between">
							<a href="{{URL('/logout')}}" class="btn btn-label btn-label-brand btn-sm btn-bold">{{ trans("messages.header.sign_out") }}</a>
							<!--<a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Upgrade Plan</a>-->
						</div>
					</div>

					<!--end: Navigation -->
				</div>
			</div>
			
			
			@endif
			
			<!--end: User bar -->
		</div>
		
	@if(empty(Auth::user()))
		<div class="kt-header__topbar kt-grid__item" >
			<!--begin: Language bar -->
			
			<div class="kt-header__topbar-item kt-header__topbar-item--langs">
				<?php
					if (Session::has('applocale')) {	

						$select_lang		=		Session::get('applocale');	

					}else{						

						$select_lang		=		Config::get('app.fallback_locale');	

					}
				?>
				<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
					<span class="kt-header__topbar-icon">
						
						@if($select_lang == "en")

							<img class="" src="<?php echo WEBSITE_IMG_URL ?>flags/226-united-states.svg" alt="" />

						@elseif ($select_lang == "ms")

							<img class="" src="<?php echo WEBSITE_IMG_URL ?>flags/118-malasya.svg" alt="" />

						@endif

					</span>
				</div>
				
				<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim">
					
					<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
						<li class="kt-nav__item kt-nav__item--{{($select_lang == 'en')? 'active':''}}">
							<a href="{{URL::to('change-language-settings/'.'en')}}" class="kt-nav__link">
								<span class="kt-nav__link-icon"><img src="<?php echo WEBSITE_IMG_URL ?>flags/226-united-states.svg" alt="" /></span>
								<span class="kt-nav__link-text">{{ trans("English") }}</span>
							</a>
						</li>
						<li class="kt-nav__item kt-nav__item--{{($select_lang == 'ms')? 'active':''}}">
							<a href="{{URL::to('change-language-settings/'.'ms')}}" class="kt-nav__link">
								<span class="kt-nav__link-icon"><img src="<?php echo WEBSITE_IMG_URL ?>flags/118-malasya.svg" alt="" /></span>
								<span class="kt-nav__link-text">{{ trans("Malay") }}</span>
							</a>
						</li>
					</ul>
				</div>
				
			</div>
			<style>
				.kt-header__topbar a.login_btn_tab button {
					width: max-content;
				}
			</style>
			<!--end: Language bar -->
		  
			<a href="{{URL('/login')}}" class="kt-nav__link login_btn_tab">
				<button class="btn btn-secondary"  style="margin: 5px 20px; height:40px;">{{ trans("messages.header.login") }}</button>
			</a>
			
		</div>
	  @endif
	

		<!-- end:: Header Topbar -->
	</div>
</div>

<!-- end:: Header -->

