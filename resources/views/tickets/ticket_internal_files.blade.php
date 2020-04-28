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
			<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Uploaded Ticket Files</li>
		</ol><!-- End breadcrumb -->
	</div>
	<!-- End page-header -->


<div class="card">
	<div class="card-header">
		<div class="card-title">Ticket Uploaded Images</div>
	</div>
	<div class="card-body">
		<div class="row">
				@foreach($arrayOfImageFiles as $item)
				 @if($item != "")
					<div class="col-lg-3 col-md-4 col-xs-6 thumb">
	            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
	               data-image="/ticket_images/{{$item}}"
	               data-target="#image-gallery">
	                <img class="img-thumbnail"
	                     src="/ticket_images/{{$item}}"
	                     alt="Another alt text">
	            </a>
	        </div>
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
	</div>
	<div class="card-body">
		<div class="row">
			@foreach($arrayOfFiles as $item)
				@if($item != "")
					<div class="col-md-12 col-xl-3">
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
								<div class="card-footer">
									<div class="row">
										<form action="{{route('ticket.download_file')}}" method="POST" enctype="multipart/form-data">
											@csrf
												<div class="col-12">
													<input type="hidden" name="file_name" value="{{ $item }}">
													<a href="#">{{ $item }}</a>
												</div>
												<div class="col-12 mt-2">
													<button type="submit" class="btn btn-sm btn-pill btn-success mx-auto d-block">Download</button>
												</div>
										</form>
									</div>
								</div>
						</div>
					</div>
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


@endsection

@section('additional_scripts')

<!-- WYSIWYG Editor js -->
<!-- <<script src="../assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="../assets/plugins/wysiwyag/richText1.js"></script> -->

<script src="{{ asset('assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

<script src="{{ asset('js/ticket_internal_files.js') }}"></script>


@endsection
