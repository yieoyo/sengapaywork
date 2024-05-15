@extends('front.layouts.default')
@section('content')

<link href="{{WEBSITE_CSS_URL}}pages/error/error-3.css" rel="stylesheet" type="text/css" />

<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url({{WEBSITE_IMG_URL}}error/bg3.jpg);">
		<div class="kt-error_container">
			<span class="kt-error_number">
				<h1>404</h1>
			</span>
			<p class="kt-error_title kt-font-light">
				How did you get here
			</p>
			<p class="kt-error_subtitle">
				{{$errorType}} <?php /*Sorry we can't seem to find the page you're looking for.*/ ?>
			</p>
			<p class="kt-error_description">
				{{$errorMessage}} <?php /*There may be amisspelling in the URL entered,<br>
				or the page you are looking for may no longer exist.*/ ?>
			</p>
		</div>
	</div>
</div>


@stop
