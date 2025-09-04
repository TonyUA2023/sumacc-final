<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'base_duration_hours',
        'notes',
        'recommendation',
        'features',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Un servicio pertenece a una categoría.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    /**
     * Un servicio tiene diferentes precios según el tipo de vehículo.
     */
    public function servicePrices(): HasMany
    {
        return $this->hasMany(ServicePrice::class);
    }
}