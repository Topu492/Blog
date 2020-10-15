<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request,$id){
    	$comment=new Comment();
    	$comment->user_id=Auth::id();
    	$comment->post_id=$id;
    	$comment->comment=$request->comment;
    	$comment->save();
    	Toastr::success('Comment Successfully Added','Success');
   		return redirect()->back();
    }
}
