<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\StockOut;



class StockOutItems extends Model
{
    use HasFactory;

    protected $table = "stock_out_items";
    protected $fillable = ['product_id','qty','expiry_date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function stock(){
        return $this->belongsTo(StockOut::class, "stock_out_id");
    }
}
