<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategories::where("parent_id",0)->get();
        return view('admin.adminview', ['page' => 'category.index', 'title' => 'Category', 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = ProductCategories::where('parent_id',0)->get();
        return view('admin.adminview', ['page' => 'category.create', 'title' => 'Category','parents'=>$parents]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $category = new ProductCategories;
        
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;

        $result = $category->save();

        if($result){
            //session()->flash('successMessage', trans('common.save_success'));
            return redirect('admin/categories')->with('cmsStatus','success');
        }else{
            //session()->flash('errorMessage', trans('common.save_failed'));
            return redirect('admin/categories')->with('cmsStatus', 'fail');
        }

        //return redirect()->route('categories.index');

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategories $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategories $category)
    {
        $parents = ProductCategories::where('parent_id',0)->get();
        return view('admin.adminview', ['page' => 'category.edit', 'title' => 'Category','parents'=>$parents,'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategories $category)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;

        $result = $category->save();

        if($result){
            //session()->flash('successMessage', trans('common.save_success'));
            return redirect('admin/categories')->with('cmsStatus','success');
        }else{
            //session()->flash('errorMessage', trans('common.save_failed'));
            return redirect('admin/categories')->with('cmsStatus', 'fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       ProductCategories::find($id)->delete();
       return redirect('admin/categories')->with('cmsStatus','success');
    }
}
