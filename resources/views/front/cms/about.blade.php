@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
	<div class="about_us_wrapper" style="background-image:url('<?php echo WEBSITE_IMG_URL ; ?>info_sec_bg.png')">
        <div class="container">
            <div class="wrapper-heading">{{trans('messages.home.about_us')}}</div>
			<div class="about_us_hd">About Us</div>
        </div>
    </div>
	<div class="about_us_content_sec">
		<div class="container">
			<div class="about_lottery_content">
					@if(!empty($result))
						{{ $result['body']}}
					@endif
			</div>
		</div>
	</div>
	<div class="info_content_sec">
		<div class="container">
			<div class="info_sec_content_block">
				<div class="row">
					<div class="col-sm-6">
						<div class="info_content_block">
							<div class="info_content_heading">PRIVACY</div>
							<div class="info_content_txt">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="info_img_block"><img src="<?php echo WEBSITE_IMG_URL ; ?>info1.png"></div>
					</div>
				</div>
			</div>
			<div class="info_sec_content_block">
				<div class="row">
					<div class="col-sm-6">
						<div class="info_img_block"><img src="<?php echo WEBSITE_IMG_URL ; ?>info2.png"></div>
					</div>
					<div class="col-sm-6">
						<div class="info_content_block">
							<div class="info_content_heading">TRANSACTIONS</div>
							<div class="info_content_txt">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</section>
@stop