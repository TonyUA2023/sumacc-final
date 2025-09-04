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

    /**
     * Una categoría tiene muchos servicios.
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}