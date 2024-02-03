<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// En el modelo RedeemedService.php
class RedeemedService extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'quantity',
        'state',
        'redemption_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function redemption()
    {
        return $this->hasOne(Redemption::class);
    }
    

    public function pets()
    {
        return $this->belongsToMany(Pet::class)->withPivot('quantity');
    }

}
