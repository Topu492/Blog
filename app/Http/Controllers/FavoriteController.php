<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($id){

    	$user=Auth::user();
    	$favoritecount=$user->favorite_posts()->where('post_id',$id)->count();
    	if($favoritecount==0){
    		$user->favorite_posts()->attach($id);
    		Toastr::success('Post Successfully Added To Your Favorite List:)','Success');
   			return redirect()->back();
    	}
    	else{
    		$user->favorite_posts()->detach($id);
    		Toastr::success('Post Successfully Removed To Your Favorite List:)','Success');
   			return redirect()->back();

    	}
    }
}
