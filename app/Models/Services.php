<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
   public function packages()
{
    return $this->belongsToMany(Package::class)->withPivot('quantity');
}

public function users()
{
    return $this->belongsToMany(User::class, 'user_services')->withPivot('quantity');
}
}
