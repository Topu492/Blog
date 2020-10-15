<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
    	$posts=Auth::user()->posts;
    	return view('author.comment',compact('posts'));

    }

    public function delete($id){
    	$comment=Comment::find($id);
    	if($comment->post->user->id=Auth::id()):
    		{
    			$comment->delete();
    			Toastr::success('Comment Successfully Deleted:)','Success');
    		}
    		else{
    			Toastr::Error('You are not authorized to delete this comments:)','Error');

    		}
    	
   		return redirect()->back();

    }
}
