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
        return $this->belongsTo(Service::class);
    }


    public function approveScheduled($walkerId, $serviceScheduled, $petScheduled, $dateScheduled, $shiftScheduled, $commentScheduled, $addressScheduled, $userId)
    {
      

        if ($this->state === 'Send To Walker') {
            // Obtiene todos los servicios y paquetes asociados a la solicitud
            $petScheduled = implode(',', $petScheduled);
            Scheduled::create([
                'nameservice' => $serviceScheduled,
                'user_id' => $userId,
                'walker_id' => $walkerId,
                'state' => "assign",
                'date' =>  $dateScheduled,
                'shift' => $shiftScheduled  , 
                'comment' => $commentScheduled,
                'address' => $addressScheduled,
                'namepets' =>  $petScheduled ,

            ]);
     }
    }
    
}

