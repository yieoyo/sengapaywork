<!DOCTYPE html>
<html>
	<head>
		<title>{{{Config::get("Site.title")}}}</title>
		{{ HTML::script('js/admin/jquery.min.js') }}
		{{ HTML::style('css/admin/bootstrap.min.css') }}
		{{ HTML::style('css/admin/font-awesome.min.css') }}
		{{ HTML::style('css/admin/ionicons.min.css') }}
		{{ HTML::style('css/admin/morris/morris.css') }}
		{{ HTML::style('css/admin/jvectormap/jquery-jvectormap-1.2.2.css') }}
		{{ HTML::style('css/admin/daterangepicker/daterangepicker-bs3.css') }}
		{{ HTML::style('css/admin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}
		{{ HTML::style('css/admin/themify-icons.css') }}
		{{ HTML::style('css/admin/AdminLTE.css') }}
		{{ HTML::style('css/admin/custom_admin.css') }}
		{{ HTML::style('css/admin/bootmodel.css') }}
		{{ HTML::script('css/admin/notification/jquery.toastmessage.js') }}
		{{ HTML::style('css/admin/notification/jquery.toastmessage.css') }}
		{{ HTML::script('js/admin/vendors/match-height/jquery.equalheights.js') }}
	</head>
	<body class="skin-black">
		<header class="header"> <a href="{{URL::to('admin/dashboard')}}" class="logo"> 
		  <!-- Add the class icon to your logo image or logo icon to add the margining --> 
			{{{Config::get("Site.title")}}}
		  </a> 
		  <!-- Header Navbar: style can be found in header.less -->
		  <nav class="navbar navbar-static-top" role="navigation"> 
			<!-- Sidebar toggle button--> 
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
			<div class="navbar-right">
			  <ul class="nav navbar-nav">
				<li class="dropdown user user-menu"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span>{{{ Auth::user()->email}}} <i class="caret"></i></span> </a>
				  <ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header bg-light-blue"> 
						{{ HTML::image('img/admin/logo.png','Admin Image',array("class"=>"img-circle")) }}						
					</li>
				   
					<!-- Menu Footer-->
					<li class="user-footer">
					  <div class="pull-left"><a class="btn btn-default btn-flat" href="{{URL::to('admin/myaccount')}}">{{ trans("messages.dashboard.edit_profile") }} </a> </div>
					  <div class="pull-right"> <a class="btn btn-default btn-flat" href="{{URL::to('admin/logout')}}">{{ trans("messages.dashboard.logout") }} </a></div>
					</li>
				  </ul>
				</li>
			  </ul>
			</div>
		  </nav>
		</header>
		
		<!-- Start Main Wrapper -->
		<div class="wrapper row-offcanvas row-offcanvas-left">
			<?php 
				$segment2	=	Request::segment(1);
				$segment3	=	Request::segment(2); 
				$segment4	=	Request::segment(3); 
				$segment5	=	Request::segment(4); 
				
			?>
			<aside class="left-side sidebar-offcanvas"> 
				<section class="sidebar"> 
					<ul class='sidebar-menu'>
						<li class="{{ ($segment3 == 'dashboard') ? 'active' : '' }} "><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-home  {{ ($segment3 == 'dashboard') ? '' : '' }}"></i>{{ trans("messages.system_management.dashboard") }} </a></li>
						
						<li class="{{ ($segment3 == 'users') ? 'active' : '' }}">
							<a href="{{URL::to('admin/users')}}"><i class="fa fa-users"></i>{{ trans("Users Management") }} </a>
						</li>
						
						<?php /* <li class="{{ ($segment3 == 'track-records') ? 'active' : '' }} "><a href="{{URL::to('admin/track-records')}}"><i class="fa fa-plus-square-o  {{ ($segment3 == 'track-records') ? '' : '' }}"></i>{{ trans("Track Records") }} </a></li>
						
						<li class="{{ ($segment3 == 'contact-manager') ? 'active' : '' }} "><a href="{{URL::to('admin/contact-manager')}}"><i class="fa fa-plus-square-o  {{ ($segment3 == 'contact-manager') ? '' : '' }}"></i>{{ trans("Contact Manager") }} </a></li> */ ?>
						
						<li class="treeview {{ in_array($segment3 ,array('gift-faqs-manager','result-faq','cms-manager','no-cms-manager','email-manager','email-logs','block-manager','faqs-manager','system-doc-manager','testimonial-manager','how-it-work-manager','news-letter','video-demo-manager','video-demo-manager','how-it-work-manager','product-faq')) ? 'active in' : 'offer-reports' }}">
							<a href="javascript::void(0)"><i class="fa fa-desktop  {{ in_array($segment3 ,array('gift-faqs-manager','result-faq','cms-manager','no-cms-manager','email-manager','email-logs','block-manager','faqs-manager','system-doc-manager','testimonial-manager','how-it-work-manager','news-letter','video-demo-manager','video-demo-manager','how-it-work-manager','product-faq')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("messages.system_management.system_management") }} </a>
							<ul class="treeview-menu {{ in_array($segment3 ,array('gift-faqs-manager','result-faq','cms-manager','no-cms-manager','email-manager','email-logs','block-manager','faqs-manager','system-doc-manager','testimonial-manager','how-it-work-manager','news-letter','video-demo-manager','video-demo-manager','how-it-work-manager')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('cms-manager','product-faq')) ? 'display:block;' : 'display:none;' }}">
								<li  @if($segment3 =='cms-manager') class="active" @endif>
									<a href="{{URL::to('admin/cms-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.system_management.cms_pages") }} </a>
								</li>
								<?php /* <li @if($segment3 =='email-manager') class="active" @endif ><a href="{{URL::to('admin/email-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.system_management.email_templates") }} </a></li>
								
								<li @if($segment3=='email-logs') class="active" @endif><a href="{{URL::to('admin/email-logs')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.system_management.email_logs") }} </a></li> */ ?>
								
								<li @if($segment3=='block-manager') class="active" @endif><a href="{{URL::to('admin/block-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Block Manager") }} </a></li>
								
								<li @if($segment3=='how-it-work-manager') class="active" @endif><a href="{{URL::to('admin/how-it-work-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("How It Work") }} </a></li>
								
								<li @if($segment3=='system-doc-manager') class="active" @endif ><a href="{{URL::to('admin/system-doc-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("System Images") }}</a></li>
								
								<?php /* <li @if($segment3=='testimonial-manager') class="active" @endif><a href="{{URL::to('admin/testimonial-manager')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Testimonial")}}</a></li> */ ?>
								
								<!--<li @if($segment3=='news-letter') class="active" @endif><a href="{{URL::to('admin/news-letter/newsletter-templates')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.system_management.newsletter") }} </a></li>-->
								
							</ul>
						</li>
						
						<li class="treeview {{ in_array($segment3 ,array('dropdown-manager','currency')) ? 'active in' : 'faq' }}">
							<a href="javascript::void(0)"><i class="fa fa-th  {{ in_array($segment3 ,array('dropdown-manager','currency')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Masters") }}</a>
							<ul class="treeview-menu {{ in_array($segment3 ,array('dropdown-manager','currency')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('dropdown-manager','currency')) ? 'display:block;' : 'display:none;' }}">
								<li @if($segment4 =='photo-title' || $segment5 =='photo-title') class="active" @endif>
									<a href="{{URL::to('admin/dropdown-manager/photo-title')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Photo Title") }} </a>
								</li>
							</ul>
						</li>
						
						<!--<li class="{{ ($segment3 == 'language') ? 'active' : '' }}">
							<a href="{{URL::to('admin/language')}}"><i class="fa fa-language"></i>{{ trans("Languages") }} </a>
						</li>-->
						<?php /* <li class="treeview {{ in_array($segment3 ,array('language','language-settings')) ? 'active in' : 'offer-reports' }}">
							<a href="javascript::void(0)"><i class="fa fa-list  {{ in_array($segment3 ,array('language','language-settings')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("Language Settings") }} </a>
							<ul class="treeview-menu {{ in_array($segment3 ,array('language','language-settings')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('language','language-settings')) ? 'display:block;' : 'display:none;' }}">
								
								<!--<li @if($segment3 =='language') class="active" @endif ><a href="{{URL::to('admin/language')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Languages") }} </a></li>-->
								
								<li @if($segment3 =='language-settings') class="active" @endif ><a href="{{URL::to('admin/language-settings')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Language Settings") }} </a></li>
							</ul>
						</li> */ ?>
						
						<li class="treeview {{ in_array($segment3 ,array('settings')) ? 'active in' : 'offer-reports' }}">
							<a href="javascript::void(0)"><i class="fa fa-cogs  {{ in_array($segment3 ,array('settings')) ? '' : '' }}"></i><i class="fa pull-right fa-angle-left"></i>{{ trans("messages.system_management.settings")  }} </a>
							<ul class="treeview-menu {{ in_array($segment3 ,array('settings')) ? 'open' : 'closed' }}" style="treeview-menu {{ in_array($segment3 ,array('settings')) ? 'display:block;' : 'display:none;' }}">
								<li  @if($segment3=='settings' && Request::segment(4)=='Site') class="active" @endif>
									<a href="{{URL::to('admin/settings/prefix/Site')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.settings.site_setting") }} </a>
								</li>
								<li  @if($segment3=='settings' && Request::segment(4)=='Reading') class="active" @endif>
									<a href="{{URL::to('admin/settings/prefix/Reading')}}"><i class='fa fa-angle-double-right'></i>{{ trans("messages.settings.reading_setting") }} </a>
								</li>
								
								<li  @if($segment3=='settings' && Request::segment(4)=='Social') class="active" @endif>
									<a href="{{URL::to('admin/settings/prefix/Social')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Social Setting") }} </a>
								</li>
								<li  @if($segment3=='settings' && Request::segment(4)=='Contact') class="active" @endif>
									<a href="{{URL::to('admin/settings/prefix/Contact')}}"><i class='fa fa-angle-double-right'></i>{{ trans("Contact Setting") }} </a>
								</li>
							</ul>
						</li>
					
					</ul>
				</section>
			</aside>
			  <!-- Main Container Start -->
				<aside class="right-side"> 
						@if(Session::has('error'))
							<script type="text/javascript"> 
								$(document).ready(function(e){
									
									show_message("{{{ Session::get('error') }}}",'error');
								});
							</script>
						@endif
						
						@if(Session::has('success'))
							<script type="text/javascript"> 
								$(document).ready(function(e){
									show_message("{{{ Session::get('success') }}}",'success');
								});
							</script>
						@endif

						@if(Session::has('flash_notice'))
							<script type="text/javascript"> 
								$(document).ready(function(e){
									show_message("{{{ Session::get('flash_notice') }}}",'success');
								});
							</script>
						@endif
						
						@yield('content')
				</aside>
		</div>
		<div id="loader_img" style="display:none;"><center><img style="margin-top:17%;" src="{{WEBSITE_IMG_URL}}loader32222.gif"></center></div>
		<?php echo Config::get("Site.copyright_text"); ?>
	</body>
</html>
{{ HTML::script('js/admin/bootbox.js') }}
{{ HTML::script('js/admin/core/mws.js') }}
{{ HTML::script('js/admin/core/themer.js') }}
{{ HTML::script('js/admin/bootstrap.js') }}
{{ HTML::script('js/admin/app.js') }}
{{ HTML::script('js/admin/plugins/fancybox/jquery.fancybox.js') }}
{{ HTML::style('js/admin/plugins/fancybox/jquery.fancybox.css') }}
{{ HTML::style('css/admin/bootmodel.css') }}
<style>
#loader_img {    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.5);    height: 100%;    left: 0;    position: fixed;    text-align: center;    top: 0;    width: 100%;    z-index: 9999;}#loader_img img {     border-radius: 11px;    padding: 15px;    position: relative;    top: 50%;}
</style>
<script type="text/javascript">
	function show_message(message,message_type) {
		$().toastmessage('showToast', {	
			text: message,
			sticky: false,
			position: 'top-right',
			type: message_type,
		});
	}
			
	$(function(){
		$('.fancybox').fancybox();
		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',
		});
		
		$(document).on('click', '.delete_any_item', function(e){ 
			e.stopImmediatePropagation();
			url = $(this).attr('href');
			bootbox.confirm("Are you sure want to delete this ?",
			function(result){
				if(result){
					window.location.replace(url);
				}
			});
			e.preventDefault();
		});
		
		/**
		 * Function to change status
		 *
		 * @param null
		 *
		 * @return void
		 */
		$(document).on('click', '.status_any_item', function(e){ 
			e.stopImmediatePropagation();
			url = $(this).attr('href');
			bootbox.confirm("Are you sure want to change status ?",
			function(result){
				if(result){
					window.location.replace(url);
				}
			});
			e.preventDefault();
		});
		
		$('.open').parent().addClass('active');
		$('.fancybox').fancybox();
		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
			prevEffect : 'none',
			nextEffect : 'none',
		});
	

		$('.skin-black .sidebar > .sidebar-menu > li > a').click(function(e) {
			if(!($(this).next().hasClass("open"))) { 
				$(".treeview-menu").addClass("closed");
				$(".treeview-menu").removeClass("open");
				$(".treeview-menu.open").slideUp();
				$('.skin-black .sidebar > .sidebar-menu > li').removeClass("active");
			  
				$(this).next().slideDown();
				$(this).next().addClass("open");  
				$(this).parent().addClass("active"); 
				 
			}else {  
				e.stopPropagation(); 
				return false;  
			}
		}); 
		/**
		 * For match height of div 
		 */
		$('.items-inner').equalHeights();
		/**
		 * For tooltip
		 */
		var tooltips = $( "[title]" ).tooltip({
			position: {
				my: "right bottom+50",
				at: "right+5 top-5"
			}
		});
	});
</script>