<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockInItems;


class StockIn extends Model
{
    use HasFactory;

    protected $table = "stock_in";

    public function items(){
        return $this->hasMany(StockInItems::class,"stock_in_id");
    }

    public function user(){
        return $this->belongsTo(User::class,"createdBy");
    }
}
