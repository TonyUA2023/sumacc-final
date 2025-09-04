<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',         // <-- Añadir
        'is_active',    // <-- Añadir
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean', // <-- Añadir
        ];
    }

    // --- RELACIONES COMO ADMINISTRADOR ---

    /**
     * Citas creadas por este administrador.
     */
    public function createdAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'created_by_admin_id');
    }

    /**
     * Citas actualizadas por este administrador.
     */
    public function updatedAppointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'updated_by_admin_id');
    }

    /**
     * Cambios de estado realizados por este administrador.
     */
    public function statusChanges(): HasMany
    {
        return $this->hasMany(AppointmentStatusHistory::class, 'changed_by_admin_id');
    }
}