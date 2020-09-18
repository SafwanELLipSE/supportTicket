@extends('layouts.app')

@section('additional_headers')

<!-- WYSIWYG Editor css -->
<!-- <link href="../assets/plugins/wysiwyag/richtext.css" rel="stylesheet" /> -->
<!-- side app-->
<link href="{{asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/select2/select2.min-dark.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<link href="{{asset('assets/switcher/css/switcher.css')}}" rel="stylesheet">
<link href="{{asset('assets/switcher/demo.css')}}s" rel="stylesheet">
<link href="{{asset('assets/plugins/gallery/gallery.css')}}" rel="stylesheet">

<meta http-equiv="imagetoolbar" content="no">
<style media="screen">
	.btn:focus, .btn:active, button:focus, button:active {
	  outline: none !important;
	  box-shadow: none !important;
	}

	#image-gallery .modal-footer{
	  display: block;
	}

	.thumb{
	  margin-top: 15px;
	  margin-bottom: 15px;
	}
</style>


@endsection

@section('content')

<div class="side-app">
	<!-- page-header -->
	<div class="page-header">
		<ol class="breadcrumb"><!-- breadcrumb -->
			<li class="breadcrumb-item"><a href="{{route('deshboard.home')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('ticket.display',$ticketID) }}">Display Ticket</a></li>
			<li class="breadcrumb-item active" aria-current="page">Uploaded Ticket Files</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->


<div class="card">
	<div class="card-header">
		<div class="card-title">Ticket Uploaded Images</div>
		<div class="card-options">
			<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
				<span class="fa fa-ellipsis-v"></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-right" role="menu">
				<li>
					<a href="#" data-toggle="modal" data-ticketid="{{$ticketID}}" data-target="#imageUploadModal"><i class="si si-plus mr-2"></i>Add New Image</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			@php
				$count = 1;
			@endphp
				@foreach($arrayOfImageFiles as $item)
				 @if($item != "")
					<div class="col-lg-3 col-md-4 col-xs-6 thumb">
						<div class="card">
								<div class="card-body">
									<a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
										 data-image="/ticket_images/{{$item}}"
										 data-target="#image-gallery">
											<img class="img-thumbnail" style="width: 15rem; height: 10rem;"
													 src="/ticket_images/{{$item}}"
													 alt="Another alt text">
									</a>
						@if(Auth::user()->canModarateTickets())
									<div class="col-md-12">
										<div class="collapse" id="collapseImage{{$count}}">
											<form action="{{ route('ticket.edit_image') }}" method="post" enctype="multipart/form-data">
												@csrf
												<div class="form-group">
													<div class="custom-file">
														<input type="hidden" name="ticket_id" value="{{ $ticketID }}">
														<input type="hidden" name="image_name" value="{{ $item }}">
														<input type="file" class="custom-file-input" name="imageToUpload" id="filesToUpload" />
														<label class="custom-file-label">Choose Images</label>
													</div>
												</div>
												<button type="submit" class="btn btn-sm btn-pill btn-success mt-1 mx-auto d-block">Submit</button>
											</form>
										</div>
									</div>
						@endif
								</div>
						@if(Auth::user()->canModarateTickets())
								<div class="card-footer mx-auto d-block">
									<div class="col-md-12">
										<button type="submit" class="btn btn-sm btn-pill btn-success" style="position: absolute; margin-right: 3rem;" data-toggle="collapse" data-target="#collapseImage{{$count}}" aria-expanded="false" aria-controls="collapseImage{{$count}}"><i class="si si-pencil"></i></button>
										<form action="{{ route('ticket.delete_image') }}" method="post" style="margin-left: 3rem;">
											@csrf
											<input type="hidden" name="ticket_id" value="{{ $ticketID }}">
											<input type="hidden" name="image_name" value="{{ $item }}">
											<button type="submit" class="btn btn-sm btn-pill btn-danger"><i class="fe fe-trash"></i></button>
										</form>
								  </div>
								</div>
						@endif
							</div>
	        </div>
					 @php
	 					 $count++;
	 				 @endphp
					@else
					 <div class="h3 text-secondary mx-auto d-block">
					 	 Sorry!! No image Uploaded.
					 </div>
					@endif
				@endforeach
      </div>
	</div>
</div>



<div class="card">
	<div class="card-header">
		<div class="card-title">Ticket Uploaded Files</div>
		<div class="card-options">
			<a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
				<span class="fa fa-ellipsis-v"></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-right" role="menu">
				<li>
					<a href="#" data-toggle="modal" data-ticketid="{{$ticketID}}" data-target="#fileUploadModal"><i class="si si-plus mr-2"></i>Add New File</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			@php
				$count = 1;
			@endphp

			@foreach($arrayOfFiles as $item)
				@if($item != "")
					<div class="col-lg-3 col-md-4 col-xs-6">
						<div class="card">
								<div class="card-body mx-auto d-block">
										@if(explode('.', $item)[1] == 'pdf')
											<i class="fa fa-file-pdf-o fa-4x text-red"></i>
										@elseif(explode('.', $item)[1] == 'txt')
											<i class="fa fa-file-text-o fa-4x text-indigo"></i>
										@elseif(explode('.', $item)[1] == 'doc' || explode('.', $item)[1] == 'docx')
											<i class="fa fa-file-word-o fa-4x text-primary"></i>
										@elseif(explode('.', $item)[1] == 'xls' || explode('.', $item)[1] == 'xlsx')
											<i class="fa fa-file-excel-o fa-4x text-lime"></i>
										@elseif(explode('.', $item)[1] == 'ppt' || explode('.', $item)[1] == 'pptx')
											<i class="fa fa-file-powerpoint-o fa-4x text-orange"></i>
										@elseif(explode('.', $item)[1] == 'mp3' || explode('.', $item)[1] == 'wav' || explode('.', $item)[1] == 'pcm'
										|| explode('.', $item)[1] == 'aiff' || explode('.', $item)[1] == 'aac' || explode('.', $item)[1] == 'flac')
											<i class="fa fa-file-audio-o fa-4x text-orange"></i>
										@elseif(explode('.', $item)[1] == 'mp4' || explode('.', $item)[1] == 'mpv' || explode('.', $item)[1] == 'mov'
										|| explode('.', $item)[1] == 'avi' || explode('.', $item)[1] == 'webm' || explode('.', $item)[1] == 'flv')
											<i class="fa fa-file-video-o fa-4x text-orange"></i>
										@elseif(explode('.', $item)[1] == 'rar' || explode('.', $item)[1] == 'zip')
											<i class="fa fa-file-archive-o fa-4x text-cyan"></i>
										@elseif(explode('.', $item)[1] == 'cpp' || explode('.', $item)[1] == 'php' || explode('.', $item)[1] == 'html'
										 || explode('.', $item)[1] == 'js' || explode('.', $item)[1] == 'css' || explode('.', $item)[1] == 'scss')
											<i class="fa fa-file-code-o fa-4x text-secondary"></i>
										@elseif(explode('.', $item)[1] == 'jpg' || explode('.', $item)[1] == 'png' || explode('.', $item)[1] == 'jpeg' || explode('.', $item)[1] == 'indd'
										 || explode('.', $item)[1] == 'gif' || explode('.', $item)[1] == 'ai' || explode('.', $item)[1] == 'psd' || explode('.', $item)[1] == 'tiff' || explode('.', $item)[1] == 'bmp')
											<i class="fa fa-file-image-o fa-4x text-yellow"></i>
										@else
											<i class="fa fa-files-o fa-4x text-orange"></i>
										@endif
								</div>
								<div class="card-footer mx-auto d-block">
									<div class="row text-center">
										<div class="col-12">
											<a href="#" class="text-center">{{ $item }}</a>
										</div>
										@if(Auth::user()->canModarateTickets())
											<button type="submit" class="btn btn-sm btn-pill btn-success mt-2" data-toggle="collapse" data-target="#collapseFile{{$count}}" aria-expanded="false" aria-controls="collapseFile{{$count}}"><i class="si si-pencil"></i></button>
										@endif
										<form action="{{route('ticket.download_file')}}" method="POST" enctype="multipart/form-data" class="mx-auto d-block">
											@csrf
												<input type="hidden" name="file_name" value="{{ $item }}">
												<div class="col-12 mt-2">
													<button type="submit" class="btn btn-sm btn-pill btn-purple mx-auto d-block">Download</button>
												</div>
										</form>
										@if(Auth::user()->canModarateTickets())
										<form action="{{ route('ticket.delete_file') }}" method="post" class="mt-2">
											@csrf
											<input type="hidden" name="ticket_id" value="{{ $ticketID }}">
											<input type="hidden" name="file_name" value="{{ $item }}">
											<button type="submit" class="btn btn-sm btn-pill btn-danger"><i class="fe fe-trash"></i></button>
										</form>
										<div class="col-md-12 mt-3">
											<div class="collapse" id="collapseFile{{$count}}">
												<form action="{{ route('ticket.edit_file') }}" method="post" enctype="multipart/form-data">
													@csrf
													<div class="form-group">
														<div class="custom-file">
															<input type="hidden" name="ticket_id" value="{{ $ticketID }}">
															<input type="hidden" name="file_name" value="{{ $item }}">
															<input type="file" class="custom-file-input" name="fileToUpload" id="filesToUpload"/>
															<label class="custom-file-label">Choose Files</label>
														</div>
													</div>
													<button type="submit" class="btn btn-sm btn-pill btn-success mt-1">Submit</button>
												</form>
											</div>
										</div>
										@endif
									</div>
								</div>
						</div>
					</div>

					@php
						$count++;
					@endphp
					@else
					 <div class="h3 text-secondary mx-auto d-block">
					 	 Sorry!! No file is there in the Database.
					 </div>
				@endif
			@endforeach
		</div>
	</div>
</div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                </button>

                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!--End side app-->


<!---Model Start--->
<div class="modal fade" id="imageUploadModal" aria-labelledby="fileUploadModal" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Upload New Images</h5>
			</div>
			<div class="modal-body">
					<div class="container">
						<form action="{{ route('ticket.upload_new_image') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<input type="hidden" name="ticket_id" id="ticket_id" value="">
								<label class="form-label">Upload Images :</label>
								<div class="custom-file row ml-1">
									<input type="file" class="custom-file-input" name="imagesToUpload[]" id="filesToUpload"  multiple="multiple" />
									<label class="custom-file-label">Choose Images</label>
								</div>
							</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Submit</button>
			 </form>
			</div>
		</div>
	</div>
</div>
<!---Model End--->

<!---Model Start--->
<div class="modal fade" id="fileUploadModal" aria-labelledby="fileUploadModal" aria-hidden="true" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="example-Modal3">Upload New Files</h5>
			</div>
			<div class="modal-body">
					<div class="container">
						<form action="{{ route('ticket.upload_new_file') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<input type="hidden" name="ticket_id" id="ticket_id" value="">
								<label class="form-label"> Upload Files :</label>
								<div class="custom-file row ml-1">
									<input type="file" class="custom-file-input" name="filesToUpload[]" id="filesToUpload"  multiple="multiple" />
									<label class="custom-file-label">Choose files</label>
								</div>
							</div>

					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success">Submit</button>
			 </form>
			</div>
		</div>
	</div>
</div>
<!---Model End--->

@endsection

@section('additional_scripts')
<script type="text/javascript">
$('#imageUploadModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var ticket_id = button.data('ticketid')
		var modal = $(this)
		modal.find('.modal-body #ticket_id').val(ticket_id);
})
$('#fileUploadModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget)
		var ticket_id = button.data('ticketid')
		var modal = $(this)
		modal.find('.modal-body #ticket_id').val(ticket_id);
})
</script>
<!-- WYSIWYG Editor js -->
<!-- <<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="../assets/plugins/wysiwyag/richText1.js"></script> -->

<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('js/ticket_internal_files.js') }}"></script>


@endsection
