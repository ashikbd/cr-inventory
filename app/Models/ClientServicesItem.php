<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;


class ClientServicesItem extends Model
{
    use HasFactory;

    protected $table = "client_services_items";
    protected $fillable = ['service_id','discount','price'];

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
