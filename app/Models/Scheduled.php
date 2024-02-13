<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    protected $table = 'scheduled'; // Debería ser singular

    use HasFactory;

    protected $fillable = [
        'nameservice',
        'user_id',
        'walker_id',
        'quantity',
        'state',
        'comment',
        'address',
        'date',
        'shift',
        'namepets',
        'unique_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function walker()
    {
        return $this->belongsTo(User::class, 'walker_id');
    }

}
