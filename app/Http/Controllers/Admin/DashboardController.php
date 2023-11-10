<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockInItems;

class DashboardController extends Controller
{
    

    public function index(){
       $allProducts = Product::where('status',1)->get();

        $low_stock_products = $allProducts->filter(function ($product) {
            return $product->isLowStock();
        });


        $items = StockInItems::selectRaw("expiry_date,product_id, SUM(`qty`) as total_qty")->where('expiry_date','>',date("Y-m-d"))->where('expiry_date','<=',date("Y-m-d",strtotime("+60 days")))->whereRelation('product', 'status', 1)->groupBy(['expiry_date','product_id'])->orderBy('expiry_date','asc')->limit(10)->get();
        
        $expiring_products = [];
        foreach($items as $key=>$row){
            
            if(!$row->expiry_date){
                continue;
            }
            
            $stockout_qty = $row->product->stockout()->where('expiry_date',$row->expiry_date)->get()->sum('qty');

            $current_stock = $row->total_qty - $stockout_qty;

            $expiring_products[] = ['current_stock'=>$current_stock,'name'=>$row->product->name,'brand'=>$row->product->brand?$row->product->brand->name:'','expiry_date'=>date("d M Y",strtotime($row->expiry_date))];
            
        }

        
        return view('admin.adminview', ['page' => 'dashboard','title'=> 'Dashboard', 'low_stock_products'=>$low_stock_products, 'expiring_products'=>$expiring_products]);
    }
}
