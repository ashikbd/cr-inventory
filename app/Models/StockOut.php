<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockOutItems;


class StockOut extends Model
{
    use HasFactory;

    protected $table = "stock_out";

    public function items(){
        return $this->hasMany(StockOutItems::class,"stock_out_id");
    }

    public function user(){
        return $this->belongsTo(User::class,"createdBy");
    }
}
