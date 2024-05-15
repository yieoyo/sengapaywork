@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
	 "{{$userDetails->full_name}}" Profile Content Management
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/artists')}}">Artists</a></li>
		<li class="active">Profile Content Management</li>
	</ol>
</section>
<section class="content"> 
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','url' => 'admin/artists-content/'.$userDetails->id,'class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
		<div class="col-md-3 col-sm-3">
			<div class="form-group ">  
				{{ Form::text('title',((isset($searchVariable['title'])) ? $searchVariable['title'] : ''), ['class' => 'form-control','placeholder'=>"Title"]) }}
			</div>
		</div>
		<div class="col-md-4 col-sm-4">
			<button class="btn btn-primary"><i class='fa fa-search '></i> {{ trans('messages.search.text') }}</button>
			<a href="{{URL::to('admin/artists-content/'.$userDetails->id)}}"  class="btn btn-primary"><i class='fa fa-refresh '></i> {{ trans("messages.reset.text") }}</a>
		</div>
		{{ Form::close() }}
		<div class="col-md-5 col-sm-5 ">
			<div class="form-group pull-right">  
				<a href="{{URL::to('admin/artists-content/add-content/'.$userDetails->id)}}" class="btn btn-success btn-small align">{{ trans("Add New Content") }} </a>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-body ">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="16%">
							Content Title
						</th>
						<th width="16%">
							About Content
						</th>
						<th width="16%">
							Banner Image
						</th>
						<th width="16%">
							Photo/Embeded Path
						</th>
						<th >
							Status
						</th>
						<th width="14%">
							Featured Video
						</th>
						<th width="25%">{{ trans("messages.system_management.action") }}</th>
					</tr>
				</thead>
				<tbody >
					@if(!$result->isEmpty())
						@foreach($result as $record)
						<tr class="items-inner">
							<td data-th='{{ trans("messages.system_management.title") }}'>{{ $record->title }}</td>
							<td data-th='{{ trans("messages.system_management.title") }}'>{{ $record->description }}</td>
							<td data-th='{{ trans("Banner Image") }}'>
								@if($record->banner_image != '' && File::exists(CONTENT_IMAGE_ROOT_PATH.$record->banner_image))
									<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo CONTENT_IMAGE_URL.$record->banner_image; ?>">
										<div class="usermgmt_image">
											<img class="img-circle" src="<?php echo WEBSITE_URL.'image.php?width=100px&height=50px&image='.CONTENT_IMAGE_URL.'/'.$record->banner_image ?>">
										</div>
									</a>
								@else
									<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
										<div class="usermgmt_image">
											<img  height="100" width="100"  src="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
										</div>
									</a>
								@endif
							</td>
							<td data-th='{{ trans("messages.system_management.title") }}'>
								@if($record->content_type == 'embedded')
									
									<iframe width="100" height="80" src="{{$record->embedded_url}}" frameborder="0" allowfullscreen></iframe>
								@else
									@if($record->pdf_path != '' && File::exists(CONTENT_IMAGE_ROOT_PATH.$record->pdf_path))
										<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo CONTENT_IMAGE_URL.$record->pdf_path; ?>">
											<div class="usermgmt_image">
												<img class="img-circle" src="<?php echo WEBSITE_URL.'image.php?width=100px&height=50px&image='.CONTENT_IMAGE_URL.'/'.$record->pdf_path ?>">
											</div>
										</a>
									@endif
								@endif
							</td>
							<td  data-th='{{ trans("Status") }}'>
								@if($record->is_active	== 1)
									<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
								@else
									<span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
								@endif
							</td>
							<td align="center">
								@if($record->content_type == 'embedded')
									{{ Form::checkbox('is_featured', 1, $record->is_featured,["onclick"=>"change_featured('$record->id',this)"] )}}
								@endif
							</td>
							<td data-th='{{ trans("messages.system_management.action") }}'>
								@if($record->is_active)
									<a  title="Click To Deactivate" href="{{URL::to('admin/artists-content/update-status/'.$record->id.'/0')}}" class=" btn btn-warning btn-small status_any_item"><span class="ti-check"></span>
									</a>
								@else
									<a title="Click To Activate" href="{{URL::to('admin/artists-content/update-status/'.$record->id.'/1')}}" class=" btn btn-success btn-small status_any_item"><span class="ti-na"></span>
									</a>
								@endif
								<a href="{{URL::to('admin/artists-content/edit-content/'.$record->id."/".$userDetails->id)}}" title='{{ trans("messages.system_management.edit") }}' class="btn btn-primary">
									<i class="fa fa-pencil"></i>
								</a>
								
								<a href="{{URL::to('admin/artists-content/delete-content/'.$record->id)}}" title='{{ trans("messages.system_management.delete") }}' class="btn btn-danger delete_any_item">
									<i class="fa fa-trash-o"></i>
								</a> 
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td class="alignCenterClass" colspan="8" >{{ trans("messages.user_management.no_record_found_message") }}</td>
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

<script>
	function change_featured(user_id,element){
		if($(element).prop('checked')) {
			checked_value			=	1;
		} else {
			checked_value			=	0;
		}

		$.ajax({
			url:'{{URL("admin/artists-content/change-featured-status")}}',
			'type':'post',
			data:{'checked_value':checked_value,"content_id":user_id},
			async : false,
			success:function(response){
			}
		});
	}
</script>
@stop
