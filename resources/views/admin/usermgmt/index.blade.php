@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
	  {{ trans("Users Management") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("Users Management") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['role' => 'form','url' => 'admin/users','class' => 'mws-form',"method"=>"get"]) }}
		{{ Form::hidden('display') }}
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">  
					{{ Form::select('is_active',array(''=>trans('Select Status'),0=>'Inactive',1=>'Active'),((isset($searchVariable['is_active'])) ? $searchVariable['is_active'] : ''), ['class' => 'form-control']) }}
				</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">  
					{{ Form::text('full_name',((isset($searchVariable['full_name'])) ? $searchVariable['full_name'] : ''), ['class' => 'form-control','placeholder'=>'Full Name']) }}
				</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">  
					{{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control','placeholder'=>'Email']) }}
				</div>
			</div>
			<div class="col-md-2 col-sm-2">
				<div class="form-group ">  
					{{ Form::text('phone_number',((isset($searchVariable['phone'])) ? $searchVariable['phone'] : ''), ['class' => 'form-control','placeholder'=>'Phone']) }}
				</div>
			</div>
			<div class="col-md-4 col-sm-3">
				<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
				<a href="{{URL::to('admin/users')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
				<a href="{{URL::to('admin/users/add-user')}}" class="btn btn-success btn-small align">{{ trans("Add New User") }} </a>
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
								trans("Full Name"),
								array(
									'sortBy' => 'full_name',
									'order' => ($sortBy == 'full_name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'full_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'full_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="16%">
							{{
								link_to_route(
								"Users.index",
								trans("Email"),
								array(
									'sortBy' => 'email',
									'order' => ($sortBy == 'email' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'email' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'email' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="13%">
							{{
								link_to_route(
								"Users.index",
								trans("Phone"),
								array(
									'sortBy' => 'phone',
									'order' => ($sortBy == 'phone' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'phone' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'phone' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="13%">
							{{
								link_to_route(
								"Users.index",
								trans("Country"),
								array(
									'sortBy' => 'country_name',
									'order' =>  ($sortBy == 'country_name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'country_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'country_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="16%">
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
						<th>
							Action
						</th>
					</tr>
				</thead>
				@if(!$result->isEmpty())
					@foreach($result as $key => $record)
						<tr>
							<td>
								{{ $record->full_name }}
							</td>
							<td>
								<a href="mailto:{{ $record->email }}" class="redicon">
									{{ $record->email }}
								</a>
							</td>
							<td>
								{{ $record->phone }}
							</td>
							<td>
								{{ $record->country_name }}
							</td>
							<td>
								@if($record->is_active	==1)
									<span class="label label-success" >{{ trans("messages.user_management.activated") }}</span>
								@else
									<span class="label label-warning" >{{ trans("messages.user_management.deactivated") }}</span>
								@endif
							</td>
							<td>
								@if($record->is_active == 1)
									<a  title="Click To Deactivate" href="{{URL::to('admin/users/update-status/'.$record->id.'/0')}}" class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
									</a>
								@else
									<a title="Click To Activate" href="{{URL::to('admin/users/update-status/'.$record->id.'/1')}}" class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
									</a> 
								@endif 
								<a href="{{URL::to('admin/users/view-user/'.$record->id)}}" title="{{ trans('messages.global.view') }}" class="btn btn-info">
									<i class="fa fa-eye"></i>
								</a>
									
								<a title="{{ trans('messages.global.edit') }}" href="{{URL::to('admin/users/edit-user/'.$record->id)}}" class="btn btn-primary">
									<i class="fa fa-pencil"></i>
								</a>
								
								<a title="{{ trans('messages.global.delete') }}" href="{{ URL::to('admin/users/delete-user/'.$record->id) }}"  class="delete_any_item btn btn-danger">
									<i class="fa fa-trash-o"></i>
								</a>
								
								<?php /* <a title="{{ trans('Message') }}" href="{{ URL::to('admin/users/message/'.$record->id) }}"  class="btn btn-primary">
									<i class="fa fa-comment-o"></i>
								</a> */ ?>
							
								<a title="{{ trans('messages.user_management.send_login_credentials') }}" href="{{ URL::to('admin/users/send-credential/'.$record->id) }}" class="btn btn-success">
									<i class="fa fa-share"></i>
								</a>
								
								<a title="{{ trans('track records') }}" href="{{ URL::to('admin/users/track-records/'.$record->id) }}"  class="btn btn-default">
									<i class="fa fa-bicycle"></i>
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