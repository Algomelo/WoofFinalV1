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

    // Puedes agregar relaciones aquí si es necesario
}

