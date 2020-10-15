<?php
namespace App\Http\Controllers\Admin;
use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CategoryController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$categories=Category::latest()->get();
return view('admin.category.index',compact('categories'));
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('admin.category.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$validatedData = $request->validate([
'name' => 'required|unique:categories|max:255',
'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);
// get for image
$image=$request->file('image');
$slug=Str::slug($request->name);
if(isset($image)){
 //make uniqure name for image
    $curentdata=Carbon::now()->toDateString();
    $imagename=$slug.'-'.$curentdata.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    //check category dir is exists
    if(!Storage::disk('public')->exists('category')){
        Storage::disk('public')->makeDirectory('category');
    }
    //resize for image

    $category=Image::make($image)->resize(1600,479)->stream();
    Storage::disk('public')->put('category/'.$imagename,$category);

    //check slider dir is exists
    if(!Storage::disk('public')->exists('category/slider')){
        Storage::disk('public')->makeDirectory('category/slider');
    }
    //resize for image

    $slider=Image::make($image)->resize(500,333)->stream();
    Storage::disk('public')->put('category/slider/'.$imagename,$slider);
}
else
{
    $imagename='default.png';
}

$category=new Category();
$category->name=$request->name;
$category->slug=$slug;
$category->image=$imagename;
$category->save();
Toastr::success('Category Successfully Saved:)','Success');
return redirect()->route('admin.category.index');
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}
/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $category=Category::find($id);
return view('admin.category.edit',compact('category'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$validatedData = $request->validate([
'name' => 'required|unique:categories|max:255',
'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
]);

$image=$request->file('image');
$slug=Str::slug('image');
$category=Category::find($id);

if(isset($image)){
 //make uniqure name for image
    $curentdata=Carbon::now()->toDateString();
    $imagename=$slug.'-'.$curentdata.'-'.uniqid().'.'.$image->getClientOriginalExtension();
    //check category dir is exists
    if(!Storage::disk('public')->exists('category')){
        Storage::disk('public')->makeDirectory('category');
    }

    //delete for image 

    if(Storage::disk('public')->exists('category/'.$category->image)){
        Storage::disk('public')->delete('category/'.$category->image);
    }



    //resize for image

    $categoryimage=Image::make($image)->resize(1600,479)->stream();
    Storage::disk('public')->put('category/'.$imagename,$categoryimage);

    //check slider dir is exists
    if(!Storage::disk('public')->exists('category/slider')){
        Storage::disk('public')->makeDirectory('category/slider');
    }

     //delete for image 

    if(Storage::disk('public')->exists('category/slider/'.$category->image)){
        Storage::disk('public')->delete('category/slider/'.$category->image);
    }
    //resize for image

    $slider=Image::make($image)->resize(500,333)->stream();
    Storage::disk('public')->put('category/slider/'.$imagename,$slider);
}
else
{
    $imagename=$category->image;
}

$category->name=$request->name;
$category->slug=$slug;
$category->image=$imagename;
$category->save();
Toastr::success('Category Successfully Updated:)','Success');
return redirect()->route('admin.category.index');




}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{

$category=Category::find($id);
if(Storage::disk('public')->exists('category/'.$category->image));{
    Storage::disk('public')->delete('category/'.$category->image);
}
if(Storage::disk('public')->exists('category/slider/'.$category->image));{
    Storage::disk('public')->delete('category/slider/'.$category->image);
}
$category->delete();
Toastr::success('Category Successfully Deleted:)','Success');
return redirect()->back();

}
}