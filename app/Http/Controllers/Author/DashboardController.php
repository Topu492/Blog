<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
     public function index(){
     	$user=Auth::user();
     	$posts=$user->posts;
     	$popular_post=$user->posts()
     	->withCount('comments')
     	->withCount('favorite_users')
     	->orderBy('view_count','desc')
     	->orderBy('comments_count')
     	->orderBy('favorite_users_count')
     	->take(5)->get();
     	$total_pending_post=$posts->where('is_approved','false')->count();
     	$all_view=$posts->sum('view_count');
    	return view('author.dashboard',compact('posts','popular_post','total_pending_post','all_view'));
    }
}
