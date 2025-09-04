<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_address_id',
        'service_price_id',
        'appointment_datetime',
        'estimated_duration_minutes',
        'timezone',
        'status',
        'base_price',
        'final_total',
        'client_notes',
        'internal_notes',
        'created_by_admin_id',
        'updated_by_admin_id',
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
    ];

    /**
     * La cita pertenece a un cliente.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * La cita se asocia a una dirección.
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(ClientAddress::class, 'client_address_id');
    }

    /**
     * La cita se basa en un precio de servicio específico.
     */
    public function servicePrice(): BelongsTo
    {
        return $this->belongsTo(ServicePrice::class);
    }

    /**
     * Cita creada por un administrador.
     */
    public function createdByAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_admin_id');
    }

    /**
     * Cita actualizada por un administrador.
     */
    public function updatedByAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_admin_id');
    }

    /**
     * Historial de cambios de estado de la cita.
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(AppointmentStatusHistory::class);
    }

    /**
     * Servicios extra añadidos a la cita.
     */
    public function extraServices(): BelongsToMany
    {
        return $this->belongsToMany(ExtraService::class, 'appointment_extra_services')
                    ->withPivot('price_at_booking');
    }
}