<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'vehicle_type_id',
        'price',
    ];

    public $timestamps = false;

    /**
     * El precio pertenece a un servicio principal.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * El precio pertenece a un tipo de vehículo.
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}