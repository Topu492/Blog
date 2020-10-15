<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
	public function index(){
		$subscribers=Subscriber::latest()->get();
		return view('admin.subscriber',compact('subscribers'));
	}
	public function destroy($subscriber){
		$subscriber=Subscriber::findorfail($subscriber)->delete();
		Toastr::success('Subscriber Successfully Deleted:)','Success');
       return redirect()->back();
	}
}
