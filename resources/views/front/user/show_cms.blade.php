@extends('front.layouts.default')

@section('content')

<div class="innerbanner loginpage">
	<h3>{{$result["title"]}}
<span>{{trans("messages.cms_pages_site_title")}}</span></h3>
</div>	
</div>
{{$result["body"]}}
	
@stop