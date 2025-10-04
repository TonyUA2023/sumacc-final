<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\ExtraService;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Muestra la vista principal con todos los datos.
     */
    public function index()
    {
        $categories = ServiceCategory::with('services.servicePrices.vehicleType')->orderBy('display_order')->get();
        $extraServices = ExtraService::orderBy('name')->get();
        $vehicleTypes = VehicleType::orderBy('display_order')->get();

        return view('admin.services.index', compact('categories', 'extraServices', 'vehicleTypes'));
    }

    /**
     * Almacena o actualiza un nuevo servicio.
     */
    public function saveService(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:service_categories,id',
            'base_duration_hours' => 'required|numeric|min:0.5',
            'notes' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'features' => 'nullable|array',
            'image_path_file' => 'nullable|image|max:5120',
            'is_active' => 'boolean',
            'prices' => 'required|array',
            'prices.*' => 'nullable|numeric|min:0',
        ]);
        
        $serviceId = $request->input('serviceId');
        
        if ($serviceId) {
            $service = Service::findOrFail($serviceId);
        } else {
            $service = new Service();
        }

        $service->fill($validatedData);

        if ($request->hasFile('image_path_file')) {
            if ($service->image_path) {
                $oldImagePath = Str::after($service->image_path, 'storage/');
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            try {
                $filename = Str::slug($request->name) . '-' . time() . '.' . $request->file('image_path_file')->getClientOriginalExtension();
                $path = $request->file('image_path_file')->storeAs('images/services', $filename, 'public');
                $service->image_path = 'storage/' . $path;
            } catch (\Exception $e) {
                Log::error('Image processing error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while processing the image: ' . $e->getMessage());
            }
        }
        
        // Manejar el array de features correctamente
        $features = [];
        if ($request->has('features')) {
            foreach($request->input('features') as $group) {
                if (isset($group['name']) && is_array($group['features'])) {
                    $features[$group['name']] = array_values(array_filter($group['features']));
                }
            }
        }
        $service->features = $features;
        $service->save();

        foreach ($request->input('prices') as $vehicleTypeId => $price) {
            $service->servicePrices()->updateOrCreate(
                ['vehicle_type_id' => $vehicleTypeId],
                ['price' => $price ?? 0]
            );
        }
        
        $message = $serviceId ? 'Service updated successfully!' : 'Service created successfully!';
        return redirect()->route('admin.services.index')->with('success', $message);
    }
    
    /**
     * Elimina un servicio.
     */
    public function destroyService(Service $service)
    {
        try {
            if ($service->image_path) {
                $imagePath = Str::after($service->image_path, 'storage/');
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $service->delete();
            return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the service.');
        }
    }

    /**
     * Almacena o actualiza una categoría.
     */
    public function saveCategory(Request $request)
    {
        $categoryId = $request->input('categoryIdToEdit');
        
        $validatedData = $request->validate([
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'nullable|string',
            'categoryDisplayOrder' => ['required', 'integer', 'min:1'],
        ]);
        
        try {
            if ($categoryId) {
                $category = ServiceCategory::findOrFail($categoryId);
                $category->update([
                    'name' => $validatedData['categoryName'],
                    'slug' => Str::slug($validatedData['categoryName']),
                    'description' => $validatedData['categoryDescription'],
                    'display_order' => $validatedData['categoryDisplayOrder'],
                ]);
                $message = 'Category updated successfully!';
            } else {
                ServiceCategory::create([
                    'name' => $validatedData['categoryName'],
                    'slug' => Str::slug($validatedData['categoryName']),
                    'description' => $validatedData['categoryDescription'],
                    'display_order' => $validatedData['categoryDisplayOrder'],
                ]);
                $message = 'Category created successfully!';
            }
            return redirect()->route('admin.services.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving category: ' . $e->getMessage());
        }
    }

    /**
     * Elimina una categoría.
     */
    public function destroyCategory(ServiceCategory $category)
    {
        try {
            if ($category->services()->count() > 0) {
                return redirect()->back()->with('error', 'Cannot delete a category with services. Please delete the services first.');
            }
            $category->delete();
            return redirect()->route('admin.services.index')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category.');
        }
    }

    /**
     * Almacena o actualiza un servicio adicional.
     */
    public function saveExtraService(Request $request)
    {
        $extraServiceId = $request->input('extraServiceId');
        
        $validatedData = $request->validate([
            'extraServiceName' => 'required|string|max:255',
            'extraServiceDescription' => 'nullable|string',
            'extraServicePrice' => 'required|numeric|min:0',
            'extraServiceDuration' => 'required|integer|min:0',
        ]);
        
        try {
            if ($extraServiceId) {
                ExtraService::findOrFail($extraServiceId)->update([
                    'name' => $validatedData['extraServiceName'],
                    'description' => $validatedData['extraServiceDescription'],
                    'price' => $validatedData['extraServicePrice'],
                    'estimated_duration_minutes' => $validatedData['extraServiceDuration'],
                ]);
                $message = 'Extra Service updated successfully!';
            } else {
                ExtraService::create([
                    'name' => $validatedData['extraServiceName'],
                    'description' => $validatedData['extraServiceDescription'],
                    'price' => $validatedData['extraServicePrice'],
                    'estimated_duration_minutes' => $validatedData['extraServiceDuration'],
                ]);
                $message = 'Extra Service created successfully!';
            }
            return redirect()->route('admin.services.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving extra service: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene los datos de un servicio específico.
     *
     * @param \App\Models\Service $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function getService(Service $service)
    {
        $service->load('servicePrices');
        return response()->json($service);
    }

    /**
     * Obtiene los datos de una categoría específica.
     *
     * @param \App\Models\ServiceCategory $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategory(ServiceCategory $category)
    {
        return response()->json($category);
    }

    /**
     * Obtiene los datos de un servicio extra específico.
     *
     * @param \App\Models\ExtraService $extraService
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExtraService(ExtraService $extraService)
    {
        return response()->json($extraService);
    }
}