<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index(){
    	return view('admin.settings');
    }

    public function profileupdate(Request $request){
    	$validatedData = $request->validate([
	'name' => 'required',
	'email' => 'required',
	'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
]);
    	$image=$request->file('image');
    	$slug=Str::slug($request->name);
    	$user=User::findOrFail(Auth::id());
    	 if(isset($image)){
            //unique name for image
            $currentDate=Carbon::now()->toDateString();
            $imagename=$slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check dir for exists

            if(!Storage::disk('public')->exists('profile')){
                Storage::disk('public')->makeDirectory('profile');
            }
            //delete image
             if(Storage::disk('public')->exists('profile/'.$user->image)){
                Storage::disk('public')->delete('profile/'.$user->image);
            }

            //resize for image

            $profileimage=Image::make($image)->resize(500,500)->stream();
            Storage::disk('public')->put('profile/'.$imagename,$profileimage);

        }
        else{
            $imagename=$user->image;
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->image=$imagename;
        $user->about=$request->about;
        $user->save();

       Toastr::success('Your Profile Successfully Update)','Success');
       return redirect()->back();
    }

    public function passwordupdate(Request $request){
    $validatedData = $request->validate([
	'old_password' => 'required',
	'password' => 'required|confirmed',
]);
    $hashpassword=Auth::user()->password;
    if(Hash::check($request->old_password,$hashpassword)){
    	if(!Hash::check($request->password,$hashpassword)){
    		$user=User::find(Auth::id());
    		$user->password=Hash::make($request->password);
    		$user->save();
    		Toastr::success('New password Successfully Changed :)','Success');
    		Auth::logout();
    		return redirect()->back();

    	}
    	else{
    		Toastr::error('New password cannot as same as old password :)','Error');
    		return redirect()->back();

    	}

    }

    else{
    	Toastr::error('Current Password Does Not Match :)','Error');
    	return redirect()->back();
    }

    }
}
