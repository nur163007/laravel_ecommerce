<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use DB;

class SubCategoryController extends Controller
{
    function create(){
    	$category = Category::all();
    	return view('admin.subcategory.addSubCategory',compact('category'));
    }

    function store(Request $request){
    	// dd($request->all());

    	$this->validate($request,[
            'category_name' => 'required',
            'subcategory_name' => 'required',
            'status' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $subcat = new SubCategory;

       $subcat->category_id = $request->category_name;
       $subcat->sub_name = $request->subcategory_name;
       $subcat->status = $request->status;
       $subcat->description = $request->description;

       $random = Carbon::now()->format('his')+rand(1000,9999);

    	  if($image = $request->file('image')){
            $extention = $request->file('image')->getClientOriginalExtension();
            $imageName = $random.'.'.$extention;
            $path = public_path('uploads/subcategory');
            $image->move($path,$imageName);

            $subcat->image = $imageName;
        }  
        else{
            $subcat->image = "null";
        }

        if($subcat->save()){
        	return redirect()->back()->with('success','SubCategory information successfully saved.');
        }
        else{
        	return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }

    }

    public function view(){
    	$subcat = DB::table('subcategories')
    			  ->join('categories','subcategories.category_id','categories.id')
    			  ->select('subcategories.*','categories.name')->get();
    	// $subcat = DB::select("SELECT sc.*, c.`name`
    	// 	from subcategories AS sc
    	// 	INNER JOIN categories as c on sc.`category_id` = c.`id`;");
    	return view('admin.subcategory.viewSubCategory',compact('subcat'));
    }

    public function delete($id){
    	// dd($id);
    	$subcat = SubCategory::findOrFail($id);
    	if($subcat){
            if(file_exists('uploads/subcategory/'.$subcat->image) AND !empty($subcat->image)){
                unlink('uploads/subcategory/'.$subcat->image);
            }
            $subcat->delete();
            return redirect()->back()->with('success','SubCategory information successfully deleted.');
        }else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }
    }

    public function edit($id){
    	// dd($id);
    }
}
