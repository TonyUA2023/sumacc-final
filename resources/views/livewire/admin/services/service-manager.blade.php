<div class="relative">
    {{-- Notificación de éxito/error --}}
    <div x-data="{ show: @entangle('showAlert'), alertMessage: @entangle('alertMessage'), alertType: @entangle('alertType') }"
         x-show="show" 
         x-init="setTimeout(() => { show = false; @this.call('clearAlert'); }, 5000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed top-5 right-5 z-50 p-4 rounded-md shadow-lg transition-all duration-300 transform"
         :class="{
             'bg-green-100 border border-green-400 text-green-700': alertType === 'success',
             'bg-red-100 border border-red-400 text-red-700': alertType === 'error'
         }">
        <div class="flex items-center">
            <template x-if="alertType === 'success'">
                <i class="fas fa-check-circle mr-2 text-green-500 text-lg"></i>
            </template>
            <template x-if="alertType === 'error'">
                <i class="fas fa-exclamation-triangle mr-2 text-red-500 text-lg"></i>
            </template>
            <span x-text="alertMessage" class="font-semibold"></span>
            <button @click="show = false; @this.call('clearAlert');" class="ml-4 text-lg"
                    :class="{
                        'text-green-700 hover:text-green-900': alertType === 'success',
                        'text-red-700 hover:text-red-900': alertType === 'error'
                    }">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    
    {{-- Botones de acción globales --}}
    <div class="flex justify-end mb-6 space-x-4">
        <button wire:click="newCategory" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i> Add Category
        </button>
        <button wire:click="newService" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i> Add Service
        </button>
        <button wire:click="newExtraService" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i> Add Extra Service
        </button>
    </div>

    {{-- Sección de Servicios por Categoría --}}
    <div class="space-y-8">
        @foreach ($categories as $category)
            <div class="bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <h3 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h3>
                        <button wire:click="editCategory({{ $category->id }})" class="text-blue-500 hover:text-blue-700 transition-colors duration-200">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <p class="text-sm text-gray-500 mt-1">{{ $category->description }}</p>
                        <button wire:click="confirmDelete('category', {{ $category->id }})" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($category->services as $service)
                        <div class="bg-gray-100 rounded-lg overflow-hidden flex flex-col shadow-inner hover:shadow-lg transition-shadow duration-200">
                            <div class="relative h-48 bg-cover bg-center group" style="background-image: url('{{ asset($service->image_path ?? 'images/default-service.jpg') }}');">
                                <button wire:click="editService({{ $service->id }})" class="absolute top-2 right-2 p-2 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    <i class="fas fa-pencil-alt text-gray-600"></i>
                                </button>
                            </div>

                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-xl font-bold text-gray-900">{{ $service->name }}</h4>
                                        <div class="flex space-x-2">
                                            <button wire:click="editService({{ $service->id }})" class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete('service', {{ $service->id }})" class="text-gray-400 hover:text-red-600 transition-colors duration-200">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $service->notes ?? $service->recommendation }}</p>
                                </div>
                                
                                <div class="mt-4">
                                    <h5 class="font-semibold text-gray-700 mb-2">Features:</h5>
                                    <div class="space-y-2">
                                        @foreach ($service->features ?? [] as $groupName => $featuresList)
                                            <div class="text-sm">
                                                <span class="font-medium text-gray-800">{{ $groupName }}:</span>
                                                <ul class="list-disc list-inside text-gray-600 ml-4">
                                                    @foreach ($featuresList as $feature)
                                                        <li>{{ $feature }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-semibold text-gray-700 mb-2">Pricing:</h5>
                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        @foreach ($service->servicePrices->sortBy('vehicleType.display_order') as $price)
                                            <div class="flex justify-between items-center bg-white p-2 rounded-md border border-gray-200 shadow-sm">
                                                <span class="font-medium text-gray-800">{{ $price->vehicleType->name }}</span>
                                                <span class="text-gray-900 font-bold">${{ number_format($price->price, 2) }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 col-span-full">No services found for this category.</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

    {{-- Sección de Servicios Adicionales --}}
    <div class="mt-12 bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800">Extra Services</h3>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($extraServices as $extraService)
                <div class="bg-gray-100 rounded-lg p-5 flex flex-col shadow-inner hover:shadow-md transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-lg font-bold text-gray-800">{{ $extraService->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $extraService->description }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button wire:click="editExtraService({{ $extraService->id }})" class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete('extra_service', {{ $extraService->id }})" class="text-gray-400 hover:text-red-600 transition-colors duration-200">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($extraService->price, 2) }}</span>
                        <span class="text-sm text-gray-500">{{ $extraService->estimated_duration_minutes }} min</span>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full">No extra services found.</p>
            @endforelse
        </div>
    </div>

    {{-- MODAL PARA SERVICIOS --}}
    @if($showServiceModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" wire:click.self="$set('showServiceModal', false)">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl p-8 max-h-[90vh] overflow-y-auto">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $isEditing ? 'Edit Service' : 'Add New Service' }}</h3>
                <form wire:submit.prevent="saveService">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Detalles del Servicio --}}
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                                <input type="text" id="name" wire:model.defer="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="categoryId" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="categoryId" wire:model.defer="categoryId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="baseDurationHours" class="block text-sm font-medium text-gray-700">Base Duration (hours)</label>
                                <input type="number" step="0.5" id="baseDurationHours" wire:model.defer="baseDurationHours" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('baseDurationHours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea id="notes" wire:model.defer="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="recommendation" class="block text-sm font-medium text-gray-700">Recommendation</label>
                                <textarea id="recommendation" wire:model.defer="recommendation" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('recommendation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            {{-- Campo para subir imagen --}}
                            <div>
                                <label for="imagePathFile" class="block text-sm font-medium text-gray-700">Service Image</label>
                                <div class="mt-2 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        @if ($imagePathFile)
                                            <img src="{{ $imagePathFile->temporaryUrl() }}" class="h-24 w-24 rounded-lg object-cover">
                                        @elseif ($imagePath)
                                            <img src="{{ asset($imagePath) }}" class="h-24 w-24 rounded-lg object-cover">
                                        @else
                                            <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 text-center text-sm">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <label for="imagePathFile" class="cursor-pointer bg-violet-50 text-violet-700 py-2 px-4 rounded-full border border-violet-700 hover:bg-violet-100 transition-colors duration-200 text-sm font-semibold">
                                            Reemplazar Foto
                                        </label>
                                        <input type="file" id="imagePathFile" wire:model="imagePathFile" class="hidden" accept="image/*">
                                        @error('imagePathFile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Precios por Vehículo --}}
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Pricing by Vehicle Type</h4>
                                <div class="space-y-2">
                                    @foreach($vehicleTypes as $vt)
                                        <div>
                                            <label for="price-{{ $vt->id }}" class="block text-sm font-medium text-gray-700">{{ $vt->name }}</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">$</span>
                                                <input type="number" step="0.01" id="price-{{ $vt->id }}" wire:model.defer="prices.{{ $vt->id }}" class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            </div>
                                            @error("prices.{$vt->id}") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Features --}}
                            <div class="mt-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Features</h4>
                                <div class="space-y-4">
                                    @foreach($features as $group => $items)
                                        <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                            <div class="flex justify-between items-center mb-2">
                                                <input type="text" wire:model.defer="features.{{ $group }}" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Feature Group Title">
                                                <button type="button" wire:click="removeFeatureGroup('{{ $group }}')" class="ml-2 text-red-500 hover:text-red-700"><i class="fas fa-times-circle"></i></button>
                                            </div>
                                            <ul class="space-y-2">
                                                @foreach($items as $index => $item)
                                                    <li class="flex items-center space-x-2">
                                                        <i class="fas fa-check-circle text-green-500"></i>
                                                        <input type="text" wire:model.defer="features.{{ $group }}.{{ $index }}" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Feature description">
                                                        <button type="button" wire:click="removeFeature('{{ $group }}', {{ $index }})" class="text-red-500 hover:text-red-700"><i class="fas fa-minus-circle"></i></button>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <button type="button" wire:click="addFeature('{{ $group }}')" class="text-blue-500 hover:text-blue-700 text-sm font-semibold mt-2"><i class="fas fa-plus mr-1"></i> Add Feature</button>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                    <button type="button" wire:click="addFeatureGroup" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md shadow-md transition-colors duration-200 mt-4">
                                        <i class="fas fa-layer-group mr-2"></i> Add Feature Group
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" wire:click="$set('showServiceModal', false)" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors duration-200" wire:loading.attr="disabled" wire:target="saveService">
                            <span wire:loading.remove wire:target="saveService">Save Service</span>
                            <span wire:loading wire:target="saveService">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- MODAL PARA EXTRA SERVICES --}}
    @if($showExtraServiceModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" wire:click.self="$set('showExtraServiceModal', false)">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $extraServiceId ? 'Edit Extra Service' : 'Add New Extra Service' }}</h3>
                <form wire:submit.prevent="saveExtraService">
                    <div class="space-y-4">
                        <div>
                            <label for="extraServiceName" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="extraServiceName" wire:model.defer="extraServiceName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServiceName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServiceDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="extraServiceDescription" wire:model.defer="extraServiceDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('extraServiceDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServicePrice" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" id="extraServicePrice" wire:model.defer="extraServicePrice" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServicePrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServiceDuration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" step="1" id="extraServiceDuration" wire:model.defer="extraServiceDuration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServiceDuration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="$set('showExtraServiceModal', false)" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white font-semibold rounded-md" wire:loading.attr="disabled" wire:target="saveExtraService">
                            <span wire:loading.remove wire:target="saveExtraService">Save Extra Service</span>
                            <span wire:loading wire:target="saveExtraService">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- MODAL PARA CATEGORÍAS --}}
    @if($showCategoryModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4" wire:click.self="$set('showCategoryModal', false)">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $categoryIdToEdit ? 'Edit Category' : 'Add New Category' }}</h3>
                <form wire:submit.prevent="saveCategory">
                    <div class="space-y-4">
                        <div>
                            <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" id="categoryName" wire:model.defer="categoryName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('categoryName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="categoryDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="categoryDescription" wire:model.defer="categoryDescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('categoryDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="categoryDisplayOrder" class="block text-sm font-medium text-gray-700">Display Order</label>
                            <input type="number" id="categoryDisplayOrder" wire:model.defer="categoryDisplayOrder" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('categoryDisplayOrder') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" wire:click="$set('showCategoryModal', false)" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md" wire:loading.attr="disabled" wire:target="saveCategory">
                            <span wire:loading.remove wire:target="saveCategory">Save Category</span>
                            <span wire:loading wire:target="saveCategory">
                                <i class="fas fa-spinner fa-spin mr-2"></i> Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    
    {{-- Modal de confirmación de eliminación --}}
    <div x-data="{ show: false, type: null, id: null }"
         x-show="show"
         x-on:confirm-deletion.window="show = true; type = $event.detail.type; id = $event.detail.id;"
         class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">
            <div class="text-center">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Deletion</h3>
                <p class="text-gray-600">Are you sure you want to delete this {{ $type ?? '' }}? This action cannot be undone.</p>
            </div>
            <div class="mt-6 flex justify-center space-x-4">
                <button @click="show = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300">Cancel</button>
                <button wire:click="deleteConfirmed(type, id)" @click="show = false" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
</div>