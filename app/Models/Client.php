<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
    ];

    /**
     * Un cliente puede tener múltiples direcciones.
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class);
    }

    /**
     * Un cliente puede tener múltiples citas.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}