@extends('admin.layouts.default')
@section('content')
<!--set width of  Select box on date picker -->
<section class="content-header">
	<h1>
		{{ trans("Edit Content") }}
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/artists')}}">Artists</a></li>
		<li><a href="{{URL::to('admin/artists-content/'.$userDetails->id)}}">{{ trans("Profile Content") }}</a></li>
		<li class="active">{{ trans("Edit Content") }}</li>
	</ol>
</section>
<section class="content"> 
	{{ Form::open(['role' => 'form','url' => 'admin/artists-content/edit-content/'.$doc->id."/".$userDetails->id,'class' => 'mws-form', 'files' => true]) }}
	<div class="row pad">
		<div class="col-md-6">
			<div class="form-group <?php echo ($errors->first('title')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('title',trans("Content Title").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('title',isset($doc->title)?$doc->title:'',['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('title'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('description')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('description',trans("About Content").'<span class="requireRed">  </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::textarea('description',isset($doc->description)?$doc->description:'',['class' => 'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('description'); ?>
					</div>
				</div>
			</div>
			
			<div class="video_div">
				<div class="form-group <?php echo ($errors->first('content_type')) ? 'has-error' : ''; ?>">
					<div class="mws-form-row">
						{{ HTML::decode( Form::label('content_type', trans("Content Type").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
						<div class="mws-form-item">
							<span class="styled-selectors">
								{{ Form::radio('content_type', 'embedded',($doc->content_type=='embedded'?true:''),['class'=>'content_type']) }}
								<label for="confrm1"> Embedded Path</label>
							</span>
							<span class="styled-selectors">
								{{ Form::radio('content_type', 'pdf',($doc->content_type=='pdf'?true:''),['class'=>'content_type']) }}
								<label for="confrm1"> Upload Photo</label>
							</span>
							<div class="error-message help-inline">
								<?php echo $errors->first('content_type'); ?>
							</div>
						</div>
					</div>
				</div>	
				<div class="embedded_div">
					<div class="form-group <?php echo ($errors->first('banner_image')) ? 'has-error' : ''; ?>">
						{{ HTML::decode( Form::label('banner_image',trans("Banner Image").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }} <a class='tooltipHelp' title="" data-html="true" data-toggle="tooltip" data-placement="right"  data-original-title="<?php echo "The attachment must be a file of type:".IMAGE_EXTENSION; ?>" style="cursor:pointer;">
								<i class="fa fa-question-circle fa-2x"> </i>
							</a>
						<div class="mws-form-item">
							{{ Form::file('banner_image') }}
							<br />
							@if($doc->banner_image != '' && File::exists(CONTENT_IMAGE_ROOT_PATH.$doc->banner_image))
								<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo CONTENT_IMAGE_URL.$doc->banner_image; ?>">
									<div class="usermgmt_image">
										<img  src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&image='.CONTENT_IMAGE_URL.'/'.$doc->banner_image ?>">
									</div>
								</a>
							@else
								<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
									<div class="usermgmt_image">
										<img  height="100" width="100"  src="<?php echo WEBSITE_IMG_URL ?>admin/no_image.jpg">
									</div>
								</a>
							@endif
							<div class="error-message help-inline">
								<?php echo $errors->first('banner_image'); ?>
							</div>
						</div>
					</div>
					<div class="form-group <?php echo ($errors->first('embedded_url')) ? 'has-error' : ''; ?>">
						<div class="mws-form-row">
							{{ HTML::decode( Form::label('embedded_url', trans("Embedded Url").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
							<div class="mws-form-item">
								{{ Form::text('embedded_url',isset($doc->embedded_url)?$doc->embedded_url:'',['class'=>'form-control']) }}
								<span>Example: http://www.youtube.com</span>
								<div class="error-message help-inline">
									<?php echo $errors->first('embedded_url'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="form-group upload_video_div <?php echo ($errors->first('pdf_path')) ? 'has-error' : ''; ?>" style="display:none;">
					{{ HTML::decode( Form::label('pdf_path',trans("Photo").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }} <a class='tooltipHelp' title="" data-html="true" data-toggle="tooltip" data-placement="right"  data-original-title="<?php echo "The attachment must be a file of type:".IMAGE_EXTENSION; ?>" style="cursor:pointer;">
							<i class="fa fa-question-circle fa-2x"> </i>
						</a>
					<div class="mws-form-item">
						{{ Form::file('pdf_path') }}
						<br />
						@if($doc->pdf_path != '' && File::exists(CONTENT_IMAGE_ROOT_PATH.$doc->pdf_path))
							<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo CONTENT_IMAGE_URL.$doc->pdf_path; ?>">
									<div class="usermgmt_image">
										<img  src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&image='.CONTENT_IMAGE_URL.'/'.$doc->pdf_path ?>">
									</div>
								</a>
						@endif
						<div class="error-message help-inline">
							<?php echo $errors->first('pdf_path'); ?>
						</div>
					</div>
				</div>	
			</div>
		</div>		
	</div>
	<div class="mws-button-row">
		<div class="input" >
			<input type="submit" value="{{ trans('messages.user_management.save') }}" class="btn btn-danger">
			<a href="{{URL::to('admin/artists-content/edit-content/'.$doc->id."/".$userDetails->id)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("messages.user_management.reset") }}</a>
			<a href="{{URL::to('admin/artists-content/'.$userDetails->id)}}" class="btn btn-info"><i class=\"icon-refresh\"></i> {{ trans("Cancel") }}</a>
		</div>
	</div>
	{{ Form::close() }}
</section>
<script>
	$(function(){
		var type = $(".content_type:checked").val();
		if(type == 'embedded'){
			$(".embedded_div").show();
			$(".upload_video_div").hide();
		}
		if(type == 'pdf'){
			$(".embedded_div").hide();
			$(".upload_video_div").show();
		}	
	});
	$(".content_type").click(function(){
		var type = $(".content_type:checked").val();
		if(type == 'embedded'){
			$(".embedded_div").show();
			$(".upload_video_div").hide();
		}
		if(type == 'pdf'){
			$(".embedded_div").hide();
			$(".upload_video_div").show();
		}
	});
</script>
@stop
