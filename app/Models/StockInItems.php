<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\StockIn;



class StockInItems extends Model
{
    use HasFactory;

    protected $table = "stock_in_items";
    protected $fillable = ['product_id','qty','purchase_price','expiry_date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function stock(){
        return $this->belongsTo(StockIn::class,'stock_in_id');
    }
}
