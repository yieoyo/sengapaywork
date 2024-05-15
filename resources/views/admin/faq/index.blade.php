@extends('admin.layouts.default')
@section('content')
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
	  {{ trans("messages.system_management.manage_faq") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("messages.system_management.manage_faq") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/faqs-manager','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('question',((isset($searchVariable['question'])) ? $searchVariable['question'] : ''), ['class' => 'form-control','placeholder'=>'Question']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('answer',((isset($searchVariable['answer'])) ? $searchVariable['answer'] : ''), ['class' => 'form-control','placeholder'=>'Answer']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
				<a href="{{URL::to('admin/faqs-manager')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
			</div>
		{{ Form::close() }}
		<div class="col-md-3 col-sm-3 ">
			<div class="form-group pull-right">  
				<a href="{{URL::to('admin/faqs-manager/add-faqs')}}" class="btn btn-success btn-small align">{{ trans("messages.system_management.add_faq") }} </a>
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
								'Faq.listFaq',
								trans("messages.system_management.question"),
								array(
									'sortBy' => 'question',
									'order' => ($sortBy == 'question' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'question' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'question' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="25%">
							{{
								link_to_route(
								'Faq.listFaq',
								trans("messages.system_management.answer"),
								array(
									'sortBy' => 'answer',
									'order' => ($sortBy == 'answer' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'answer' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'answer' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<?php /* <th width="15%">{{ 'Category Name' }}</th> */ ?>
						<th width="10%" >
							{{
								link_to_route(
								'Faq.listFaq',
								trans("messages.system_management.status"),
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
							<td data-th="{{ trans('messages.system_management.question') }}">{{ $record->question }}</td>
							<td data-th="{{ trans('messages.system_management.answer') }}">{{ strip_tags(Str::limit($record->answer, 220)) }}</td>
							<?php /* <td data-th='Category Name '>{{ $record->category->name }}</td> */ ?>
							<td data-th='Category Name '>
								@if($record->is_active)
									<label class="label label-success">Activated</label>
								@else
									<label class="label label-warning">Deactivated</label>
								@endif
							</td>
							<td data-th="{{ trans('messages.system_management.action') }}">
								@if($record->is_active == 1)
									<a  title="Click To Deactivate" href="{{URL::to('admin/faqs-manager/update-status/'.$record->id.'/0')}}" class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
									</a>
								@else
									<a title="Click To Activate" href="{{URL::to('admin/faqs-manager/update-status/'.$record->id.'/1')}}" class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
									</a> 
								@endif 
								
								<a title='{{ trans("messages.system_management.edit") }}' href="{{URL::to('admin/faqs-manager/edit-faqs/'.$record->id)}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
								
								<a title='{{ trans("messages.system_management.view") }}' href="{{URL::to('admin/faqs-manager/view-faqs/'.$record->id)}}" class="btn btn-info"><span class="fa fa-eye"></span></a>
								
								<a title='{{ trans("messages.system_management.delete") }}' href="{{URL::to('admin/faqs-manager/delete-faqs/'.$record->id)}}" class="delete_any_item btn btn-danger"><span class="fa fa-trash-o"></span></a>
							</td>
						</tr>
					@endforeach 
					@else
						<tr>
							<td colspan="5" class="alignCenterClass" >
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
