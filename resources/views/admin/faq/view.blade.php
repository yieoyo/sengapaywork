@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
		{{ trans("View FAQ") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/faqs-manager')}}">{{ trans("messages.system_management.manage_faq") }}</a></li>
		<li class="active">{{ trans("View FAQ") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row pad">
		<div class="col-md-12">	
			@if(count($languages) > 1)
				<div class="wizard-nav wizard-nav-horizontal">
					<ul class="nav nav-tabs">
						@foreach($languages as $value)
						<?php $i = $value -> id ; ?>
							<li class=" {{ ($i ==  $language_code )?'active':'' }}">
								<a data-toggle="tab" href="#{{ $i }}div">
									{{ $value -> title }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
	</div>
	<div class="row pad">
		<div class="col-md-12 tab-content">
			@foreach($languages as  $key => $value)
			<div  id="{{  $value->id }}div" class="tab-pane fade {{ ( $value->id ==  $language_code )?'in active':'' }}">
				<table  class="table table-bordered table-responsive">
					<tr>
						<th>
							Question
						</th>
						<th>
							Answer
						</th>
					</tr>
					<tr>
						<td>
							{{ (isset($multiLanguage[$value->id]['question']))? $multiLanguage[$value->id]['question'] :'' }}
						</td>
						<td>
							{{ isset($multiLanguage[$value->id]['answer'])? $multiLanguage[$value->id]['answer']:'' }}
						</td>
					</tr>
				</table>
			</div>
			@endforeach
		</div>
	</div>
</section>
@stop
