<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockInItems;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function brand()
    {
        return $this->belongsTo(ProductBrands::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategories::class);
    }

    public function stockin(){
        return $this->hasMany(StockInItems::class,'product_id');
    }

    public function stockout(){
        return $this->hasMany(StockOutItems::class,'product_id');
    }

    public function getCurrentStockQuantity()
    {
        $totalStockIn = $this->stockin->sum('qty');
        $totalStockOut = $this->stockout->sum('qty');
        
        return $totalStockIn - $totalStockOut;
    }

     public function isLowStock()
    {
       
        $isLowStock = $this->getCurrentStockQuantity() <= $this->low_stock_qty;

        return $isLowStock;
    }

}
