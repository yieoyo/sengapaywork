@extends('front.layouts.default')
@section('content')


<!--- ckeditor js start  here -->
{{ HTML::script('js/bootstrap.js') }}
{{ HTML::script('js/ckeditor/ckeditor.js') }}

<!--begin::Page Vendors(used by this page) -->
<script src="{{WEBSITE_JS_URL}}plugins/custom/ckeditor/ckeditor-classic.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{WEBSITE_JS_URL}}pages/crud/forms/editors/ckeditor-classic.js" type="text/javascript"></script>

<!--- ckeditor js end  here -->

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

		<!-- begin:: Subheader -->
		<div class="kt-subheader   kt-grid__item" id="kt_subheader">
			<div class="kt-container ">
				<div class="kt-subheader__main">
					<h3 class="kt-subheader__title">
						<button class="kt-subheader__mobile-toggle kt-subheader__mobile-toggle--left" id="kt_subheader_mobile_toggle"><span></span></button>
						 {{ trans("messages.cms_pages.edit_cms_page") }}</h3>
					<div class="kt-subheader__breadcrumbs">
						<a href="{{WEBSITE_URL;}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="#" class="kt-subheader__breadcrumbs-link"> {{ trans("messages.header.general") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<a href="{{ route('user.general_cms_pages') }}" class="kt-subheader__breadcrumbs-link"> {{ trans("messages.cms_pages.cms_pages") }} </a>
						<span class="kt-subheader__breadcrumbs-separator"></span>
						<span class="kt-subheader__breadcrumbs-link"> {{ trans("messages.cms_pages.edit_cms_page") }} </span>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Subheader -->

		<!-- begin:: Content -->
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">

			<!--Begin::App-->
			<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

				<!--Begin:: App Aside Mobile Toggle-->
				<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
					<i class="la la-close"></i>
				</button>

				<!--End:: App Aside Mobile Toggle-->


				<div class="col-sm-12">
					{{ Form::open(['role' => 'form','url'=>"cms-pages-update", 'class'=>'kt-form kt-form--label-left', 'id'=>"editCmsPageForm"]) }}
					{{ Form::hidden('id',$results->id, ['class'=>'form-control', 'autocomplete'=>'off']) }}
					<div class="kt-portlet">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">{{ trans("messages.cms_pages.properties") }}</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.page_title") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('page_name',!empty($results->page_name)?$results->page_name:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('cms_pages.enter_page_title')]) }}
											</div>
											<span class="form-text text-muted name_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.page_slug") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('slug',!empty($results->slug)?$results->slug:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.enter_page_slug')]) }}
											</div>
											<span class="form-text text-muted slug_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.upload_slider") }}</label>
										<div class="col-sm-4">
											<div class="input-group">
												<div class="dropzone dropzone-default dropzone-success" id="upload_images">
													<div class="dropzone-msg dz-message needsclick">
														<h3 class="dropzone-msg-title">{{ trans("messages.cms_pages.drop_files_here_or_click_to_upload") }}</h3>
														<span class="dropzone-msg-desc"
														{{ trans("messages.cms_pages.only_image_pdf_and_psd_files_are_allowed_for_upload") }}</span>
													</div>
													@if(!empty($sliderImages))
													  @foreach($sliderImages as $sliderImage)
														<div class="dz-preview dz-processing dz-image-preview dz-success dz-complete img_blk_{{$sliderImage->id}}">
															<div class="dz-image">
																<img data-dz-thumbnail="" alt="logo-4-md.png" src="<?php echo WEBSITE_URL.'image.php?width=120px&image='.CMS_IMG_URL . $sliderImage->image; ?>">
															</div>  
															<div class="dz-details">    
																<?php /*<div class="dz-size"><span data-dz-size=""><strong></strong> </span></div> */ ?>   
																<div class="dz-filename"><span data-dz-name=""><?php echo str_replace(substr($sliderImage->image, 0, strpos($sliderImage->image, "/")).'/','',$sliderImage->image); ?></span></div>  
															</div> 
															<a class="dz-remove remove-dz-image" data-img-id="{{$sliderImage->id}}" href="javascript:undefined;" data-dz-remove="">{{ trans("messages.cms_pages.remove_file") }}</a>
														</div>
													  @endforeach
													@endif
													
												</div>
											</div>
											<span class="form-text text-muted slider_error"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
							
					</div>
					
					<div class="clearfix"></div>
					
					<div class="kt-portlet">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">{{ trans("messages.cms_pages.header") }}</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.theme") }}:</label>
										<div class="col-sm-4">
											<div class="kt-radio-inline">
												<label class="kt-radio">
													{{ Form::radio('theme','0',($results->theme == 0)? 1:'',['class'=>'']) }} {{trans('messages.cms_pages.default')}}
													<span></span>
												</label>
												<label class="kt-radio">
													{{ Form::radio('theme','1',($results->theme == 1)? 1:'',['class'=>'']) }} {{trans('messages.cms_pages.top')}}
													<span></span>
												</label>
											</div>
											<span class="form-text text-muted theme_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.main_title_english") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('title',!empty($results->title)?$results->title:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.enter_main_title_english')]) }}
											</div>
											<span class="form-text text-muted title_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.main_title_malay") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('title_ms',!empty($results->title_ms)?$results->title_ms:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.enter_main_title_malay')]) }}
											</div>
											<span class="form-text text-muted title_ms_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.subtitle_english") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('sub_title',!empty($results->sub_title)?$results->sub_title:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.enter_subtitle_english')]) }}
											</div>
											<span class="form-text text-muted sub_title_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.subtitle_malay") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::text('sub_title_ms',!empty($results->sub_title_ms)?$results->sub_title_ms:'', ['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.enter_subtitle_malay')]) }}
											</div>
											<span class="form-text text-muted sub_title_error"></span>
										</div>
									</div>
									<div class="form-group row" style="display:none;">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.font_color") }}</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::color('font_color',!empty($results->font_color)?$results->font_color:'#563d7c', ['class'=>'form-control']) }}
											</div>
											<span class="form-text text-muted font_color_error"></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					
					<div class="kt-portlet">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">{{ trans("messages.cms_pages.body") }}</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.editor_english") }}:</label>
										<div class="col-sm-10">
											<div class="input-group">
												{{ Form::textarea('body',!empty($results->body)?$results->body:'', ['class'=>'form-control', 'autocomplete'=>'off', 'id'=>'body']) }}
												<script type="text/javascript">
													// For CKEDITOR //
													CKEDITOR.replace( 'body',
													{
														height: 350,
														//width: 507,
														filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth : '640',
														filebrowserImageWindowHeight : '480',
														enterMode : CKEDITOR.ENTER_BR
													});
													CKEDITOR.config.allowedContent = true;
												</script>
											</div>
											<span class="form-text text-muted body_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.editor_malay") }}:</label>
										<div class="col-sm-10">
											<div class="input-group">
												{{ Form::textarea('body_ms',!empty($results->body_ms)?$results->body_ms:'', ['class'=>'form-control', 'autocomplete'=>'off', 'id'=>'body_ms']) }}
												<script type="text/javascript">
													// For CKEDITOR //
													CKEDITOR.replace( 'body_ms',
													{
														height: 350,
														//width: 507,
														filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth : '640',
														filebrowserImageWindowHeight : '480',
														enterMode : CKEDITOR.ENTER_BR
													});
													CKEDITOR.config.allowedContent = true;
												</script>
											</div>
											<span class="form-text text-muted body_ms_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.project") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::select('project',$projectLists,!empty($results->project)?$results->project:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.select_project')]) }}
											</div>
											<span class="form-text text-muted project_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.arrangement") }}:</label>
										<div class="col-sm-4">
											<div class="kt-radio-inline">
												<label class="kt-radio">
													{{ Form::radio('arrangement','1',($results->arrangement == 1)? 1:'',['class'=>'']) }} {{trans('messages.admin_dashboard.all')}}
													<span></span>
												</label>
												<label class="kt-radio">
													{{ Form::radio('arrangement','2',($results->arrangement == 2)? 1:'',['class'=>'']) }} {{trans('messages.cms_pages.group')}}
													<span></span>
												</label>
											</div>
											<span class="form-text text-muted arrangement_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans("messages.cms_pages.subproject_row") }}:</label>
										<div class="col-sm-4">
											<div class="input-group">
												{{ Form::select('sub_project_row',$SubProjectRows,!empty($results->sub_project_row)?$results->sub_project_row:'', ['class'=>'form-control','autocomplete'=>'off', 'placeholder'=>trans('messages.cms_pages.select_subproject_row')]) }}
											</div>
											<span class="form-text text-muted sub_project_error"></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					
					<div class="kt-portlet">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">{{ trans('messages.cms_pages.footer') }}</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.editor_english') }}:</label>
										<div class="col-sm-10">
											<div class="input-group">
												{{ Form::textarea('footer_body',!empty($results->footer_body)?$results->footer_body:'', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'footer_body']) }}
												<script type="text/javascript">
													// For CKEDITOR //
													CKEDITOR.replace( 'footer_body',
													{
														height: 350,
														//width: 507,
														filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth : '640',
														filebrowserImageWindowHeight : '480',
														enterMode : CKEDITOR.ENTER_BR
													});
													CKEDITOR.config.allowedContent = true;	
												</script>
											</div>
											<span class="form-text text-muted footer_body_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.editor_malay') }}:</label>
										<div class="col-sm-10">
											<div class="input-group">
												{{ Form::textarea('footer_body_ms',!empty($results->footer_body_ms)?$results->footer_body_ms:'', ['class'=>'form-control','autocomplete'=>'off', 'id'=>'footer_body_ms']) }}
												<script type="text/javascript">
													// For CKEDITOR //
													CKEDITOR.replace( 'footer_body_ms',
													{
														height: 350,
														//width: 507,
														filebrowserUploadUrl : '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth : '640',
														filebrowserImageWindowHeight : '480',
														enterMode : CKEDITOR.ENTER_BR
													});
													CKEDITOR.config.allowedContent = true;	
												</script>
											</div>
											<span class="form-text text-muted footer_body_ms_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.contact_us_form') }}:</label>
										<div class="col-sm-4">
											<div class="kt-radio-inline">
												<label class="kt-radio">
													{{ Form::radio('contactus_status','1',($results->contactus_status == 1)? 1:'',['class'=>'']) }} {{trans('messages.cms_pages.enable')}}
													<span></span>
												</label>
												<label class="kt-radio">
													{{ Form::radio('contactus_status','0',($results->contactus_status == 0)? 1:'',['class'=>'']) }} {{trans('messages.cms_pages.disable')}}
													<span></span>
												</label>
											</div>
											<span class="form-text text-muted contactus_status_error"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="clearfix"></div>
					
					<div class="kt-portlet">
						<div class="kt-portlet__head">
							<div class="kt-portlet__head-label">
								<h3 class="kt-portlet__head-title">{{ trans('messages.cms_pages.seo') }}</h3>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="kt-section__body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.meta_title') }}:</label>
										<div class="col-sm-6">
											<div class="input-group">
												{{ Form::text('meta_title',!empty($results->meta_title)?$results->meta_title:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
											</div>
											<span class="form-text text-muted meta_title_error"></span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.meta_keyword') }}:</label>
										<div class="col-sm-6">
											<div class="input-group">
												{{ Form::text('meta_keyword',!empty($results->meta_keywords)?$results->meta_keywords:'', ['class'=>'form-control', 'autocomplete'=>'off']) }}
											</div>
											<span class="form-text text-muted meta_keyword_error">{{ trans('messages.cms_pages.separate_keywords_by_comma') }}</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">{{ trans('messages.cms_pages.meta_description') }}:</label>
										<div class="col-sm-6">
											<div class="input-group">
												{{ Form::textarea('meta_description',!empty($results->meta_description)?$results->meta_description:'', ['class'=>'form-control', 'autocomplete'=>'off','rows'=>'10']) }}
											</div>
											<span class="form-text text-muted meta_description_error"></span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
						<div class="kt-portlet__foot">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-2 col-xl-2"></div>
									<div class="col-lg-10 col-xl-10">
										<input type="button" onclick="saveCmsPage(1)" value='{{ trans("messages.general_setting.save") }}' class="btn btn-success btn_1">&nbsp;
										<input type="button" onclick="saveCmsPage(2)" class="btn btn-brand btn_2" value="{{ trans('messages.cms_pages.save_create_new') }}" >&nbsp;
										<a href="{{ route('user.general_cms_pages') }}" class="btn btn-secondary">
										{{ trans('messages.personal_information.cancel') }}</a>
									</div>
								</div>
							</div>
						</div>
						{{ Form::close() }}
					</div>
					
					
				</div>


			</div>

			<!--End::App-->
		</div>

		<!-- end:: Content -->
	</div>
</div>



<script>
function saveCmsPage(KeyVal){
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	var formData  = $('#editCmsPageForm')[0];
	for (instance in CKEDITOR.instances){
		CKEDITOR.instances[instance].updateElement();
	}

	$(".btn_"+KeyVal).addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
	$.ajax({
		url: '{{ route("User.GeneralCmsPagesUpdate") }}',
		type:'POST',
		data: $('#editCmsPageForm').serialize(),
		data: new FormData(formData),
		dataType: 'json',
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,
		success: function(r){
			error_array 	= 	JSON.stringify(r);
			datas			=	JSON.parse(error_array);
			if(datas['success'] == 1) {
				if(KeyVal == 2){
					//location.reload();
					window.location.href	 =	"{{ route('user.general_cms_pages_add') }}";
				}else{
					window.location.href	 =	"{{ route('user.general_cms_pages') }}";
				}
			}else {
				$.each(datas['errors'],function(index,html){
					if(index == "page_name"){
						$(".name_error").addClass('error');
						$(".name_error").html(html);
					}else if(index == "slug"){
						$(".slug_error").addClass('error');
						$(".slug_error").html(html);
					}else if(index == "title"){
						$(".title_error").addClass('error');
						$(".title_error").html(html);
					}else if(index == "title_ms"){
						$(".title_ms_error").addClass('error');
						$(".title_ms_error").html(html);
					}else if(index == "sub_title"){
						$(".sub_title_error").addClass('error');
						$(".sub_title_error").html(html);
					}else if(index == "sub_title_ms"){
						$(".sub_title_ms_error").addClass('error');
						$(".sub_title_ms_error").html(html);
					}else if(index == "body"){
						$(".body_error").addClass('error');
						$(".body_error").html(html);
					}else if(index == "body_ms"){
						$(".body_ms_error").addClass('error');
						$(".body_ms_error").html(html);
					}else if(index == "project"){
						$(".project_error").addClass('error');
						$(".project_error").html(html);
					}else if(index == "sub_project_row"){
						$(".sub_project_error").addClass('error');
						$(".sub_project_error").html(html);
					}else if(index == "footer_body"){
						$(".footer_body_error").addClass('error');
						$(".footer_body_error").html(html);
					}else if(index == "footer_body_ms"){
						$(".footer_body_ms_error").addClass('error');
						$(".footer_body_ms_error").html(html);
					}else{
						$("input[name = "+index+"]").next().addClass('error');
						$("input[name = "+index+"]").next().html(html);
					}
				});
			}
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
		error: function(r){
			$('#loader_img').hide();
			$(".btn_"+KeyVal).removeClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', false);
		},
	});
}


$(".remove-dz-image").click(function(){
	var imageId = $(this).attr("data-img-id");
	$('#loader_img').show();
	$('.help-inline').html('');
	$('.help-inline').removeClass('error');
	$.ajax({
		url: '{{ route("User.DeleteCmsImage") }}',
		type:'POST',
		data: { 'imageId':imageId },
		dataType: 'json',
		success: function(r){
			//alert(".img_blk_"+imageId);
			$(".img_blk_"+imageId).html("");
			$('#loader_img').hide();
		},
		error: function(r){
			$('#loader_img').hide();
		},
	});
})
</script>


<script>

var KTDropzoneDemo = function () {
    // Private functions
    var demo1 = function () {
        var URL = '{{ route("User.UploadCmsImages") }}';
        var DeleteURL = '{{ route("User.DeleteCmsImages") }}';
        // file type validation
        $('#upload_images').dropzone({
            url: URL, // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
			removedfile: function(file) {
				var name = file.name;        
				$.ajax({
					type: 'POST',
					url: DeleteURL,
					data: "id="+name,
					dataType: 'html'
				});
				var _ref;
				return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
			},
            acceptedFiles: "image/*",
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    }

    var demo2 = function () {
        // set the dropzone container id
		
        //acceptedFiles: "image/*,application/pdf,.psd",
        var id = '#kt_dropzone_4';

        // set the preview element template
        var previewNode = $(id + " .dropzone-item");
        previewNode.id = "";
        var previewTemplate = previewNode.parent('.dropzone-items').html();
        previewNode.remove();

        var myDropzone4 = new Dropzone(id, { // Make the whole body a dropzone
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            maxFilesize: 1, // Max filesize in MB
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: id + " .dropzone-items", // Define the container to display the previews
            clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
        });

        myDropzone4.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { myDropzone4.enqueueFile(file); };
            $(document).find( id + ' .dropzone-item').css('display', '');
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
        });

        // Update the total progress bar
        myDropzone4.on("totaluploadprogress", function(progress) {
            $(this).find( id + " .progress-bar").css('width', progress + "%");
        });

        myDropzone4.on("sending", function(file) {
            // Show the total progress bar when upload starts
            $( id + " .progress-bar").css('opacity', '1');
            // And disable the start button
            file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone4.on("complete", function(progress) {
            var thisProgressBar = id + " .dz-complete";
            setTimeout(function(){
                $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
            }, 300)

        });

        // Setup the buttons for all transfers
        document.querySelector( id + " .dropzone-upload").onclick = function() {
            myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED));
        };

        // Setup the button for remove all files
        document.querySelector(id + " .dropzone-remove-all").onclick = function() {
            $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
            myDropzone4.removeAllFiles(true);
        };

        // On all files completed upload
        myDropzone4.on("queuecomplete", function(progress){
            $( id + " .dropzone-upload").css('display', 'none');
        });

        // On all files removed
        myDropzone4.on("removedfile", function(file){
            if(myDropzone4.files.length < 1){
                $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
            }
        });
    }

    var demo3 = function () {
         // set the dropzone container id
         var id = '#kt_dropzone_5';

         // set the preview element template
         var previewNode = $(id + " .dropzone-item");
         previewNode.id = "";
         var previewTemplate = previewNode.parent('.dropzone-items').html();
         previewNode.remove();

         var myDropzone5 = new Dropzone(id, { // Make the whole body a dropzone
             url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
             parallelUploads: 20,
             maxFilesize: 1, // Max filesize in MB
             previewTemplate: previewTemplate,
             previewsContainer: id + " .dropzone-items", // Define the container to display the previews
             clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
         });

         myDropzone5.on("addedfile", function(file) {
             // Hookup the start button
             $(document).find( id + ' .dropzone-item').css('display', '');
         });

         // Update the total progress bar
         myDropzone5.on("totaluploadprogress", function(progress) {
             $( id + " .progress-bar").css('width', progress + "%");
         });

         myDropzone5.on("sending", function(file) {
             // Show the total progress bar when upload starts
             $( id + " .progress-bar").css('opacity', "1");
         });

         // Hide the total progress bar when nothing's uploading anymore
         myDropzone5.on("complete", function(progress) {
             var thisProgressBar = id + " .dz-complete";
             setTimeout(function(){
                 $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
             }, 500)
         });
    }

    return {
        // public functions
        init: function() {
            demo1();
            demo2();
            demo3();
        }
    };
}();

KTUtil.ready(function() {
    KTDropzoneDemo.init();
});

</script>

@stop