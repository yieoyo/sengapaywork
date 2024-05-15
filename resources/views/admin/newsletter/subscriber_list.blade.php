@extends('admin.layouts.default')

@section('content')


<script type="text/javascript">
var action_url = '<?php echo WEBSITE_URL; ?>admin/news-letter/delete-multiple-subscriber';
 /* for equal height of the div */	
</script>

{{ HTML::script('js/admin/multiple_delete.js') }}

<section class="content-header">
	<h1>
		Newsletter Subscribers
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/news-letter/newsletter-templates')}}">Newsletter Templates</a></li>
		<li class="active">Newsletter Subscribers</li>
	</ol>
</section>

<section class="content">
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/news-letter/subscriber-list','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
		<div class="col-md-3 col-sm-3">
			<div class="form-group ">  
				{{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control','placeholder'=>'Email']) }}
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
			<a href="{{URL::to('admin/news-letter/subscriber-list')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans('messages.system_management.reset') }}</a>
		</div>
		{{ Form::close() }}
		<div class="pull-right form-group col-md-2 col-sm-2">
			<a href="{{URL::to('admin/news-letter/add-subscriber')}}"  style="margin-left: 47px !important;" class="btn btn-success btn-small align">{{ trans("messages.system_management.add_subscriber") }} </a>
		</div>
		
		<!--<div id="DataTables_Table_0_length" style="margin-right: -69px !important;" class="pull-right form-group col-md-4 col-sm-4">
			
			<?php 
			$actionTypes	= array(
					'delete' 		=> trans('messages.global.delete_all'),
					'inactive' 		=> trans('messages.global.mark_as_inactive'),
					'active' 		=> trans('messages.global.mark_as_active'),
				 );
			?>
			
			{{ Form::open() }}
			<div  class="pull-right col-md-6 col-sm-8">
				{{ Form::select('action_type',array(''=>trans("messages.user_management.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control'])}}
			</div>
			<div class="pull-right col-md-1 col-sm-1">
				{{ Form::checkbox('is_checked','',null,['class'=>'checkAllUser'])}}
			</div>
			
			{{ Form::close() }}
			
		</div>-->
	</div>
	
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
				<tr>
					<th width="40%">
						{{
							link_to_route(
							'Subscriber.subscriberList',
							trans("messages.system_management.email"),
							array(
								'sortBy' => 'email',
								'order' => ($sortBy == 'email' && $order == 'desc') ? 'asc' : 'desc'
							),
							array('class' => (($sortBy == 'email' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'email' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th width="20%">
						{{
							link_to_route(
							'Subscriber.subscriberList',
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
				<tbody  id="powerwidgets">
				@if(!$result->isEmpty())
				@foreach($result as $record)
				<tr class="items-inner">
					
					<td data-th='{{ trans("messages.system_management.email") }}'>{{ $record->email }}</td>
					<td data-th='{{ trans("messages.system_management.created") }}'>{{ date(Config::get("Reading.date_format"),strtotime($record->created_at)) }}</td>
					<td data-th='{{ trans("messages.system_management.action") }}'>
						@if($record->status==1)
							<a title="Click To Dectivate" href="{{URL::to('admin/news-letter/subscriber-active/'.$record->id.'/0')}}" class="status_any_item btn btn-success btn-small status_user"> <span class="fa fa-ban"></span> </a>
						@else
							<a title="Click To Activate" href="{{URL::to('admin/news-letter/subscriber-active/'.$record->id.'/1')}}" class="status_any_item btn btn-warning btn-small status_user"> <span class="fa fa-check"></span> </a>
						@endif
						
						<a title="{{ trans('messages.global.delete') }}" href="{{URL::to('admin/news-letter/subscriber-delete/'.$record->id)}}"  class="delete_any_item btn btn-danger btn-small delete_user no-ajax"> <span class="fa fa-trash-o"></span> </a>
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
