@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
		 {{ trans("User Detail") }} 
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}">{{ trans("Users Management") }}</a></li>
		<li class="active"> {{ trans("User Detail") }}  </li>
	</ol>
</section>
<div class="box box-warning "> 
	<div class="row pad">
		<div class="col-md-6 col-sm-6">	
			<table class="table table-bordered table-responsive">
				<tbody>
					<tr>
						<th  width="30%">Profile Image</th>
						<td data-th='First Name'>
							<?php 
								$image		=	isset($userDetails->image) ? $userDetails->image : '';
							?>
							@if($image != '' && File::exists(USER_PROFILE_IMAGE_ROOT_PATH.$image))
								<a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo USER_PROFILE_IMAGE_URL.$userDetails->image; ?>">
									<div class="usermgmt_image">
										<img  src="<?php echo WEBSITE_URL.'image.php?width=150px&height=150px&image='.USER_PROFILE_IMAGE_URL.'/'.$userDetails->image ?>">
									</div>
								</a>
							@endif
						</td>
					</tr>
					<tr>
						<th  width="30%">First Name</th>
						<td data-th='First Name'>{{ isset($userDetails->first_name) ? $userDetails->first_name:'' }}</td>
					</tr>
					<tr>
						<th  width="30%">Last Name</th>
						<td data-th='Last Name'>{{ isset($userDetails->last_name) ? $userDetails->last_name :'' }}</td>
					</tr>
					<tr>
						<th  width="30%">Full Name</th>
						<td data-th='Last Name'>{{ isset($userDetails->full_name) ? $userDetails->full_name :'' }}</td>
					</tr>
					<tr>
						<th  width="30%">Gender</th>
						<td data-th='Gender'>{{ isset($userDetails->gender) ? ucfirst($userDetails->gender) :'' }}</td>
					</tr>
					<tr>
						<th  width="30%">Date Of Birth</th>
						<td data-th='Gender'>{{ isset($userDetails->date_of_birth) ? date(Config::get("Reading.date_format") , strtotime($userDetails->date_of_birth)) :'' }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-6 col-sm-6">	
			<table class="table table-bordered table-responsive">
				<tr>
					<th  width="30%">Email</th>
					<td data-th='Email'><a href="mailTo:{{ $userDetails->email }}">{{ $userDetails->email }}</a></td>
				</tr>
				
			
				<tr>
					<th  width="30%">Phone Number</th>
					<td data-th='Phone'>{{ isset($userDetails->phone) ? $userDetails->phone :''  }}</td>
				</tr>
				
				<tr>
					<th  width="30%">Address</th>
					<td data-th='Address'>{{ str_replace("\n","<br />",$userDetails->address) }}</td>
				</tr>
				<tr>
					<th width="20%" >City</th>
					<td data-th='Country'>{{ $userDetails->city }}</td>
				</tr>
				<tr>
					<th width="20%" >State</th>
					<td data-th='Country'>{{ $userDetails->state }}</td>
				</tr>
				<tr>
					<th width="20%" >Country</th>
					<td data-th='Country'>{{ $userDetails->country_name }}</td>
				</tr>
				<tr>
					<th  width="30%">Created On</th>
					<td data-th='Created On'>{{ date(Config::get("Reading.date_format") , strtotime($userDetails->created_at)) }}</td>
				</tr>
			</table>
		</div>
	</div>
</div>
@stop
