@extends('admin.layouts.default')
@section('content')
<section class="content-header">
	<h1>
		 {{ trans($userDetails->full_name."'s Message") }} 
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li><a href="{{URL::to('admin/users')}}">{{ trans("Users Management") }}</a></li>
		<li class="active"> {{ trans($userDetails->full_name."'s Message") }}  </li>
	</ol>
</section>
<div class="box box-warning ">  
	{{ Form::open(['role' => 'form','url' => 'admin/users/message/'.$userId,'class' => 'mws-form','files'=>'true']) }}
	<div class="row pad">
		<div class="col-md-6 col-sm-6">	
			<div class="form-group <?php echo ($errors->first('subject')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('subject', trans("Subject").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::text('subject','',['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('subject'); ?>
					</div>
				</div>
			</div>
			<div class="form-group <?php echo ($errors->first('message')) ? 'has-error' : ''; ?>">
				{{ HTML::decode( Form::label('message', trans("Message").'<span class="requireRed"> * </span>', ['class' => 'mws-form-label'])) }}
				<div class="mws-form-item">
					{{ Form::textarea('message','',['class'=>'form-control']) }}
					<div class="error-message help-inline">
						<?php echo $errors->first('message'); ?>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<div class="mws-button-row">
		<div class="input">
			<input type="submit" value="{{ trans('messages.user_management.save') }}" class="btn btn-danger">
			<a href="{{URL::to('admin/users/message/'.$userId)}}" class="btn btn-primary"><i class=\"icon-refresh\"></i> {{ trans("messages.user_management.reset") }}</a> 
		</div>
	</div>
	{{ Form::close() }}
	<div class="row pad">
		<div class="col-md-12 col-sm-6">	
			<table class="table table-bordered table-responsive">
				<thead> 
					<tr>
						<th  width="25%">SUBJECT</th>  
						<th  width="25%">SENT</th>  
						<th  width="25%">SELECT</th>  
						<th  width="25%">DATE</th> 
					</tr>
				</thead>
				<tbody>
					@if(!$userMessages->isEmpty())
						@foreach($userMessages as $message)
							<tr>
								<td>{{$message->subject}}</td>
								<td>{{nl2br($message->message)}}</td>
								<td>&nbsp;</td>
								<td>{{date(('Y-m-d'),strtotime($message->created_at))}}</td>
							</tr>
						@endforeach
					@else
							<tr>
								<td colspan="4" align="center">No message found.</td> 
							</tr>
					@endif
				</tbody> 
			</table>
		</div> 
	</div>
</div>
@stop
