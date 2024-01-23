<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $fillable = [
        'service_id',
        'quantity',
        'state',
        'comment',
        'address',
        'date',
        'shift',
    ];
    public function redeemedService()
    {
        return $this->belongsTo(RedeemedService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pets()
    {
        return $this->belongsToMany(Pet::class)->withPivot('quantity');
    }
    public function service()
    {
        return $this->belongsTo(Services::class);
    }
    
}

