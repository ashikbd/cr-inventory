<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientServicesItem;
use App\Models\Client;
use App\Models\User;



class ClientService extends Model
{
    

    protected $table = "client_services";

    public function items(){
        return $this->hasMany(ClientServicesItem::class,"client_service_id");
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'createdBy');
    }
}
