<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Package;

class ServiceRequest extends Model
{
    use HasFactory;
    
    protected $table = 'service_request'; // Ajusta este nombre según el nombre real de tu tabla

    protected $fillable = [
        'user_id',
        'package_id',
        'service_id',
        'package_quantity',
        'service_quantity',
        'price',
        'comment',
        'state',
        'create_at',
        'unique_number',
        
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_service_request')->withPivot('package_quantity');
    }

    public function services()
    {
        return $this->belongsToMany(Services::class, 'service_service_request', 'service_request_id', 'service_id')
            ->withPivot('service_quantity');
    }


}



