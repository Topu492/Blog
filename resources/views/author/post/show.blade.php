@extends('layouts.backend.app')

@section('title','Post')

@push('css')
<!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush


@section('content')

  <div class="container-fluid">
            <div class="block-header">
            </div>
            <a href="{{ route('author.post.index') }}" class="btn btn-danger">Back</a>

            @if($post->is_approved==false)
            <button type="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
            @else
            <button type="button" class="btn btn-success pull-right" disabled="">
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>

            @endif
            <br> <br>

            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $post->title }}
                               <small>Posted By <strong><a href="">{{ $post->user->name }}</a> On {{ $post->created_at->toFormattedDateString() }}</strong></small> 
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            
                                {!! $post->body !!}
                            
                               
                           
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                               Categories
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            @foreach($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>

                            @endforeach
                            
                               
                           
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                              Tags
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            @foreach($post->tags as $tag)
                            <span class="label bg-amber">{{ $tag->name }}</span>

                            @endforeach
                            
                               
                           
                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                             Feature Image
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                           <img class="image-responsive thumbnail" src="{{ asset('public/storage/post/'.$post->image) }}" alt="" style=" height: 170px;">
                            
                               
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@push('js')
<!-- Select Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <script src="{{ asset('public/assets/backend/plugins/tinymce/tinymce.js')}}"></script>

    <script>
        $(function () {
   

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('public/assets/backend/plugins/tinymce')}}';
});
    </script>



@endpush