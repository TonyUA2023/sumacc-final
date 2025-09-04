<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'old_status',
        'new_status',
        'changed_by_admin_id',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public $timestamps = false; // El timestamp se maneja manualmente con 'changed_at'

    /**
     * El registro del historial pertenece a una cita.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * El cambio fue realizado por un administrador.
     */
    public function changedByAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by_admin_id');
    }
}