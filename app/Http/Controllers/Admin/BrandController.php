<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use Carbon\Carbon;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $category = Category::all();
        $subcat = SubCategory::all();
        return view('admin.brand.addBrand',compact('category','subcat'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
          $this->validate($request,[
            'category_id' => 'required',
            'subcat_id' => 'required',
            'brand_name' => 'required|unique:brands,brand_name',
            'status' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $brands = new Brand;

        $brands->cat_id = $request->category_id;
        $brands->sub_id = $request->subcat_id;
        $brands->brand_name = $request->brand_name;
        $brands->description = $request->description;
        $brands->status = $request->status;

       $random = Carbon::now()->format('his')+rand(1000,9999);

          if($image = $request->file('image')){
            $extention = $request->file('image')->getClientOriginalExtension();
            $imageName = $random.'.'.$extention;
            $path = public_path('uploads/brands');
            $image->move($path,$imageName);
            $brands->image = $imageName;
        }  
        else{
            $brands->image = null;
        }


        if($brands->save()){

            return redirect()->back()->with('success','Brand information successfully saved.');
        }
        else{
            return redirect()->back()->with('error','Something Error Found !, Please try again.');
        }

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
