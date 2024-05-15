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
	var action_url = '<?php echo WEBSITE_URL; ?>admin/cms-manager/multiple-action';
</script>
<section class="content-header">
	<h1>
	  {{ trans("messages.system_management.manage_cms_pages") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("messages.system_management.manage_cms_pages") }}</li>
	</ol>
</section>

<section class="content"> 
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/cms-manager','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control' , 'placeholder' => 'Page Name']) }}
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<button class="btn btn-primary"><i class='fa fa-search '></i> Search</button>
				<a href="{{URL::to('admin/cms-manager')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> Reset</a>
			</div>
		{{ Form::close() }}
		
		@if(Config::get('app.debug'))
			<div class="col-md-5 col-sm-5 ">
				<div class="form-group pull-right">  
					<a href="{{URL::to('admin/cms-manager/add-cms')}}" class="btn btn-success btn-small align">{{ trans("messages.system_management.add_new_cms") }} </a>
				</div>
			</div>
		@endif
	</div> 
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="30%">
							{{
								link_to_route(
								"Cms.index",
								trans("messages.system_management.page_name"),
								array(
									'sortBy' => 'name',
									'order' => ($sortBy == 'name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="40%">{{ trans("messages.system_management.page_description") }}</th>
						<?php /* <th>
							{{
								link_to_route(
								"Cms.index",
								trans("messages.system_management.status"),
								array(
									'sortBy' => 'is_active',
									'order' => ($sortBy == 'is_active' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'is_active' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'is_active' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th> */ ?>
						<th>
							{{
								link_to_route(
								"Cms.index",
								trans("messages.system_management.modified"),
								array(
									'sortBy' => 'updated_at',
									'order' => ($sortBy == 'updated_at' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
								),
								array('class' => (($sortBy == 'updated_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'updated_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th>{{ trans("messages.system_management.action") }}</th>
					</tr>
				</thead>
				<tbody id="powerwidgets">
					@if(!$result->isEmpty())
					@foreach($result as $record)
					<tr class="items-inner">
						<td data-th='{{ trans("messages.system_management.page_name") }}'>{{ $record->name }}</td>
						<td data-th='{{ trans("messages.system_management.page_description") }}'>{{ strip_tags(Str::limit($record->body, 300)) }}</td>
						<?php /* <td data-th='{{ trans("messages.system_management.status") }}'>
						@if($record->is_active	== 1)
							<span class="label label-success" >{{ trans("messages.user_management.activated") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.user_management.deactivated") }}</span>
						@endif
						</td> */ ?>
						<td data-th='{{ trans("messages.system_management.modified") }}'>
						{{ date(Config::get("Reading.date_format") , strtotime($record->updated_at)) }}
						</td>
						<td data-th='{{ trans("messages.system_management.action") }}'>
							<a title="Edit" href="{{URL::to('admin/cms-manager/edit-cms/'.$record->id)}}" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
							<?php /* @if($record->is_active == 1)
								<a  title="Click To Deactivate" href="{{URL::to('admin/cms-manager/update-status/'.$record->id.'/0')}}" class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
								</a>
							@else
								<a title="Click To Activate" href="{{URL::to('admin/cms-manager/update-status/'.$record->id.'/1')}}" class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
								</a> 
							@endif  */ ?>
						</td>
					</tr>
					 @endforeach
					 @else
						<tr>
							<td class="alignCenterClass" colspan="6" >{{ trans("messages.user_management.no_record_found_message") }}</td>
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
