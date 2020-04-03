@extends('layouts.app')

@section('additional_headers')
<style>
table {
  border-collapse: collapse;
	width: 100%;
}

table, th, td {
  border: 1px solid white;
}
.ticket-description{
	border: 1px solid blue;
	background-color: #020429;
	border-radius: 20px;
}
</style>

<!-- WYSIWYG Editor css -->
<!-- <link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" /> -->
<!-- side app-->

@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Display Ticket</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->
  <div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
      <div class="card">
        <div class="card-header">
            <h3 class="card-title">Display Ticket</h3>
        </div>
        <div class="card-body">
          <div class="card">
            <div class="product-gallery-data mb-3">
              <h3 class="mb-3 font-weight-semibold">{{$ticket->title}}</h3>
              <div class="mb-3">
                <span class="text-primary ml-2"><i class="fa fa-info-circle"></i>{{$ticket->department->name}}</span>
              </div>
              <div class="text-white mt-3 ml-2 p-2 ticket-description">{!!  $ticket->description  !!}</div>
              <p class="text-muted"></p>
              <dl class="product-gallery-data1">
                <dt class="text-primary">Category</dt>
                <dd>{{$ticket->ticketCategory->category ?? "Other"}}</dd>
              </dl>
              <dl class="product-gallery-data1">
                <dt class="text-primary">Priority</dt>
                <dd>{!! App\Ticket::getTicketPriorityString($ticket->priority) !!}</dd>
              </dl>
              <dl class="product-gallery-data1">
                <dt class="text-primary">Customer</dt>
                <dd>{{$ticket->customer_name}}</dd>
              </dl>
              <dl class="product-gallery-data1">
                <dt class="text-primary">Contact</dt>
                <dd>{{$ticket->customer_phone }}</dd>
              </dl>
						</div>

            <form action="{{ route('ticket.save_comments',$ticket->id) }}" method="POST" enctype="multipart/form-data" class="mt ng-pristine ng-valid">
	               @csrf
              <div class="form-group mb-0">
                <label class="sr-only" for="new-event">New event</label>
                <textarea class="form-control" id="comments" name="comments" placeholder="Comment something..." rows="3"></textarea>
              </div>
              <div class="btn-toolbar pull-right">
                <!-- <div class=""><a href="#" class="btn btn-sm btn-primary mr-2"><i class="fa fa-camera fa-lg"></i></a> <a href="#" class="btn btn-sm btn-info"><i class="fa fa-map-marker fa-lg"></i></a>
                </div> -->
                <button type="submit" class="btn btn-danger btn-sm ml-3">Post</button>
              </div>
            </form>
          </div>
          <div class="activities">
            @foreach($comments as $item)
            <section class="event card border">
              <div class="d-flex">
                <span class="thumb-sm  pull-left mr-sm"><img class="avatar avatar-md brround" src="../assets/images/users/female/18.jpg" alt="..."></span>
                <div>
                  <h4 class="event-heading"><a href="#">{{ $item->user->name }}</a><span><small class="text-muted"><a href="#">{{ $item->user->email }}</a></small></span></h4>
                  <p class="text-xs text-muted">{{ $item->created_at->format('M d, Y') }} at {{ $item->created_at->format('h:i A') }}</p>
                </div>
              </div>
              <p class="text-sm ">{{ $item->comment }}</p>
              <div class="border-top post-comments">
                <ul class="post-links mb-0 pt-2 pl-2 pr-2">
                  <li><a href="#">1 hour</a>
                  </li>
                  <li><a href="#"><span class="text-danger"><i class="fa fa-heart"></i> Like</span></a>
                  </li>
                  <li><a href="#">Comment</a>
                  </li>
                </ul>
              </div>
            </section>
           @endforeach
          </div>
        </div>
    </div>
   </div>
</div>
<!--End side app-->
@endsection

@section('additional_scripts')
<!-- WYSIWYG Editor js -->
<!-- <script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="../assets/plugins/wysiwyag/richText1.js"></script>
<script src="{{ asset('js/create_ticket.js') }}"></script> -->
@endsection
