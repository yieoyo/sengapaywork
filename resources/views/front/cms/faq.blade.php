@extends('front.layouts.default')

@section('content')
<section class="site_content_holder">
    <div class="about_us_wrapper">
        <div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="blue-header">
							<h3>{{trans('messages.home.italian_superenalotto_faqs')}}</h3>
						</div>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							@if(!empty($faqDetail))
								@foreach($faqDetail as $key=>$faq)
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
													<i class="more-less fa fa-plus"></i>
													 {{!empty($faq->question)?$faq->question:''}}
												</a>
											</h4>
										</div>
										<div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												   {{!empty($faq->answer)?$faq->answer:''}}
											</div>
										</div>
									</div>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop