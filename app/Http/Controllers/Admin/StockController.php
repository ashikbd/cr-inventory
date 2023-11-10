<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockInItems;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Carbon\Carbon;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminview', ['page' => 'stock.stock_current', 'title' => 'Current Stock', 'products' => Product::where('status',1)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockin()
    {
        return view('admin.adminview', ['page' => 'stock.stock_in', 'title' => 'Stock Management','products'=>Product::all()]);
    }

     public function stockin_list()
    {
        return view('admin.adminview', ['page' => 'stock.stockin_list', 'title' => 'Stock IN History','stocks'=>StockIn::all()]);
    }

    public function stockin_save(Request $request){

        $stock = new StockIn;
        $stock->description = $request->description;
        $stock->reference_no = $request->reference_no;
        $stock->createdBy = admin_id();
        $result = $stock->save();

        if($request->items){
            foreach ($request->items as $key=>$item) {
                $items = array();
                $items = ["product_id"=>$item, "qty"=> $request->qty[$key], "purchase_price"=> $request->purchase_price[$key], "expiry_date"=> sqldate($request->expiry_date[$key])];
                $stock->items()->create($items);
            }
        }
        
        if ($result) {
            return redirect('admin/stock/stockin_list')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/stock/stockin_list')->with('cmsStatus', 'fail');
        }

    }

    public function stockin_update(Request $request){

        $validated = $request->validate([
            'id' => 'required'
        ]);

        $stock = StockIn::find($request->post('id'));
        $stock->description = $request->description;
        $stock->reference_no = $request->reference_no;
        $stock->createdBy = admin_id();
        $result = $stock->save();

        $stock->items()->delete();
        
        if($request->items){
            foreach ($request->items as $key=>$item) {
                $items = array();
                $items = ["product_id"=>$item, "qty"=> $request->qty[$key], "purchase_price"=> $request->purchase_price[$key], "expiry_date"=> sqldate($request->expiry_date[$key])];
                $stock->items()->create($items);
            }
        }
        
        if ($result) {
            return redirect('admin/stock/stockin_list')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/stock/stockin_list')->with('cmsStatus', 'fail');
        }

    }

    public function stockin_edit($id)
    {
        $stock = StockIn::find($id);
        return view('admin.adminview', ['page' => 'stock.stock_in_edit', 'title' => 'Stock Management','products'=>Product::all(),'stock'=>$stock]);
    }

    public function stockin_detail($id)
    {
        $stock = StockIn::find($id);
        return view('admin.stock.modal_stock_in', ['title' => 'Stock-in Detail','stock'=>$stock]);
    }

    public function stockout_list()
    {
        return view('admin.adminview', ['page' => 'stock.stockout_list', 'title' => 'Stock Out History','stocks'=>StockOut::all()]);
    }

    public function stockout()
    {
        return view('admin.adminview', ['page' => 'stock.stock_out', 'title' => 'Stock Management','products'=>Product::all()]);
    }

    public function stockout_save(Request $request){

        $stock = new StockOut;
        $stock->description = $request->description;
        $stock->reference_no = $request->reference_no;
        $stock->createdBy = admin_id();
        $result = $stock->save();

        if($request->items){
            foreach ($request->items as $key=>$item) {
                $items = array();
                $items = ["product_id"=>$item, "qty"=> $request->qty[$key], "expiry_date"=> $request->expiry_date[$key]?$request->expiry_date[$key]:null];
                $stock->items()->create($items);
            }
        }
        
        if ($result) {
            return redirect('admin/stock/stockout_list')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/stock/stockout_list')->with('cmsStatus', 'fail');
        }



    }

    public function stockout_edit($id)
    {
        $stock = StockOut::find($id);
        return view('admin.adminview', ['page' => 'stock.stock_out_edit', 'title' => 'Stock Management','products'=>Product::all(),'stock'=>$stock]);
    }

    public function stockout_detail($id)
    {
        $stock = StockOut::find($id);
        return view('admin.stock.modal_stock_out', ['stock'=>$stock]);
    }

    public function stockout_update(Request $request){
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $stock = StockOut::find($request->post('id'));
        $stock->description = $request->description;
        $stock->reference_no = $request->reference_no;
        $stock->createdBy = admin_id();
        $result = $stock->save();

        $stock->items()->delete();


        if ($request->items) {
            foreach ($request->items as $key => $item) {
                $items = array();
                $items = ["product_id" => $item, "qty" => $request->qty[$key], "expiry_date" => $request->expiry_date[$key] ? $request->expiry_date[$key] : null];
                $stock->items()->create($items);
            }
        }

        if ($result) {
            return redirect('admin/stock/stockout_list')->with('cmsStatus', 'success');
        } else {
            return redirect('admin/stock/stockout_list')->with('cmsStatus', 'fail');
        }

    }

    public function get_product_stock(Request $request){
        if(!$request->product_id) return false;

        $array = array();
        
        $pr = Product::find($request->product_id);
        $stck_g = $pr->stockin->groupBy('expiry_date');
       

        foreach($stck_g->all() as $key=>$row){
            if(!$key){
                $key1 = "undefined";
            }else{
                $key1 = $key;
            }

            $stockout_qty = $pr->stockout()->where('expiry_date',$key)->get()->sum('qty');

            $array[$key1] = $row->sum('qty') - $stockout_qty;
        }
        

        echo json_encode($array);

        
    }

    public function show_transaction($id){
        $product = Product::find($id);
        $data['stock_in'] = $product->stockin;
        $data['stock_out'] = $product->stockout;

        return view('admin.stock.modal_show_transaction', $data);

    }

    public function show_expiry_dates($id){
        $array = array();
        
        $pr = Product::find($id);
        $stck_g = $pr->stockin->groupBy('expiry_date');
       

        foreach($stck_g->all() as $key=>$row){
            if(!$key){
                $key1 = "undefined";
            }else{
                $key1 = $key;
            }

            $stockout_qty = $pr->stockout()->where('expiry_date',$key)->get()->sum('qty');

            $array[$key1] = $row->sum('qty') - $stockout_qty;
        }

        $data['stock'] = $array;

        //print_r($data['stock']);

        return view('admin.stock.modal_show_expiry_dates', $data);
    }

    public function expiring()
    {
        $items = StockInItems::selectRaw("expiry_date,product_id, SUM(`qty`) as total_qty")->where('expiry_date','>',date("Y-m-d"))->where('expiry_date','<=',date("Y-m-d",strtotime("+60 days")))->whereRelation('product', 'status', 1)->groupBy(['expiry_date','product_id'])->orderBy('expiry_date','asc')->get();
        
        $array = [];
        foreach($items as $key=>$row){
            
            if(!$row->expiry_date){
                continue;
            }
            
            $stockout_qty = $row->product->stockout()->where('expiry_date',$row->expiry_date)->get()->sum('qty');

            $current_stock = $row->total_qty - $stockout_qty;

            $array[] = ['current_stock'=>$current_stock,'name'=>$row->product->name,'brand'=>$row->product->brand?$row->product->brand->name:'','expiry_date'=>date("d M Y",strtotime($row->expiry_date))];
            
        }

       
        return view('admin.adminview', ['page' => 'stock.expiring', 'title' => 'Products Expiring in 60 Days','products'=>$array]);
    }

    
}
