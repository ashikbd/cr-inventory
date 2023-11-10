<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrands;
use App\Models\ProductCategories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminview', ['page' => 'products.index', 'title' => 'Products', 'products' => Product::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminview', ['page' => 'products.create', 'title' => 'Product','brands' => ProductBrands::all(), 'categories'=> ProductCategories::where('parent_id',0)->get()]);
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

        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->low_stock_qty = $request->low_stock_qty?$request->low_stock_qty:0;
        $product->initial_stock_qty = $request->initial_stock_qty?$request->initial_stock_qty:0;
        $product->current_stock_qty = $request->initial_stock_qty?$request->initial_stock_qty:0;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku?$request->sku:'';
        $product->status = $request->status;
        $product->createdBy = admin_id();

        $result = $product->save();

        if ($result) {
            return redirect('admin/products')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/products')->with('cmsStatus', 'fail');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.adminview', ['page' => 'products.edit', 'title' => 'Product','brands' => ProductBrands::all(), 'categories'=> ProductCategories::where('parent_id',0)->get(),'product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);


        $product->name = $request->name;
        $product->description = $request->description;
        $product->low_stock_qty = $request->low_stock_qty?$request->low_stock_qty:0;
        $product->initial_stock_qty = $request->initial_stock_qty?$request->initial_stock_qty:0;
        $product->current_stock_qty = $request->initial_stock_qty?$request->initial_stock_qty:0;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku?$request->sku:'';
        $product->status = $request->status;
        $product->createdBy = admin_id();

        $result = $product->save();

        if ($result) {
            return redirect('admin/products')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/products')->with('cmsStatus', 'fail');
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
        Product::find($id)->delete();
        return redirect('admin/products')->with('cmsStatus', 'success');
    }
}
