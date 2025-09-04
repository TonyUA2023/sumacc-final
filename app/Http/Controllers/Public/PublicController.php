<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ExtraService;

class PublicController extends Controller
{
    /**
     * Muestra la página de inicio (Home).
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Obtenemos los 4 servicios más recientes y activos para mostrar en el Home
        // Con sus precios, categoría y tipos de vehículo
        $featuredServices = Service::with([
            'servicePrices.vehicleType',
            'category'
        ])
        ->where('is_active', true)
        ->latest() // <--- CAMBIO CLAVE: Ordena por los más nuevos primero
        ->take(4)   // <--- Toma los 4 más nuevos
        ->get();

        // Transformamos los servicios para incluir el precio mínimo y máximo
        $featuredServices = $featuredServices->map(function ($service) {
            $service->min_price = $service->servicePrices->min('price');
            $service->max_price = $service->servicePrices->max('price');
            return $service;
        });

        return view('public.index', compact('featuredServices'));
    }

    /**
     * Muestra la página de todos los servicios.
     *
     * @return \Illuminate\View\View
     */
    public function services(): View
    {
        $categories = ServiceCategory::with([
            'services' => function ($query) {
                $query->where('is_active', true)
                      ->with(['servicePrices.vehicleType']);
            }
        ])
        ->orderBy('display_order', 'asc')
        ->get();

        // Agregamos precios mínimos y máximos a cada servicio
        $categories = $categories->map(function ($category) {
            $category->services = $category->services->map(function ($service) {
                $service->min_price = $service->servicePrices->min('price');
                $service->max_price = $service->servicePrices->max('price');
                return $service;
            });
            return $category;
        });

        return view('public.services', compact('categories'));
    }

    /**
     * Muestra la página de servicios extra (A La Carte).
     *
     * @return \Illuminate\View\View
     */
    public function extraServices(): View
    {
        $extraServices = ExtraService::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        return view('public.extra-services', compact('extraServices'));
    }

    /**
     * Muestra la página de contacto.
     *
     * @return \Illuminate\View\View
     */
    public function contact(): View
    {
        return view('public.contact');
    }
}