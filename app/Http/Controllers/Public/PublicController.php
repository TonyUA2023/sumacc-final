<?php
// app/Http/Controllers/Public/PublicController.php

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
        $featuredServices = Service::with([
            'servicePrices.vehicleType',
            'category'
        ])
        ->where('is_active', true)
        ->latest()
        ->take(4)
        ->get();

        // Transformamos los servicios para incluir el precio mínimo y máximo
        $featuredServices = $featuredServices->map(function ($service) {
            $service->min_price = $service->servicePrices->min('price');
            $service->max_price = $service->servicePrices->max('price');
            return $service;
        });

        // Obtenemos todas las categorías con servicios activos para la sección de servicios
        $serviceCategories = ServiceCategory::with([
            'services' => function ($query) {
                $query->where('is_active', true)
                      ->with(['servicePrices.vehicleType']);
            }
        ])
        ->whereHas('services', function ($query) {
            $query->where('is_active', true);
        })
        ->orderBy('display_order', 'asc')
        ->get();

        // Agregamos precios mínimos y máximos a cada servicio
        $serviceCategories = $serviceCategories->map(function ($category) {
            $category->services = $category->services->map(function ($service) {
                $service->min_price = $service->servicePrices->min('price');
                $service->max_price = $service->servicePrices->max('price');
                return $service;
            });
            return $category;
        });

        // Preparar paquetes para la sección de pricing
        $packages = Service::with(['servicePrices.vehicleType', 'category'])
            ->where('is_active', true)
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->groupBy('category_id')
            ->map(function ($services, $categoryId) {
                $category = ServiceCategory::find($categoryId);
                
                return [
                    'name' => $category->name,
                    'services' => $services->map(function ($service) {
                        // Simplificar features y detectar exterior/interior
                        $features = $service->features;
                        $simplifiedFeatures = [];
                        $hasExterior = false;
                        $hasInterior = false;
                        
                        if (is_string($features)) {
                            $decoded = json_decode($features, true);
                            $features = is_array($decoded) ? $decoded : ['General' => [$features]];
                        }
                        
                        if (is_array($features)) {
                            // Detectar si tiene exterior e interior
                            foreach ($features as $categoryName => $items) {
                                $categoryLower = strtolower($categoryName);
                                if (str_contains($categoryLower, 'exterior')) $hasExterior = true;
                                if (str_contains($categoryLower, 'interior')) $hasInterior = true;
                                
                                // Tomar solo los primeros 2 items de la primera categoría
                                if (empty($simplifiedFeatures) && is_array($items)) {
                                    $simplifiedFeatures = array_slice($items, 0, 2);
                                }
                            }
                        }
                        
                        // Obtener precios de los primeros 2 tipos de vehículo
                        $prices = $service->servicePrices->sortBy('price')->take(2);
                        $totalVehicleTypes = $service->servicePrices->count();
                        $hasMorePrices = $totalVehicleTypes > 2;
                        
                        $priceDisplay = $prices->map(function ($price) {
                            return $price->vehicleType->name . ': $' . number_format($price->price, 0);
                        })->implode(' | ');
                        
                        return [
                            'id' => $service->id,
                            'name' => $service->name,
                            'min_price' => $service->servicePrices->min('price'),
                            'price_display' => $priceDisplay,
                            'has_more_prices' => $hasMorePrices,
                            'total_vehicle_types' => $totalVehicleTypes,
                            'features' => $simplifiedFeatures,
                            'has_exterior' => $hasExterior,
                            'has_interior' => $hasInterior,
                            'image_path' => $service->image_path
                        ];
                    })->toArray()
                ];
            })
            ->values()
            ->toArray();

        return view('public.index', compact('featuredServices', 'serviceCategories', 'packages'));
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
        ->whereHas('services', function ($query) {
            $query->where('is_active', true);
        })
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
     * Muestra servicios por categoría específica.
     *
     * @param string $categorySlug
     * @return \Illuminate\View\View
     */
    public function servicesByCategory($categorySlug): View
    {
        $category = ServiceCategory::where('slug', $categorySlug)
            ->with(['services' => function($query) {
                $query->where('is_active', true)
                      ->with(['servicePrices.vehicleType']);
            }])
            ->firstOrFail();

        $allCategories = ServiceCategory::whereHas('services', function($query) {
            $query->where('is_active', true);
        })->orderBy('display_order')->get();

        // Agregar precios mínimos y máximos
        $category->services = $category->services->map(function ($service) {
            $service->min_price = $service->servicePrices->min('price');
            $service->max_price = $service->servicePrices->max('price');
            return $service;
        });

        return view('public.services-category', compact('category', 'allCategories'));
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
     * Muestra un servicio específico.
     *
     * @param string $serviceSlug
     * @return \Illuminate\View\View
     */
    public function showService($serviceSlug): View
    {
        $service = Service::where('name', 'like', '%' . str_replace('-', ' ', $serviceSlug) . '%')
            ->where('is_active', true)
            ->with(['servicePrices.vehicleType', 'category'])
            ->firstOrFail();

        $service->min_price = $service->servicePrices->min('price');
        $service->max_price = $service->servicePrices->max('price');

        $relatedServices = Service::where('is_active', true)
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->with(['servicePrices.vehicleType', 'category'])
            ->inRandomOrder()
            ->limit(3)
            ->get();

        $relatedServices = $relatedServices->map(function ($relatedService) {
            $relatedService->min_price = $relatedService->servicePrices->min('price');
            return $relatedService;
        });

        return view('public.services.show', compact('service', 'relatedServices'));
    }

    /**
     * Devuelve las categorías de servicios para la selección en el modal de booking.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoriesForBooking()
    {
        $categories = ServiceCategory::with([
            'services' => function ($query) {
                $query->where('is_active', true);
            }
        ])
        ->orderBy('display_order', 'asc')
        ->get(['id', 'name', 'slug', 'description']);

        return response()->json($categories);
    }
    
    /**
     * Devuelve los detalles del servicio "Premium Interior Detail" para el modal.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPremiumInteriorDetailForBooking()
    {
        $service = Service::where('name', 'Premium Interior Detail')
            ->where('is_active', true)
            ->with(['servicePrices.vehicleType', 'category'])
            ->first();
            
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        // Calculate min and max prices
        $minPrice = $service->servicePrices->min('price');
        $maxPrice = $service->servicePrices->max('price');

        // Transform the data into the desired format
        $data = [
            'name' => $service->name,
            'slug' => \Illuminate\Support\Str::slug($service->name),
            'image_path' => asset($service->image_path),
            'description' => $service->notes,
            'features' => $service->features,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
        ];

        return response()->json($data);
    }
}