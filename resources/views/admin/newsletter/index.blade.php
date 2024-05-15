@extends('admin.layouts.default')

@section('content')

<!--popup  script  and  css start here-->
{{HTML::script('js/admin/libs/jquery-1.8.3.min.js')}}
{{HTML::script('js/admin/jui/js/jquery-ui-1.9.2.min.js')}}
{{HTML::script('js/admin/demo.widget.js')}}

{{HTML::Style('css/admin/jui/css/jquery.ui.all.css')}}
{{HTML::Style('css/admin/mws-theme.css')}}
<!--popup  script  and  css end here-->

<script type="text/javascript">
/* For view subscrieber */
$(function(){
	$(".view-subscrieber").bind("click", function (event) {
		 id	=	$(this).attr('id');
		
		 $.post('<?php echo URL::to('admin/news-letter/view-subscriber')?>/'+id,id, function(r) {
			$("#body").html(r);
				$("#view-subscrieber-dialog").dialog("option", {
					modal: true
				}).dialog("open");
		});
		
		event.preventDefault();
	});
	/* For Delete subscrieber */
	$('[data-delete]').click(function(e){
		
	     e.preventDefault();
		// If the user confirm the delete
		if (confirm('Do you really want to delete the element ?')) {
			// Get the route URL
			var url = $(this).prop('href');
			// Get the token
			var token = $(this).data('delete');
			// Create a form element
			var $form = $('<form/>', {action: url, method: 'post'});
			// Add the DELETE hidden input method
			var $inputMethod = $('<input/>', {type: 'hidden', name: '_method', value: 'delete'});
			// Add the token hidden input
			var $inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
			// Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
			$form.append($inputMethod, $inputToken).hide().appendTo('body').submit();
		} 
	});
});
</script>

<section class="content-header">
	<h1>
		Newsletter
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/news-letter/newsletter-templates')}}">Newsletter Templates</a></li>
		<li class="active">Newsletter</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/news-letter','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
		<div class="col-md-3 col-sm-3">
			<div class="form-group ">  
				{{ Form::text('subject',((isset($searchVariable['subject'])) ? $searchVariable['subject'] : ''), ['class' => 'form-control','placeholder'=>'Subject']) }}
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
			<a href="{{URL::to('admin/news-letter')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans('messages.system_management.reset') }}</a>
		</div>
		{{ Form::close() }}
	</div>
	
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="30%">
					{{
						link_to_route(
							'NewsLetter.listTemplate',
							trans("messages.system_management.subject"),
							array(
								'sortBy' => 'subject',
								'order' => ($sortBy == 'subject' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'subject' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'subject' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
					</th>
					<th width="25%">{{
						link_to_route(
							'NewsLetter.listTemplate',
							trans("messages.system_management.scheduled_time"),
							array(
								'sortBy' => 'scheduled_time',
								'order' => ($sortBy == 'scheduled_time' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'scheduled_time' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'scheduled_time' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}</th>
					<th width="15%">
					{{
						link_to_route(
							'NewsLetter.listTemplate',
							trans("messages.system_management.created"),
							array(
								'sortBy' => 'created_at',
								'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
	                </th>
					<th>{{ trans("messages.system_management.action") }}</th>
				</tr>
			</thead>
			<tbody>
				@if(!$result->isEmpty())
				@foreach($result as $record)
				<tr>
					<td data-th='{{ trans("messages.system_management.subject") }}'>{{ $record->subject }}</td>
					<td data-th='{{ trans("messages.system_management.scheduled_time") }}'>{{ date(Config::get("Reading.date_format"),strtotime($record->scheduled_time)) }}</td>
					<td data-th='{{ trans("messages.system_management.created") }}'>{{ $record->updated_at->format(Config::get("Reading.date_format")); }}</td>
					<td data-th='{{ trans("messages.system_management.action") }}'>
						
						<!--<a title="{{ trans('View') }}" href="javascript:void(0)" id="{{$record->id}}" class="view-subscrieber btn btn-info btn-small no-ajax" ><i class="fa fa-eye"></i></a>-->
								
						<a title="{{ trans('messages.global.edit') }}" href="{{URL::to('admin/news-letter/edit-template/'.$record->id)}}" class="btn btn-primary btn-small"><i class="fa fa-pencil"></i> </a>
						
						<a  title="{{ trans('messages.global.delete') }}" href="{{URL::to('admin/news-letter/delete-template/'.$record->id)}}" class="delete_any_item btn btn-danger btn-small no-ajax"><i class="fa fa-trash-o"></i></a>
						
					</td>
				</tr>
				@endforeach
				@else
				<tr>
					<td class="alignCenterClass" colspan="4" >{{ trans("messages.user_management.no_record_found_message") }}</td>
				</tr>
				@endif
			</tbody>
			</table>
		</div>
		<div class="box-footer clearfix">	
			<div class="col-md-3 col-sm-4 "></div>
			<div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $result])</div>
		</div>
	</div>
</section>
@stop
