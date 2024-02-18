<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event', 'start_date' ,'end_date', 'description', 'address', 'shift', 'user_id', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

