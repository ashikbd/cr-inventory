<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Service;
use App\Models\ClientService;
use Illuminate\Http\Request;

class ClientServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('client_id')){
            $items = ClientService::where('client_id',$request->get('client_id'))->orderBy('id','desc')->get();
            $client = Client::find($request->get('client_id'));
            $title = "Sales of ".$client->first_name.' '.$client->last_name;
        }else{
            $items = ClientService::orderBy('id','desc')->get();
            $title = "Sales";
        }
        
        return view('admin.adminview', ['page' => 'sales.index', 'title' => $title, 'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminview', ['page' => 'sales.create', 'title' => 'Sales', 'clients' => Client::all(), 'services' => Service::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $sale = new ClientService;

        $sale->client_id = $request->client_id;
        $sale->reference_no = $request->reference_no;
        $sale->notes = $request->notes?$request->notes:'';
        $sale->total_discount = collect($request->discount)->sum();
        $sale->total_price = collect($request->unit_price)->sum() - collect($request->discount)->sum();
        $sale->createdBy = admin_id();
        $result = $sale->save();

        if ($request->service) {
            foreach ($request->service as $key => $item) {
                $items = array();
                $items = ["service_id" => $item, "discount" => $request->discount[$key], "price" => $request->price[$key]];
                $sale->items()->create($items);
            }
        }

        if ($result) {
            return redirect('admin/sales')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/sales')->with('cmsStatus', 'fail');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientService  $clientService
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.sales.modal_sale_detail', ['sale'=>ClientService::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientService  $clientService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.adminview', ['page' => 'sales.edit', 'title' => 'Sales', 'clients' => Client::all(), 'services' => Service::all(), 'sale'=>ClientService::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientService  $clientService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientService $sale)
    {   
        //dd($_POST);

        $sale->client_id = $request->client_id;
        $sale->reference_no = $request->reference_no;
        $sale->notes = $request->notes?$request->notes:'';
        $sale->total_discount = collect($request->discount)->sum();
        $sale->total_price = collect($request->unit_price)->sum() - collect($request->discount)->sum();
        $sale->createdBy = admin_id();
        $result = $sale->save();

        $sale->items()->delete();

        if ($request->service) {
            foreach ($request->service as $key => $item) {
                $items = array();
                $items = ["service_id" => $item, "discount" => $request->discount[$key], "price" => $request->price[$key]];
                $sale->items()->create($items);
            }
        }

        if ($result) {
            return redirect('admin/sales')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/sales')->with('cmsStatus', 'fail');
        }
    }

   
    public function delete($id)
    {
        ClientService::find($id)->delete();
        return redirect('admin/sales')->with('cmsStatus', 'success');
    }
}
