@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
	  {{ trans("Track Records") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}"> Users Management</a></li>
		<li class="active"> {{ trans("Track Records") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['role' => 'form','url' => 'admin/users/track-records','class' => 'mws-form',"method"=>"get"]) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('track_id',((isset($searchVariable['track_id'])) ? $searchVariable['track_id'] : ''), ['class' => ' form-control','placeholder'=>'Track id']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					
				</div>
			</div>
			
			<div class="col-md-3 col-sm-3">
				<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
				<a href="{{URL::to('admin/users')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
			</div>
		{{ Form::close() }}
	</div> 
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="14%">
							{{
								link_to_route(
								"Users.index",
								trans("User Name"),
								array(
									'sortBy' => 'user_name',
									'order' => ($sortBy == 'user_name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'user_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'user_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="16%">
							{{
								link_to_route(
								"Users.index",
								trans("Track ID"),
								array(
									'sortBy' => 'track_id',
									'order' => ($sortBy == 'track_id' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'track_id' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'track_id' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="13%">
							{{
								link_to_route(
								"Users.index",
								trans("Start Date Time"),
								array(
									'sortBy' => 'start_time',
									'order' => ($sortBy == 'start_time' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'start_time' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'start_time' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="13%">
							{{
								link_to_route(
								"Users.index",
								trans("End Date Time"),
								array(
									'sortBy' => 'end_time',
									'order' =>  ($sortBy == 'end_time' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'end_time' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'end_time' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="16%">
							{{
								link_to_route(
								"Users.index",
								trans("Created"),
								array(
									'sortBy' => 'created_at',
									'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="15%">
							{{
								link_to_route(
								"Users.index",
								trans("Status"),
								array(
								'sortBy' => 'is_active',
								'order' => ($sortBy == 'is_active' && $order == 'desc') ? 'asc' : 'desc',
								$query_string
								),
								array('class' => (($sortBy == 'is_active' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'is_active' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="10%">{{ trans("messages.global.action") }}</th>
					</tr>
				</thead>
				@if(!$result->isEmpty())
					@foreach($result as $key => $record)
						<tr>
							<td data-th='{{ trans("messages.Users.font_name") }}'>{{ $record->user_name }}</td>
							<td data-th='{{ trans("messages.Users.name") }}'>{{ $record->track_id  }}</td>
							<td data-th='{{ trans("messages.Users.created_at") }}'>{{ date(Config::get("Reading.date_format") , strtotime($record->start_time)) }}</td>
							<td data-th='{{ trans("messages.Users.created_at") }}'>{{ ($record->end_time > "0000-00-00 00:00:00") ? date(Config::get("Reading.date_format") , strtotime($record->end_time)):'-' }}</td>
							<td data-th='{{ trans("messages.Users.created_at") }}'>{{ date(Config::get("Reading.date_format") , strtotime($record->created_at)) }}</td>
							<td data-th='{{ trans("messages.Users.status") }}'>
								@if($record->is_active	== 1)
									<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
								@else
									<span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
								@endif
							</td>
							<td>
								<a href="{{URL::to('admin/users/track-records-view/'.$record->id)}}" title="{{ trans('track records view') }}" class="btn btn-info">
									<i class="fa fa-eye"></i>
								</a>
							</td>
						</tr>
					 @endforeach
					 @else
						<tr>
							<td class="alignCenterClass" colspan="5" >{{ trans("messages.user_management.no_record_found_message") }}</td>
						</tr>
					@endif 
			</table>
		</div>
		<div class="box-footer clearfix">	
			<div class="col-md-3 col-sm-4 "></div>
			<div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $result])</div>
		</div>
	</div> 
</section> 
@stop