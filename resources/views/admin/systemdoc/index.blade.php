@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
		{{ trans("System Images") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">{{ trans("System Images") }}</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/system-doc-manager','class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
		<div class="col-md-3 col-sm-3">
			<div class="form-group ">  
				{{ Form::text('title',((isset($searchVariable['title'])) ? $searchVariable['title'] : ''), ['class' => 'form-control','placeholder'=>"Title"]) }}
			</div>
		</div>
		<div class="col-md-4 col-sm-4">
			<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
			<a href="{{URL::to('admin/system-doc-manager')}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
		</div>
		{{ Form::close() }}
		<div class="col-md-5 col-sm-5 ">
			<div class="form-group pull-right">  
				@if(Config::get('app.debug'))
					<a href="{{URL::to('admin/system-doc-manager/add-doc')}}" class="btn btn-success btn-small align">{{ trans("Add System Image") }} </a>
				@endif
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
								'SystemDoc.index',
								trans('Name'),
								array(
								'sortBy' => 'title',
								'order' => ($sortBy == 'title' && $order == 'desc') ? 'asc' : 'desc',
								$query_string
								),
								array('class' => (($sortBy == 'title' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'title' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="40%">
							Image
						</th>
						<th width="20%">{{ trans("messages.system_management.action") }}</th>
					</tr>
				</thead>
				<tbody >
					@if(!$result->isEmpty())
						@foreach($result as $record)
						<tr class="items-inner">
							<td data-th='{{ trans("messages.system_management.title") }}'>{{ $record->title }}</td>
							<td data-th='{{ trans("Image") }}'>
								@if($record->name != '' && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH.$record->name))
									<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo SYSTEM_IMAGE_URL.$record->name; ?>">
										<div class="usermgmt_image">
											<img class="img-circle" src="<?php echo WEBSITE_URL.'image.php?width=75px&height=75px&cropratio=1:1&image='.SYSTEM_IMAGE_URL.'/'.$record->name ?>">
										</div>
									</a>
								@else
									<img class="img-circle" src="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg" style="height:75px;width:75px;">
								@endif
							</td>
						
							<td data-th='{{ trans("messages.system_management.action") }}'>
								
								<a href="{{URL::to('admin/system-doc-manager/edit-doc/'.$record->id)}}" title='{{ trans("messages.system_management.edit") }}' class="btn btn-primary">
									<i class="fa fa-pencil"></i>
								</a>
								@if(Config::get('app.debug'))
									<a href="{{URL::to('admin/system-doc-manager/delete-doc/'.$record->id)}}" title='{{ trans("messages.system_management.delete") }}' class="btn btn-danger delete_any_item">
										<i class="fa fa-trash-o"></i>
									</a>
								@endif
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
