<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<?php
		if(!empty(Config::get("Settings.favicon")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.favicon"))){
			$favicon = SYSTEM_IMAGE_URL . Config::get("Settings.favicon");
		}else{
			$favicon = WEBSITE_IMG_URL . "favicon.png";
		}
	?>
	<link rel="shortcut icon" href="{{$favicon}}" type="image/x-icon">
	<title><?php echo Config::get("Settings.meta_title"); ?></title>
	<meta name="keywords" content="<?php echo Config::get("Settings.meta_keyword"); ?>" />
	<meta name="title" content="<?php echo Config::get("Settings.meta_title"); ?>" />
	<meta name="description" content="<?php echo Config::get("Settings.meta_description"); ?>" />
	<link rel="canonical" href="{{WEBSITE_URL}}" />

	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
	
	<!--begin::Page Custom Styles(used by this page) -->
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/login/login-1.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>pages/login/login-3.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>style.css" rel="stylesheet" type="text/css" />
	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="<?php echo WEBSITE_JS_URL;?>plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo WEBSITE_CSS_URL;?>style.bundle.css" rel="stylesheet" type="text/css" />

	<script src="<?php echo WEBSITE_JS_URL;?>pages/custom/login/login-general.js" type="text/javascript"></script>
	
		
</head>

<body style="background-image: url(<?php echo WEBSITE_IMG_URL; ?>demos/demo4/header.jpg); background-position: center top; background-size: 100% 350px;" class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

	<!-- begin::Page loader -->

	<!-- end::Page Loader -->

	<!-- begin:: Page -->
	<div class="main_dv">
		<script>
			function show_message(message,message_type) {
				$().toastmessage('showToast', {	
					text: message,
					sticky: false,
					position: 'top-right',
					type: message_type,
				});
			}
			
		</script>
		@include('front.elements.header')
		@if(Session::has('error'))
			<script type="text/javascript">
				show_message("{{ Session::get('error')}}",'error');
			</script>
		@endif
			
		@if(Session::has('success'))
			<script type="text/javascript">
				show_message("{{ Session::get('success')}}",'success');
			</script>
		@endif
		@if(Session::has('flash_notice'))
			<script type="text/javascript">
				show_message("{{ Session::get('flash_notice')}}",'success');
			</script>
		@endif
		
		<!-- begin::Global Config(global config for global JS sciprts) -->
			<script>
				var KTAppOptions = {
					"colors": {
						"state": {
							"brand": "#366cf3",
							"light": "#ffffff",
							"dark": "#282a3c",
							"primary": "#5867dd",
							"success": "#34bfa3",
							"info": "#36a3f7",
							"warning": "#ffb822",
							"danger": "#fd3995"
						},
						"base": {
							"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
							"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
						}
					}
				};
			</script>

		<!-- end::Global Config -->

		@yield('content')
		
		<div style="display:none" id="loader_img"><center><img src="{{WEBSITE_IMG_URL}}loader32222.gif"></center></div>
	</div>
	<!-- end:: Page -->

	<!--begin::Global Theme Bundle(used by all pages) -->
	<script src="<?php echo WEBSITE_JS_URL;?>plugins/global/plugins.bundle.js" type="text/javascript"></script>
	<script src="<?php echo WEBSITE_JS_URL;?>scripts.bundle.js" type="text/javascript"></script>

	<!--end::Global Theme Bundle -->

	<!--begin::Page Scripts(used by this page) -->
	<script src="<?php echo WEBSITE_JS_URL;?>pages/custom/login/login-general.js" type="text/javascript"></script>

	<!--end::Page Scripts -->
</body>

	<!-- end::Body -->
</html>