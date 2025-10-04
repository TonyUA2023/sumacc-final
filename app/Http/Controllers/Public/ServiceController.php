<?php
// app/Http/Controllers/Public/ServiceController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Mostrar servicios por categoría
     */
    public function byCategory(ServiceCategory $category): View
    {
        $category->load(['services' => function($query) {
            $query->where('is_active', true)
                  ->with(['servicePrices.vehicleType', 'category'])
                  ->orderBy('name');
        }]);

        // Servicios relacionados (de otras categorías)
        $relatedServices = Service::where('is_active', true)
            ->where('category_id', '!=', $category->id)
            ->with(['servicePrices.vehicleType', 'category'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('public.services.category', compact('category', 'relatedServices'));
    }

    /**
     * Mostrar un servicio específico
     */
    public function show(Service $service): View
    {
        if (!$service->is_active) {
            abort(404);
        }

        $service->load(['servicePrices.vehicleType', 'category']);
        
        // Servicios relacionados (misma categoría)
        $relatedServices = Service::where('is_active', true)
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->with(['servicePrices.vehicleType', 'category'])
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('public.services.show', compact('service', 'relatedServices'));
    }
}