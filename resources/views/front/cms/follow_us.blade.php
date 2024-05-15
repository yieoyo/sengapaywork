@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
    <div class="about_us_wrapper">
        <div class="container">
            <div class="wrapper-heading">{{trans('messages.home.follow_us')}}</div>
            <div class="row">
                <div class="col-sm-3">
                    @include('front.elements.navigation')
                </div>
                <div class="col-sm-6">
                    <div class="about_lottery_content">
					@if(!empty($result))
						{{ $result['body']}}
					@endif
					<ul class="social_icons_list">
						<li class="facebook">
							<a href="{{ Config::get('Social.facebook') }}" target="_blank">
								<div class="social_icons_wrapper">
									<i class="fa fa-facebook" aria-hidden="true"></i>
									<span class="flex">
										<span class="social-icons-content">Like us</span>
										<span class="social-icons-category">Facebook</span>
									</span>
								</div>
							</a>
						</li>
						<li class="twitter">
							<a href="{{ Config::get('Social.twitter') }}" target="_blank">
								<div class="social_icons_wrapper">
									<i class="fa fa-twitter" aria-hidden="true"></i>
									 <span class="flex">
										<span class="social-icons-content">Follow us</span>
										<span class="social-icons-category">Twitter</span>
									  </span>
								</div>
							</a>
						</li>
						<li class="youtube">
							<a href="{{ Config::get('Social.youtube_link') }}" target="_blank">
								<div class="social_icons_wrapper">
									<i class="fa fa-youtube" aria-hidden="true"></i>
									 <span class="flex">
										<span class="social-icons-content">View us</span>
										<span class="social-icons-category">Youtube</span>
									  </span>
								</div>
							</a>
						</li>
					</ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    @include('front.elements.nagivation_right')
                </div>
            </div>
        </div>
    </div>
</section>
@stop