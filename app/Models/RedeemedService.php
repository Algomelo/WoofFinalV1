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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Services::class);
    }
}
