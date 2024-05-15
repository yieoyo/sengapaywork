@extends('admin.layouts.default')
@section('content')
<script type="text/javascript">
	var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
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
	/* For open Email detail popup */
	function getPopupClient(id){
		$.ajax({
			url: '<?php echo URL::to('admin/email-logs/email_details')?>/'+id,
			type: "POST",
			success : function(r){
				$("#getting_basic_list_popover").html(r);
				$("#getting_basic_list_popover").modal('show');
			}
		});
	}
	
</script>
<section class="content-header">
	<h1>
	  {{ trans("Font Manager") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"> {{ trans("Font Manager") }}</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		{{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form']) }}
		{{ Form::hidden('display') }}
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('font_name',((isset($searchVariable['font_name'])) ? $searchVariable['font_name'] : ''), ['class' => ' form-control','placeholder'=>'Font Name']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group ">  
					{{ Form::text('font_family_css_text',((isset($searchVariable['font_family_css_text'])) ? $searchVariable['font_family_css_text'] : ''), ['class' => 'form-control','placeholder'=>'Font Family']) }}
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<button class="btn btn-primary"><i class='fa fa-search '></i> Search</button>
				<a href='{{ route("$modelName.index")}}'  class="btn btn-primary"> <i class="fa fa-refresh "></i> {{ trans('messages.global.reset') }}</a>
			</div>
			
			<div class="col-md-3 col-sm-3 ">
				@if(Config::get('app.debug'))
					<a href='{{route("$modelName.add")}}'  class="btn btn-success btn-small align pull-right"> {{ trans("messages.$modelName.add_new") }} </a>
				@endif
			</div>
		{{ Form::close() }}
	
	</div>
	<div class="box">
		<div class="box-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<!--<th width="5%"></th>-->
						<th width="10%">
							{{
								link_to_route(
									"$modelName.index",
									trans("messages.$modelName.font_name"),
									array(
									'sortBy' => 'font_name',
									'order' => ($sortBy == 'font_name' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
									),
									array('class' => (($sortBy == 'font_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'font_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th width="30%">
							{{ 'Description' }}
						</th>
						<?php /* <th width="10%">
							{{ 'Image' }}
						</th> */ ?>
						<th width="10%">
							{{ 'Font Family' }}
						</th>
						<th width="15%">
							{{
								link_to_route(
									"$modelName.index",
									trans("messages.$modelName.created_at"),
									array(
									'sortBy' => 'created_at',
									'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc',
									$query_string
									),
									array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
						</th>
						<th >
							{{
								link_to_route(
								"$modelName.index",
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
					<tbody id="powerwidgets">
						@if(!$model->isEmpty())
							@foreach($model as $result)
							<?php
								/* echo '<pre>';
								print_r($result);die; */
							?>
								<tr class="items-inner">
									<!--<td data-th='{{ trans("messages.$modelName.select") }}'>
										{{ Form::checkbox('status',$result->id,null,['class'=> 'userCheckBox'] )}}
									</td>-->
									<td data-th='{{ trans("messages.$modelName.page_name") }}'>{{ $result->font_name }}</td>
									<td data-th='{{ trans("messages.$modelName.block_name") }}'>{{ substr(strip_tags($result->font_description), 0, 200)  }}</td>
									<?php /* <td data-th='{{ trans("Image") }}'>
										@if($result->image != '' && File::exists(BLOCK_ROOT_PATH.$result->image))
											<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo BLOCK_URL.$result->image; ?>">
												<div class="usermgmt_image">
													<img class="img-circle" src="<?php echo WEBSITE_URL.'image.php?width=100px&height=100px&image='.BLOCK_URL.'/'.$result->image ?>">
												</div>
											</a>
										@else
											<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
												<div class="usermgmt_image">
													<img class="img-circle" width="150px" height="150px" src="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
												</div>
											</a>
										@endif
									</td> */ ?>
									<td  data-th='{{ trans("Order") }}'>
										<span style="color:#0088CC;cursor:pointer;" id="link_<?php echo $result->font_family_css_text."_".$result->id ?>" onclick="change(this)">
											{{ $result->font_family_css_text }}
										</span>
											<div id="change_div<?php echo $result->id ?>" style="display:none; ">
												{{ Form::text(
														'order_by', 
														$result->font_family_css_text,
														['class'=>'form-control','id'=>'order_by_'.$result->id]
													) 
												}}
												<a class="btn btn btn-success"  id="link_<?php echo $result->font_family_css_text."_".$result->id ?>" onclick="order(this)"  href="javascript:void(0);">
													<i class="fa fa-check"></i>
												</a>
											</div>
									</td>
									
									<td data-th='{{ trans("messages.$modelName.created_at") }}'>{{ 		date(Config::get("Reading.date_format") , strtotime($result->created_at)) }}</td>
									<td  data-th='{{ trans("messages.$modelName.status") }}'>
										@if($result->is_active	== 1)
											<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
										@else
											<span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
										@endif
									</td>
									<td data-th='{{ trans("messages.global.action") }}'>
										@if($result->is_active == 1)
											<a  title="Click To Deactivate" href='{{route("$modelName.status",array($result->id,0))}}' class="btn btn-success btn-small status_any_item"><span class="fa fa-ban"></span>
											</a>
										@else
											<a title="Click To Activate" href='{{route("$modelName.status",array($result->id,1))}}' class="btn btn-warning btn-small status_any_item"><span class="fa fa-check"></span>
											</a> 
										@endif 
										<a href='{{route("$modelName.edit","$result->id")}}' class="btn btn-primary" title="Edit"> <span class="fa fa-pencil"></span></a>
										@if(Config::get('app.debug'))
											<a href='{{route("$modelName.delete","$result->id")}}' data-delete="delete" class="delete_any_item btn btn-danger" title="Delete">
											<span class="fa fa-trash-o"></span>
											</a>
										@endif
									</td>
								</tr>
							@endforeach  
							@else
							<tr>
								<td colspan="7" class="alignCenterClass"> {{ trans("messages.global.no_record_found_message") }}</td>
							</tr>
							@endif 
					</tbody>
			</table>
		</div>
		<div class="box-footer clearfix">	
			<div class="col-md-3 col-sm-4 "></div>
			<div class="col-md-9 col-sm-8 text-right ">@include('pagination.default', ['paginator' => $model])</div>
		</div>
	</div>
</section>
{{ HTML::script('js/admin/lightbox.js') }}
<script type="text/javascript">
// when click on order by field value,button will appear to change the order by value
function change(obj){
	id_array		=	obj.id.split("_");

	current_id		=	id_array[2]; 
		
	current_order	=	id_array[1];
	
	order_by		=	$("#order_by_"+current_id).val();
	$("#change_div"+current_id).show();
	$("#link_"+current_order+"_"+current_id).hide();
	return false; 
 }
 
 // for update the orderby value
  function order(obj){
	
	id_array		=	obj.id.split("_");
	current_id		=	id_array[2]; 
	current_order	=	id_array[1]; 
	order_by		=	$("#order_by_"+current_id).val();
	$.ajax({
		type: "POST",
		url: "<?php  echo route('Block.change_order'); ?>",
		data: { current_id: current_id,current_order: current_order,order_by: order_by },
		success : function(res){
			if(res.success != 1) {
				alert(res.message); return false; 
			}else{
			
			//$("#order_by_"+current_id).css({'border-color':'#CCCCCC'});
			$("#change_div"+current_id).hide();
			$("#link_"+current_order+"_"+current_id).html(res.order_by);
			$("#link_"+current_order+"_"+current_id).show();
				return true;
		}
	 }
	}) 
		return false; 
 }
 
</script>
@stop

