<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Service extends Model
{
    use HasFactory;

 public function redeemedServices()
{
    return $this->hasMany(RedeemedService::class);
    
}
public function redemptions()
{
    return $this->hasMany(Redemption::class);
}
}
