@extends('layouts.backend.app')

@section('title','Favorite')

@push('css')

<!-- JQuery DataTable Css -->
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">
            <div class="block-header">
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALLS FAVORITE POST
                                <span class="badge bg-blue">{{ $posts->count() }}</span>
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">visibility </i></th>
                                           {{--<th><i class="material-icons">visibility </i></th>--}}
                                             <th><i class="material-icons">favorite </i></th>
                                             <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                         <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th><i class="material-icons">visibility </i></th>
                                           {{--<th><i class="material-icons">visibility </i></th>--}}
                                             <th><i class="material-icons">favorite </i></th>
                                             <th>Action</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    	@foreach($posts as $key=>$post)

                                    	<tr>
                                    		<th>{{ $key + 1 }}</th>
                                    		<th>{{Str::limit($post->title,'3')}}</th>
                                            <th>{{ $post->user->name }}</th>
                                            
                                            <th>{{$post->view_count}}</th>
                                            <th>{{$post->favorite_users->count() }}</th>
                                           
                                    		<th class="text-center">
                                                 <a class=" btn btn-info waves-effect" href="">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                
                                    			<button type="button" class="btn btn-danger waves-effect" onclick="deleteFavorite({{$post->id }})"> <i class="material-icons">delete</i></button>
                                    			<form action="{{ route('favorite.add',$post->id) }}" method="post"  style="display:none;"  id="delete-form-{{$post->id }}">
                                    				
                                    				@csrf
                                    			</form>
                                    		</th>
                                    	</tr>

                                    	@endforeach
                                       
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>


@endsection

@push('js')

<!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

     <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
     <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteFavorite(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>


@endpush