@extends('layouts.backend.app')

@section('title','Category')

@push('css')

@endpush

@section('content')

  <div class="container-fluid">
            <div class="block-header">
            </div>

            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT NEW CATEGORY
                                
                            </h2>
                           
                        </div>
                        <div class="body">
                            <form method="post" action="{{ route('admin.category.update',$category->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="{{ $category->name }}" id="email_address" class="form-control" name="name">
                                        <label class="form-label">Category Name</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="image">
                                </div>

                            
                                <br>
                                <a type="button" href="{{ route('admin.category.index') }}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                                 <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
        </div>


@endsection

@push('js')



@endpush