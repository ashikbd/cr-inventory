<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminview', ['page' => 'service.index', 'title' => 'Services', 'services' => Service::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminview', ['page' => 'service.create', 'title' => 'Service']);
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
            'purchase_price' => 'required'
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->description = $request->description?$request->description:'';
        $service->purchase_price = $request->purchase_price?$request->purchase_price:0;
        $service->status = $request->status;

        $result = $service->save();

        if ($result) {
            return redirect('admin/services')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/services')->with('cmsStatus', 'fail');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.adminview', ['page' => 'service.edit', 'title' => 'Services', 'service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required',
            'purchase_price' => 'required'
        ]);


        $service->name = $request->name;
        $service->description = $request->description?$request->description:'';
        $service->purchase_price = $request->purchase_price?$request->purchase_price:0;
        $service->status = $request->status;

        $result = $service->save();

        if ($result) {
            return redirect('admin/services')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/services')->with('cmsStatus', 'fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Service::find($id)->delete();
        return redirect('admin/services')->with('cmsStatus', 'success');
    }
}
