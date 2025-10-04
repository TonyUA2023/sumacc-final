<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'display_order',
    ];
    
    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Una categoría tiene muchos servicios.
     * ESPECIFICAMOS EXPLÍCITAMENTE LA CLAVE FORÁNEA
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id'); // ← AQUÍ ESTÁ LA CORRECCIÓN
    }
}