@extends('admin.layouts.default')
@section('content') 
<section class="content-header">
	<h1>
	  {{ trans("Currency") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("Currency") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','route' => 'currency.listCurrency','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control','placeholder'=>'Name']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('symbol',((isset($searchVariable['symbol'])) ? $searchVariable['symbol'] : ''), ['class' => 'form-control','placeholder'=>'Symbol']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
				<a href="{{route('currency.listCurrency')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
			</div>
		{{ Form::close() }}
		<div class="col-md-3 col-sm-3 ">
			<div class="form-group pull-right">  
				<a href="{{route('currency.addCurrency')}}" class="btn btn-success btn-small align">{{ trans("Add Currency") }} </a>
			</div>
		</div>
	</div> 
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="25%">
							{{
								link_to_route(
								'currency.listCurrency',
								trans("Name"),
								array(
									'sortBy' => 'name',
									'order' => ($sortBy == 'name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="25%">
							{{
								link_to_route(
								'currency.listCurrency',
								trans("Symbol"),
								array(
									'sortBy' => 'symbol',
									'order' => ($sortBy == 'symbol' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'symbol' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'symbol' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<?php /* <th width="15%">{{ 'Category Name' }}</th> */ ?>
						<th width="10%" >
							{{
								link_to_route(
								'currency.listCurrency',
								trans("Status"),
								array(
									'sortBy' => 'is_active',
									'order' => ($sortBy == 'is_active' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'is_active' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'is_active' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}</th>
						<th >{{ trans("messages.system_management.action") }}</th>
					</tr>
				</thead>
				<tbody id="powerwidgets">
					@if(!$result->isEmpty())
					@foreach($result as $record)
						
						<tr>
							<td data-th="{{ trans('messages.system_management.question') }}">{{ $record->name }}</td>
							<td data-th="{{ trans('messages.system_management.question') }}">{{ $record->symbol }}</td> 
							<td data-th='Category Name '>
								@if($record->is_active)
									<label class="label label-success">Activated</label>
								@else
									<label class="label label-warning">Deactivated</label>
								@endif
							</td>
							<td data-th="{{ trans('messages.system_management.action') }}">
								@if($record->is_active == 1)
									<a  title="Click To Deactivate" href="{{route('currency.updateCurrencyStatus',[$record->id,0])}}" class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
									</a>
								@else
									<a title="Click To Activate" href="{{route('currency.updateCurrencyStatus',[$record->id,1])}}" class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
									</a> 
								@endif  
								<a title='{{ trans("messages.system_management.edit") }}' href="{{route('currency.editCurrency',$record->id)}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a> 
								<a title='{{ trans("messages.system_management.delete") }}' href="{{route('currency.deleteCurrency',$record->id)}}" class="delete_any_item btn btn-danger"><span class="fa fa-trash-o"></span></a>
							</td>
						</tr>
					@endforeach 
					@else
						<tr>
							<td colspan="4" class="alignCenterClass" >
								{{ trans("messages.system_management.no_record_found_message") }}
							</td>
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
