<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Package;
use App\Models\RedeemedPackage;
use App\Models\RedeemedService;

class ServiceRequest extends Model
{
    use HasFactory;
    
    protected $table = 'service_request'; // Ajusta este nombre según el nombre real de tu tabla

    protected $fillable = [
        'user_id',
        'package_id',
        'service_id',
        'package_quantity',
        'service_quantity',
        'price',
        'comment',
        'state',
        'create_at',
        'unique_number',
        
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_service_request')
            ->withPivot('package_quantity');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_service_request', 'service_request_id', 'service_id')
            ->withPivot('service_quantity');
    }

        // En tu modelo ServiceRequest
    public function approveAndRedeem()
    {
        // Verifica si el estado es aprobado
        if ($this->state === 'Approved') {


            // Obtiene todos los servicios y paquetes asociados a la solicitud
            $services = $this->services;
            $packages = $this->packages;
            // Itera sobre los servicios y guarda la redención en la nueva tabla

            foreach ($services as $service) {

                RedeemedService::create([
                    'user_id' => $this->user_id,
                    'service_id' => $service->id,
                    'quantity' => $service->pivot->service_quantity,
                    'state' => 'available ', // Establecer el estado a "disponible"

                ]);
            }

            // Itera sobre los paquetes y guarda la redención en la nueva tabla
      

            foreach ($packages as $package) {
                RedeemedPackage::create([
                    'user_id' => $this->user_id,
                    'package_id' => $package->id,
                    'quantity' => $package->pivot->package_quantity,
                    'state' => 'available ', // Establecer el estado a "disponible"

                ]);
                // Además, para cada paquete, redime también los servicios asociados al paquete
                foreach ($package->services as $service) {

                    RedeemedService::create([
                        'user_id' => $this->user_id,
                        'service_id' => $service->id,
                        'quantity' => $service->pivot->quantity,
                        'state' => 'available ', // Establecer el estado a "disponible"

                    ]);
                }
            }
        }
}



}



