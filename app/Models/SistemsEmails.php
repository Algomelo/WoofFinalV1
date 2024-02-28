<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class SistemsEmails extends Model
{
    use HasFactory;
    protected $table = 'email'; // Cambia 'mi_tabla_personalizada' al nombre deseado de tu tabla

    
    protected $fillable = [
        'email',
        'comment',
        'name',
        'phone',
        'dogname',
        'breed',
        'age',
        'address',
        'service',    
        'form',
    ];
}
