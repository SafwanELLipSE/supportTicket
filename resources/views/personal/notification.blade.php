@extends('layouts.app')

@section('additional_headers')

@endsection

@section('content')
<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Notification Page</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->


@if(count(Auth::user()->unreadNotifications) != 0)
<div class="card mt-5 store">
	<div class="table-responsive">
		<div class="card-header bg-transparent border-0">
			<h3 class="card-title mb-0">Recent Notification</h3>
		</div>
		<table class="table card-table table-vcenter text-nowrap">
			<tbody>
			@foreach(Auth::user()->unreadNotifications as $notification)
				@if($notification->type == 'App\Notifications\TicketCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-green">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Created. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\SolveTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-lime">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Solved. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\CloseTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-danger">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Closed. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\DepartmentCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-pink">
							<i class="fa fa-user-plus"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['name'] }} Department was Created. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\AgentCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-primary">
							<i class="fa fa-user"></i>
						</div>
					</td>
					<td>
						Agent {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just created. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\ActiveEmpolyeeTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-check-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Active in <br> {{ $notification->data['title'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\InactiveEmpolyeeTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-times-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Inactive in <br> {{ $notification->data['title'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\createEmployeeNotification')
				<tr>
					<td>
						<div class="notifyimg bg-secondary">
							<i class="fa fa-user-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) created under <br> {{ $notification->data['department']  }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\TicketCommentsNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-primary">
							<i class="fa fa-comments"></i>
						</div>
					</td>
					<td>
						Comment on {{ $notification->data['ticket_title'] }}  <br>by {{ $notification->data['name'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\AssignTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-orange">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket is just Assigned <br> by {{ $notification->data['department'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\ActiveAgentDepartment')
				<tr>
					<td>
						<div class="notifyimg bg-purple">
							<i class="si si-user-follow"></i>
						</div>
					</td>
					<td>
					   Department {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Active for <br> {{ $notification->data['department'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\InactiveAgentDepartment')
				<tr>
					<td>
						<div class="notifyimg bg-pink">
							<i class="si si-user-unfollow"></i>
						</div>
					</td>
					<td>
					   Department {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Inactive for <br> {{ $notification->data['department'] }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editAgentNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gray">
							<i class="mdi mdi-account-alert"></i>
						</div>
					</td>
					<td>
						 Edit agent {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editEmployeeNotification')
				<tr>
					<td>
						<div class="notifyimg bg-teal">
							<i class="mdi mdi-account-settings-variant"></i>
						</div>
					</td>
					<td>
						Edit employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editDepartmentNotifiaction')
				<tr>
					<td>
						<div class="notifyimg bg-cyan">
							<i class="mdi mdi-account-edit"></i>
						</div>
					</td>
					<td>
						 Edit Department ({{ $notification->data['department'] }}) where <br> User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\addDepartmentCategoryNotification')
				<tr>
					<td>
						<div class="notifyimg bg-azure">
							<i class="ion ion-pricetags"></i>
						</div>
					</td>
					<td>
						 Category added to Department ({{ $notification->data['department'] }}) where <br> User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}). <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\deleteTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['image_name'], 20);
					@endphp
					<td>
						 Image, {{ $value2 }} deleted from ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\deleteTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['file_name'], 20);
					@endphp
					<td>
						 File, {{ $value2 }} deleted from ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['from_image_name'], 20);
						$value3 = str_limit($notification->data['to_image_name'], 20);
					@endphp
					<td>
						 Image, {{ $value2 }} was edited to {{ $value3 }} from ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['from_file_name'], 20);
						$value3 = str_limit($notification->data['to_file_name'], 20);
					@endphp
					<td>
						 File, {{ $value2 }} was edited to {{ $value3 }} from ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\uploadNewTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
					@endphp
					<td>
						 New Images has been Uploaded to ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\uploadNewTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
					@endphp
					<td>
						 New Files has been Uploaded to ticket <br> {{ $value }}. <div class="badge badge-primary badge-md">New</div>
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.mark_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Mark</button>
						</form>
					</td>
				</tr>
				@endif
			@endforeach
			<tr>
				<td></td>
				<td class="text-center">
						<a href="{{ route('deshboard.mark_all_notification',Auth::user()->id) }}">
							View all Notifications ({{ count(Auth::user()->unreadNotifications) }})
						</a>
				</td>
				<td class="text-right"></td>
			</tr>
			</tbody>
   </table>
  </div>
</div>
@endif


@if(count(Auth::user()->readNotifications) != 0)
<div class="card mt-5 store">
	<div class="table-responsive">
		<div class="card-header bg-transparent border-0">
			<h3 class="card-title mb-0">Old Notification</h3>
		</div>
		<table class="table card-table table-vcenter text-nowrap">
			<tbody>
			@foreach(Auth::user()->readNotifications as $notification)
				@if($notification->type == 'App\Notifications\TicketCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-green">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Created.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\SolveTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-lime">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Solved.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\CloseTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-danger">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket Closed.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\DepartmentCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-pink">
							<i class="fa fa-user-plus"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['name'] }} Department was Created.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\AgentCreateNotification')
				<tr>
					<td>
						<div class="notifyimg bg-primary">
							<i class="fa fa-user"></i>
						</div>
					</td>
					<td>
						Agent {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) has just created.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\ActiveEmpolyeeTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-check-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Active in <br> {{ $notification->data['title'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\InactiveEmpolyeeTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-times-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Inactive in <br> {{ $notification->data['title'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\createEmployeeNotification')
				<tr>
					<td>
						<div class="notifyimg bg-secondary">
							<i class="fa fa-user-circle"></i>
						</div>
					</td>
					<td>
						Employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) created under <br> {{ $notification->data['department']  }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\TicketCommentsNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-primary">
							<i class="fa fa-comments"></i>
						</div>
					</td>
					<td>
						Comment on {{ $notification->data['ticket_title'] }}  <br>by {{ $notification->data['name'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\AssignTicketNotification')
				<tr>
					<td>
						<div class="notifyimg bg-orange">
							<i class="fa fa-ticket"></i>
						</div>
					</td>
					<td>
						{{ $notification->data['title'] }} Ticket is just Assigned <br> by {{ $notification->data['department'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\ActiveAgentDepartment')
				<tr>
					<td>
						<div class="notifyimg bg-purple">
							<i class="si si-user-follow"></i>
						</div>
					</td>
					<td>
					   Department {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Active for <br> {{ $notification->data['department'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\InactiveAgentDepartment')
				<tr>
					<td>
						<div class="notifyimg bg-pink">
							<i class="si si-user-unfollow"></i>
						</div>
					</td>
					<td>
					   Department {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) Inactive for <br> {{ $notification->data['department'] }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editAgentNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gray">
							<i class="mdi mdi-account-alert"></i>
						</div>
					</td>
					<td>
						 Edit agent {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editEmployeeNotification')
				<tr>
					<td>
						<div class="notifyimg bg-teal">
							<i class="mdi mdi-account-settings-variant"></i>
						</div>
					</td>
					<td>
						Edit employee {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editDepartmentNotifiaction')
				<tr>
					<td>
						<div class="notifyimg bg-cyan">
							<i class="mdi mdi-account-edit"></i>
						</div>
					</td>
					<td>
						 Edit Department ({{ $notification->data['department'] }}) where <br> User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) is done.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\addDepartmentCategoryNotification')
				<tr>
					<td>
						<div class="notifyimg bg-azure">
							<i class="ion ion-pricetags"></i>
						</div>
					</td>
					<td>
						 Category added to Department ({{ $notification->data['department'] }}) where <br> User {{ $notification->data['name'] }} ({{ $notification->data['email'] }}).
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif


				@if($notification->type == 'App\Notifications\deleteTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['image_name'], 20);
					@endphp
					<td>
						 Image, {{ $value2 }} deleted from ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\deleteTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-danger">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['file_name'], 20);
					@endphp
					<td>
						 File, {{ $value2 }} deleted from ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['from_image_name'], 20);
						$value3 = str_limit($notification->data['to_image_name'], 20);
					@endphp
					<td>
						 Image, {{ $value2 }} was edited to {{ $value3 }} from ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\editTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
						$value2 = str_limit($notification->data['from_file_name'], 20);
						$value3 = str_limit($notification->data['to_file_name'], 20);
					@endphp
					<td>
						 File, {{ $value2 }} was edited to {{ $value3 }} from ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\uploadNewTicketImageNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-picture-o"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
					@endphp
					<td>
						 New Images has been uploaded to ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
				@if($notification->type == 'App\Notifications\uploadNewTicketFileNotification')
				<tr>
					<td>
						<div class="notifyimg bg-gradient-success">
							<i class="fa fa-file"></i>
						</div>
					</td>
					@php
						$value = str_limit($notification->data['title'], 20);
					@endphp
					<td>
						 New Files has been uploaded to ticket <br> {{ $value }}.
						<div class="small text-muted">{{ $notification->created_at->format('F j, Y, g:i a') }}</div>
					</td>
					<td class="text-right">
						<form action="{{ route('deshboard.delete_notification') }}" method="post" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name= "notification_id" value="{{$notification->id}}">
								<input type="hidden" name= "user_id" value="{{Auth::user()->id}}">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</td>
				</tr>
				@endif
			@endforeach
			</tbody>
   </table>
  </div>
</div>
@endif




</div>
<!--End side app-->
@endsection

@section('additional_scripts')

@endsection
