<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    	$posts=Post::all();
    	$popular_posts=Post::withCount('comments')
    						->withCount('favorite_users')
    						->orderBy('view_count','desc')
    						->orderBy('comments_count')
    						->orderBy('favorite_users_count')
    						->take(5)
    						->get();
    	$total_pending_post=Post::where('is_approved',false)->count();
    	$all_views=Post::sum('view_count');
    	$total_author=User::where('role_id',2)->count();
    	$new_author=User::where('role_id',2)->whereDate('created_at',Carbon::today())->count();
    	$active_author=User::where('role_id',2)
    					->withCount('posts')				
    					->withCount('comments')				
    					->withCount('favorite_posts')
    					->orderBy('posts_count','desc')				
    					->orderBy('comments_count','desc')				
    					->orderBy('favorite_posts_count','desc')
    					->take(10)
    					->get();
    	$total_category=Category::all()->count();								
    	$total_tag=Tag::all()->count();								
    	return view('admin.dashboard',compact('posts','popular_posts','total_pending_post','all_views','total_author','new_author','active_author','total_category','total_tag'));
    }
}
