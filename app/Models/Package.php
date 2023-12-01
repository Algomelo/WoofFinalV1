<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'custom_price'
    ];

    public function services()
    {
        return $this->belongsToMany(Services::class)->withPivot('quantity');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_packages')->withPivot('quantity');
    }
    
}

