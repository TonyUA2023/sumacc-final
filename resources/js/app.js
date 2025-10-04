import './bootstrap';

import Alpine from 'alpinejs';

// Importación directa de Livewire desde la carpeta de vendor
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm.js';
Livewire.start();

window.Alpine = Alpine;
Alpine.start();
