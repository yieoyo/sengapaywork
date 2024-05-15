@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
	@if(!empty($result))
    <div class="about_us_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="about_lottery_content">
						<h2 class="about_lottery_content_head">{{ $result['title']}}</h2>
						{{ $result['body']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endif
</section>
@stop