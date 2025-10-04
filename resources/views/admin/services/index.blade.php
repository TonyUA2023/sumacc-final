@extends('layouts.app')

@section('title', 'Services Management')

@section('content')
    <div class=" p-4 md:p-6 lg:p-8" x-data="{
        showServiceModal: false,
        showExtraServiceModal: false,
        showCategoryModal: false,
        showDeleteModal: false,
        
        // Variables para los formularios
        serviceData: {
            id: '',
            name: '',
            categoryId: '',
            baseDurationHours: '',
            notes: '',
            recommendation: '',
            imagePath: '',
            features: [], // Cambiado a un array
            prices: {},
        },
        extraServiceData: {
            id: '',
            name: '',
            description: '',
            price: '',
            duration: '',
        },
        categoryData: {
            id: '',
            name: '',
            description: '',
            displayOrder: '',
        },
        confirmData: {
            type: '',
            id: '',
        },

        // Funciones para abrir los modales
        openServiceModal(id = null) {
            if (id) {
                // Modo edición
                this.resetServiceForm();
                fetch(`{{ url('admin/api/services') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        this.serviceData = {
                            id: data.id,
                            name: data.name,
                            categoryId: data.category_id,
                            baseDurationHours: data.base_duration_hours,
                            notes: data.notes,
                            recommendation: data.recommendation,
                            imagePath: data.image_path,
                            // Convertir el objeto de features del backend a un array de objetos
                            features: Object.entries(data.features || {}).map(([name, features]) => ({
                                name: name,
                                features: features
                            })),
                            prices: Object.fromEntries(data.service_prices.map(p => [p.vehicle_type_id, p.price]))
                        };
                        this.showServiceModal = true;
                    });
            } else {
                // Modo creación
                this.resetServiceForm();
                this.showServiceModal = true;
            }
        },
        openExtraServiceModal(id = null) {
            if (id) {
                // Modo edición
                this.resetExtraServiceForm();
                fetch(`{{ url('admin/api/extra-services') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        this.extraServiceData = {
                            id: data.id,
                            name: data.name,
                            description: data.description,
                            price: data.price,
                            duration: data.estimated_duration_minutes,
                        };
                        this.showExtraServiceModal = true;
                    });
            } else {
                // Modo creación
                this.resetExtraServiceForm();
                this.showExtraServiceModal = true;
            }
        },
        openCategoryModal(id = null) {
            if (id) {
                // Modo edición
                this.resetCategoryForm();
                fetch(`{{ url('admin/api/categories') }}/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        this.categoryData = {
                            id: data.id,
                            name: data.name,
                            description: data.description,
                            displayOrder: data.display_order,
                        };
                        this.showCategoryModal = true;
                    });
            } else {
                // Modo creación
                this.resetCategoryForm();
                this.showCategoryModal = true;
            }
        },
        
        confirmDelete(type, id) {
            this.confirmData.type = type;
            this.confirmData.id = id;
            this.showDeleteModal = true;
        },
        
        // Funciones para resetear los formularios
        resetServiceForm() {
            this.serviceData = {
                id: '', name: '', categoryId: '', baseDurationHours: '', notes: '', recommendation: '', imagePath: '', features: [], prices: {}
            };
        },
        resetExtraServiceForm() {
            this.extraServiceData = { id: '', name: '', description: '', price: '', duration: '' };
        },
        resetCategoryForm() {
            this.categoryData = { id: '', name: '', description: '', displayOrder: '' };
        }
    }">
        {{-- Notificación de éxito/error --}}
        @if(session('success'))
        <div x-data="{ show: true }"
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="fixed top-5 right-5 z-50 p-4 rounded-md shadow-lg transition-all duration-300 transform bg-green-100 border border-green-400 text-green-700">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2 text-green-500 text-lg"></i>
                <span class="font-semibold">{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-lg text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif
        
        @if(session('error'))
        <div x-data="{ show: true }"
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             class="fixed top-5 right-5 z-50 p-4 rounded-md shadow-lg transition-all duration-300 transform bg-red-100 border border-red-400 text-red-700">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-2 text-red-500 text-lg"></i>
                <span class="font-semibold">{{ session('error') }}</span>
                <button @click="show = false" class="ml-4 text-lg text-red-700 hover:text-red-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif
        
        {{-- Botones de acción globales ahora llaman a las nuevas funciones --}}
        <div class="flex justify-end mb-6 space-x-4">
            <button @click="openCategoryModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i> Add Category
            </button>
            <button @click="openServiceModal()" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i> Add Service
            </button>
            <button @click="openExtraServiceModal()" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors duration-200">
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
                            <button @click="openCategoryModal('{{ $category->id }}')" class="text-blue-500 hover:text-blue-700 transition-colors duration-200">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </div>
                        <div class="flex items-center space-x-2">
                            <p class="text-sm text-gray-500 mt-1">{{ $category->description }}</p>
                            <button @click="confirmDelete('category', '{{ $category->id }}')" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($category->services as $service)
                            <div class="bg-gray-100 rounded-lg overflow-hidden flex flex-col shadow-inner hover:shadow-lg transition-shadow duration-200">
                                <div class="relative h-48 bg-cover bg-center group" style="background-image: url('{{ asset($service->image_path ?? 'images/default-service.jpg') }}');">
                                    <button @click="openServiceModal('{{ $service->id }}')" class="absolute top-2 right-2 p-2 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <i class="fas fa-pencil-alt text-gray-600"></i>
                                    </button>
                                </div>

                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-xl font-bold text-gray-900">{{ $service->name }}</h4>
                                            <div class="flex space-x-2">
                                                <button @click="openServiceModal('{{ $service->id }}')" class="text-gray-400 hover:text-blue-600 transition-colors duration-200">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button @click="confirmDelete('service', '{{ $service->id }}')" class="text-gray-400 hover:text-red-600 transition-colors duration-200">
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
                                                            {{-- Corrección del error de tipo: comprueba si la característica es una cadena antes de mostrarla --}}
                                                            @if (is_string($feature))
                                                                <li>{{ $feature }}</li>
                                                            @endif
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

        {{-- MODAL PARA SERVICIOS --}}
        <div x-show="showServiceModal" 
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-600 bg-opacity-75 overflow-y-auto">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl p-8 max-h-[90vh] overflow-y-auto">
                <button @click="showServiceModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 id="service-modal-title" class="text-2xl font-bold text-gray-900 mb-6" x-text="serviceData.id ? 'Edit Service' : 'Add New Service'"></h3>
                <form id="service-form" method="POST" action="{{ route('admin.services.save-service') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="serviceId" x-bind:value="serviceData.id">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Detalles del Servicio --}}
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Service Name</label>
                                <input type="text" id="name" name="name" x-bind:value="serviceData.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="categoryId" class="block text-sm font-medium text-gray-700">Category</label>
                                <select id="categoryId" name="category_id" x-bind:value="serviceData.categoryId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="baseDurationHours" class="block text-sm font-medium text-gray-700">Base Duration (hours)</label>
                                <input type="number" step="0.5" id="baseDurationHours" name="base_duration_hours" x-bind:value="serviceData.baseDurationHours" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('base_duration_hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea id="notes" name="notes" x-bind:value="serviceData.notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="recommendation" class="block text-sm font-medium text-gray-700">Recommendation</label>
                                <textarea id="recommendation" name="recommendation" x-bind:value="serviceData.recommendation" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('recommendation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            {{-- Campo para subir imagen --}}
                            <div>
                                <label for="imagePathFile" class="block text-sm font-medium text-gray-700">Service Image</label>
                                <div class="mt-2 flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img id="service-image-preview" x-bind:src="serviceData.imagePath ? `{{ asset('') }}${serviceData.imagePath}` : '{{ asset('images/default-service.jpg') }}'" class="h-24 w-24 rounded-lg object-cover">
                                    </div>
                                    <div>
                                        <label for="imagePathFile" class="cursor-pointer bg-violet-50 text-violet-700 py-2 px-4 rounded-full border border-violet-700 hover:bg-violet-100 transition-colors duration-200 text-sm font-semibold">
                                            Reemplazar Foto
                                        </label>
                                        <input type="file" id="imagePathFile" name="image_path_file" class="hidden" accept="image/*" onchange="previewImage(event, 'service-image-preview')">
                                        @error('image_path_file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Precios por Vehículo y Features --}}
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">Pricing by Vehicle Type</h4>
                                <div class="space-y-2">
                                    @foreach($vehicleTypes as $vt)
                                        <div>
                                            <label for="price-{{ $vt->id }}" class="block text-sm font-medium text-gray-700">{{ $vt->name }}</label>
                                            <div class="mt-1 flex rounded-md shadow-sm">
                                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">$</span>
                                                <input type="number" step="0.01" id="price-{{ $vt->id }}" name="prices[{{ $vt->id }}]" x-bind:value="serviceData.prices['{{ $vt->id }}'] || ''" class="flex-1 block w-full rounded-r-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                                    {{-- Contenedor para los grupos de features --}}
                                    <template x-for="(group, groupIndex) in serviceData.features" :key="groupIndex">
                                        <div class="border border-gray-300 rounded-md p-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <input type="text"
                                                       x-model="group.name"
                                                       :name="`features[${groupIndex}][name]`"
                                                       class="font-semibold text-gray-700 w-full bg-transparent border-none focus:outline-none p-0"
                                                       placeholder="Group Name">
                                                <button type="button" @click="serviceData.features.splice(groupIndex, 1)" class="text-red-500 hover:text-red-700 ml-2">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                            <div class="space-y-2 mt-2">
                                                <template x-for="(feature, featureIndex) in group.features" :key="featureIndex">
                                                    <div class="flex items-center space-x-2">
                                                        <input type="text"
                                                               x-model="group.features[featureIndex]"
                                                               :name="`features[${groupIndex}][features][]`"
                                                               class="flex-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                               placeholder="Feature description">
                                                        <button type="button" @click="group.features.splice(featureIndex, 1)" class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-minus-circle"></i>
                                                        </button>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="mt-2 flex justify-end">
                                                <button type="button" @click="group.features.push('')" class="text-blue-500 hover:text-blue-700 text-sm font-semibold">
                                                    <i class="fas fa-plus-circle mr-1"></i> Add Feature
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                    
                                    {{-- Botón para añadir un nuevo grupo de features --}}
                                    <div class="flex justify-center mt-4">
                                        <button type="button" 
                                                @click="serviceData.features.push({ name: 'New Group', features: [''] })" 
                                                class="bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-md hover:bg-gray-300 transition-colors duration-200">
                                            <i class="fas fa-plus mr-2"></i> Add Feature Group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="showServiceModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300 transition-colors duration-200">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition-colors duration-200">Save Service</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL PARA EXTRA SERVICES --}}
        <div x-show="showExtraServiceModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-600 bg-opacity-75 overflow-y-auto">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-lg p-8">
                <button @click="showExtraServiceModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 id="extra-service-modal-title" class="text-2xl font-bold text-gray-900 mb-6" x-text="extraServiceData.id ? 'Edit Extra Service' : 'Add New Extra Service'"></h3>
                <form id="extra-service-form" method="POST" action="{{ route('admin.services.save-extra-service') }}">
                    @csrf
                    <input type="hidden" name="extraServiceId" x-bind:value="extraServiceData.id">
                    <div class="space-y-4">
                        <div>
                            <label for="extraServiceName" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="extraServiceName" name="extraServiceName" x-bind:value="extraServiceData.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServiceName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServiceDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="extraServiceDescription" name="extraServiceDescription" x-bind:value="extraServiceData.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('extraServiceDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServicePrice" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" step="0.01" id="extraServicePrice" name="extraServicePrice" x-bind:value="extraServiceData.price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServicePrice') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="extraServiceDuration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                            <input type="number" step="1" id="extraServiceDuration" name="extraServiceDuration" x-bind:value="extraServiceData.duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('extraServiceDuration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" @click="showExtraServiceModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white font-semibold rounded-md">Save Extra Service</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL PARA CATEGORÍAS --}}
        <div x-show="showCategoryModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-600 bg-opacity-75 overflow-y-auto">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-8">
                <button @click="showCategoryModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <h3 id="category-modal-title" class="text-2xl font-bold text-gray-900 mb-6" x-text="categoryData.id ? 'Edit Category' : 'Add New Category'"></h3>
                <form id="category-form" method="POST" action="{{ route('admin.services.save-category') }}">
                    @csrf
                    <input type="hidden" name="categoryIdToEdit" x-bind:value="categoryData.id">
                    <div class="space-y-4">
                        <div>
                            <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" id="categoryName" name="categoryName" x-bind:value="categoryData.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('categoryName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="categoryDescription" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="categoryDescription" name="categoryDescription" x-bind:value="categoryData.description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('categoryDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="categoryDisplayOrder" class="block text-sm font-medium text-gray-700">Display Order</label>
                            <input type="number" id="categoryDisplayOrder" name="categoryDisplayOrder" x-bind:value="categoryData.displayOrder" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('categoryDisplayOrder') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-4">
                        <button type="button" @click="showCategoryModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
        
        {{-- Modal de confirmación de eliminación --}}
        <div x-show="showDeleteModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-600 bg-opacity-75 overflow-y-auto">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">
                <button @click="showDeleteModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Deletion</h3>
                    <p class="text-gray-600">Are you sure you want to delete this <span x-text="confirmData.type"></span>? This action cannot be undone.</p>
                </div>
                <div class="mt-6 flex justify-center space-x-4">
                    <button @click="showDeleteModal = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-md hover:bg-gray-300">Cancel</button>
                    <form x-bind:action="`/admin/services/${confirmData.id}/destroy-${confirmData.type}`" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        [x-cloak] { display: none !important; }
        .fixed.inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
    </style>
@endpush

@push('scripts')
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById(previewId);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush