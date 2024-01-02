<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\serviceRequests;

class Services extends Model
{
    use HasFactory;
   public function packages()
{
    return $this->belongsToMany(Package::class)->withPivot('quantity');
}

public function users()
{
    return $this->belongsToMany(User::class, 'user_services')->withPivot('quantity');
}


public function serviceRequests()
{
    return $this->belongsToMany(ServiceRequest::class, 'service_service_request', 'service_id', 'service_request_id')
        ->withPivot('service_quantity');
}
}
