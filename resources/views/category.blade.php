@extends('layouts.frontend.app')

@section('title','Categories')

@push('css')
<link href="{{asset('public/assets/frontend/css/category/css/styles.css') }}" rel="stylesheet">

<link href="{{asset('public/assets/frontend/css/category/css/responsive.css') }}" rel="stylesheet">
<style>
     .favorite_post{
        color: blue;

        }
        .slider {
    height: 400px;
    width: 100%;
    background-image: url({{ asset('public/storage/category/'.$category->image) }});
    background-size: cover;
    </style>

@endpush

@section('content')
<div class="slider display-table center-text" >
        <h1 class="title display-table-cell"><b >{{ $category->name }}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @if($posts->count()>0)
                 @foreach($posts as $post)
                             <div class="col-lg-4 col-md-6">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        <div class="blog-image"><img src="{{ asset('public/storage/post/'.$post->image) }}" alt="{{ $post->title }}"></div>
                                        <a class="avatar" href="{{ route('author.profile',$post->user->username) }}"><img src="{{ asset('public/storage/profile/'.$post->user->image) }}" alt="Profile Image"></a>
                                        <div class="blog-info">
                                            <h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>
                                            <ul class="post-footer">

                                                <li>
                                                    @guest
                                             <a href="#"><i class="ion-heart" onclick="toastr.info('To add favorite list,you login first','Info',{
                                                            closeButton:true,
                                                            progessBar:true,

                                        })"></i>{{ $post->favorite_users->count() }}</a>

                                         @else
                                 <a  class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()==0 ? 'favorite_post' : '' }}" href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id  }}').submit();" ><i class="ion-heart"></i>{{ $post->favorite_users->count() }}
                                      </a>

                                     <form action="{{ route('favorite.add',$post->id) }}" method="post" style="display: none;" id="favorite-form-{{ $post->id }}">
                                            @csrf
                                        </form>

                                        @endguest


                                         </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                         <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                            </ul>
                                            </div><!-- blog-info -->
                                            </div><!-- single-post -->
                                            </div><!-- card -->
                                            </div><!-- col-lg-4 col-md-6 -->


                            @endforeach

                            @else

                             <div class="col-lg-4 col-md-6">
                                <div class="card h-100">
                                    <div class="single-post post-style-1">
                                        
                                        <div class="blog-info">
                                            <h4 class="title">Sorry,no Post found:(</h4>
                                    
                                            </div><!-- blog-info -->
                                            </div><!-- single-post -->
                                            </div><!-- card -->
                                            </div><!-- col-lg-4 col-md-6 -->


                            


                            @endif



            </div><!-- row -->


        </div><!-- container -->
    </section><!-- section -->



@endsection

@push('js')



@endpush