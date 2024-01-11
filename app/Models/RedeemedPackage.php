<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// En el modelo RedeemedPackage.php
class RedeemedPackage extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'quantity',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
