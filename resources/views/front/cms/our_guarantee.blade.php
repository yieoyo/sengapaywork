@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
	@if(!empty($result))
    <div class="about_us_wrapper">
        <div class="container">
            <div class="wrapper-heading">{{ $result['title']}}</div>
            <div class="row">
                <div class="col-sm-3">
                    @include('front.elements.navigation')
                </div>
                <div class="col-sm-6">
                    <div class="about_lottery_content">
						{{ $result['body']}}
                    </div>
                </div>
                <div class="col-sm-3">
                    @include('front.elements.nagivation_right')
                </div>
            </div>
        </div>
    </div>
	@endif
</section>
@stop