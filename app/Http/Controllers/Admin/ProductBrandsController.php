<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrands;
use Illuminate\Http\Request;

class ProductBrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminview', ['page' => 'brand.index', 'title' => 'Brands', 'brands' => ProductBrands::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminview', ['page' => 'brand.create', 'title' => 'Brand']);

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
            'name' => 'required',
        ]);

        $brand = new ProductBrands;

        $brand->name = $request->name;
        $brand->status = $request->status;

        $result = $brand->save();

        if ($result) {
            return redirect('admin/brands')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/brands')->with('cmsStatus', 'fail');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductBrands  $productBrands
     * @return \Illuminate\Http\Response
     */
    public function show(ProductBrands $productBrands)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductBrands  $productBrands
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = ProductBrands::find($id);
        return view('admin.adminview', ['page' => 'brand.edit', 'title' => 'Brand','brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductBrands  $productBrands
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $productBrands = ProductBrands::find($id);
        $productBrands->name = $request->name;
        $productBrands->status = $request->status;

        $result = $productBrands->save();

        if ($result) {
            return redirect('admin/brands')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/brands')->with('cmsStatus', 'fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductBrands  $productBrands
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        ProductBrands::find($id)->delete();
        return redirect('admin/brands')->with('cmsStatus', 'success');
    }
}
