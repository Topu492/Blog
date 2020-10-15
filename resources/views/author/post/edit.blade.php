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

            <form method="post" action="{{ route('author.post.update',$post->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               EDIT NEW POST
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="email_address" class="form-control" name="title" value="{{ $post->title }}">
                                        <label class="form-label">Post Title</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Feature Image</label>
                                    <input type="file" name="image">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="publish" class="filled-in" name="status" {{ $post->status==true ? 'checked' : '' }}>
                                    <label for="publish">Publish</label>
                                </div>

                            
                               
                           
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Categories And Tags
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label for="categories {{ $errors->has('categories') ? 'focused-error' : ''  }}">Select Category</label>
                                        <select name="categories[]" id="categories" class="form-control show-trick" data-live-search="true" multiple>
                                            @foreach($categories as $category)
                                            <option @foreach($post->categories as $postcategory){{ $category->id==$postcategory->id ? 'selected' : '' }}   @endforeach value="{{ $category->id }}">{{ $category->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <label for="categories {{ $errors->has('tags') ? 'focused-error' : ''  }}">Select Tag</label>
                                        <select name="tags[]" id="tags" class="form-control show-trick" data-live-search="true" multiple>
                                            @foreach($tags as $tag)
                                            <option @foreach($post->tags as $posttag) {{ $posttag->id==$tag->id ? 'selected' : '' }} @endforeach value="{{ $tag->id }}">{{ $tag->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               

                            
                                <br>
                                <a type="button" href="{{ route('author.post.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                                 <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                           
                        </div>
                    </div>
                </div>
            </div>
             <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               BODY
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            <textarea name="body" id="tinymce" cols="30" rows="10">{{ $post->body }}</textarea>
                                

                
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->

             </form>
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