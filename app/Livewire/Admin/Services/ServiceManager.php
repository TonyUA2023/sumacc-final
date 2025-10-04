<?php

namespace App\Livewire\Admin\Services;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ExtraService;
use App\Models\VehicleType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class ServiceManager extends Component
{
    use WithFileUploads;

    public $categories;
    public $extraServices;
    public $vehicleTypes;
    
    public $isEditing = false;
    public $showServiceModal = false;
    public $showExtraServiceModal = false;
    public $showCategoryModal = false;

    public $serviceId;
    public $name;
    public $categoryId;
    public $baseDurationHours;
    public $notes;
    public $recommendation;
    public $features = [];
    public $imagePath;
    public $imagePathFile;
    public $isActive = true;
    public $prices = [];

    public $extraServiceId;
    public $extraServiceName;
    public $extraServiceDescription;
    public $extraServicePrice;
    public $extraServiceDuration;

    public $categoryIdToEdit;
    public $categoryName;
    public $categoryDescription;
    public $categoryDisplayOrder;

    public $showAlert = false;
    public $alertMessage = '';
    public $alertType = 'success';
    
    // Propiedad para el modal de confirmación
    public $confirmType;
    public $confirmId;

    protected $listeners = [
        'editService',
        'editExtraService',
        'editCategory',
        'deleteConfirmed'
    ];
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'categoryId' => 'required|exists:service_categories,id',
        'baseDurationHours' => 'required|numeric|min:0.5',
        'notes' => 'nullable|string',
        'recommendation' => 'nullable|string',
        'features' => 'array',
        'features.*' => 'array',
        'features.*.*' => 'nullable|string|max:255',
        'imagePathFile' => 'nullable|image|max:5120',
        'isActive' => 'boolean',
        'prices' => 'required|array',
        'prices.*' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->categories = ServiceCategory::with('services.servicePrices.vehicleType')->orderBy('display_order')->get();
        $this->extraServices = ExtraService::orderBy('name')->get();
        $this->vehicleTypes = VehicleType::orderBy('display_order')->get();
    }

    public function confirmDelete($type, $id)
    {
        $this->confirmType = $type;
        $this->confirmId = $id;
        $this->dispatch('confirmDeletion', ['type' => $type, 'id' => $id]);
    }

    public function deleteConfirmed($data)
    {
        $type = $data['type'];
        $id = $data['id'];

        try {
            switch ($type) {
                case 'service':
                    $service = Service::find($id);
                    if ($service) {
                        $this->deleteService($service);
                    } else {
                        throw new \Exception('Service not found.');
                    }
                    break;
                case 'category':
                    $category = ServiceCategory::find($id);
                    if ($category) {
                        $this->deleteCategory($category);
                    } else {
                        throw new \Exception('Category not found.');
                    }
                    break;
                case 'extra_service':
                    $extraService = ExtraService::find($id);
                    if ($extraService) {
                        $this->deleteExtraService($extraService);
                    } else {
                        throw new \Exception('Extra service not found.');
                    }
                    break;
            }
        } catch (\Exception $e) {
            $this->flashAlert('An error occurred while deleting: ' . $e->getMessage(), 'error');
            Log::error('Deletion error: ' . $e->getMessage());
        }
        $this->loadData();
    }
    
    private function deleteService(Service $service)
    {
        if ($service->image_path) {
            $imagePath = Str::after($service->image_path, 'storage/');
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        $service->delete();
        $this->flashAlert('Service deleted successfully!', 'success');
    }

    private function deleteCategory(ServiceCategory $category)
    {
        if ($category->services()->count() > 0) {
            throw new \Exception('Cannot delete a category with services. Please delete the services first.');
        }
        $category->delete();
        $this->flashAlert('Category deleted successfully!', 'success');
    }

    private function deleteExtraService(ExtraService $extraService)
    {
        $extraService->delete();
        $this->flashAlert('Extra Service deleted successfully!', 'success');
    }
    
    public function newService()
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showServiceModal = true;
    }

    public function editService($serviceId)
    {
        try {
            $service = Service::with('servicePrices')->findOrFail($serviceId);
            $this->serviceId = $service->id;
            $this->name = $service->name;
            $this->categoryId = $service->category_id;
            $this->baseDurationHours = $service->base_duration_hours;
            $this->notes = $service->notes;
            $this->recommendation = $service->recommendation;
            $this->features = $service->features ?? [];
            $this->imagePath = $service->image_path;
            $this->isActive = $service->is_active;

            $this->prices = [];
            foreach ($this->vehicleTypes as $vt) {
                $price = $service->servicePrices->firstWhere('vehicle_type_id', $vt->id);
                $this->prices[$vt->id] = $price ? $price->price : 0;
            }

            $this->isEditing = true;
            $this->showServiceModal = true;
        } catch (\Exception $e) {
            $this->flashAlert('Error loading service for editing: ' . $e->getMessage(), 'error');
            Log::error('Error in editService: ' . $e->getMessage());
        }
    }

    public function saveService()
    {
        $this->validate();

        $serviceData = [
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'base_duration_hours' => $this->baseDurationHours,
            'notes' => $this->notes,
            'recommendation' => $this->recommendation,
            'features' => $this->features,
            'is_active' => $this->isActive,
        ];
        
        if ($this->imagePathFile) {
            if ($this->isEditing && $this->imagePath) {
                $oldImagePath = Str::after($this->imagePath, 'storage/');
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            try {
                $image = Image::make($this->imagePathFile->getRealPath());

                $image->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $filename = Str::slug($this->name) . '-' . time() . '.' . $this->imagePathFile->getClientOriginalExtension();
                $path = 'images/services/' . $filename;
                Storage::disk('public')->put($path, (string) $image->encode());

                $serviceData['image_path'] = 'storage/' . $path;
            } catch (\Exception $e) {
                $this->flashAlert('An error occurred while processing the image: ' . $e->getMessage(), 'error');
                Log::error('Image processing error: ' . $e->getMessage());
                return;
            }
        } elseif ($this->isEditing) {
            $serviceData['image_path'] = $this->imagePath;
        } else {
            $serviceData['image_path'] = null;
        }

        if ($this->isEditing) {
            $service = Service::find($this->serviceId);
            $service->update($serviceData);
            $this->flashAlert('Service updated successfully!', 'success');
        } else {
            $service = Service::create($serviceData);
            $this->flashAlert('Service created successfully!', 'success');
        }

        foreach ($this->prices as $vehicleTypeId => $price) {
            $service->servicePrices()->updateOrCreate(
                ['vehicle_type_id' => $vehicleTypeId],
                ['price' => $price ?? 0]
            );
        }

        $this->showServiceModal = false;
        $this->loadData();
    }

    public function newExtraService()
    {
        $this->resetExtraServiceForm();
        $this->showExtraServiceModal = true;
    }

    public function editExtraService($extraServiceId)
    {
        try {
            $extraService = ExtraService::findOrFail($extraServiceId);
            $this->extraServiceId = $extraService->id;
            $this->extraServiceName = $extraService->name;
            $this->extraServiceDescription = $extraService->description;
            $this->extraServicePrice = $extraService->price;
            $this->extraServiceDuration = $extraService->estimated_duration_minutes;
            $this->showExtraServiceModal = true;
        } catch (\Exception $e) {
            $this->flashAlert('Error loading extra service for editing: ' . $e->getMessage(), 'error');
        }
    }

    public function saveExtraService()
    {
        $validatedData = $this->validate([
            'extraServiceName' => 'required|string|max:255',
            'extraServiceDescription' => 'nullable|string',
            'extraServicePrice' => 'required|numeric|min:0',
            'extraServiceDuration' => 'required|integer|min:0',
        ]);
        
        try {
            if ($this->extraServiceId) {
                ExtraService::find($this->extraServiceId)->update([
                    'name' => $this->extraServiceName,
                    'description' => $this->extraServiceDescription,
                    'price' => $this->extraServicePrice,
                    'estimated_duration_minutes' => $this->extraServiceDuration,
                ]);
                $this->flashAlert('Extra Service updated successfully!', 'success');
            } else {
                ExtraService::create([
                    'name' => $this->extraServiceName,
                    'description' => $this->extraServiceDescription,
                    'price' => $this->extraServicePrice,
                    'estimated_duration_minutes' => $this->extraServiceDuration,
                ]);
                $this->flashAlert('Extra Service created successfully!', 'success');
            }
    
            $this->showExtraServiceModal = false;
            $this->loadData();
        } catch (\Exception $e) {
            $this->flashAlert('Error saving extra service: ' . $e->getMessage(), 'error');
        }
    }
    
    public function newCategory()
    {
        $this->resetCategoryForm();
        $this->showCategoryModal = true;
    }

    public function editCategory($categoryId)
    {
        try {
            $category = ServiceCategory::findOrFail($categoryId);
            $this->categoryIdToEdit = $category->id;
            $this->categoryName = $category->name;
            $this->categoryDescription = $category->description;
            $this->categoryDisplayOrder = $category->display_order;
            $this->showCategoryModal = true;
        } catch (\Exception $e) {
            $this->flashAlert('Error loading category for editing: ' . $e->getMessage(), 'error');
        }
    }

    public function saveCategory()
    {
        $validatedData = $this->validate([
            'categoryName' => 'required|string|max:255',
            'categoryDescription' => 'nullable|string',
            'categoryDisplayOrder' => 'required|integer|min:1',
        ]);
    
        try {
            if ($this->categoryIdToEdit) {
                $category = ServiceCategory::find($this->categoryIdToEdit);
                $category->update([
                    'name' => $this->categoryName,
                    'slug' => Str::slug($this->categoryName),
                    'description' => $this->categoryDescription,
                    'display_order' => $this->categoryDisplayOrder,
                ]);
                $this->flashAlert('Category updated successfully!', 'success');
            } else {
                ServiceCategory::create([
                    'name' => $this->categoryName,
                    'slug' => Str::slug($this->categoryName),
                    'description' => $this->categoryDescription,
                    'display_order' => $this->categoryDisplayOrder,
                ]);
                $this->flashAlert('Category created successfully!', 'success');
            }
        
            $this->showCategoryModal = false;
            $this->loadData();
        } catch (\Exception $e) {
            $this->flashAlert('Error saving category: ' . $e->getMessage(), 'error');
        }
    }
    
    public function resetForm()
    {
        $this->reset([
            'serviceId', 'name', 'categoryId', 'baseDurationHours', 'notes',
            'recommendation', 'isActive', 'imagePath', 'imagePathFile', 'features', 'prices'
        ]);
        $this->features = [];
        $this->prices = collect($this->vehicleTypes)->mapWithKeys(fn($vt) => [$vt->id => 0])->toArray();
    }

    public function resetExtraServiceForm()
    {
        $this->reset([
            'extraServiceId', 'extraServiceName', 'extraServiceDescription', 
            'extraServicePrice', 'extraServiceDuration'
        ]);
    }

    public function resetCategoryForm()
    {
        $this->reset([
            'categoryIdToEdit', 'categoryName', 'categoryDescription', 'categoryDisplayOrder'
        ]);
    }

    public function addFeatureGroup()
    {
        $this->features[] = [''];
    }

    public function removeFeatureGroup($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addFeature($index)
    {
        if (isset($this->features[$index])) {
            $this->features[$index][] = '';
        }
    }

    public function removeFeature($groupIndex, $featureIndex)
    {
        if (isset($this->features[$groupIndex][$featureIndex])) {
            unset($this->features[$groupIndex][$featureIndex]);
            $this->features[$groupIndex] = array_values($this->features[$groupIndex]);
        }
    }
    
    public function flashAlert($message, $type = 'success')
    {
        $this->alertMessage = $message;
        $this->alertType = $type;
        $this->showAlert = true;
    }

    public function clearAlert()
    {
        $this->showAlert = false;
        $this->alertMessage = '';
        $this->alertType = 'success';
    }

    public function render()
    {
        return view('livewire.admin.services.service-manager');
    }
}