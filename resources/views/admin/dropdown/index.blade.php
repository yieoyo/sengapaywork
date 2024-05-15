
@extends('admin.layouts.default')

@section('content')

{{HTML::script('js/admin/vendors/match-height/jquery.equalheights.js') }}

<script type="text/javascript"> 
	$(function(){
		/**
		 * For match height of div 
		 */
		$('.items-inner').equalHeights();
		/**
		 * For tooltip
		 */
		var tooltips = $( "[title]" ).tooltip({
			position: {
				my: "right bottom+50",
				at: "right+5 top-5"
			}
		});
	});	
</script>
<section class="content-header">
	<h1>
		{{ studly_case($type) }} Management
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ studly_case($type) }} Management</li>
	</ol>
</section>
	
<section class="content"> 
	<div class="row">
		{{ Form::open(['role' => 'form','url' => 'admin/dropdown-manager/'.$type,'class' => 'mws-form',"method"=>"get"]) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control','placeholder'=>studly_case($type)]) }}
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<button class="btn btn-primary"><i class='fa fa-search '></i> Search</button>
				<a href="{{URL::to('admin/dropdown-manager/'.$type)}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> Reset</a>
			</div>
		{{ Form::close() }}
		<div class="col-md-5 col-sm-5 ">
			<div class="form-group ">  
				<a href="{{URL::to('admin/dropdown-manager/add-dropdown/'.$type)}}" class="btn btn-success btn-small align pull-right">{{ 'Add New '.studly_case($type) }} </a>
			</div>
		</div>
	</div> 
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
			<thead>
				<tr>
					<th width="40%">
						{{
							link_to_route(
								'DropDown.listDropDown',
								'Name',
								array(
									$type,
									'sortBy' => 'name',
									'order' => ($sortBy == 'name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
							   array('class' => (($sortBy == 'name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th width="30%">
						{{
							link_to_route(
								'DropDown.listDropDown',
								'Created ',
								array(
									$type,
									'sortBy' => 'created_at',
									'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
							   array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th>
						{{
							link_to_route(
								'DropDown.listDropDown',
								'Status',
								array(
									$type,
									'sortBy' => 'is_active',
									'order' => ($sortBy == 'is_active' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
							   array('class' => (($sortBy == 'is_active' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'is_active' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th>{{ 'Action' }}</th>
				</tr>
			</thead>
			<tbody id="powerwidgets">
				@if(!$result->isEmpty())
				@foreach($result as $record)
				<tr class="items-inner">
					<td data-th='Name'>{{ $record->name }}</td>
					<td data-th='Created At'>{{ date(Config::get("Reading.date_format") , strtotime($record->created_at)) }}</td>
					<td>
						@if($record->is_active	==1)
							<span class="label label-success" >{{ trans("messages.user_management.activated") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.user_management.deactivated") }}</span>
						@endif
					</td>
					<td data-th='Action'>
						@if($record->is_active == 1)
							<a  title="Click To Deactivate" href="{{URL::to('admin/dropdown-manager/update-dropdown/'.$record->id.'/'.'0'.'/'.$type)}}" class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
							</a>
						@else
							<a title="Click To Activate" href="{{URL::to('admin/dropdown-manager/update-dropdown/'.$record->id.'/'.'1'.'/'.$type)}}" class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
							</a> 
						@endif 
						<a title="Edit" href="{{URL::to('admin/dropdown-manager/edit-dropdown/'.$record->id.'/'.$type)}}" class="btn btn-primary">
							<i class="fa fa-pencil"></i>
						</a>
						<?php /* <a title="Delete" href="{{URL::to('admin/dropdown-manager/delete-dropdown/'.$record->id.'/'.$type)}}"  class="delete_any_item btn btn-danger">
							<i class="fa fa-trash-o"></i>
						</a> */ ?>
					</td>
				</tr>
				 @endforeach
					 @else
						<tr>
							<td class="alignCenterClass" colspan="3" >{{ trans("messages.user_management.no_record_found_message") }}</td>
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