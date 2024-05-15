@extends('admin.layouts.default')

@section('content')

<style>
@media (min-width: 768px) {
	.nes{margin-left: -12px  !important;}
}
@media (max-width: 768px) {
	.nes{margin-left: -12px !important;}
}
</style>
<script type="text/javascript">
	var action_url = '<?php echo WEBSITE_URL; ?>admin/users/multiple-action';
</script>
 {{ HTML::script('js/admin/multiple_delete.js') }}

<section class="content-header">
	<h1>
		Newsletter Templates
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Newsletter Templates</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/news-letter/newsletter-templates','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
		<div class="col-md-3 col-sm-3">
			<div class="form-group ">  
				{{ Form::text('subject',((isset($searchVariable['subject'])) ? $searchVariable['subject'] : ''), ['class' => 'form-control','placeholder'=>'Subject']) }}
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
			<a href="{{URL::to('admin/news-letter/newsletter-templates')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans('messages.system_management.reset') }}</a>
		</div>
		{{ Form::close() }}
		<div class="col-md-6 col-sm-6">
		
			<div class="col-md-12 col-sm-12">  
				<a href="{{URL::to('admin/news-letter/add-template')}}" style=" " class="btn btn-success btn-small align">{{ trans("messages.system_management.add_template") }} </a>
				<a href="{{URL::to('admin/news-letter/subscriber-list')}}"  style="" class="btn btn-success btn-small align">{{ trans("messages.system_management.subscriber_list") }} </a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="{{URL::to('admin/news-letter')}}"  style="" class="btn btn-success btn-small align nes">{{ trans("messages.system_management.scheduled_newletter") }} </a>&nbsp;&nbsp;
			</div>
		</div>
	</div>
	
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
			<thead>
				<tr>
					<th width="35%">
					{{
						link_to_route(
							'NewsTemplates.newsletterTemplates',
							'Subject',
							array(
								'sortBy' => 'subject',
								'order' => ($sortBy == 'subject' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'subject' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'subject' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
					</th>
					
					<th width="18%">
					{{
						link_to_route(
							'NewsTemplates.newsletterTemplates',
							'Created',
							array(
								'sortBy' => 'created_at',
								'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
	                </th>
					<th width="18%">
					{{
						link_to_route(
							'NewsTemplates.newsletterTemplates',
							'Updated',
							array(
								'sortBy' => 'updated_at',
								'order' => ($sortBy == 'updated_at' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'updated_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'updated_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
	                </th>
					<th>{{ 'Action' }}</th>
				</tr>
			</thead>
			<tbody>
				@if(!$result->isEmpty())
				@foreach($result as $record)
				<tr>
					<td data-th='Subject'>{{ $record->subject }}</td>
					<td data-th='Scheduled Date'>{{ date(Config::get("Reading.date_format"),strtotime($record->created_at)) }}</td>
					<td data-th='Created'>{{ date(Config::get("Reading.date_format"),strtotime($record->updated_at)) }}</td>
					<td data-th='Action'>
						<a title="{{ trans('messages.global.edit') }}" href="{{URL::to('admin/news-letter/edit-newsletter-templates/'.$record->id)}}" class="btn btn-primary btn-small"> <span class="fa fa-pencil"> </a>
						
						<a title="{{ trans('messages.global.delete') }}" href="{{URL::to('admin/news-letter/delete-newsletter-template/'.$record->id)}}" class="delete_any_item btn btn-danger btn-small no-ajax"> <span class="fa fa-trash-o"></span> </a>
						
						<a title="{{ trans('Send') }}" href="{{URL::to('admin/news-letter/send-newsletter-templates/'.$record->id)}}" class="btn btn-info btn-small"> <span class="fa fa-send"></span> </a>
						
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
